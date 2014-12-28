<?php

namespace user\fund;

use hhp\App;
use orm\Condition;
use user\fund\exception\NotSufficientFundsException;

/**
 */
class AccountManager {

	public function __construct () {
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
		
		$sql = "UPDATE account SET amount = amount-$amount WHERE userId = $accountId AND amount >= $amount";
		$db = App::Instance()->getService('db');
		if (1 != $db->exec($sql)) { // 成功执行SQL语句确一行也没有更改，肯定是没钱了
			throw new NotSufficientFundsException();
		}
	}

	/**
	 *
	 * @param
	 *        	accountId
	 * @return null
	 */
	public function getBalance ($accountId) {
		$orm = App::Instance()->getService('orm');
		$account = $orm->get('user\fund\entity\Account', $accountId);
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
		// TODO implement here
	}
}