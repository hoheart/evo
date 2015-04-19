<?php

namespace user\exception;

class PhonenumExistingException extends \Exception {

	public function __construct ($message = '') {
		$this->message = $message;
		$this->code = UserErrorCode::PhonenumExisting;
	}
}