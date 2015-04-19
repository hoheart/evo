<?php

namespace user\exception;

class NotLoginException extends \Exception {

	public function __construct ($message = '') {
		$this->message = $message;
		$this->code = UserErrorCode::NotLogin;
	}
}