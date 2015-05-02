<?php

namespace User\Controller;

use HHP\Controller;
use HHP\App;
use User\Login;
use HHP\URLGenerator;

class UserBaseController extends Controller {

	public function __construct () {
		$l = Login::Instance();
		if (! Login::IsLogin()) {
			$u = new URLGenerator();
			$url = $u->to('\User\Controller\LoginController::login');
			header('Location: ' . $url);
			
			exit(0);
		}
	}

	public function getView () {
		$v = parent::getView();
		if (null != $v) {
			$v->setLayoutPath(App::$ROOT_DIR . 'User/View/UserLayout.php');
		}
		
		return $v;
	}
}