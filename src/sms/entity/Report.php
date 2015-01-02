<?php

namespace sms\entity;

use orm\DataClass;

/**
 * @hhp:orm entity
 *
 * @author Hoheart
 *        
 */
class Report extends DataClass {
	
	/**
	 * 读取状态值
	 *
	 * @var integer
	 */
	const READ_STATUS_UNREAD = 0;
	const READ_STATUS_READ = 1;
	
	/**
	 * @hhp:orm autoIncrement true
	 * @hhp:orm var int64
	 *
	 * @var integer
	 */
	protected $id;
	
	/**
	 *
	 * @var DateTime
	 */
	protected $time;
	
	/**
	 * 网关消息id
	 *
	 * @var string
	 */
	protected $msgId;
	
	/**
	 *
	 * @var string
	 */
	protected $longnum;
	
	/**
	 * @hhp:orm var int64
	 *
	 * @var integer
	 */
	protected $userId;
	
	/**
	 * 手机号
	 *
	 * @var string
	 */
	protected $phonenum;
	
	/**
	 *
	 * @var string
	 */
	protected $userMsgId;
	
	/**
	 *
	 * @var integer
	 */
	protected $status;
	
	/**
	 *
	 * @var string
	 */
	protected $errstr;
	
	/**
	 *
	 * @var integer
	 */
	protected $readStatus;

	public function getId () {
		return $this->id;
	}

	public function setTime (\DateTime $t) {
		$this->time = $t;
	}

	public function getTime () {
		return $this->time;
	}

	public function setMsgId ($id) {
		$this->msgId = $id;
	}

	public function getMsgId () {
		return $this->msgId;
	}

	public function setLongnum ($num) {
		if (is_numeric($num)) {
			$this->longnum = $num;
		}
	}

	public function getLongnum () {
		return $this->longnum;
	}

	public function setUserId ($id) {
		$this->userId = $id;
	}

	public function getUserId () {
		return $this->userId;
	}

	public function setPhonenum ($num) {
		if (is_numeric($num)) {
			$this->phonenum = $num;
		}
	}

	public function getPhonenum () {
		return $this->phonenum;
	}

	public function setUserMsgId ($id) {
		$this->userMsgId = $id;
	}

	public function getUserMsgId () {
		return $this->userMsgId;
	}

	public function setStatus ($status) {
		if (is_numeric($status)) {
			$this->status = $status;
		}
	}

	public function getStatus () {
		return $this->status;
	}

	public function setErrstr ($str) {
		$this->errstr = $str;
	}

	public function getErrstr () {
		return $this->errstr;
	}

	public function setReadStatus ($status) {
		$this->readStatus = $status;
	}

	public function getReadStatus () {
		return $this->readStatus;
	}
}
