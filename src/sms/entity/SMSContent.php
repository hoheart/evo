<?php

namespace sms\entity;

use orm\DataClass;
use user\entity\User;

/**
 * @hhp:orm persistentName SMSContent
 * @hhp:orm primaryKey id
 *
 * @author Hoheart
 *        
 */
class SMSContent extends DataClass {

	public function __construct () {
	}
	
	/**
	 * @hhp:orm persistentName id
	 * @hhp:orm var int64
	 * @hhp:orm autoIncrement true
	 *
	 * @var integer
	 */
	protected $id;
	
	/**
	 * @hhp:orm persistentName userId
	 * @hhp:orm var int32
	 *
	 * @var integer
	 */
	protected $userId;
	
	/**
	 *
	 * @var User
	 */
	protected $sender;
	
	/**
	 * @hhp:orm persistentName msg
	 * @hhp:orm var string
	 *
	 * @var string
	 */
	protected $msg;
	
	/**
	 * @hhp:orm persistentName subPort
	 * @hhp:orm var string
	 *
	 * @var string
	 */
	protected $subPort;
	
	/**
	 * @hhp:orm persistentName userMsgId
	 * @hhp:orm var string
	 *
	 * @var string
	 */
	protected $userMsgId;

	public function getId () {
		return $this->id;
	}

	public function setUserId ($id) {
		$this->userId = (int) $id;
	}

	public function getUserId () {
		return $this->userId;
	}

	public function getSender () {
		return $this->user;
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
}