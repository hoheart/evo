<?php

namespace user\exception;

class ModifySamePhonenumErrorException extends \Exception {

	public function __construct ($message = '') {
		$this->message = $message;
		$this->code = UserErrorCode::ModifySamePhonenumError;
	}
}