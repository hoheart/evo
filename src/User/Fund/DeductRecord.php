<?php

namespace user\fund;

/**
 * table
 */
class DeductRecord {

	public function __construct () {
	}
	
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
}