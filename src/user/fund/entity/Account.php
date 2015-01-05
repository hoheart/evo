<?php

namespace user\fund\entity;

use orm\DataClass;

/**
 * @hhp:orm entity
 * @hhp:orm primaryKey userId
 */
class Account extends DataClass {
	
	/**
	 *
	 * @var integer
	 */
	protected $userId;
	
	/**
	 * 用户账户的总金额，单位为分。
	 *
	 * @var integer
	 */
	protected $amount;
	
	/**
	 *
	 * @var DateTime
	 */
	protected $createTime;

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

	public function setCreateTime (\DateTime $t) {
		$this->createTime = $t;
	}

	public function getCreateTime () {
		return $this->createTime;
	}
}