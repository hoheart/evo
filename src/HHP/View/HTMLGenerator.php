<?php

namespace HHP\View;

use HHP\App;

class HTMLGenerator {
	
	/**
	 *
	 * @var string
	 */
	protected $mStaticUrl = null;

	/**
	 *
	 * @return \HHP\View\HTMLGenerator
	 */
	static public function Instance () {
		static $me = null;
		if (null == $me) {
			$me = new self();
		}
		
		return $me;
	}

	public function __construct () {
		$app = App::Instance();
		$this->mStaticUrl = $app->getConfigValue('staticUrl');
	}

	public function css ($relativeUrl) {
		echo '<link rel="stylesheet" href="' . $this->mStaticUrl . $relativeUrl . '" type="text/css" />';
	}

	public function script ($relativeUrl) {
		echo '<script type="text/javascript" src="' . $this->mStaticUrl . $relativeUrl . '"></script>';
	}
}