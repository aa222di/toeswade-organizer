<?php

namespace Toeswade\Database; 
	

class Database 
{

	public $db; // PDO object

	/* 
	 * @param associative array $config, defined in app/themeName/config/config.php
	 * @return void
	 */
	public function __construct( $host, $dbname, $user, $password ) 
	{	
		try {
		    $this->db = new \PDO('mysql:host=' . $host . ';dbname=' . $dbname . '', $user, $password);
		    $this->db->setAttribute( \PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION );
		} catch (\PDOException $e) {
		    print "Error!: " . $e->getMessage() . "<br/>";
		    die();
		}
	}
}