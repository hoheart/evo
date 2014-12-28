<?php

namespace user\exception;

class UserErrcode extends \hhp\exception\UserErrcode {
	const LoginError = 4200;
	const NotSufficientFunds = 4201; // 余额不足
}
?>