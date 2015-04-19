<?php

namespace user\fund\entity;

use orm\DataClass;

/**
 * 消费记录
 *
 * @author Jejim
 *        
 */
class ConsumeLog extends DataClass {
	
	/**
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
}