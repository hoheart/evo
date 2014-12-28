<?php

namespace sms;

/**
 */
interface ISMSGateway {

	/**
	 *
	 * @param
	 *        	userName
	 * @param
	 *        	password
	 */
	public function login ($userName, $password);

	/**
	 *
	 * @param array $phonenumArr        	
	 * @param string $msg        	
	 * @param string $subPort        	
	 * @param string $msgId        	
	 */
	public function send ($phonenumArr, $msg, $subPort, $msgId);

	/**
	 */
	public function getBalance ();
}