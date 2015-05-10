<?php

namespace User\Controller;

use HHP\Controller;
use HHP\App;
use User\Login;
use HHP\View\View;
use SMS\ClientManager;

class UserBaseController extends Controller {

	public function __construct () {
	}

	public function getView () {
		$v = parent::getView();
		if (null != $v) {
			if (View::VIEW_TYPE_HTML == $v->getType()) {
				$v->setLayoutPath(App::$ROOT_DIR . 'User/View/UserLayout.php');
				
				$u = Login::GetLoginedUser();
				$c = ClientManager::Instance()->getOneClient($u->id);
				$v->assign('systemTitle', $c->systemTitle);
			}
		}
		
		return $v;
	}
}