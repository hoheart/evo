<?php

namespace user;

use user\exception\LoginFailedException;
use user\entity\User;

/**
 */
class Login {

	public function __construct () {
	}

	/**
	 * 添加用户
	 *
	 * @param string $phonenum
	 *        	手机号
	 * @param string $password
	 *        	原文密码
	 * @param string $captcha        	
	 * @param string $realName        	
	 */
	public function addUser ($phonenum, $password, $captcha, $realName) {
		$app = Facade::getFacadeApplication();
		$smsSender = $app['SMSSender'];
		$sc = new SmsCaptcha($this, $smsSender);
		$sc->checkCaptcha($captcha, self::CAPTCHA_OP_REG, $phonenum);
		
		$u = new User();
		$u->phonenum = $phonenum;
		$u->realName = $realName;
		
		$u->salt = $this->createSalt();
		$u->password = $this->encryptPassword($u->salt, $password);
		
		try {
			$u->save();
		} catch (QueryException $e) {
			if ('23000' == $e->getCode()) {
				throw new PhonenumExistingException();
			} else {
				throw $e;
			}
		}
	}

	/**
	 */
	public function login ($userName, $password) {
		$um = new UserManager();
		$u = $um->getUserByName($userName);
		if ($u->checkPassword($password)) {
			$_SESSION['userId'] = $u->id;
		} else {
			throw new LoginFailedException('');
		}
	}

	/**
	 */
	public function loginOut () {
		$_SESSION = null;
	}

	/**
	 */
	public static function GetLoginUserId () {
		return $_SESSION['userId'];
	}

	protected function encryptPassword ($salt, $srcPwd) {
		return md5(md5($salt . $srcPwd) . $salt);
	}

	public function checkPassword (User $u, $password) {
		$enPwd = $this->encryptPassword($u->salt, $password);
		return $enPwd === $u->password;
	}
}