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
     * Get an object from its id
     *
     * @param int id of the object
     * @return object result of the query
     */
    public static function get($id){
        global $db;
        $params = array(':id' => $id);
        $sql = 'SELECT * FROM '.self::$table.' WHERE id=:id';
        $result = $db->row($sql, $params);
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
	public static function getList() {
		global $db;
		$users = $db->query('SELECT * FROM '.self::$table.' WHERE archived = 0 ORDER BY firstname');
		return $users;
	}


    public static function getFromTrash(){
        global $db;
        $result = $db->query('SELECT * FROM '.self::$table.' WHERE archived = 1 ORDER BY firstname');
        return $result;
    }

    
    /**
     * Insert a new object into the database
     *
     * @param array data to insert
     * @param array override the metadata
     * @return boolean query result
     */
    public static function add($data = array(), $metadata = false){
        global $db;

        // Handle Metadata infos
        if(!$metadata) {
            $metadata = array(
                                ':created' => tool::currentTime(),
                                ':edited' => tool::currentTime(),
                                ':creator' => user::getCurrentUser(), 
                                ':editor' => user::getCurrentUser(), 
                            );
        }

        // Merge the data and metadatas arrays
        $data = array_merge($metadata, $data);

        // Build the Query, be careful, vars must be prefixed with ":"
        $bind = implode(', ', array_keys($data)); 
        $entries = '';
        foreach (array_keys($data) as $key => $name) {
            if($key !=0)
                $entries .= ',';
            $entries .=  substr($name, 1);
        }    
        $sql = 'INSERT INTO '.self::$table.' (' . $entries . ') ' . 'values (' . $bind . ')';

        $result = $db->insert($sql, $data);
        
        return $result;
    }



    /**
     * Update the object
     *
     * @param array data to update
     * @param int id of the object to update
     * @param array override the metadata
     * @return boolean query result
     */
    public static function update($data = array(), $id, $metadata = false){
        global $db;

        // Handle the metadatas
        if(!$metadata) {
            $metadata = array(
                                ':edited' => tool::currentTime(),
                                ':editor' => user::getCurrentUser(), 
                            );
        }

        // Merge the data and metadatas arrays
        $data = array_merge($metadata, $data);

        // Build the Query, be careful, vars must be prefixed with ":"
        $entries = '';
        foreach (array_keys($data) as $key => $name) {
            if($key !=0)
                $entries .= ',';
            $entries .=  substr($name, 1).' = '.$name;
        }
        $sql = 'UPDATE '.self::$table.' SET '.$entries.' WHERE id='.$id;

        $result = $db->update($sql, $data);

        return $result;
    }




    /**
     * Count the number of entries in the database table
     *
     * @return int number of the entries in the table
     */
    public static function countAll(){
        global $db;
        $result = $db->row('SELECT COUNT(*) FROM '.self::$table.'');
        return $result;
    }

    /**
     * Log the current user out
     *
     */
	static function logout() {
		$_SESSION = array();
		session_destroy();		
	}


    /**
     * Get the current logged user
     *
     * @return id of the current logged user
     */
    public static function getCurrentUser(){
        return $_SESSION['Auth']['id'];
    }


    public static function remove($id){
        global $db;
        // $data = array(':id' => $id);
        // $sql = 'DELETE FROM '.self::$table.' WHERE id = :id';
        // $result = $db->delete($sql, $data);
        $result = self::archive($id);
        return $result;
    }

    public static function archive($id){
        $data = array(
            ':archived' => 1,
            ':archived_on' => tool::currentTime(),
            ':archived_by' => user::getCurrentUser() 
        ); 
        $result = self::update($data, $id);
        return $result;       
    }

    public static function unarchive($id){
        $data = array(
            ':archived' => 0,
            ':archived_on' => '',
            ':archived_by' => ''
        ); 
        $result = self::update($data, $id);
        return $result;
    }

    public static function delete($id){
        global $db;
        $data = array(':id' => $id);
        $sql = 'DELETE FROM '.self::$table.' WHERE id = :id';
        $result = $db->delete($sql, $data);
        //$result = self::archive($id);
        return $result;
    }


    public static function getLastID(){
        global $db;
        return $db->lastInsertId('id');
    }


    public static function cleanEmpty(){
        global $db;
        $sql = 'DELETE FROM '.self::$table.' WHERE firstname = ""';
        $result = $db->delete($sql);
        return $result;
    }
    

/*
http://www.grafikart.fr/tutoriels/php/securiser-sessions-php-58
http://www.grafikart.fr/tutoriels/php/poo-models-php-90
http://www.grafikart.fr/tutoriels/php/introduction-poo-php-114
http://www.grafikart.fr/tutoriels/php/pdo-php-111
*/



}

?>