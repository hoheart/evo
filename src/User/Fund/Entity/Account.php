<?php

namespace user\fund\entity;

use orm\DataClass;

/**
 * @hhp:orm entity
 * @hhp:orm primaryKey id
 */
class Account extends DataClass {
	
	/**
	 * @hhp:orm autoIncrement true
	 *
	 * @var integer
	 */
	protected $id;
	
	/**
	 *
	 * @var integer
	 */
	protected $userId;
	
	/**
	 * 用户账户的总金额，单位为厘。
	 *
	 * @var integer
	 */
	protected $amount;

	public function getId () {
		return $this->id;
	}

	public function setUserId ($id) {
		$this->userId = $id;
	}

	public function getUserId () {
		return $this->userId;
	}

	public function setAmount ($amount) {
		$this->amount = $amount;
	}

	public function getAmount () {
		return $this->amount;
	}
}