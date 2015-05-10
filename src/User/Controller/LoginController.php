<?php

namespace User\Controller;

use HHP\Controller;
use HHP\IRequest;
use HFC\Exception\ParameterErrorException;
use User\Login;
use HHP\Router\Redirector;
use HHP\App;
use HHP\HttpRequest;

class LoginController extends Controller {
	
	/**
	 * 试图文件的位置
	 *
	 * @var string
	 */
	protected $mViewDir = 'User/Login/';

	static public function getConfig ($action) {
		return array(
			'executor' => array(
				'pre_executor' => array()
			)
		);
	}

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
		$loginIP = '';
		if ($req instanceof HttpRequest) {
			$loginIP = $req->getClientIP();
		}
		$login->login($userName, $password, $captcha, $loginIP);
	}

	public function getLoginCaptcha () {
		$l = $this->getLoginObject();
		$l->getLoginCaptcha();
	}

	public function logout () {
		$l = $this->getLoginObject();
		$l->logout();
		
		$app = App::Instance();
		$url = $app->getConfigValue('logoutUrl');
		
		$r = Redirector::Instance();
		$r->to($url);
	}
}
