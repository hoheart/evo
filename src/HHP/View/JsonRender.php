<?php

namespace HHP\View;

class JsonRender {

	static public function Instance () {
		static $me = null;
		if (null == $me) {
			$me = new self();
		}
		
		return $me;
	}

	/**
	 * 渲染试图
	 *
	 * @param View $view        	
	 */
	public function render ($view, $e = null) {
		$data = $this->renderTemplate($view->getDataMap(), $view->getTemplatePath());
		$errcode = null == $e ? 0 : $e->getCode();
		$errstr = null == $e ? '' : $e->getMessage();
		
		$this->renderLayout($data, $view->getLayoutPath(), $errcode, $errstr);
	}

	public function renderLayout ($data, $layoutPath, $errcode, $errstr, \Exception $e = null) {
		if (file_exists($layoutPath)) {
			$jsonObj = include ($layoutPath);
			echo json_encode($jsonObj);
		} else {
			echo $data;
		}
	}

	protected function renderTemplate ($data, $templatePath) {
		extract($data);
		return include $templatePath;
	}
}

?>