<?php

namespace sms\controller;

use hhp\Controller;
use sms\SMSSender;
use hfc\exception\ParameterErrorException;
use hhp\view\View;
use sms\ClientManager;
use hhp\IRequest;

class SMSSenderController extends Controller {

	public function sendAction (IRequest $req) {
		$clientManager = new ClientManager();
		$client = $clientManager->getOnlieClient();
		if (null == $client) {
			$client = $clientManager->checkClient($req->get('userName'), $req->get('password'));
		}
		
		$phonenums = $req->get('phonenums');
		$phonenumsLen = strlen($phonenums);
		if ($phonenumsLen <= 0 || $phonenumsLen > 1100) { // 最多100个手机号
			throw new ParameterErrorException('phonenums');
		}
		$msg = $req->get('msg');
		$msgLen = strlen($msg);
		if ($msgLen <= 0 || $msgLen > 350) {
			throw new ParameterErrorException('msg');
		}
		$subPort = $req->get('subPort');
		if (strlen($subPort) > 6) {
			throw new ParameterErrorException('subPort');
		}
		$msgId = $req->get('msgId');
		if (! empty($msgId) && ! is_numeric($msgId)) {
			throw new ParameterErrorException('msgid');
		}
		
		$sender = new SMSSender();
		$sender->send($client, $phonenums, $msg, $subPort, $msgId);
		
		return new View('sms/SMSSender/send');
	}
}