<?php

namespace HHP\Exception;

use HHP\Exception\SystemErrcode;

class APINotAvailableException extends \Exception {

	public function __construct ($msg) {
		$this->code = SystemErrcode::APINotAvailable;
		$this->message = $msg;
	}
}
?>