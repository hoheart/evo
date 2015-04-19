<?php

namespace user\models;

use orm\DataClass;

class Invitation extends DataClass {
	
	/**
	 *
	 * @var string
	 */
	protected $table = 'Invitation';
	
	/**
	 *
	 * @var string
	 */
	protected $primaryKey = 'userId';
	public $incrementing = false;
	
	/**
	 * 邀请码
	 *
	 * @var string
	 */
	protected $code;
	
	/**
	 *
	 * @var integer
	 */
	protected $userId;
}