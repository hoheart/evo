<?php

namespace user\fund\entity;

use orm\DataClass;

/**
 * 消费记录
 * @hhp:orm entity
 *
 * @author Jejim
 */
class ConsumeLog extends DataClass {
	
	/**
	 * @hhp::orm autoIncrement true
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
	 * @var integer
	 */
	protected $extId;
	
	/**
	 *
	 * @var string
	 */
	protected $desc;
}