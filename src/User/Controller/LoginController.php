<?php

namespace User\Controller;

use HHP\Controller;
use HHP\View\View;
use HHP\IRequest;
use HFC\Exception\ParameterErrorException;
use User\Login;

class LoginController extends Controller {

	/**
	 */
	public function loginAction_get () {
		$v = new View('user/user/login_get');
		
		return $v;
	}

	/**
	 */
	public function loginAction_post (IRequest $req) {
		$userName = $req->get('userName');
		if (empty($userName)) {
			throw new ParameterErrorException('userName');
		}
		$password = $req->get('password');
		if (empty($password)) {
			throw new ParameterErrorException('password');
		}
		$captcha = $req->get('captcha');
		if (empty($captcha)) {
			throw new ParameterErrorException('captcha');
		}
		
		$login = Login::Instance();
		$login->login($userName, $password, $captcha);
	}

	public function getLoginCaptcha () {
		$l = new Login();
		$l->getLoginCaptcha();
	}
}
