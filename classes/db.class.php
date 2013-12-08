<?php

class DB {
 
    private $host 		= DB_HOST;
    private $username 	= DB_USER;
    private $password 	= DB_PASSWORD;
    private $database 	= DB_NAME;
    private $db;
 
    /**
     * desc
     *
     * @note 
     *
     * @param
     * @return
     */
    public function __construct($host = null, $username = null, $password = null, $database = null){
        if($host != null){
            $this->host = $host;
            $this->username = $username;
            $this->password = $password;
            $this->database = $database;
        }
 
        try{
            $this->db = new PDO('mysql:host='.$this->host.';dbname='.$this->database, $this->username, $this->password, array(
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
                ));
        }catch(PDOException $e){
            die('Impossible de se connecter a la base de donnee');
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
    public function query($sql, $data = array(), $type = PDO::FETCH_OBJ){
        // Fetch Type: PDO::FETCH_BOTH|PDO::FETCH_ASSOC|PDO::FETCH_OBJ|PDO::FETCH_LAZ
        $req = $this->db->prepare($sql);
        $req->execute($data);
        return $req->fetchAll($type);
    }

    /**
     * desc
     *
     * @note 
     *
     * @param
     * @return
     */
    public function row($sql, $data = array()){
        $datas = $this->query($sql, $data);
        return empty($datas) ? false : $datas[0];
    }

    /**
     * Insert query
     *
     * @note 
     *
     * @param $sql SQL query
     * @param $data Binded parameters
     */
    public function insert($sql, $data = array()) {
        $req = $this->db->prepare($sql);
        $req->execute($data);   
        return $req->rowCount();
    }

    /**
     * Update query
     *
     * @note 
     *
     * @param $sql SQL query
     * @param $data Binded parameters
     */
    public function update($sql, $data = array()) {
        $req = $this->db->prepare($sql);
        $req->execute($data);   
        return $req->rowCount();
    }

    /**
     * Delete query
     *
     * @note 
     *
     * @param $sql SQL query
     * @param $data Binded parameters
     */
    public function delete($sql, $data = array()) {
        $req = $this->db->prepare($sql);
        $req->bindParam($data); 
        $req->execute();  
        return $req->rowCount();	
    }

}


/*
@see: http://net.tutsplus.com/tutorials/php/pdo-vs-mysqli-which-should-you-use/
@see: http://net.tutsplus.com/tutorials/php/php-database-access-are-you-doing-it-correctly/
@see: http://net.tutsplus.com/tutorials/php/why-you-should-be-using-phps-pdo-for-database-access/
@see: http://net.tutsplus.com/tutorials/php/creating-a-web-poll-with-php/
@see: http://www.grafikart.fr/tutoriels/php/pdo-php-111
*/



?>