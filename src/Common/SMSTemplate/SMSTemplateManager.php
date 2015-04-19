<?php

namespace common\SMSTemplate\models;

use common\exception\ConfigErrorException;

class SMSTemplateManager {

	/**
	 * 取得注册短信的模版
	 */
	public function getRegTemplate () {
		$t = SMSTemplate::find('register');
		if (null == $t) {
			throw new ConfigErrorException('can not found register sms template.');
		}
		return $t->template;
	}

	public function getPhoneLoginTemplate () {
		$t = SMSTemplate::find('phoneLogin');
		if (null == $t) {
			throw new ConfigErrorException('can not found phone login sms template.');
		}
		return $t->template;
	}
	
	public function getModifyPhonenumTemplate(){
		$t = SMSTemplate::find('modifyPhonenum');
		if (null == $t) {
			throw new ConfigErrorException('can not found modify phonenum sms template.');
		}
		return $t->template;
	}
	/**
	 * [getRegNoteTemplate 获得加入团购短信模板]
	 * @return [type] [description]
	 */
	public function getRegNoteTemplate(){
		$message = SMSTemplate::find('regNote');
		if (is_null($message)) {
			throw new ConfigErrorException('can not find register note sms template.');
		}
		return $message->template;
	}
	/**
	 * [getDealerNoteTemplate 获得确认经销商短信模板]
	 * @return [type] [description]
	 */
	public function getDealerNoteTemplate(){
		$message = SMSTemplate::find('dealerNote');
		if (is_null($message)) {
			throw new ConfigErrorException('can not find dealer note sms template.');
		}
		return $message->template;
	}
	/**
	 * [getCancelPlanTemplate 获得取消团购短信模板]
	 * @return [type] [description]
	 */
	public function getCancelPlanTemplate(){
		$message = SMSTemplate::find('cancelPlan');
		if (is_null($message)) {
			throw new ConfigErrorException('can not find cancel groupon note sms template.');
		}
		return $message->template;
	}
	/**
	 * [getCancelDealerTemplate 获得取消团购短信模板]
	 * @return [type] [description]
	 */
	public function getCancelDealerTemplate(){
		$message = SMSTemplate::find('cancelDealer');
		if (is_null($message)) {
			throw new ConfigErrorException('can not find cancel groupon note sms template.');
		}
		return $message->template;
	}

}