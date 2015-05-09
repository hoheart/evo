<?php

namespace HHP\Router;

use HHP\App\ClassLoader;
use HHP\Exception\RequestErrorException;
use HHP\IRequest;

/**
 * 直接解析请求路径的路由器
 *
 * 规则：
 * /user				/user/UserController/index
 * /user				/index/IndexController/user
 *
 * /user/register		/user/UserController/register
 * /user/register		/user/RegisterController/index
 * /user/register		/user/register/RegisterController/index
 *
 * /user/login/captcha	/user/LoginController/captcha
 * /user/login/captcha	/user/login/CaptchaController/index
 * /user/login/captcha	/user/login/captcha/CaptchaController/index
 *
 * @author Hoheart
 *        
 */
class PathParseRouter implements IRouter {

	static public function Instance () {
		static $me = null;
		if (null == $me) {
			$me = new PathParseRouter();
		}
		
		return $me;
	}

	public function getRoute (IRequest $request, ClassLoader $clsLoader) {
		if (! empty($this->mRedirection)) {
			return $this->mRedirection;
		}
		
		$moduleAlias = '';
		$ctrlName = '';
		$actionName = '';
		
		$uri = $request->getScriptName();
		$arr = explode('/', $uri);
		array_shift($arr);
		$arrCount = count($arr);
		if ('.php' == substr($arr[$arrCount - 1], - 4)) {
			array_pop($arr);
			$arrCount = count($arr);
		}
		
		if (0 == $arrCount) {
			$moduleAlias = 'index';
			$clsName = '\index\IndexController';
			$actionName = 'index';
		} else if (1 == $arrCount) {
			$segment = $arr[0];
			list ($moduleAlias, $ctrlName, $actionName) = $this->getRouteByOne($segment, $clsLoader);
		} else if (2 == $arrCount) {
			list ($moduleAlias, $ctrlName, $actionName) = $this->getRouteByTwo($arr, $clsLoader);
		} else {
			list ($moduleAlias, $ctrlName, $actionName) = $this->getRouteByMany($arr, $clsLoader);
		}
		
		if ('POST' == $_SERVER['REQUEST_METHOD']) {
			$postActionName = $actionName . '_post';
			if (method_exists($ctrlName, $postActionName)) {
				$actionName = $postActionName;
			}
		}
		
		return array(
			$moduleAlias,
			$ctrlName,
			$actionName
		);
	}

	/**
	 * 只有一段请求的情况（即/admin的情况）
	 */
	protected function getRouteByOne ($uri, ClassLoader $clsLoader) {
		$clsName = '';
		
		$moduleAlias = $uri;
		$subDir = '';
		$ctrlName = $uri;
		$actionName = 'index';
		try {
			$clsName = $clsLoader->loadController($moduleAlias, $ctrlName, $subDir);
		} catch (RequestErrorException $e) {
			$moduleAlias = 'index';
			$subDir = '';
			$ctrlName = 'index';
			$actionName = 'user';
			
			$clsName = $clsLoader->loadController($moduleAlias, $ctrlName, $subDir);
		}
		
		return array(
			$moduleAlias,
			$clsName,
			$actionName
		);
	}

	protected function getRouteByTwo ($arr, ClassLoader $clsLoader) {
		$clsName = '';
		
		$moduleAlias = $arr[0];
		$subDir = '';
		$ctrlName = $arr[0];
		$actionName = $arr[1];
		try {
			$clsName = $clsLoader->loadController($moduleAlias, $ctrlName, $subDir);
			
			if (! method_exists($clsName, $actionName)) {
				throw new RequestErrorException();
			}
		} catch (RequestErrorException $e) {
			$ctrlName = $arr[1];
			$actionName = 'index';
			
			try {
				$clsName = $clsLoader->loadController($moduleAlias, $ctrlName, $subDir);
				
				if (! method_exists($clsName, $actionName)) {
					throw new RequestErrorException();
				}
			} catch (RequestErrorException $e) {
				$subDir = $arr[1];
				
				$clsName = $clsLoader->loadController($moduleAlias, $ctrlName, $subDir);
			}
		}
		
		return array(
			$moduleAlias,
			$clsName,
			$actionName
		);
	}

	protected function getRouteByMany ($arr, ClassLoader $clsLoader) {
		$clsName = '';
		
		$moduleAlias = array_shift($arr);
		$lastItem = array_pop($arr);
		$rightSecondItem = array_pop($arr);
		$subDir = implode(DIRECTORY_SEPARATOR, $arr);
		$ctrlName = $rightSecondItem;
		$actionName = $lastItem;
		try {
			$clsName = $clsLoader->loadController($moduleAlias, $ctrlName, $subDir);
		} catch (RequestErrorException $e) {
			$subDir .= empty($subDir) ? '' : DIRECTORY_SEPARATOR;
			$subDir .= $rightSecondItem;
			$ctrlName = $lastItem;
			$actionName = 'index';
			
			try {
				$clsName = $clsLoader->loadController($moduleAlias, $ctrlName, $subDir);
			} catch (RequestErrorException $e) {
				$subDir .= DIRECTORY_SEPARATOR . $lastItem;
				$clsName = $clsLoader->loadController($moduleAlias, $ctrlName, $subDir);
			}
		}
		
		return array(
			$moduleAlias,
			$clsName,
			$actionName
		);
	}
}