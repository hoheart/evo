<?php

namespace SMS;

use HFC\Exception\ParameterErrorException;
use SMS\Exception\CallGatewayErrorException;
use User\Fund\AccountManager;
use SMS\Entity\SMSContent;
use HHP\App;
use SMS\Entity\ClientInfo;
use SMS\Entity\SMS;
use HHP\Singleton;
use User\Fund\Exception\NotSufficientFundsException;

/**
 *
 * @author Jejim
 *        
 */
class SMSSender extends Singleton {
	
	/**
	 * 一次群发的最大消息条数
	 *
	 * @var integer
	 */
	const MAX_PHONENUM_AMOUNT = 100;

	public function __construct () {
	}

	/**
	 *
	 * @param string $userId        	
	 * @param string $phonenums        	
	 * @param string $msg        	
	 * @param string $subPort        	
	 * @param string $msgId        	
	 */
	public function send (ClientInfo $client, $phonenums, $msg, $subPort = '', $msgId = '') {
		$ret = explode(',', $phonenums);
		$phonenumArr = array();
		foreach ($ret as $phonenum) {
			$one = trim($phonenum);
			if (empty($one)) {
				continue;
			}
			
			if (! is_numeric($one) || count($phonenumArr) > self::MAX_PHONENUM_AMOUNT) {
				throw new ParameterErrorException('phonenums amount exceed the limit.');
			}
			
			$phonenumArr[] = $one;
		}
		
		$status = SMS::STATUS_SENDING;
		
		try {
			// 进行扣款
			$accountManager = new AccountManager();
			$amount = count($phonenumArr) * $client->price;
			// 因为多条消息一起发送，只记录一次消费记录，消费记录里不记录extId
			$accountManager->deduct($client->userId, $amount, 0, 'send ' . count($phonenumArr) . ' sms.');
			
			$gf = new SMSGatewayFactory();
			$g = $gf->getGateway($client);
			$msg = '【' . $client->getSign() . '】' . $msg . '退订回N';
			list ($ret, $gatewayMsgId) = $g->send($phonenumArr, $msg, $subPort, $msgId);
		} catch (NotSufficientFundsException $e) {
			$status = SMS::STATUS_NO_MONEY;
		} catch (\Exception $e) {
			$status = SMS::STATUS_SEND_ERROR;
		}
		
		$status = $ret ? SMS::STATUS_SEND_OK : SMS::STATUS_GATEWAY_ERROR;
		
		$this->log($client->id, $phonenumArr, $msg, $subPort, $msgId, $gatewayMsgId, $status, $client->price);
		
		if (null != $e) {
			throw $e;
		}
		
		if (! $ret) {
			throw new CallGatewayErrorException();
		}
		
		return $ret;
	}

	public function log ($clientId, $phonenumArr, $msg, $subPort, $userMsgId, $gatewayMsgId, $status, $price) {
		$smsContent = new SMSContent();
		$smsContent->clientId = $clientId;
		$smsContent->msg = $msg;
		$smsContent->subPort = $subPort;
		$smsContent->userMsgId = $userMsgId;
		$smsContent->price = $price;
		
		$orm = App::Instance()->getService('orm');
		foreach ($phonenumArr as $phonenum) {
			$sms = new SMS();
			$sms->receiver = $phonenum;
			$sms->content = $smsContent;
			$sms->msgId = $gatewayMsgId;
			$sms->clientId = $clientId;
			$sms->status = $status;
			
			$orm->save($sms);
		}
	}
}
