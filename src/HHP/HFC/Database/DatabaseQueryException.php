<?php

namespace hfc\database;

use hfc\exception\SystemErrcode;

class DatabaseQueryException extends \Exception {
	
	/**
	 * 源错误码，即数据库错误码
	 *
	 * @var string
	 */
	protected $mSourceCode = 0;

	public function __construct ($msg = '') {
		$this->code = SystemErrcode::DatabaseQuery;
		$this->message = $msg;
	}

	public function setSourceCode ($code) {
		$this->mSourceCode = $code;
	}

	public function getSourceCode () {
		return $this->mSourceCode;
	}
}
?>