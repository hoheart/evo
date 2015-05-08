<?php

namespace sms\entity;

use orm\DataClass;

/**
 * 客户相关的信息，比如该客户的价格，采用的通道等。一个公司（用户）可能对应多个产品，每个产品申请的通道。
 *
 * @hhp:orm entity
 * @hhp:orm primaryKey id
 *
 * @author Jejim
 */
class ClientInfo extends DataClass {
	
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
	protected $userId;
	
	/**
	 *
	 * @var integer
	 */
	protected $price;
	
	/**
	 *
	 * @var string
	 */
	protected $gateway;
	
	/**
	 * 签名
	 *
	 * @var string
	 */
	protected $sign;

	public function getId () {
		return $this->id;
	}

	public function setUserId ($id) {
		$this->userId = (int) $id;
	}

	public function getUserId () {
		return $this->userId;
	}

	public function setPrice ($price) {
		$this->price = (int) $price;
	}

	public function getPrice () {
		return $this->price;
	}

	public function setGateway ($gateway) {
		$this->gateway = $gateway;
	}

	public function getGateway () {
		return $this->gateway;
	}

	public function setSign ($sign) {
		$this->sign = $sign;
	}

	public function getSign () {
		return $this->sign;
	}
}
