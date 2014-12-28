<?php

namespace sms;

use hhp\App;
use orm\Condition;

class SMSPriceManager {

	public function getPrice ($userId) {
		$dbf = App::Instance()->getService('DataFactory');
		return $dbf->get('sms\SMSPrice', new Condition('userId=' . $userId));
	}
}