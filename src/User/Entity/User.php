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
	 */
	const GENDER_UNKNOW = 0;
	const GENDER_FEMALE = 1;
	const GENDER_MALE = 2;
	
	/**
	 * 用户ID
	 *
	 * @hhp:orm autoIncrement true
	 *
	 * @var integer
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
	
	// public function getId () {
	// return $this->id;
	// }
	
	// public function setName ($name) {
	// $this->name = $name;
	
	// return $this;
	// }
	
	// public function getName () {
	// return $this->name;
	// }
	
	// public function setPhonenum ($phonenum) {
	// $this->phonenum = $phonenum;
	// }
	
	// public function getPhonenum () {
	// return $this->phonenum;
	// }
	
	// public function setSalt ($salt) {
	// $this->salt = $salt;
	// }
	
	// public function getSalt () {
	// return $this->salt;
	// }
	
	// public function setPassword ($password) {
	// $this->password = $password;
	// }
	
	// public function getPassword () {
	// return $this->password;
	// }
	
	// public function setRealName ($name) {
	// $this->realName = $name;
	// }
	
	// public function getRealName () {
	// return $this->realName;
	// }
	
	// public function setGender ($gender) {
	// $this->gender = $gender;
	// }
	
	// public function getGender () {
	// return $this->gender;
	// }
	
	// public function setAvatar ($id) {
	// $this->avatar = $id;
	// }
	
	// public function getAvatar () {
	// return $this->avatar;
	// }
	
	// public function setEmail ($email) {
	// $this->email = $email;
	// }
	
	// public function getEmail () {
	// return $this->email;
	// }
	
	// public function setStatus ($status) {
	// $this->status = $status;
	// }
	
	// public function getStatus () {
	// return $this->status;
	// }
	
	// public function setLastLoginIP ($ip) {
	// $this->lastLoginIP = $ip;
	// }
	
	// public function getLastLoginIP () {
	// return $this->lastLoginIP;
	// }
}