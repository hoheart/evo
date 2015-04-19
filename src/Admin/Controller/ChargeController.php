<?php

namespace admin\controller;

use hhp\Controller;
use user\fund\AccountManager;
use hhp\IRequest;
use hfc\exception\ParameterErrorException;

class ChargeController extends Controller {

	public function charge_getAction (IRequest $request) {
		$accountId = $request->get('accountId');
		if (! is_numeric($accountId) || $accountId <= 0) {
			throw new ParameterErrorException('accountId');
		}
		
		$am = AccountManager::Instance();
		$balance = $am->getBalance($accountId);
		
		echo $balance;
	}

	public function chargeAction (IRequest $request) {
		$accountId = $request->get('accountId');
		if (! is_numeric($accountId) || $accountId <= 0) {
			throw new ParameterErrorException('accountId');
		}
		
		$addAmount = $request->get('amount');
		if (! is_numeric($addAmount) || $addAmount <= 0) {
			throw new ParameterErrorException('amount');
		}
		
		$am = AccountManager::Instance();
		$am->charge($accountId, $addAmount, $request->get('desc'));
	}
}
?>