<?php

namespace util\exception;

class OutofSMSException extends \Exception {

	public function __construct ($message = '') {
		$this->message = $message;
		$this->code = UserErrorCode::OutofSMSError;
	}
}