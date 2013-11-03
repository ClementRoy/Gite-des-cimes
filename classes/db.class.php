<?php

class db
{
	
	//private ;

	function __construct()
	{
		$pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASSWORD);
	}


/*
Ressources
http://net.tutsplus.com/tutorials/php/pdo-vs-mysqli-which-should-you-use/
http://net.tutsplus.com/tutorials/php/php-database-access-are-you-doing-it-correctly/
http://net.tutsplus.com/tutorials/php/why-you-should-be-using-phps-pdo-for-database-access/
http://net.tutsplus.com/tutorials/php/creating-a-web-poll-with-php/


*/


}

?>