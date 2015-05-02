<?php

namespace HHP\Exception;

use HHP\Exception\UserErrcode;

class RequestErrorException extends \Exception {

	public function __construct ($msg = '') {
		$this->code = UserErrcode::RequestError;
		$this->message = $msg;
	}
}
?>