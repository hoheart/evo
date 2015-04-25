<?php

namespace Util\Captcha;

class GraphicCaptcha extends BaseCaptcha {
	
	/**
	 * alphabet without similar symbols (o=0, 1=l, i=j, t=f)
	 *
	 * @var string
	 */
	protected $mAllowedCharList = '23456789abcdegikpqsvxyz';
	
	/**
	 * 验证码长度
	 *
	 * @var integer
	 */
	protected $mLength = 4;

	/**
	 * (non-PHPdoc)
	 *
	 * @see \util\captcha\DigitCaptcha::getCaptcha()
	 */
	public function getCaptcha ($op, $addition = null, $debug = false) {
		$this->deleteExistsCaptcha($op); // 保证每次取得的都是新验证码
		
		$srcCaptcha = parent::getCaptcha($op, $addition, $debug);
		
		require_once __DIR__ . '/Captcha.ru/kcaptcha.php';
		
		$ru = new \KCAPTCHA($srcCaptcha, $this->mLength);
		
		return $ru;
	}
}