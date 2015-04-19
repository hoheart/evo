<?php

namespace sms;

use hhp\App;
use hhp\Singleton;

class ClientManager extends Singleton {

	public function get ($id) {
		$orm = App::Instance()->getService('orm');
		$ret = $orm->get('sms\entity\ClientInfo', $id);
		
		return $ret;
	}
}
