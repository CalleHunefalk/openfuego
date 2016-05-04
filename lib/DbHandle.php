<?php namespace CalleHunefalk\OpenFuego;
require_once __DIR__ . "/../vendor/autoload.php";


class DbHandle extends \PDO {
	
	public function __construct() {
		
		$dsn = \CalleHunefalk\OpenFuego\DB_DRIVER
		. ":host=" . \CalleHunefalk\OpenFuego\DB_HOST
		. ';port=' . \CalleHunefalk\OpenFuego\DB_PORT
		. ';dbname=' . \CalleHunefalk\OpenFuego\DB_NAME
		. ';';

		try {
	        parent::__construct($dsn, \CalleHunefalk\OpenFuego\DB_USER, \CalleHunefalk\OpenFuego\DB_PASS, array(
				\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8' COLLATE 'utf8_unicode_ci';",
				\PDO::ATTR_PERSISTENT => true
			));
			
			$this->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		}
		
		catch (\PDOException $e) {
			Logger::error($e);
		}
	}
	
	public function __destruct() {
		// close db connection
	}
}