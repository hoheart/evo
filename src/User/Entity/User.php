<?php

namespace User\Entity;

use ORM\DataClass;

/**
 * 用户数据类
 * @hhp:orm entity
 * @hhp:orm saveName User
 *
 * @author Jejim
 *        
 */
class User extends DataClass {
	
	/**
	 * 性别取值
	 * @hhp:orm autoIncrement true
	 *
	 * @var integer
	 */
	const GENDER_UNKNOW = 0;
	const GENDER_FEMALE = 1;
	const GENDER_MALE = 2;
	
	/**
	 */
	protected $id;
	
	/**
	 * 用户名
	 *
	 * @var string
	 */
	protected $name;
	
	/**
	 */
	protected $phonenum;
	
	/**
	 * 加密用户密码的混淆码
	 *
	 * @var string
	 */
	protected $salt;
	
	/**
	 */
	protected $password;
	
	/**
	 * 真实姓名
	 *
	 * @var string
	 */
	protected $realName;
	
	/**
	 */
	protected $gender;
	
	/**
	 * 文件id
	 */
	protected $avatar = 1;
	
	/**
	 */
	protected $email;
	
	/**
	 * 1：正常、2：禁用、3：异常
	 */
	protected $status;
	
	/**
	 */
	protected $lastLoginIP;
}