<?php

namespace User\Exception;

class OldPasswordErrorException extends \Exception {

	public function __construct ($message = '') {
		$this->message = $message;
		$this->code = UserErrcode::OldPasswordError;
	}
}