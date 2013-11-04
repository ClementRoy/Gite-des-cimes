<?php

class user
{
	
	//public
	//private
	public $identifier;
	public $firstname;
	public $lastname;
	public $rank;
	public $id;

	function __construct( $identifier = '', $password = '') {

		global $db;

		$user = $db->row('SELECT * FROM users WHERE identifier=:identifier AND password=:password', array(
		        'identifier' => $identifier,
		        'password' => $password
		    	));
		//echo 'helo';
		if($user){
		    $this->identifier = $user->identifier;
		    $this->firstname = $user->firstname;
		    $this->lastname = $user->lastname;
		    $this->rank = $user->rank;
		    $this->id = $user->id;
		}
	}

	public static function login( $identifier = '', $password = '', $remember = false, $redirect = '' ){

		global $db;

		$user = $db->row('SELECT * FROM users WHERE identifier=:identifier AND password=:password', array(
		        'identifier' => $identifier,
		        'password' => md5($password)
		    	));

		if($user){
		    $_SESSION['Auth'] = (array)$user;
		    // if $remember
		    	// create cookie
		    header('Location:'.$redirect);
		}else{
		    $error = true;
		}
		
	}

	static function is_logged() {
		if( isset($_SESSION['Auth']) && isset($_SESSION['Auth']['identifier']) && isset($_SESSION['Auth']['password']) ){
			return true;
		} else {
			return false;
		}
	}

	function get_user($id) {
		global $db;

		$user = $db->row('SELECT * FROM users WHERE id=:id', array(
		        'id' => $id
		        ));

		return $user;
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