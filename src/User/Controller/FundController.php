<?php

namespace user\controller;

use sms\ClientManager;
use user\fund\AccountManager;
use hhp\view\View;

/**
 */
class FundController {

	public function __construct () {
	}

	public function balanceAction ($req) {
		$clientManager = new ClientManager();
		$client = $clientManager->getOnlieClient();
		if (null == $client) {
			$client = $clientManager->checkClient($req->get('userName'), $req->get('password'));
		}
		
		$am = new AccountManager();
		$balance = $am->getBalance($client->userId);
		$balance = $balance / 10; // 取出来的是厘
		
		$view = new View('user/fund/balance');
		$view->assign('balance', $balance);
		
		return $view;
	}
}