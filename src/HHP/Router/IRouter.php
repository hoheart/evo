<?php

namespace HHP\Router;

use HHP\App\ClassLoader;
use HHP\IRequest;

interface IRouter {

	static public function Instance ();

	/**
	 *
	 * @param IRequest $req        	
	 * @param ClassLoader $clsLoader        	
	 * @return array 第一个值为controller类全名，第二个值为action名称
	 */
	public function getRoute (IRequest $req, ClassLoader $clsLoader);
}