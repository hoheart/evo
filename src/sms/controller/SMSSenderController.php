<?php

namespace sms\controller;

use hhp\Controller;
use sms\SMSSender;
use hfc\exception\ParameterErrorException;
use sms\ClientManager;

class SMSSenderController extends Controller {

	public function sendAction ($argv) {
		$clientManager = new ClientManager();
		$client = $clientManager->getOnlieClient();
		if (null == $client) {
			$client = $clientManager->checkClient($argv['userName'], $argv['password']);
		}
		
		$phonenums = $argv['phonenums'];
		$phonenumsLen = strlen($phonenums);
		if ($phonenumsLen <= 0 || $phonenumsLen > 1100) { // 最多100个手机号
			throw new ParameterErrorException('phonenums');
		}
		$msg = $argv['msg'];
		$msgLen = strlen($msg);
		if ($msgLen <= 0 || $msgLen > 350) {
			throw new ParameterErrorException('msg');
		}
		$subPort = $argv['subPort'];
		if (strlen($subPort) > 6) {
			throw new ParameterErrorException('subPort');
		}
		$msgId = $argv['msgId'];
		if (! empty($msgId) && ! is_numeric($msgId)) {
			throw new ParameterErrorException('msgid');
		}
		
		$sender = new SMSSender();
		$msgId = $sender->send($client, $phonenums, $msg, $subPort, $msgId);
		
		echo $msgId;
		
		$this->assign('msgId', $msgId);
	}
}