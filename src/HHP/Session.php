<?php

namespace HHP;

class Session {

	/**
	 *
	 * @return \HHP\Session;
	 */
	static public function Instance () {
		static $me = null;
		if (null == $me) {
			$me = new self();
		}
		
		return $me;
	}

	public function __construct () {
		session_start();
	}

	public function set ($key, $val) {
		$_SESSION[$key] = $val;
	}

	public function get ($key) {
		return $_SESSION[$key];
	}

	public function forget ($key) {
		unset($_SESSION[$key]);
	}

	public function has ($key) {
		return array_key_exists($key, $_SESSION);
	}
}
?>