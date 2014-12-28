<?php

namespace user;

use hhp\App;
use orm\Condition;

/**
 * table
 */
class UserManager {

	public function __construct () {
	}

	/**
	 */
	public function saveUser () {
		// TODO implement here
	}

	public function getUserByName ($name) {
		$orm = App::Instance()->getService('orm');
		return $orm->where('user\entity\User', new Condition('name=' . $name))[0];
	}

	/**
	 */
	protected function listUser () {
		// TODO implement here
		return null;
	}

	/**
	 */
	protected function delUser () {
		// TODO implement here
	}

	/**
	 *
	 * @param
	 *        	userId 是谁推荐的
	 */
	protected function getRecommendedList ($userId) {
		// TODO implement here
	}

	/**
	 *
	 * @param
	 *        	oldPassword
	 * @param
	 *        	newPassword
	 */
	protected function modifyPassword ($oldPassword, $newPassword) {
		// TODO implement here
	}
}