<?php

namespace SMS\Exception;

/**
 * table
 */
class CallGatewayErrorException extends \Exception {

	public function __construct ($msg = null) {
		$this->code = SystemErrcode::CallGatewayError;
		$this->message = $msg;
	}
}