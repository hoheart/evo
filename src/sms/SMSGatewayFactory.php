<?php

namespace sms;

use sms\ISMSGateway;
use sms\gateway\MongateSMSGateway;
use sms\entity\ClientInfo;
use sms\gateway\EMASMSGateway;

/**
 * table
 */
class SMSGatewayFactory {

	public function __construct () {
	}
	
	/**
	 *
	 * @var array
	 */
	protected $mGatewayMap = array();

	/**
	 *
	 * @return ISMSGateway
	 */
	public function getGateway (ClientInfo $clientInfo) {
		$gateway = $this->mGatewayMap[$clientInfo->gateway];
		if (null == $gateway) {
			switch ($clientInfo->gateway) {
				case 'ema':
					$gateway = new EMASMSGateway();
					break;
				case 'mongate':
					$gateway = new MongateSMSGateway();
					break;
			}
			
			$this->mGatewayMap[$clientInfo->gateway] = $gateway;
		}
		
		return $gateway;
	}
}