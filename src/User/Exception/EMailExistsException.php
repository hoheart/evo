<?php

namespace user\exception;

class EMailExistsException extends \Exception {

	public function __construct ($message = '') {
		$this->message = $message;
		$this->code = UserErrorCode::EMailExists;
	}
}