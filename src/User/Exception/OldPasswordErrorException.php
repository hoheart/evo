<?php

namespace user\exception;

class OldPasswordErrorException extends \Exception {

	public function __construct ($message = '') {
		$this->message = $message;
		$this->code = UserErrorCode::OldPasswordError;
	}
}