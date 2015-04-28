<?php

namespace HHP\View;

use HHP\IExecutor;
use HHP\HttpRequest;

class ViewRender implements IExecutor {
	
	/**
	 *
	 * @var array
	 */
	protected $mRenderList = array();

	static public function Instance () {
		$me = null;
		if (null == $me) {
			$me = new self();
		}
		
		return $me;
	}

	public function run ($v = null) {
		if (null == $v) {
			if (HttpRequest::isAjaxRequest()) {
				$v = new View();
				$v->setType(View::VIEW_TYPE_JSON);
			} else {
				return;
			}
		}
		
		$viewType = View::VIEW_TYPE_UNKNOWN;
		$ret = null;
		
		if (View::VIEW_TYPE_HTML == $v->getType()) {
			$viewType = View::VIEW_TYPE_HTML;
		} else if (View::VIEW_TYPE_JSON == $v->getType()) {
			$viewType = View::VIEW_TYPE_JSON;
		}
		
		$render = null;
		switch ($viewType) {
			case View::VIEW_TYPE_HTML:
			case View::VIEW_TYPE_UNKNOWN:
				$render = $this->mRenderList[$viewType];
				if (null == $render) {
					$render = HTMLRender::Instance();
					$this->mRenderList[$viewType] = $render;
				}
				
				break;
			case View::VIEW_TYPE_JSON:
				$render = $this->mRenderList[$viewType];
				if (null == $render) {
					$render = JsonRender::Instance();
					$this->mRenderList[$viewType] = $render;
				}
				
				break;
		}
		
		$ret = $render->render($v);
		
		return $ret;
	}
}