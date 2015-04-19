<?php

namespace util\SMS;

interface ISMSGateway {

	/**
	 *
	 * @param array $conf
	 *        	格式array(
	 *        	'uid' => '9999',
	 *        	'pwd' => '9999',
	 *        	'url' => 'http://dxhttp.c123.cn/tx/',
	 *        	'mid' => ''
	 *        	)
	 */
	public function __construct ($conf);

	/**
	 * 发送短信
	 * 
	 * @param string $phonenum
	 *        	手机号，可以是多个，用英文逗号分开
	 * @param string $content        	
	 */
	public function send ($phonenum, $content);
}