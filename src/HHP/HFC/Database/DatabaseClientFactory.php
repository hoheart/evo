<?php

namespace hfc\Database;

use HFC\Database\Mysql\MysqlClient;
use HFC\Exception\NotImplementedException;

class DatabaseClientFactory {

	public function create (array $conf) {
		$client = null;
		$dbms = $conf['dbms'];
		switch ($dbms) {
			case 'mysql':
				$client = new MysqlClient($conf);
				break;
			default:
				throw new NotImplementedException('the DBMS: ' . $dbms . ' not support yet.');
				break;
		}
		
		return $client;
	}
}
?>