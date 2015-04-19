<?php

namespace util\SMS;

/**
 * 短信发送程序
 *
 * @author Jejim
 *        
 */
class C123SMSSender implements ISMSGateway {
	
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

	/**
	 *
	 * @param
	 *        	phonenum
	 * @param
	 *        	content
	 */
	public function send ($phonenum, $content) {
		$data = array(
			'ac' => $this->mConf['uid'],
			'authkey' => $this->mConf['pwd'],
			'cgid' => $this->mConf['cgid'],
			'csid' => $this->mConf['csid'],
			'c' => $content,
			'm' => $phonenum,
			't' => ''
		);
		
		$strData = http_build_query($data);
		curl_setopt($this->mCurl, CURLOPT_POSTFIELDS, $strData);
		
		// $ret = '<xml name="sendOnce" result="1"><Item cid="501033020001"
		// sid="1001" msgid="92924457458168500" total="2" price="0.1"
		// remain="0.400" /></xml>';
		$ret = curl_exec($this->mCurl);
		
		$retInfo = $this->parseRet($ret);
		
		return $retInfo;
	}

	protected function parseRet ($re) {
		preg_match_all('/result="(.*?)"/', $re, $res);
		
		$send = array(
			''
		);
		preg_match_all('/\<Item\s+(.*?)\s+\/\>/', $re, $item);
		for ($i = 0; $i < count($item[1]); $i ++) {
			
			preg_match_all('/msgid="(.*?)"/', $item[1][$i], $msgid);
			// preg_match_all('/total="(.*?)"/', $item[1][$i], $total);
			// preg_match_all('/price="(.*?)"/', $item[1][$i], $price);
			// preg_match_all('/remain="(.*?)"/', $item[1][$i], $remain);
			
			// $send['cid'] = $cid[1][0]; // 企业编号
			// $send['sid'] = $sid[1][0]; // 员工编号
			$send[] = $msgid[1][0]; // 发送编号
				                        // $send['total'] = $total[1][0]; //
				                        // 计费条数
				                        // $send['price'] = $price[1][0]; //
				                        // 短信单价
				                        // $send['remain'] = $remain[1][0]; //
				                        // 余额
				                        // $send_arr[] = $send; // 数组send_arr
				                        // 存储了发送返回后的相关信息
		}
		
		return array(
			trim($res[1][0]),
			$send
		);
	}
}