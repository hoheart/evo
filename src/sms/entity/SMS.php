<?php

namespace sms\entity;

use orm\DataClass;

/**
 * @hhp:orm entity
 *
 * @author Hoheart
 *        
 */
class SMS extends DataClass {
	
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
	 * 手机号码，用英文逗号(,)分隔，最大100个号码。
	 *
	 * @var string
	 */
	protected $receiver;
	
	/**
	 * @hhp:orm var int16
	 *
	 * @var integer
	 */
	protected $status = self::STATUS_SENDING;
	
	/**
	 * @hhp:orm var int64
	 *
	 * @var integer
	 */
	protected $contentId;
	
	/**
	 * 消息内容
	 * @hhp:orm var class
	 * @hhp:orm belongClass sms\entity\SMSContent
	 * @hhp:orm selfAttribute2Relationship contentId
	 * @hhp:orm anotherAttribute2Relationship id
	 *
	 * @var SMSContent
	 */
	protected $content;
	
	/**
	 * @hhp:orm var DateTime
	 *
	 * @var \DateTime
	 */
	protected $createTime;

	public function getId () {
		return $this->id;
	}

	public function setReceiver ($receiver) {
		$this->receiver = $receiver;
	}

	public function getReceiver () {
		return $this->receiver;
	}

	public function setContentId ($id) {
		$this->contentId = $id;
	}

	public function getContentId () {
		return $this->contentId;
	}

	public function setStatus ($status) {
		if ($status >= self::STATUS_MIN && $status <= self::STATUS_MAX) {
			$this->status = $status;
		}
	}

	public function getStatus () {
		return $this->status;
	}

	public function setContent (SMSContent $content) {
		$this->content = $content;
	}

	public function getContent () {
		return $this->content;
	}

	public function setCreateTime (\DateTime $t) {
		$this->createTime = $t;
	}

	public function getCreateTime () {
		return $this->createTime;
	}
}