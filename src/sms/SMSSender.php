<?php

namespace sms;

use hfc\exception\ParameterErrorException;
use sms\exception\CallGatewayErrorException;
use user\fund\AccountManager;
use sms\entity\SMSContent;
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
			$g = $gf->getDefaultGateway();
			list ($ret, $gatewayMsgId) = $g->send($phonenumArr, $msg, $subPort, $msgId);
		} catch (\Exception $e) {
			$status = SMSContent::STATUS_GATEWAY_ERROR;
		}
		
		$status = $ret ? SMSContent::STATUS_SEND_OK : SMSContent::STATUS_GATEWAY_ERROR;
		
		$this->log($client->getUserId(), $phonenumArr, $msg, $subPort, $msgId, $gatewayMsgId, $status);
		
		if (! $ret) {
			throw new CallGatewayErrorException();
		}
	}

	public function log ($userId, $phonenumArr, $msg, $subPort, $userMsgId, $gatewayMsgId, $status) {
		$smsContent = new SMSContent();
		$smsContent->userId = $userId;
		$smsContent->msg = $msg;
		$smsContent->subPort = $subPort;
		$smsContent->userMsgId = $userMsgId;
		$smsContent->status = $status;
		$smsContent->createTime = new \DateTime();
		
		$orm = App::Instance()->getService('orm');
		foreach ($phonenumArr as $phonenum) {
			$sms = new SMS();
			$sms->receiver = $phonenum;
			$sms->content = $smsContent;
			$sms->msgId = $gatewayMsgId;
			$sms->userId = $userId;
			
			$orm->save($sms);
		}
	}
}