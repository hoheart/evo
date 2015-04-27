<?php

namespace ORM;

use ORM\DatabaseFactory;
use HHP\App;

class DatabaseFactoryCreator {

	public function create (array $conf = null) {
		$db = App::Instance()->getService('db');
		
		$f = new DatabaseFactory();
		$f->setDatabaseClient($db);
		
		return $f;
	}
}
?>