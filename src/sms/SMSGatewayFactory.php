<?php

namespace sms;

use sms\ISMSGateway;
use sms\MongateSMSGateway;

/**
 * table
 */
class SMSGatewayFactory {

	public function __construct () {
	}
	
	/**
	 *
	 * @var ISMSGateway
	 */
	protected $mDefaultGateway;
	
	/**
	 *
	 * @var ISMSGateway
	 */
	protected $mSecondGateway;

	/**
	 *
	 * @return ISMSGateway
	 */
	public function getDefaultGateway () {
		if (null == $this->mDefaultGateway) {
			$this->mDefaultGateway = new MongateSMSGateway();
		}
		
		return $this->mDefaultGateway;
	}

	/**
	 *
	 * @return ISMSGateway
	 *
	 */
	public function getSecondGateway () {
		// TODO implement here
		return null;
	}
}