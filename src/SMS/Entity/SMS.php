<?php

namespace sms\entity;

use orm\DataClass;

/**
 * 因为很可能状态报告没有，而用户要对发送记录按手机号码进行查询，所以，每条短信一个记录可以方便查询。
 * @hhp:orm entity
 *
 * @author Hoheart
 *        
 */
class SMS extends DataClass {
	
	/**
	 * 发送状态
	 *
	 * @var integer
	 */
	const STATUS_MIN = 0;
	const STATUS_SEND_OK = 0;
	const STATUS_SENDING = 1;
	const STATUS_NO_MONEY = 2;
	const STATUS_RECEIVED = 3;
	const STATUS_GATEWAY_ERROR = 4;
	const STATUS_RECEIVE_ERROR = 5;
	const STATUS_SEND_ERROR = 6;
	const STATUS_MAX = 6;
	
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
	protected $reportTime;
	
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
	protected $clientId;
	
	/**
	 * 接收者的手机号
	 *
	 * @var string
	 */
	protected $receiver;
	
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
	protected $reportReadStatus = self::READ_STATUS_UNREAD;
	
	/**
	 *
	 * @var integer
	 */
	protected $contentId;
	
	/**
	 * 消息内容
	 * @hhp:orm var class
	 * @hhp:orm belongClass SMS\Entity\SMSContent
	 * @hhp:orm selfAttribute2Relationship contentId
	 * @hhp:orm anotherAttribute2Relationship id
	 *
	 * @var SMSContent
	 */
	protected $content;

	public function getId () {
		return $this->id;
	}

	public function setReportTime (\DateTime $t) {
		$this->reportTime = $t;
	}

	public function getReportTime () {
		return $this->reportTime;
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

	public function setReceiver ($num) {
		if (is_numeric($num)) {
			$this->receiver = $num;
		}
	}

	public function getReceiver () {
		return $this->receiver;
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

	public function setReportReadStatus ($status) {
		$this->reportReadStatus = $status;
	}

	public function getReportReadStatus () {
		return $this->reportReadStatus;
	}

	public function setContentId ($id) {
		$this->contentId = $id;
	}

	public function getContentId () {
		return $this->contentId;
	}

	public function setContent (SMSContent $content) {
		$this->content = $content;
	}

	public function getContent () {
		return $this->content;
	}
}
