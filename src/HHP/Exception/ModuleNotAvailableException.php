<?php

namespace HHP\Exception;

use HHP\Exception\SystemErrcode;

class ModuleNotAvailableException extends \Exception {

	public function __construct ($msg) {
		$this->code = SystemErrcode::ModuleNotEnable;
		$this->message = $msg;
	}
}
?>