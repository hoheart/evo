<?php

namespace User\Fund\Exception;

use User\Exception\UserErrcode;

/**
 */
class NotSufficientFundsException extends \Exception {

	public function __construct () {
		$this->code = UserErrcode::NotSufficientFunds;
	}
}