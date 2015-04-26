<?php

namespace Admin;

class Login extends \User\Login {
	
	/**
	 * 登录之后的Session 名
	 *
	 * @var string
	 */
	const CAPTCHA_OP_LOGIN = 'AdminLogin';
	protected $mManager = null;

	public function __construct () {
		$this->mManager = new AdminManager();
	}
}