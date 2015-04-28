<?php

namespace HHP\View;

class HTMLRender {

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
	public function render ($view) {
		extract($view->getDataMap());
		
		$mainBody = '';
		
		$tmpl = $view->getTemplatePath();
		if (! empty($tmpl)) {
			ob_start();
			include $view->getTemplatePath();
			$mainBody = ob_get_clean();
		}
		
		$layoutPath = $view->getLayoutPath();
		if (file_exists($layoutPath)) {
			include ($layoutPath);
		} else {
			echo $mainBody;
		}
	}
}

?>