<?php

namespace User\Controller;

use User\Login;
use User\Fund\AccountManager;
use HHP\HttpRequest;
use User\UserManager;

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

	public function modifyPassword () {
		$this->setView('User/User/modifyPassword');
	}

	public function modifyPassword_post (HttpRequest $req) {
		$oldPassword = $req->get('old_password');
		$password = $req->get('password');
		
		$um = UserManager::Instance();
		$um->modifyPassword($oldPassword, $password);
	}
}