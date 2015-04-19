<?php

namespace user\exception;

class CaptchaLoginFailedException extends \Exception {

	public function __construct ($message = '') {
		$this->message = $message;
		$this->code = UserErrorCode::CaptchaLoginFailed;
	}
}