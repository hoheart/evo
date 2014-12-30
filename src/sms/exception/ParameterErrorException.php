<?php

namespace user\exception;

use sms\exception\UserErrcode;

/**
 * table
 */
class PermissionDeniedException {

	public function __construct ($msg) {
		$this->code = UserErrcode::ParameterError;
		$this->message = $msg;
	}
}