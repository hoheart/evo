<?php

namespace sms;

use hhp\App;

class MongateSMSGateway implements ISMSGateway {
	
	/**
	 *
	 * @var string
	 */
	const SEND_URL = 'http://61.145.229.29:9003/MWGate/wmgw.asmx/';
	
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
		$this->mCurl = curl_init();
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
		curl_setopt($this->mCurl, CURLOPT_URL, self::SEND_URL . 'MongateSendSubmit');
		
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
		
		$retInfo = $this->parseSendRet($ret);
		
		return $retInfo;
	}

	public function getBalance () {
	}

	protected function parseSendRet ($re) {
		$pos1 = strrpos($re, '</string>');
		$pos = strrpos($re, '>', $pos1 - strlen($re)) + 1;
		
		$ret = false;
		$msgId = substr($re, $pos, $pos1 - $pos);
		if (false !== $msgId && strlen($msgId) > 5) {
			$ret = true;
		}
		
		return array(
			$ret,
			$msgId
		);
	}

	public function readReport () {
		curl_setopt($this->mCurl, CURLOPT_URL, self::SEND_URL . 'MongateGetDeliver');
		
		$conf = App::Instance()->getConfigValue('monGateway');
		$data = array(
			'userId' => $conf['userId'],
			'password' => $conf['password'],
			'iReqType' => 2
		);
		
		$strData = http_build_query($data);
		curl_setopt($this->mCurl, CURLOPT_POSTFIELDS, $strData);
		
		// $ret = '<?xml version="1.0" encoding="utf-8"? ><ArrayOfString
		// xmlns="http://tempuri.org/">'
		// <string>2,2014-12-26
		// 23:32:43,-3648468475435350319,10657120790700003335,13401165567,0,*,0,DELIVRD</string>
		// <string>2,2014-12-27
		// 21:35:57,-3614634853381508731,10657120790700003335,13401165567,0,*,0,DELIVRD</string>
		// <string>2,2014-12-27
		// 21:39:10,-3614577129021045835,10657120790700003335,13401165567,0,*,0,DELIVRD</string>
		// <string>2,2014-12-27
		// 21:40:02,-3614562835369883541,10657120790700003335,13401165567,0,*,0,DELIVRD</string>
		// <string>2,2014-12-27
		// 21:40:59,-3614545792939651582,10657120790700003335,13611222499,0,*,0,DELIVRD</string>
		// <string>2,2014-12-27
		// 21:40:59,-3614545792939651583,10657120790700003335,13401165567,0,*,0,DELIVRD</string>
		// <string>2,2014-12-27
		// 21:42:40,-3614516106125699350,10657120790700003335,13611222499,0,*,0,DELIVRD</string>
		// <string>2,2014-12-27
		// 21:42:40,-3614516106125699351,10657120790700003335,13401165567,0,*,0,DELIVRD</string>
		// <string>2,2014-12-27
		// 21:44:19,-3614486694189653916,10657120790700003335,1340116';
		$ret = curl_exec($this->mCurl);
		
		$retInfo = $this->parseReportMoRet($ret);
		
		return $retInfo;
	}

	public function parseReportMoRet ($re) {
		$arr = array();
		
		$pos = 0;
		while (true) {
			$pos = strpos($re, '<string>', $pos);
			if (false === $pos) {
				break;
			}
			$pos += strlen('<string>');
			$pos1 = strpos($re, '</string', $pos);
			if (false === $pos1) {
				break;
			}
			
			$content = substr($re, $pos, $pos1 - $pos);
			$ret = explode(',', $content);
			
			$arr[] = array(
				'time' => $ret[1], // 时间
				'msgId' => $ret[2], // 平台消息编号
				'longnum' => $ret[3], // 通道号
				'phonenum' => $ret[4], // 手机号
				'userMsgId' => $ret[5], // 用户消息id
				'status' => $ret[7], // 状态值
				                     // 详细错误原因
				'errstr' => $ret[8]
			);
			
			$pos = $pos1 + strlen('</string>');
		}
		
		return $arr;
	}
}
