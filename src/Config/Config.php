<?php
/**
 * 注意，如果是目录，末尾必须有一个文件夹分隔符。
 * 此处没有用类，主要是数组更容易组成树形结构，也更加容易操作。
 */
return array(
	
	/**
	 * 应用程序的版本（非框架的版本）。
	 */
	'version' => '1.01',
	
	/**
	 * 默认的模块。
	 */
	'default_module' => 'SMS',
	
	/**
	 * 是否是调试模式，该模式下，会向页面输出错误信息。
	 */
	'debug' => true,
	
	/**
	 * 在执行controller的actino之前和之后执行的IExecutor接口。
	 */
	'executor' => array(
		'pre_executor' => array(),
		'later_executor' => array(
			'HHP\View\ViewRender'
		)
	),
	
	/**
	 * 应用程序拥有的模块。
	 */
	'module' => array(
		
		/**
		 * key表示模块在整个应用程序中唯一的名字。为方便书写，并和url（url一般为小写）中controller对应的模块一致，规定都为小写。
		 */
		'orm' => array(
			
			/**
			 * 模块的名字。
			 */
			'name' => 'ORM',
			
			/**
			 * 模块根目录的路径。
			 */
			'dir' => 'ORM' . DIRECTORY_SEPARATOR,
			
			/**
			 * 是否开启该模块。
			 */
			'enable' => true
		),
		'util' => array(
			'name' => 'Util',
			'dir' => 'Util' . DIRECTORY_SEPARATOR,
			'enable' => true
		),
		'user' => array(
			'name' => 'User',
			'dir' => 'User' . DIRECTORY_SEPARATOR,
			'enable' => true
		),
		'admin' => array(
			'name' => 'Admin',
			'dir' => 'Admin' . DIRECTORY_SEPARATOR,
			'enable' => true
		),
		'sms' => array(
			'name' => 'SMS',
			'dir' => 'SMS' . DIRECTORY_SEPARATOR,
			'enable' => true
		),
		'crm' => array(
			'name' => 'CRM',
			'dir' => 'CRM' . DIRECTORY_SEPARATOR,
			'enable' => true
		)
	),
	
	/**
	 * 服务。提供给整个应用程序使用。key表示服务的名称，class表示对应的类，如果有method，则该类表示创建服务的类，如果没有，表示服务类本身。config为创建服务需要的配置。
	 */
	'service' => array(
		'db' => array(
			'class' => 'HFC\Database\DatabaseClientFactory',
			'method' => 'create',
			'config' => array(
				'dbms' => 'mysql',
				'user' => 'vosms',
				'password' => 'vosms',
				'server' => '127.0.0.1',
				'port' => 3306,
				'name' => 'evo',
				'charset' => 'utf8'
			)
		),
		'orm' => array(
			'class' => 'orm\ORMService',
			'config' => array(
				'factory' => array(
					'class' => 'ORM\DatabaseFactoryCreator',
					'method' => 'create'
				),
				'persistence' => array(
					'class' => 'ORM\DatabasePersistenceCreator',
					'method' => 'create'
				)
			)
		),
		'event' => array(
			'class' => 'Hfc\Event\EventManager',
			'config' => array(
				'Hfc\Event\CommonEvent' => array()
			)
		),
		'log' => array(
			'class' => 'Hfc\Util\Logger',
			'config' => array(
				
				// 由于日志文件很可能与其他数据文件，所以一般单独指定文件夹。
				'root_dir' => dirname(__DIR__) . DIRECTORY_SEPARATOR . 'log' . DIRECTORY_SEPARATOR,
				
				// 缓存大小，单位byte
				'buffer_size' => 50000,
				
				// 写入文件事件间隔
				'interval' => 30,
				
				// 是否记录调试日志。
				'debug_log' => false,
				
				// 每个日志文件的大小，单位m
				'file_size' => 50,
				
				// 是否启用日志记录
				'enable' => true
			)
		)
	),
	'mongateGateway' => array(
		'userId' => 'JC2492',
		'password' => '566320'
	),
	'ema' => array(
		'userId' => '800033',
		'password' => 'ywok123456'
	),
	'staticUrl' => 'http://static.vo-sms.com/',
	/**
	 * 整个系统存放数据的目录，包括日志的存放。所以，不需要对日志进行单独的目录配置。
	 * 通过调用系统提供的日志
	 */
	'data_dir' => dirname(__DIR__) . DIRECTORY_SEPARATOR . 'data',
	'default_layout_dir' => dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Common' . DIRECTORY_SEPARATOR . 'View' .
			 DIRECTORY_SEPARATOR
);
