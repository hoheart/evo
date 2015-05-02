<?php

namespace User\Controller;

use User\Fund\AccountManager;
use User\Login;

/**
 */
class FundController extends UserBaseController {

	public function __construct () {
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