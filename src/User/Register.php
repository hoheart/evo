<?php

namespace user;

use user\entity\User;
use util\captcha\SMSCaptcha;
use util\captcha\ISmsContentCreator;
use Illuminate\Database\QueryException;
use user\exception\PhonenumExistingException;
use hhp\App;

/**
 */
class UserManager implements ISmsContentCreator {
	
	/**
	 * 验证码操作类型：注册
	 *
	 * @var string
	 */
	const CAPTCHA_OP_REG = 'register';

	public function __construct () {
	}

	/**
	 * (non-PHPdoc)
	 *
	 * @see \util\captcha\ISmsContentCreator::createSmsContent()
	 */
	public function createSmsContent ($captcha) {
		$app = App::Instance();
		$smsTemplateManager = $app['SMSTemplateManager'];
		
		return sprintf($smsTemplateManager->getRegTemplate(), $captcha);
	}

	/**
	 * 添加用户
	 *
	 * @param string $phonenum        	
	 * @param string $password        	
	 * @param string $captcha        	
	 * @param string $realName        	
	 * @throws PhonenumExistingException
	 * @throws QueryException
	 */
	public function register ($phonenum, $password, $captcha, $realName = '', $gender = User::Unknow) {
		$um = UserManager::Instance();
		$um->addUser($phonenum, $password, $captcha, $realName, $gender);
	}

	/**
	 * 取得注册的短信验证码
	 *
	 * @param string $phonenum        	
	 */
	public function getRegisterCaptcha ($phonenum) {
		$app = App::Instance();
		$smsSender = $app['SMSSender'];
		$sc = new SMSCaptcha($this, $smsSender);
		
		$this->mCurrentOp = self::CAPTCHA_OP_REG;
		
		return $sc->getCaptcha(self::CAPTCHA_OP_REG, $phonenum, $app->getConfigValue('app.debug'));
	}
	
	/*
	 * 检测手机有没有注册过
	 */
	public function checkPhoneIsRegisted ($phonenum) {
		$um = UserManager::Instance();
		$u = $um->getUserByKeyInfo($phonenum);
	}
}