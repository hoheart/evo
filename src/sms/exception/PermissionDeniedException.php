<?php

namespace sms\exception;

use sms\exception\UserErrcode;

/**
 * table
 */
class PermissionDeniedException extends \Exception {

	public function __construct ($str) {
		$this->code = UserErrcode::AuthError;
		$this->message = $str;
	}
}