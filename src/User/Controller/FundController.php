<?php

namespace User\Controller;

use User\Fund\AccountManager;
use User\Login;
use HHP\View\View;

/**
 */
class FundController extends UserBaseController {

	public function __construct () {
	}

	static public function getConfig ($action) {
		// balance接口不需要鉴权，需要提供用户名密码访问
		if ('balance' == $action) {
			return array(
				'executor' => array(
					'pre_executor' => array()
				)
			);
		}
	}

	public function balance ($req) {
		if (! Login::IsLogin()) {
			$l = Login::Instance();
			$l->loginWithoutCaptcha($req->get('userName'), $req->get('password'));
		}
		
		$am = new AccountManager();
		$balance = $am->getBalance(Login::GetLoginedUserId());
		
		$this->setView('User/Fund/balance', View::VIEW_TYPE_JSON);
		$this->assign('balance', $balance);
	}

	public function chargeRecord () {
		$am = AccountManager::Instance();
		$account = $am->getOneAccount(Login::GetLoginedUserId());
		$record = $am->getChargeRecord($account->id);
		
		$this->setView('User/Fund/chargeRecord');
		$this->assign('account', $account);
		$this->assign('chargeRecord', $record);
	}
}