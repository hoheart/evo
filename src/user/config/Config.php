<?php
return array(
	
	'controller_dir' => 'controller' . DIRECTORY_SEPARATOR,
	
	'default_controller' => array(
		'controller_name' => '',
		'action_name' => ''
	),
	
	/**
	 * 本模块提供的API，以类的形式给出。数组中的key代表类名，值是另外一个数组，其中enbale表示是否允许这个接口开放，这样方便以后对接口进行更加详细的控制。
	 */
	'API' => array(
		'user\User' => array(
			'enable' => true
		),
		'user\Login' => array(
			'enable' => true
		),
		'user\UserManager' => array(
			'enable' => true
		),
		'user\fund\AccountManager' => array(
			'enable' => true
		)
	),
	
	/**
	 * 本模块提供的Controller
	 */
	'controller' => array(
		'user\controller\UserController' => array(
			'enable' => true
		),
		'user\controller\FundController' => array(
			'enable' => true
		)
	),
	
	/**
	 * 本模块依赖的其他模块，用数组的key给出名字，其值暂时保留以后扩展。
	 */
	'depends' => array(
		'orm' => array(),
		'sms' => array()
	)
);
?>