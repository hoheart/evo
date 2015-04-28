<?php

namespace Util\Exception;

class CaptchaException extends \Exception {

	public function __construct ($message = 'Captcha is not correct.') {
		$this->message = $message;
		$this->code = UserErrcode::CaptchaError;
	}
}