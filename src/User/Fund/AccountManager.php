<?php

namespace User\Fund;

use HHP\App;
use User\Fund\Exception\NotSufficientFundsException;
use User\Fund\Entity\Account;
use User\Fund\Entity\ChargeRecord;
use User\Fund\Entity\ConsumeLog;
use HHP\Singleton;
use ORM\Condition;

/**
 */
class AccountManager extends Singleton {

	public function __construct () {
	}

	public function get ($accountId) {
		$orm = App::Instance()->getService('orm');
		$account = $orm->get('User\Fund\Entity\Account', $accountId);
		
		return $account;
	}

	public function getOneAccount ($userId) {
		$cond = new Condition('userId=' . $userId);
		$orm = App::Instance()->getService('orm');
		$ret = $orm->where('\User\Fund\Entity\Account', $cond);
		
		if (count($ret) > 0) {
			return $ret[0];
		} else {
			return null;
		}
	}

	public function addAccount ($userId) {
		$a = new Account();
		$a->userId = $userId;
		$a->amount = 0;
		
		$orm = App::Instance()->getService('orm');
		$orm->save($a);
	}

	/**
	 * 扣款
	 *
	 * @param
	 *        	accountId
	 * @param
	 *        	amount
	 * @param
	 *        	desc
	 */
	public function deduct ($accountId, $amount, $desc) {
		$balance = $this->getBalance($accountId);
		if ($balance < $amount) {
			throw new NotSufficientFundsException();
		}
		
		$sql = "UPDATE Account SET amount = amount-$amount WHERE id = $accountId AND amount >= $amount";
		$db = App::Instance()->getService('db');
		if (1 != $db->exec($sql)) { // 成功执行SQL语句确一行也没有更改，肯定是没钱了
			throw new NotSufficientFundsException();
		}
		
		$cl = new ConsumeLog();
		$cl->accountId = $accountId;
		$cl->amount = $amount;
		$cl->desc = $desc;
		
		$orm = App::Instance()->getService('orm');
		$orm->save($cl);
	}

	/**
	 *
	 * @param
	 *        	accountId
	 * @return null
	 */
	public function getBalance ($accountId) {
		$account = $this->get($accountId);
		return $account->amount;
	}

	/**
	 *
	 * @param
	 *        	accountId
	 * @param
	 *        	amount
	 * @param
	 *        	desc
	 */
	public function charge ($accountId, $amount, $desc) {
		$orm = App::Instance()->getService('orm');
		$a = $orm->get('User\Fund\Entity\Account', $accountId);
		$a->amount += $amount;
		$orm->save($a);
		
		$cr = new ChargeRecord();
		$cr->accountId = $accountId;
		$cr->amount = $amount;
		$cr->desc = $desc;
		$orm->save($cr);
	}

	public function getChargeRecord ($accountId) {
		$cond = new Condition('accountId=' . $accountId);
		$orm = App::Instance()->getService('orm');
		$ret = $orm->where('\User\Fund\Entity\ChargeRecord', $cond);
		
		return $ret;
	}
}