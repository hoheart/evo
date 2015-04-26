<?php

namespace HHP;

interface IRequest {

	public function isHttp ();

	public function isCli ();

	public function getResource ();

	public function getScriptName ();

	/**
	 * 根据键值取得请求内容的值
	 *
	 * @param string $key        	
	 */
	public function get ($key);
}
?>