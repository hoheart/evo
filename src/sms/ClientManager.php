<?php

namespace sms;

use hhp\App;
use sms\exception\PermissionDeniedException;

class ClientManager {

	public function getClient ($clientId) {
		$orm = App::Instance()->getService('orm');
		$ret = $orm->get('sms\entity\ClientInfo', $clientId);
		
		return $ret;
	}

	/**
	 * 取得已经用验证过密码的连接的用户id
	 */
	public function getOnlieClient () {
		$client = $_SESSION['client'];
	}

	public function checkClient ($clientId, $password) {
		$info = $this->getClient($clientId);
		if ($info->encodedPassword != $password) {
			throw new PermissionDeniedException('');
		}
		
		$_SESSION['client'] = $info;
		
		return $info;
	}
}