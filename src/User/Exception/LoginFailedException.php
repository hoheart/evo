<?php

namespace user\exception;

/**
 *
 * @author Jejim
 *        
 */
class LoginFailedException extends \Exception{

	public function __construct ($msg) {
		$this->code = UserErrcode::LoginError;
		$this->message = $msg;
	}
}
