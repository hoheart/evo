<?php

namespace Admin;

class Login extends \User\Login {
	
	/**
	 * 登录之后的Session 名
	 *
	 * @var string
	 */
	const CAPTCHA_OP_LOGIN = 'AdminLogin';

	public function __construct () {
	}

	public function getManager () {
		return AdminManager::Instance();
	}
}