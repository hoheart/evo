<?php

namespace Admin\Controller;

use HHP\Controller;
use HHP\App;

class AdminBaseController extends Controller {

	public function __construct () {
	}

	public function index () {
		echo '11';
	}

	public function getView () {
		$v = parent::getView();
		$v->setLayoutPath(App::$ROOT_DIR . 'Admin/View/AdminLayout.php');
		
		return $v;
	}
}