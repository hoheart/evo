<?php

namespace User;

use HHP\Session;
use User\Exception\LoginFailedException;
use Util\Captcha\GraphicCaptcha;
use User\Entity\User;
use HHP\Singleton;

/**
 *
 * @author Jejim
 *        
 */
class Login extends Singleton {
	
	/**
	 * 保存登录信息的session名
	 *
	 * @var string
	 */
	const SESSION_PREFIX = 'LOGIN';
	
	/**
	 *
	 * @var string
	 */
	const CAPTCHA_OP_LOGIN = 'login';

	public function __construct () {
	}

	public function getLoginCaptcha () {
		$gc = new GraphicCaptcha();
		$self = get_called_class();
		$gc->getCaptcha($self::CAPTCHA_OP_LOGIN);
	}

	/**
	 *
	 * @param string $key
	 *        	登录关键字，可以是用户名，手机号，邮箱
	 * @param string $password        	
	 */
	public function login ($key, $password, $captcha) {
		$c = new GraphicCaptcha();
		$self = get_called_class();
		$c->checkCaptcha($captcha, $self::CAPTCHA_OP_LOGIN);
		
		$this->loginWithoutCaptcha($key, $password);
	}

	public function loginWithoutCaptcha ($key, $password) {
		$um = UserManager::Instance();
		$u = $um->getUserByKeyInfo($key);
		if (null == $u || ! $um->checkPassword($u, $password)) {
			throw new LoginFailedException();
		}
		
		$this->setLoginSession($u);
	}

	/**
	 * #######慎用########不需要密码，直接登录。
	 *
	 * @param string $key        	
	 * @throws LoginFailedException
	 */
	public function loginWithoutPassword ($key) {
		$um = UserManager::Instance();
		$u = $um->getUserByKeyInfo($key);
		if (null == $u) {
			throw new LoginFailedException();
		}
		
		$this->setLoginSession($u);
	}

	public function setLoginSession (User $u) {
		$cls = get_called_class();
		Session::set($cls::SESSION_PREFIX, 
				array(
					'userId' => $u->id,
					'loginTime' => time(),
					'phonenum' => $u->phonenum
				));
	}

	protected function getLoginSession () {
		$self = get_called_class();
		return Session::get($self::SESSION_PREFIX);
	}

	/**
	 */
	public function logout () {
		$self = get_called_class();
		Session::forget($self::SESSION_PREFIX);
	}

	static public function IsLogin () {
		$self = get_called_class();
		return Session::has($self::SESSION_PREFIX);
	}

	/**
	 *
	 * @return integer 用户id
	 */
	static public function GetLoginedUserId () {
		$self = get_called_class();
		$session = Session::get($self::SESSION_PREFIX);
		if (! empty($session)) {
			return $session['userId'];
		} else {
			return - 1;
		}
	}

	public function getLoginUserPhonenum () {
		$session = $this->getLoginSession();
		return $session['phonenum'];
	}

	static public function GetLoginedUser () {
		static $u = null;
		if (null == $u) {
			$um = new UserManager();
			$self = get_called_class();
			$u = $um->get(Session::get($self::SESSION_PREFIX));
		}
		
		return $u;
	}
}