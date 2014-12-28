<?php

namespace sms;

use hhp\App;

class MongateSMSGateway implements ISMSGateway {
	
	/**
	 *
	 * @var string
	 */
	const SEND_URL = 'http://61.145.229.29:9003/MWGate/wmgw.asmx/MongateSendSubmit';
	
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

	public function __construct () {
		$this->mCurl = curl_init(self::SEND_URL);
		curl_setopt($this->mCurl, CURLOPT_POST, true);
		curl_setopt($this->mCurl, CURLOPT_RETURNTRANSFER, true);
	}

	public function __destruct () {
		curl_close($this->mCurl);
	}

	public function login ($userName, $password) {
	}

	/**
	 *
	 * @param
	 *        	phonenum
	 * @param
	 *        	content
	 */
	public function send ($phonenumArr, $content, $subPort, $msgId) {
		$conf = App::Instance()->getConfigValue('monGateway');
		$data = array(
			'userId' => $conf['userId'],
			'password' => $conf['password'],
			'pszMobis' => implode(',', $phonenumArr),
			'pszMsg' => $content,
			'iMobiCount' => count($phonenumArr),
			'pszSubPort' => $subPort,
			'MsgId' => $msgId
		);
		
		$strData = http_build_query($data);
		curl_setopt($this->mCurl, CURLOPT_POSTFIELDS, $strData);
		
		// $ret = '<?xml version="1.0" encoding="utf-8"? ><string
		// xmlns="http://tempuri.org/">-3648468475435350319</string>aa';
		$ret = curl_exec($this->mCurl);
		
		$retInfo = $this->parseRet($ret);
	}

	public function getBalance () {
	}

	protected function parseRet ($re) {
		$pos1 = strrpos('</string>', $re);
		$pos = strrpos('>', $re);
		
		$ret = false;
		$msgId = substr($re, $pos, $pos1 - $pos);
		if ($msgId < - 10000000 || $msgId > 10000000) {
			$ret = true;
		}
		
		return array(
			$ret,
			$msgId
		);
	}
}
