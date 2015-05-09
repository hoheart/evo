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
		
		$status = SMSContent::STATUS_SENDING;
		
		try {
			// 进行扣款
			$accountManager = new AccountManager();
			$amount = count($phonenumArr) * $client->price;
			$accountManager->deduct($client->userId, $amount, 'send ' . count($phonenumArr) . ' sms.');
		} catch (\Exception $e) {
			$status = SMSContent::STATUS_NO_MONEY;
		}
		
		try {
			$gf = new SMSGatewayFactory();
			$g = $gf->getGateway($client);
			$msg = '【' . $client->getSign() . '】' . $msg;
			list ($ret, $gatewayMsgId) = $g->send($phonenumArr, $msg, $subPort, $msgId);
		} catch (\Exception $e) {
			$status = SMSContent::STATUS_GATEWAY_ERROR;
		}
		
		$status = $ret ? SMSContent::STATUS_SEND_OK : SMSContent::STATUS_GATEWAY_ERROR;
		
		$this->log($client->id, $phonenumArr, $msg, $subPort, $msgId, $gatewayMsgId, $status);
		
		if (! $ret) {
			throw new CallGatewayErrorException();
		}
	}

	public function log ($clientId, $phonenumArr, $msg, $subPort, $userMsgId, $gatewayMsgId, $status) {
		$smsContent = new SMSContent();
		$smsContent->clientId = $clientId;
		$smsContent->msg = $msg;
		$smsContent->subPort = $subPort;
		$smsContent->userMsgId = $userMsgId;
		$smsContent->status = $status;
		
		$orm = App::Instance()->getService('orm');
		foreach ($phonenumArr as $phonenum) {
			$sms = new SMS();
			$sms->receiver = $phonenum;
			$sms->content = $smsContent;
			$sms->msgId = $gatewayMsgId;
			$sms->clientId = $clientId;
			
			$orm->save($sms);
		}
	}
}
