<?php

namespace User\Controller;

use HHP\Controller;
use HHP\IRequest;
use HFC\Exception\ParameterErrorException;
use User\Login;

class LoginController extends Controller {
	
	/**
	 * 试图文件的位置
	 *
	 * @var string
	 */
	protected $mViewDir = 'User/Login/';

	/**
	 */
	public function login () {
		$this->setView($this->mViewDir . 'login');
	}

	public function index () {
		return $this->login();
	}

	protected function getLoginObject () {
		return new Login();
	}

	/**
	 */
	public function login_post (IRequest $req) {
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
		
		$login = $this->getLoginObject();
		$login->login($userName, $password, $captcha);
	}

	public function getLoginCaptcha () {
		$l = $this->getLoginObject();
		$l->getLoginCaptcha();
	}
}
