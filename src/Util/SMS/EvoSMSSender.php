<?php

namespace util\SMS;

use hfc\util\Log;
use sms\ClientManager;
use sms\SMSSender;

/**
 * 短信发送程序
 *
 * @author Jejim
 *        
 */
class EvoSMSSender implements ISMSGateway {
	
	/**
	 * 配置。格式：参见接口说明
	 *
	 * @var array
	 */
	protected $mConf = null;
	
	/**
	 * 与短信网关的连接
	 *
	 * @var string
	 */
	protected $mCurl = null;

	public function __construct ($conf = null) {
		$this->mConf = $conf;
		
		$this->mCurl = curl_init($this->mConf['url']);
		curl_setopt($this->mCurl, CURLOPT_POST, true);
		curl_setopt($this->mCurl, CURLOPT_RETURNTRANSFER, true);
	}

	public function __destruct () {
		curl_close($this->mCurl);
	}

	public function send ($phonenum, $content) {
		$clientInfo = ClientManager::Instance()->get($this->mConf['clientId']);
		$ret = SMSSender::Instance()->send($clientInfo, $phonenum, $content);
		
		Log::info("send msg: $content to $phonenum , ret: $ret");
		
		$retInfo = $this->parseRet($ret);
		
		return $retInfo;
	}

	protected function parseRet ($re) {
		$arr = json_decode($re, true);
		
		$errcode = - 1;
		if (is_array($arr) && array_key_exists('errorcode', $arr)) {
			$errcode = $arr['errorcode'];
		}
		return array(
			$errcode,
			array()
		);
	}
}