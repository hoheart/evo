<?php

namespace util\SMS;

use util\SMS\EvoSMSSender;
use hhp\App;

class SMSService {

	static public function Instance () {
		static $me = null;
		if (null == $me) {
			$me = new self();
		}
		
		return $me;
	}

	/**
	 *
	 * @param
	 *        	phonenum
	 * @param
	 *        	content
	 */
	public function send ($phonenum, $content) {
		$gateway = $this->getSMSGateway();
		
		$retInfo = $gateway->send($phonenum, $content);
		
		$this->addSendRecord($phonenum, $content, $retInfo);
	}

	protected function addSendRecord ($phonenum, $content, $retInfo) {
		$phonenumArr = explode(',', $phonenum);
		for ($i = 0; $i < count($phonenumArr); ++ $i) {
			$one = $phonenumArr[$i];
			if (empty($one)) {
				continue;
			}
			
			$record = new SMSSendRecord();
			$record->phonenum = $one;
			$record->content = $content;
			$record->status = 0 == $retInfo[0] ? SMSSendRecord::STATUS_SEND_SUC : SMSSendRecord::STATUS_RECEIVED_FAILED;
			$record->gatewayError = $retInfo[0];
			$msgId = empty($retInfo[$i][0]) ? '' : $retInfo[$i][0];
			$record->msgId = $msgId;
			
			$record->save();
		}
	}

	public function getSMSGateway () {
		$conf = App::Instance()->getConfigValue('sms');
		return new EvoSMSSender($conf);
	}
}
?>