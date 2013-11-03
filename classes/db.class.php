<?php

class db
{
	
	//private ;
	private $pdo;

	function __construct()
	{
		try {
			$pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASSWORD);
			var_dump($pdo);
			$this->pdo = $pdo;
			return $pdo;
		}
		catch(PDOException $e) {
			echo 'No connexion to database';
		}
		
	}


	public function querydata($sql = ''){
		//$db = new db(); // Already called in index.php
		//$sql;
		$this->pdo->query($sql);

	}

	// getData setData

/*
Ressources
http://net.tutsplus.com/tutorials/php/pdo-vs-mysqli-which-should-you-use/
http://net.tutsplus.com/tutorials/php/php-database-access-are-you-doing-it-correctly/
http://net.tutsplus.com/tutorials/php/why-you-should-be-using-phps-pdo-for-database-access/
http://net.tutsplus.com/tutorials/php/creating-a-web-poll-with-php/


http://www.grafikart.fr/tutoriels/php/pdo-php-111


*/


}

?>