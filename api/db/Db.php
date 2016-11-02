<?php

/**
 * Singleton class to handle database connection
 */
class Db {

	 private static $instance = null;

	 private function __construct() {}

	 private function __clone() {}

	 /**
	  * Return instance of database connection object
	  */
	 public static function getInstance() {

		 if(!isset(self::$instance)) {

			 require_once 'db/Config.php';

			 $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_DATABASE . ";charset=utf8mb4";

			 $options = array(
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
			 );
		
			 self::$instance = new PDO($dsn, DB_USER, DB_PASSWORD, $options);
		 }

		 return self::$instance;
	 }
}