<?php

namespace util\exception;

class UserErrorCode {
	const CaptchaError = 416000; // 验证码错误
	const OutofSMSError = 416001;//该手机号今天的短信已用完。
}