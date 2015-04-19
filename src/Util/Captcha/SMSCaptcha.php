<?php

namespace util\captcha;

use Util\SMS\SMSService;

class SMSCaptcha extends BaseCaptcha {
	
	/**
	 *
	 * @var string
	 */
	protected $mAllowedCharList = '0123456789';
	
	/**
	 * 创建短信内容的对象
	 *
	 * @var ISmsContentCreator
	 */
	protected $mSmsContentCreator = null;
	
	/**
	 * 短信发送服务
	 *
	 * @var SMSService
	 */
	protected $mSmsSender = null;

	/**
	 *
	 * @param ISmsContentCreator $smsContentCreator        	
	 */
	public function __construct (ISmsContentCreator $smsContentCreator, SMSService $smsSender) {
		$this->mSmsContentCreator = $smsContentCreator;
		$this->mSmsSender = $smsSender;
	}

	/**
	 * (non-PHPdoc)
	 *
	 * @see \util\captcha\DigitCaptcha::getCaptcha()
	 */
	public function getCaptcha ($op, $phonenum = null, $debug = false) {
		$captcha = parent::getCaptcha($op, $phonenum, $debug);
		$sms = $this->mSmsContentCreator->createSmsContent($captcha);
		
		$this->mSmsSender->send($phonenum, $sms);
	}
}