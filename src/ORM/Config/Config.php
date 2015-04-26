<?php
return array(
	
	'controller_dir' => 'controller' . DIRECTORY_SEPARATOR,
	
	'default_controller' => array(
		'controller_name' => 'Test',
		'action_name' => 'index'
	),
	
	/**
	 * 本模块提供的API，以类的形式给出。数组中的key代表类名，值是另外一个数组，其中enbale表示是否允许这个接口开放，这样方便以后对接口进行更加详细的控制。
	 */
	'API' => array(
		'ORM\DataClass' => array(
			'enable' => true
		),
		'ORM\ClassDesc' => array(
			'enable' => true
		),
		'ORM\ClassAttribute' => array(
			'enable' => true
		),
		'ORM\DescFactory' => array(
			'enable' => true
		),
		'ORM\AbstractPersistence' => array(
			'enable' => true
		),
		'ORM\PhpPersistence' => array(
			'enable' => true
		),
		'ORM\Condition' => array(
			'enable' => true
		),
		'ORM\PhpFactory' => array(
			'enable' => true
		),
		'ORM\AbstractDataFactory' => array(
			'enable' => true
		),
		'ORM\DatabaseFactory' => array(
			'enable' => true
		),
		'ORM\DatabasePersistence' => array(
			'enable' => true
		),
		'ORM\DatabasePersistenceCreator' => array(
			'enable' => true
		),
		'ORM\DatabaseFactoryCreator' => array(
			'enable' => true
		)
	),
	
	/**
	 * 本模块提供的Controller
	 */
	'controller' => array(),
	
	'service' => array(
		'orm' => array(
			'class' => 'orm\ORMService',
			'config' => array(
				'factory' => array(
					'class' => 'orm\DatabasePersistenceCreator',
					'method' => 'create'
				),
				'persistence' => array(
					'class' => 'orm\DatabasePersistenceCreator',
					'method' => 'create'
				)
			)
		)
	),
	
	/**
	 * 本模块依赖的其他模块，用数组的key给出名字，其值暂时保留以后扩展。
	 */
	'depends' => array()
);
?>