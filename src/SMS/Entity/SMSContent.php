<?php

namespace sms\entity;

use orm\DataClass;

/**
 * @hhp:orm entity
 *
 * @author Hoheart
 *        
 */
class SMSContent extends DataClass {
	
	/**
	 * 状态取值定义
	 *
	 * @var integer
	 */
	const STATUS_MIN = 1;
	const STATUS_SEND_OK = self::STATUS_MIN;
	const STATUS_NO_MONEY = 2;
	const STATUS_GATEWAY_ERROR = 3;
	const STATUS_SENDING = 4;
	const STATUS_MAX = 4;
	
	/**
	 * @hhp:orm var int64
	 * @hhp:orm autoIncrement true
	 *
	 * @var integer
	 */
	protected $id;
	
	/**
	 * @hhp:orm var int32
	 *
	 * @var integer
	 */
	protected $clientId;
	
	/**
	 * @hhp:orm var string
	 *
	 * @var string
	 */
	protected $msg;
	
	/**
	 * @hhp:orm var string
	 *
	 * @var string
	 */
	protected $subPort;
	
	/**
	 * @hhp:orm var string
	 *
	 * @var string
	 */
	protected $userMsgId;
	
	/**
	 *
	 * @var integer
	 */
	protected $status = self::STATUS_SENDING;

	public function getId () {
		return $this->id;
	}

	public function setUserId ($id) {
		$this->userId = (int) $id;
	}

	public function getUserId () {
		return $this->userId;
	}

	public function setMsg ($msg) {
		$this->msg = $msg;
	}

	public function getMsg () {
		return $this->msg;
	}

	public function setSubPort ($port) {
		$this->subPort = $port;
	}

	public function getSubPort () {
		return $this->subPort;
	}

	public function setUserMsgId ($id) {
		$this->userMsgId = $id;
	}

	public function getUserMsgId () {
		return $this->userMsgId;
	}

	public function setStatus ($status) {
		$this->status = $status;
	}

	public function getStatus () {
		return $this->status;
	}
}