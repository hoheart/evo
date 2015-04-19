<?php

namespace user\exception;

class CheckEmailFailedException extends \Exception {

	public function __construct ($message = '') {
		$this->message = $message;
		$this->code = UserErrorCode::CheckEmailFailed;
	}
}