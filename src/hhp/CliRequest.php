<?php

namespace hhp;

use hhp\IRequest;

class CliRequest implements IRequest {

	public function __construct () {
	}

	public function isHttp () {
		return true;
	}

	public function isCli () {
		return false;
	}
}