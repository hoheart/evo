<?php
return array(
	
	'controller_dir' => 'Controller' . DIRECTORY_SEPARATOR,
	
	/**
	 * 本模块提供的API，以类的形式给出。数组中的key代表类名，值是另外一个数组，其中enbale表示是否允许这个接口开放，这样方便以后对接口进行更加详细的控制。
	 */
	'API' => array(
		'User\Entity\User' => array(
			'enable' => true
		),
		'User\Login' => array(
			'enable' => true
		),
		'User\UserManager' => array(
			'enable' => true
		),
		'User\Fund\AccountManager' => array(
			'enable' => true
		),
		'User\Exception\LoginFailedException' => array(
			'enable' => true
		),
		'User\Controller\LoginController' => array(
			'enable' => true
		)
	),
	
	/**
	 * 本模块提供的Controller
	 */
	'controller' => array(
		'User\Controller\LoginController' => array(
			'enable' => true
		),
		'User\Controller\UserController' => array(
			'enable' => true
		),
		'User\Controller\FundController' => array(
			'enable' => true
		),
		'User\Controller\DeliverNoticeController' => array(
			'enable' => true
		)
	),
	
	/**
	 * 本模块依赖的其他模块，用数组的key给出名字，其值暂时保留以后扩展。
	 */
	'depends' => array(
		'orm' => array(),
		'sms' => array(),
		'util' => array(),
		'crm' => array()
	)
);
?>
