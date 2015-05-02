<?php

namespace Admin;

class Login extends \User\Login {
	
	/**
	 * 登录之后的Session 名
	 *
	 * @var string
	 */
	const CAPTCHA_OP_LOGIN = 'AdminLogin';
	
	/**
	 * 保存登录信息的session名
	 *
	 * @var string
	 */
	const SESSION_PREFIX = 'ADMIN_LOGIN';

	public function __construct () {
	}

	public function getManager () {
		return AdminManager::Instance();
	}
}