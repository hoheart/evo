<?php

namespace util\captcha;

use hhp\Session;
use util\exception\CaptchaException;

class BaseCaptcha {
	
	/**
	 * 存放于session时的前缀
	 *
	 * @var string
	 */
	const SESSION_PREFIX = 'CAPTCHA';
	
	/**
	 * 验证码有效时间。
	 */
	const EXPIRE_TIME = 108000; // 30分钟
	
	/**
	 * 允许的字符列表
	 *
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
	protected $mLength = 6;

	static public function Instance () {
		static $me = null;
		if (null == $me) {
			$me = new self();
		}
		
		return $me;
	}

	/**
	 * 取得验证码
	 *
	 * @param string $op
	 *        	操作
	 * @param string $addition
	 *        	用于验证验证码时的附加字段
	 * @param boolean $debug
	 *        	是否为debug模式
	 * @return integer 如果为debug模式，则验证码始终为111111
	 */
	public function getCaptcha ($op, $addition = null, $debug = false) {
		$row = $this->getExistsCaptcha($op, $addition);
		$captcha = '';
		if (empty($row)) {
			if ($debug) {
				$captcha = '111111';
			} else {
				for ($i = 0; $i < $this->mLength; ++ $i) {
					$allowedCharList = $this->mAllowedCharList;
					$captcha .= $allowedCharList[mt_rand(0, strlen($allowedCharList) - 1)];
				}
			}
			
			$row = array(
				'captcha' => $captcha,
				'op' => $op,
				'addition' => $addition,
				'createTime' => time()
			);
			Session::set(self::SESSION_PREFIX . $op, $row);
		}
		
		return $row['captcha'];
	}

	protected function getExistsCaptcha ($op, $addition) {
		if (Session::has(self::SESSION_PREFIX . $op)) {
			$row = Session::get(self::SESSION_PREFIX . $op);
			if ($row['createTime'] + self::EXPIRE_TIME >= time() && $row['op'] == $op && $row['addition'] == $addition) {
				return $row;
			} else {
				$this->deleteExistsCaptcha($op);
			}
		}
	}

	protected function deleteExistsCaptcha ($op) {
		Session::forget(self::SESSION_PREFIX . $op);
	}

	/**
	 * 检查验证码
	 *
	 * @param string $captcha        	
	 * @param string $op        	
	 * @param string $addition        	
	 * @throws CaptchaException
	 */
	public function checkCaptcha ($captcha, $op, $addition = null) {
		$row = $this->getExistsCaptcha($op, $addition);
		if (null !== $row['captcha'] && $row['captcha'] == $captcha) {
			$this->deleteExistsCaptcha($op);
			
			return;
		}
		
		$this->deleteExistsCaptcha($op);
		
		throw new CaptchaException();
	}
}