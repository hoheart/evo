<?php

namespace User\Exception;

/**
 *
 * @author Jejim
 *        
 */
class LoginFailedException extends \Exception {

	public function __construct ($msg = 'User name or password incorrect.') {
		$this->code = UserErrcode::LoginFailed;
		$this->message = $msg;
	}
}
