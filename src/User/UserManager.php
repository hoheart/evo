<?php

namespace User;

use HHP\Singleton;
use HHP\App;
use ORM\Condition;
use User\Entity\User;

/**
 */
class UserManager extends Singleton {
	
	/**
	 *
	 * @var string
	 */
	protected $mUserClassName = '\User\Entity\User';
	
	/**
	 * 验证码操作类型：修改手机号
	 *
	 * @var string
	 */
	const CAPTCHA_OP_MODIFY_PHONENUM = 'modifyPhonenum';

	public function __construct () {
	}

	static public function Instance () {
		static $me = null;
		if (null == $me) {
			$clsName = get_called_class();
			$me = new $clsName();
		}
		
		return $me;
	}

	/**
	 * 通过关键信息（用户名、手机、邮箱）取得唯一用户
	 *
	 * @param string $phonenum        	
	 * @return User
	 */
	public function getUserByKeyInfo ($key) {
		$orm = App::Instance()->getService('orm');
		$cond = new Condition();
		$cond->setRelationship(Condition::RELATIONSHIP_OR);
		$cond->add('name', '=', $key);
		$cond->add('phonenum', '=', $key);
		$cond->add('email', '=', $key);
		$ret = $orm->where($this->mUserClassName, $cond);
		
		if (count($ret) >= 1) {
			return $ret[0];
		}
		
		return null;
	}

	/**
	 * (non-PHPdoc)
	 *
	 * @see \util\captcha\ISmsContentCreator::createSmsContent()
	 */
	public function createSmsContent ($captcha) {
		$smsTemplateManager = SMSTemplateManager::Instance();
		
		return sprintf($smsTemplateManager->getModifyPhonenumTemplate(), $captcha);
	}

	/**
	 * 添加用户
	 *
	 * @param string $phonenum        	
	 * @param string $password        	
	 * @param string $captcha        	
	 * @param string $realName        	
	 * @throws PhonenumExistingException
	 * @throws QueryException
	 */
	public function addUser ($phonenum, $password, $captcha, $realName = '', $gender = User::Unknow) {
		$salt = $this->createSalt();
		$encodedPassword = $this->encryptPassword($salt, $password);
		
		$this->addUserCore($phonenum, $salt, $encodedPassword, $captcha, $realName, $gender);
	}

	public function addUserNoPassword ($phonenum, $captcha, $realName, $gender = User::Unknow) {
		$this->addUserCore($phonenum, '', '', $captcha, $realName, $gender);
	}

	protected function addUserCore ($phonenum, $salt, $encodedPassword, $captcha, $realName, $gender = User::Unknow) {
		$sc = BaseCaptcha::Instance();
		$sc->checkCaptcha($captcha, self::CAPTCHA_OP_REG, $phonenum);
		
		$u = new User();
		$u->phonenum = $phonenum;
		$u->salt = $salt;
		$u->password = $encodedPassword;
		$u->realName = $realName;
		
		$im = InvitationManager::Instance();
		$recommendUserId = $im->getInvitedUserId();
		if (! empty($recommendUserId)) {
			$u->recommendUserId = $recommendUserId;
		}
		
		$u->gender = $gender;
		
		try {
			$u->save();
			return $u;
		} catch (DatabaseQueryException $e) {
			if ('23000' == $e->getSourceCode()) {
				throw new PhonenumExistingException();
			} else {
				throw $e;
			}
		}
	}

	/**
	 * 创建密码的盐
	 *
	 * @return string
	 */
	protected function createSalt () {
		$salt = '';
		for ($i = 0; $i < 8; ++ $i) {
			// 取一个可视assic字符，为增加随机性宽度没用纯数字
			$salt .= chr(mt_rand(32, 126));
		}
		
		return $salt;
	}

	/**
	 * 加密密码
	 *
	 * @param string $salt        	
	 * @param string $srcPwd        	
	 * @return string
	 */
	protected function encryptPassword ($salt, $srcPwd) {
		return sha1(sha1($salt . $srcPwd) . $salt);
	}

	/**
	 * 检查密码
	 *
	 * @param User $u        	
	 * @param string $password        	
	 * @return boolean
	 */
	public function checkPassword (User $u, $password) {
		$enPwd = $this->encryptPassword($u->salt, $password);
		return $enPwd === $u->password;
	}

	/**
	 * 取得修改手机号码的验证码
	 *
	 * @param string $phonenum        	
	 */
	public function getModifyPhonenumCaptcha ($phonenum) {
		$u = Login::GetLoginedUser();
		if ($u->phonenum == $phonenum) {
			throw new ModifySamePhonenumErrorException();
		}
		$cnt = User::where('phonenum', '=', $phonenum)->count();
		if ($cnt > 0) {
			throw new PhonenumExistingException();
		}
		
		$smsSender = SMSService::Instance();
		$sc = new SMSCaptcha($this, $smsSender);
		
		$this->mCurrentOp = self::CAPTCHA_OP_MODIFY_PHONENUM;
		
		return $sc->getCaptcha(self::CAPTCHA_OP_MODIFY_PHONENUM, $phonenum, 
				App::Instance()->getConfigValue('app.debug'));
	}

	/**
	 * 修改手机号码
	 *
	 * @param string $phonenum        	
	 * @param string $captcha        	
	 */
	public function modifyPhonenum ($phonenum, $captcha) {
		$sc = new BaseCaptcha();
		$sc->checkCaptcha($captcha, self::CAPTCHA_OP_MODIFY_PHONENUM, $phonenum);
		
		$u = Login::GetLoginedUser();
		$u->phonenum = $phonenum;
		
		$u->save();
	}

	public function get ($id) {
		if (empty($id)) {
			return null;
		}
		
		return User::find($id);
	}

	/**
	 *
	 * @param
	 *        	oldPassword
	 * @param
	 *        	newPassword
	 */
	public function modifyPassword ($oldPassword, $newPassword) {
		$u = Login::GetLoginedUser();
		if (! $this->checkPassword($u, $oldPassword)) {
			throw new OldPasswordErrorException();
		}
		
		$this->setPassword($u, $newPassword);
	}

	public function setPassword ($user, $newPassword) {
		$salt = $this->createSalt();
		$user->salt = $salt;
		$user->password = $this->encryptPassword($salt, $newPassword);
		
		$user->save();
	}

	/**
	 * 通过关键信息（用户名、手机、邮箱）取得唯一用户
	 *
	 * @param string $phonenum        	
	 * @return User
	 */
	public function getUsersByKey ($key) {
		if (! $key) {
			return null;
		}
		return User::whereRaw("phonenum=? OR name=? OR email=? OR realName = ?", 
				array(
					$key,
					$key,
					$key,
					$key
				))->get()->toArray();
	}

	public function lists ($where = null, array $value = null) {
		$userArr = User::whereRaw($where, $value)->get();
		return $userArr;
	}

	public function getListByIds (array $idArr = null) {
		if (null == $idArr) {
			return array();
		}
		return User::whereIn('id', $idArr)->get();
	}

	public function getRealName ($userId) {
		return User::where('id', '=', $userId)->pluck('realName');
	}

	public function getUserInfo ($userId) {
		return User::find($userId);
	}

	public function updateUser ($userId, $arr) {
		$user = User::find($userId);
		if (! is_null($user)) {
			foreach ($arr as $key => $value) {
				if (isset($user->$key)) {
					$user->$key = $value;
				}
			}
			return $user->save();
		}
		return false;
	}
}