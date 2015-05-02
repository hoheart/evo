<?php

namespace HHP\View;

class HTMLRender {
	
	/**
	 * Section为模板中的一段html，该段html可以作为一个变量插入到其他html中
	 *
	 * @var string
	 */
	protected $mSectionMap = array();
	
	/**
	 *
	 * @var array
	 */
	protected $mSectionNameStack = array();

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
			$this->section('mainBody');
			include $tmpl;
			$this->endSection();
		}
		
		$layoutPath = $view->getLayoutPath();
		if (file_exists($layoutPath)) {
			extract($this->mSectionMap);
			include ($layoutPath);
		} else {
			echo $mainBody;
		}
	}

	public function section ($name) {
		// 先清除之前产生的内容（这些内容可能是部分内容，因为在$name指定的section完成之后，还可能继续上个section。）
		$cnt = count($this->mSectionNameStack);
		if ($cnt > 0) {
			$sectionContent = ob_get_clean();
			$this->mSectionMap[$this->mSectionNameStack[$cnt - 1]] .= $sectionContent;
		}
		
		$this->mSectionNameStack[] = $name;
		
		ob_start();
	}

	public function endSection () {
		$sectionName = array_pop($this->mSectionNameStack);
		$sectionContent = ob_get_clean();
		$this->mSectionMap[$sectionName] .= $sectionContent;
		
		if (count($this->mSectionNameStack) > 0) {
			ob_start();
		}
	}
}

?>