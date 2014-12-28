<?php

namespace user\exception;

/**
 *
 * @author Jejim
 *        
 */
class LoginFailedException {

	public function __construct ($msg) {
		$this->code = UserErrcode::LoginError;
		$this->message = $msg;
	}
}