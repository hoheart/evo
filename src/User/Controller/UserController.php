<?php

namespace user\controller;

use hhp\view\View;
use hhp\IRequest;
use hfc\exception\ParameterErrorException;
use user\Login;

/**
 * table
 */
class UserController {

	public function __construct () {
	}

	/**
	 */
	public function login_getAction () {
		$v = new View('user/user/login_get');
		
		return $v;
	}

	/**
	 */
	public function postLogin (IRequest $req) {
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

	/**
	 */
	public function getRegister () {
		// TODO implement here
	}

	/**
	 */
	public function postRegister () {
		// TODO implement here
	}

	/**
	 */
	public function ajaxGetRegisterCheckCode () {
		// TODO implement here
	}

	/**
	 */
	public function getForgetPassword () {
		// TODO implement here
	}

	/**
	 */
	public function postForgetPassword () {
		// TODO implement here
	}

	/**
	 */
	public function getRsetPasswordCheckCode () {
		// TODO implement here
	}

	/**
	 */
	public function postRestPassword () {
		// TODO implement here
	}
}