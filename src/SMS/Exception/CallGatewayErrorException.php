<?php

namespace sms\exception;

/**
 * table
 */
class CallGatewayErrorException extends \Exception {

	public function __construct ($msg = null) {
		$this->code = SystemErrcode::CallGatewayError;
		$this->message = $msg;
	}
}