<?php

namespace user;

use user\models\Invitation;
use hhp\Session;
use hfc\database\DatabaseQueryException;
use hhp\Singleton;

class InvitationManager extends Singleton {
	
	/**
	 * 存储邀请人的session标志
	 *
	 * @var string
	 */
	const SESSION_TAG = 'INVITER_USER_ID';

	protected function getInvitationCode ($userId) {
		$it = Invitation::find($userId);
		if (null == $it) {
			$it = new Invitation();
			$it->userId = $userId;
			
			while (true) {
				$it->code = uniqid('', true);
				
				try {
					$it->save();
				} catch (DatabaseQueryException $e) {
					if ('23000' == $e->getSourceCode()) {
						continue;
					}
					
					throw $e;
				}
				
				break;
			}
		}
		
		return $it->code;
	}

	/**
	 * 邀请用户之后，有人用邀请链接来访问了，设置一下，等到用户注册时登记到user表的被邀请人字段。
	 */
	public function setInvitedUser ($code) {
		$invitation = Invitation::where('code', '=', $code)->first();
		if (null != $invitation) {
			Session::set(self::SESSION_TAG, $invitation->userId);
		}
	}

	public function getInvitedUserId () {
		return Session::get(self::SESSION_TAG);
	}
}