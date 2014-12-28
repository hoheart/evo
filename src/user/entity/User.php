<?php

namespace user\entity;

/**
 * @hhp:orm persistentName User
 * @hhp:orm primaryKey id
 * 
 * @author Hoheart
 *        
 */
class User {
	
	/**
	 * 性别
	 *
	 * @var integer
	 */
	const GENDER_UNKNOWN = 0;
	const GENDER_FEMALE = 1;
	const GENDER_MALE = 2;
	const GENDER_MIN = 0;
	const GENDER_MAX = 2;
	const STATUS_NORMAL = 0;
	const STATUS_DISABLED = 1;
	const STATUS_MIN = 0;
	const STATUS_MAX = 1;

	public function __construct () {
	}
	
	/**
	 * @hhp:orm persistentName id
	 * 
	 * @var integer
	 */
	protected $id;
	
	/**
	 * 用户名
	 *
	 * @hhp:orm persistentName name
	 * 
	 * @var string
	 */
	protected $name;
	
	/**
	 * 保存密码用的随机字符串
	 *
	 * @var string
	 */
	protected $salt;
	
	/**
	 *
	 * @var string
	 */
	protected $password;
	
	/**
	 *
	 * @var string
	 */
	protected $phonenum;
	
	/**
	 * 昵称
	 *
	 * @var string
	 */
	protected $nickName;
	
	/**
	 * 真实姓名
	 *
	 * @var string
	 */
	protected $realName;
	
	/**
	 *
	 * @var integer
	 */
	protected $gender;
	
	/**
	 * 头像文件id
	 */
	protected $avatar = 1;
	
	/**
	 * 邮件地址
	 *
	 * @var string
	 */
	protected $email;
	
	/**
	 * 状态
	 *
	 * @var integer
	 */
	protected $status;
	
	/**
	 * 最后一次登陆的IP
	 *
	 * @var string
	 */
	protected $lastLoginIP;
	
	/**
	 * 推荐的用户
	 *
	 * @var integer
	 */
	protected $recommendUserId;
	
	/**
	 *
	 * @var DateTime
	 */
	protected $createTime;

	public function getId () {
		return $this->id;
	}

	public function setName ($name) {
		$this->name = $name;
	}

	public function getName () {
		return $this->name;
	}

	private function encodePassword ($salt, $password) {
		return md5(md5($salt . $password) . $salt);
	}

	public function setPassword ($password) {
		for ($i = 0; $i < 6; ++ $i) {
			$this->salt .= chr(mt_rand(32, 126));
		}
		
		$this->password = $this->encodePassword($this->salt, $password);
	}

	public function checkPassword ($password) {
		return $this->password === $this->encodePassword($this->salt, $password);
	}
}