<?php

namespace HHP;

use HHP\View\JsonRender;
use HHP\Exception\UserErrcode;

class ErrorHandler {

	public function register2System () {
		// 关闭所有错误输出
		ini_set('display_errors', 'Off');
		error_reporting(0);
		
		set_error_handler(array(
			$this,
			'handle'
		), E_ALL | E_STRICT);
		set_exception_handler(array(
			$this,
			'handleException'
		));
		register_shutdown_function(array(
			$this,
			'handleShutdown'
		));
	}

	public function handleShutdown () {
		$errinfo = error_get_last();
		if (null != $errinfo) {
			$this->handle($errinfo['type'], $errinfo['message'], $errinfo['file'], $errinfo['line']);
		}
	}

	public function handleException (\Exception $e) {
		$this->handle($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine(), $e);
	}

	public function processError ($errno, $errstr, $errfile, $errline, array $errcontext) {
		$this->handle($errno, $errstr, $errfile, $errline, $errcontext);
	}

	public function handle ($errno, $errstr, $errfile, $errline, $e = null) {
		$notProcessError = array(
			E_NOTICE,
			E_STRICT
		);
		
		$errcode = UserErrcode::ErrorOK;
		if (in_array($errno, $notProcessError)) {
			return;
		}
		
		if (HttpRequest::isAjaxRequest()) {
			if (App::Instance()->getConfigValue('debug')) {
				if (is_array($e)) {
					$e[] = $errstr;
					$this->rendJson($errno, $errstr, $e);
				} else {
					$this->rendJson($errno, $errstr, $e);
				}
			} else {
				$this->rendJson($errno, $errstr);
			}
		} else {
			if (App::Instance()->getConfigValue('debug')) {
				echo "Error:$errno:$errstr.";
				echo '<br>';
				echo "In file:$errfile:$errline.";
				echo '<br>';
				echo '<pre>';
				print_r($e);
				echo '</pre>';
			} else {
				try {
					// echo $errno;
					// Log::e("Error:$errno:$errstr.\nIn
					// file:$errfile:$errline.");
				} catch (\Exception $e) {
				}
				
				$this->rendJson($errno, $errstr, $e);
			}
		}
		
		exit(0);
	}

	protected function rendJson ($errno, $errstr, $e = null) {
		$render = new JsonRender();
		
		$outErrcode = 0;
		if ($errno > 0 && ($errno < 400000 || $errno >= 500000)) {
			// 一旦出现致命错误，之前的chdir就没用了。
			$render->renderLayout(null, App::$ROOT_DIR . 'Common/View/JsonLayout.php', 50000, 
					'System error, the Administrator has informed, looking for other pages.', $e);
		} else {
			$outErrcode = $errno;
			$outErrstr = $errstr;
			$render->renderLayout(null, App::$ROOT_DIR . 'Common/View/JsonLayout.php', $outErrcode, $outErrstr, $e);
		}
	}
}
?>