<?php

namespace SMS\Controller;

use HHP\Controller;
use SMS\SMSSender;
use HFC\Exception\ParameterErrorException;
use HHP\View\View;
use SMS\ClientManager;
use HHP\IRequest;
use User\Login;

class SMSSenderController extends Controller {

	public function send (IRequest $req) {
		list ($userName, $clientId) = explode('|', $req->get('userName'));
		
		$login = new Login();
		$login->loginWithoutCaptcha($userName, $req->get('password'));
		
		$clientManager = new ClientManager();
		$client = $clientManager->get($clientId);
		
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
		
		$this->setView('SMS/SMSSender/send', View::VIEW_TYPE_JSON);
	}
}
