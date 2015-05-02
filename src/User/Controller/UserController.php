<?php

namespace User\Controller;

use User\Login;
use User\Fund\AccountManager;

/**
 * table
 */
class UserController extends UserBaseController {

	public function __construct () {
		parent::__construct();
	}

	public function index () {
		return $this->info();
	}

	public function info () {
		$u = Login::GetLoginedUser();
		$account = AccountManager::Instance()->getOneAccount($u->id);
		
		$this->setView('User/User/info');
		$this->assign('user', $u);
		$this->assign('clientArr', array());
		$this->assign('account', $account);
	}
}