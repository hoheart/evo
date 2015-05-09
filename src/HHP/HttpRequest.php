<?php

namespace HHP;

use HHP\IRequest;

class HttpRequest implements IRequest {
	
	/**
	 * 请求的uri
	 *
	 * @var string
	 */
	protected $mResource = '';
	
	/**
	 * 请求的主体，对应php的$_REQUEST全局变量
	 *
	 * @var array
	 */
	protected $mBody = null;

	public function __construct ($needParse = false) {
		if ($needParse) {
			$this->parse();
		}
	}

	protected function parse () {
		$this->mBody = $_REQUEST;
		$this->mResource = $_SERVER['REQUEST_URI'];
	}

	public function setBody ($body) {
		$this->mBody = $body;
	}

	public function get ($name) {
		return $this->mBody[$name];
	}

	public function getURI () {
		return $this->getResource();
	}

	public function getResource () {
		$uri = urldecode($_SERVER['REQUEST_URI']);
		return $uri;
	}

	public function getScriptName () {
		return $_SERVER['PHP_SELF'];
	}

	static public function isAjaxRequest () {
		return ! empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
				 strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
	}

	public function isHttp () {
		return true;
	}

	public function isCli () {
		return false;
	}
}