<?php

namespace Admin\Controller;

class AdminController extends AdminBaseController {

	public function index () {
		$this->setView('Admin/Admin/index');
	}
}