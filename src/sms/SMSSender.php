<?php

namespace sms;

use hfc\exception\ParameterErrorException;
use user\fund\AccountManager;
use sms\entity\SMSContent;
use sms\entity\SMSInfo;
use hhp\App;
use sms\entity\ClientInfo;
use sms\entity\SMS;

/**
 *
 * @author Jejim
 *        
 */
class SMSSender {
	
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
	public function send (ClientInfo $client, $phonenums, $msg, $subPort, $msgId) {
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
			$accountManager->deduct($client->userId, $amount, 'send ' . count($phonenumArr) . ' sms.');
		} catch (\Exception $e) {
			$status = SMS::STATUS_NO_MONEY;
		}
		
		try {
			$gf = new SMSGatewayFactory();
			$g = $gf->getDefaultGateway();
			list ($ret, $gatewayMsgId) = $g->send($phonenumArr, $msg, $subPort, $msgId);
		} catch (\Exception $e) {
			$status = SMS::STATUS_GATEWAY_ERROR;
		}
		
		$status = $ret ? SMS::STATUS_SEND_OK : SMS::STATUS_GATEWAY_ERROR;
		
		$this->log($client->getUserId(), $phonenumArr, $msg, $subPort, $msgId, $status);
		
		return $ret;
	}

	public function log ($userId, $phonenumArr, $msg, $subPort, $msgId, $status) {
		$smsContent = new SMSContent();
		$smsContent->userId = $userId;
		$smsContent->msg = $msg;
		$smsContent->subPort = $subPort;
		$smsContent->userMsgId = $msgId;
		
		$orm = App::Instance()->getService('orm');
		foreach ($phonenumArr as $phonenum) {
			$sms = new SMS();
			$sms->receiver = $phonenum;
			$sms->content = $smsContent;
			$sms->status = $status;
			$sms->createTime = new \DateTime();
			
			$orm->save($sms);
		}
	}
}