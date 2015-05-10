<?php

namespace User\Controller;

use HHP\IRequest;
use User\Login;
use SMS\SMSSender;
use HFC\Exception\ParameterErrorException;
use SMS\ClientManager;
use HHP\App;
use ORM\Condition;

class SMSSenderController extends UserBaseController {

	public function __construct () {
		parent::__construct();
	}

	public function send () {
		$this->setView('User/SMSSender/send');
	}

	public function send_post (IRequest $req) {
		$u = Login::GetLoginedUser();
		
		$receiver = $req->get('receiver');
		$msg = $req->get('content');
		
		if (empty($receiver) || empty($msg) || ! is_numeric($receiver)) {
			throw new ParameterErrorException();
		}
		
		$client = ClientManager::Instance()->getOneClient($u->id);
		$smsSender = SMSSender::Instance();
		$smsSender->send($client, $receiver, $msg);
	}

	public function sendRecord () {
		$u = Login::GetLoginedUser();
		$client = ClientManager::Instance()->getOneClient($u->id);
		
		$orm = App::Instance()->getService('orm');
		$msgArr = $orm->where('\SMS\Entity\SMS', new Condition('clientId=' . $client->id));
		
		$this->setView('/User/SMSSender/sendRecord');
		$this->assign('msgArr', $msgArr);
	}
}