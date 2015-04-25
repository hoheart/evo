<?php

namespace Admin\Controller;

use Admin\Login;

class LoginController extends \User\Controller\LoginController {
	
	/**
	 *
	 * @var string
	 */
	protected $mViewDir = 'Admin/Login/';

	/**
	 * 取得模型层Login对象
	 */
	protected function getLoginObject () {
		return new Login();
	}
}