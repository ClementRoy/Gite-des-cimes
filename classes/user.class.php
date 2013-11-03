<?php

class user
{
	
	//public
	//private

	function __construct()
	{
		# code...
	}

	public function login($identifier = '', $password = ''){
		try {
			$pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASSWORD);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			echo 'erreur de connexion';
		}

		$q = array('identifier' => $identifier, 'password' => md5($password) );

		$sql = "SELECT * FROM users WHERE identifier= :identifier AND password= :password";

		$req = $pdo->prepare($sql);
		$req->execute($q);

		$count = $req->rowCount($sql);

		if ($count == 1) {
			$_SESSION['Auth'] = array(
				'identifier' => $identifier,
				'password' => $password
			);

			// create a global var user here with all infos ?
		}
		
	}

	static function is_logged() {
		if( isset($_SESSION['Auth']) && isset($_SESSION['Auth']['identifier']) && isset($_SESSION['Auth']['password']) ){
			return true;
		} else {
			return false;
		}
	}

	function get_user() {

	}

	static function get_users() {
		$pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASSWORD);
		$sql = "SELECT * FROM users";
		$users = $pdo->query($sql);
		echo '<pre>';
		while( $d = $users->fetch(PDO::FETCH_OBJ) ) { // PDO::FETCH_ASSOC PDO::FETCH_BOTH
			print_r($d);
		}
		return $users;
	}

	public function create(){

	}

	static function logout() {
		$_SESSION = array();
		session_destroy();		
	}





/*


http://www.grafikart.fr/tutoriels/php/securiser-sessions-php-58
http://www.grafikart.fr/tutoriels/php/poo-models-php-90
http://www.grafikart.fr/tutoriels/php/introduction-poo-php-114
http://www.grafikart.fr/tutoriels/php/pdo-php-111


*/



}

?>