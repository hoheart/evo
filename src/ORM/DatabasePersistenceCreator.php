<?php

namespace ORM;

use ORM\DatabasePersistence;
use HHP\App;

class DatabasePersistenceCreator {

	public function create (array $conf = null) {
		$db = App::Instance()->getService('db');
		
		$p = new DatabasePersistence();
		$p->setDatabaseClient($db);
		
		return $p;
	}
}
?>