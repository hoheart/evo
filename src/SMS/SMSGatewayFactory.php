<?php

namespace sms;

use sms\ISMSGateway;
use sms\gateway\MongateSMSGateway;
use sms\entity\ClientInfo;
use sms\gateway\EMASMSGateway;
use hhp\App;

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
					$conf = App::Instance()->getConfigValue('ema');
					$gateway = new EMASMSGateway($conf);
					break;
				case 'mongate':
					$conf = App::Instance()->getConfigValue('mongate');
					$gateway = new MongateSMSGateway($conf);
					break;
			}
			
			$this->mGatewayMap[$clientInfo->gateway] = $gateway;
		}
		
		return $gateway;
	}
}