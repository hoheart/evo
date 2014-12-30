<?php

namespace sms\entity;

use orm\DataClass;

/**
 * @hhp:orm persistentName Report
 * @hhp:primaryKey id
 *
 * @author Hoheart
 *        
 */
class Report extends DataClass {
	
	/**
	 * @hhp:orm persistentName id
	 * @hhp:orm autoIncreament true
	 *
	 * @var int64
	 */
	protected $id;
	
	/**
	 * @hhp:orm persistentName createTime
	 *
	 * @var DateTime
	 */
	protected $time;
	
	/**
	 * @hhp:orm persistentName msgId
	 * 
	 * @var string
	 */
	protected $msgId;
	
	/**
	 * @hhp:orm persistentName longnum;
	 * 
	 * @var string
	 */
	protected $longnum;
	
	/**
	 * hhp:orm persistentName userId
	 * 
	 * @var string
	 */
	protected $userId;
	
	/**
	 * hhp:orm persistentName status
	 * 
	 * @var integer
	 */
	protected $status;
	
	/**
	 * hhp:orm persistentName errstr
	 * 
	 * @var string
	 */
	protected $errstr;
}