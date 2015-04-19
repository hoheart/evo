<?php

namespace user\exception;

class SupplementPasswordErrorException extends \Exception {

	public function __construct ($message = '') {
		$this->message = $message;
		$this->code = UserErrorCode::SupplementalPasswordError;
	}
}