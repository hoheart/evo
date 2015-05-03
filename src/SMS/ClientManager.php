<?php

namespace SMS;

use HHP\App;
use HHP\Singleton;
use ORM\Condition;

class ClientManager extends Singleton {

	public function get ($id) {
		$orm = App::Instance()->getService('orm');
		$ret = $orm->get('SMS\Entity\ClientInfo', $id);
		
		return $ret;
	}

	public function getOneClient ($userId) {
		$orm = App::Instance()->getService('orm');
		$ret = $orm->where('SMS\Entity\ClientInfo', new Condition('userId=' . $userId));
		
		if (count($ret) > 0) {
			return $ret[0];
		} else {
			return null;
		}
	}
}
