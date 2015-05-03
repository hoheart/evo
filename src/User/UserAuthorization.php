<?php

namespace User;

use HHP\IExecutor;
use HHP\URLGenerator;

class UserAuthorization implements IExecutor {

	/**
	 *
	 * @return \User\UserAuthorization
	 */
	static public function Instance () {
		static $me = null;
		if (null == $me) {
			$me = new UserAuthorization();
		}
		
		return $me;
	}

	public function run ($do = null) {
		$l = Login::Instance();
		if (! Login::IsLogin()) {
			$u = new URLGenerator();
			$url = $u->to('\User\Controller\LoginController::login');
			header('Location: ' . $url);
			
			exit(0);
		}
	}
}