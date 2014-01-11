<?php

class user
{
	
    private static $table = "users";

	//public
	//private
	public $identifier;
	public $firstname;
	public $lastname;
	public $rank;
	public $id;

    /**
     * desc
     *
     * @note 
     *
     * @param
     * @return
     */
	function __construct( $identifier = '', $password = '') {

		global $db;

		$user = $db->row('SELECT * FROM '.self::$table.' WHERE identifier=:identifier AND password=:password', array(
		        'identifier' => $identifier,
		        'password' => $password
		    	));

		if($user){
		    $this->identifier = $user->identifier;
		    $this->firstname = $user->firstname;
		    $this->lastname = $user->lastname;
		    $this->rank = $user->rank;
		    $this->id = $user->id;
		}
	}

    /**
     * desc
     *
     * @note 
     *
     * @param
     * @return
     */
	public static function login( $identifier = '', $password = '', $remember = false, $redirect = '' ){

		global $db;

		$user = $db->row('SELECT * FROM '.self::$table.' WHERE identifier=:identifier AND password=:password', array(
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

    /**
     * desc
     *
     * @note 
     *
     * @param
     * @return
     */
	public static function isLogged() {
		if( isset($_SESSION['Auth']) && isset($_SESSION['Auth']['identifier']) && isset($_SESSION['Auth']['password']) ){
			return true;
		} else {
			return false;
		}
	}

    /**
     * desc
     *
     * @note 
     *
     * @param
     * @return
     */
	public static function get($id) {
		global $db;

		$user = $db->row('SELECT * FROM '.self::$table.' WHERE id=:id', array(
		        'id' => $id
		        ));

		return $user;
	}

    /**
     * desc
     *
     * @note 
     *
     * @param
     * @return
     */
	public static function getList() {
		global $db;
		$users = $db->query('SELECT * FROM '.self::$table);
		return $users;
	}

    /**
     * desc
     *
     * @note 
     *
     * @param
     * @return
     */
	public static function add($sql, $params = array()){
        global $db;
        $result = $db->insert($sql, $params);
        return $result;
	}

    /**
     * desc
     *
     * @note 
     *
     * @param
     * @return
     */
	public static function remove($id){
        global $db;
        $data = array(':id' => $id);
        $sql = 'DELETE FROM '.self::$table.' WHERE id = :id';
        $result = $db->delete($sql, $data);
        return $result;
	}

    /**
     * desc
     *
     * @note 
     *
     * @param
     * @return
     */
	public static function update($sql, $params = array()){
        global $db;
        $result = $db->update($sql, $params);
        return $result;
	}

    /**
     * desc
     *
     * @note 
     *
     * @param
     * @return
     */
	public function count(){

	}

    /**
     * desc
     *
     * @note 
     *
     * @param
     * @return
     */
	static function logout() {
		$_SESSION = array();
		session_destroy();		
	}


    /**
     * desc
     *
     * @note 
     *
     * @param
     * @return
     */
    public static function getCurrentUser(){
        return $_SESSION['Auth']['id'];
    }



/*
http://www.grafikart.fr/tutoriels/php/securiser-sessions-php-58
http://www.grafikart.fr/tutoriels/php/poo-models-php-90
http://www.grafikart.fr/tutoriels/php/introduction-poo-php-114
http://www.grafikart.fr/tutoriels/php/pdo-php-111
*/



}

?>