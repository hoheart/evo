<?php

namespace Admin;

use User\UserManager;

class AdminManager extends UserManager {
	
	/**
	 *
	 * @var string
	 */
	protected $mUserClassName = '\Admin\Entity\Admin';
}