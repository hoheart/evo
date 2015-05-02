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
		$tmpl = $view->getTemplatePath();
		if (! empty($tmpl)) {
			$data = $this->renderTemplate($view->getDataMap(), $view->getTemplatePath());
		}
		$errcode = null == $e ? 0 : $e->getCode();
		$errstr = null == $e ? '' : $e->getMessage();
		
		$this->renderLayout($data, $view->getLayoutPath(), $errcode, $errstr);
	}

	public function renderLayout ($data, $layoutPath, $errcode, $errstr, $e = null) {
		header('Content-Type: application/json; charset=utf-8', true, 200); // 因为到这儿有可能脚本出现了致命错误，虽然handle了，但还是会抛出http错误码500，所以这儿手动改一下。
		
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