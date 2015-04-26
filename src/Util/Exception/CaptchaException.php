<?php

namespace Util\Exception;

class CaptchaException extends \Exception {

	public function __construct ($message = '') {
		$this->message = $message;
		$this->code = UserErrorCode::CaptchaError;
	}
}