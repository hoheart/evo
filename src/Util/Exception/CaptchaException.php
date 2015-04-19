<?php

namespace util\exception;

class CaptchaException extends \Exception {

	public function __construct ($message = '') {
		$this->message = $message;
		$this->code = UserErrorCode::CaptchaError;
	}
}