<?php

namespace SMS;

use SMS\ISMSGateway;
use SMS\Gateway\MongateSMSGateway;
use SMS\Entity\ClientInfo;
use SMS\Gateway\EMASMSGateway;
use HHP\App;

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