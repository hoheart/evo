<?php

namespace User\Exception;

class UserErrcode {
	const PhonenumExisting = 402000; // 手机号码已经存在
	const LoginFailed = 402001; // 登录失败
	const NotLogin = 402002; // 未登录错误
	const OldPasswordError = 402003; // 修改密码时原密码错误
	const CheckEmailFailed = 402004; // 设置邮箱时，验证邮箱错误
	const ModifySamePhonenumError = 402005; // 修改手机号时，新号与原号相同
	const SupplementPasswordError = 402006; // 补充密码时，存在原密码，不能补充密码
	const EMailExists = 402007; // 绑定邮箱时，邮箱已经存在了
	const CaptchaLoginFailed = 402008; // 手机验证码登录失败
	                                   
	// 账号相关
	const NotSufficientFunds = 400201; // 余额不足
}
?>