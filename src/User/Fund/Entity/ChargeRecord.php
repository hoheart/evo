<?php

namespace User\Fund\Entity;

use ORM\DataClass;

/**
 * @hhp:orm primaryKey id
 * @hhp:orm entity
 *
 * @author Hoheart
 *        
 */
class ChargeRecord extends DataClass {
	
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
	protected $accountId;
	
	/**
	 *
	 * @var integer
	 */
	protected $amount;
	
	/**
	 *
	 * @var string
	 */
	protected $desc;
	
	/**
	 *
	 * @var integer
	 */
	protected $balance;

	public function getId () {
		return $this->id;
	}

	public function setAccountId ($accountId) {
		$this->accountId = $accountId;
	}

	public function getAccountId () {
		return $this->accountId;
	}

	public function setAmount ($amount) {
		$this->amount = $amount;
	}

	public function getAmount () {
		return $this->amount;
	}

	public function setDesc ($desc) {
		$this->desc = $desc;
	}

	public function getDesc () {
		return $this->desc;
	}
}