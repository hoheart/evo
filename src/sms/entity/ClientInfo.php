<?php

namespace sms\entity;

use orm\DataClass;

/**
 * 客户相关的配置，比如该客户的价格，以后可扩展每个客户选择一个通道。
 *
 * @hhp:orm persistentName ClientInfo
 * @hhp:orm primaryKey clientId
 *
 * @author Jejim
 *        
 */
class ClientInfo extends DataClass {
	
	/**
	 * @hhp:orm persistentName userId
	 *
	 * @var integer
	 */
	protected $userId;
	
	/**
	 * @hhp:orm persistentName price
	 *
	 * @var integer
	 */
	protected $price;
	
	/**
	 * @hhp:orm persistentName clientId
	 *
	 * @var string
	 */
	protected $clientId;
	
	/**
	 * @hhp:orm persistentName encodedPassword
	 *
	 * @var string
	 */
	protected $encodedPassword;

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

	public function setClientId ($id) {
		$this->clientId = $id;
	}

	public function getClientId () {
		return $this->clientId;
	}

	public function setEncodedPassword ($password) {
		$this->encodedPassword = $password;
	}

	public function getEncodedPassword () {
		return $this->encodedPassword;
	}
}