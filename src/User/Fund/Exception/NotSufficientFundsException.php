<?php

namespace user\fund\exception;

use user\exception\UserErrcode;

/**
 */
class NotSufficientFundsException extends \Exception {

	public function __construct () {
		$this->code = UserErrcode::NotSufficientFunds;
	}
}