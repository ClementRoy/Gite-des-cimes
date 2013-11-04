<?php

class DB {
 
    private $host 		= DB_HOST;
    private $username 	= DB_USER;
    private $password 	= DB_PASSWORD;
    private $database 	= DB_NAME;
    private $db;
 
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
 
    public function query($sql, $data = array()){
        $req = $this->db->prepare($sql);
        $req->execute($data);
        return $req->fetchAll(PDO::FETCH_OBJ);
    }
 
    public function row($sql, $data = array()){
        $datas = $this->query($sql, $data);
        return empty($datas) ? false : $datas[0];
    }

    public function insert() {
        $req = $this->db->prepare($sql);
        $req->execute($data);   
        return $req->rowCount();  	
    }

    public function update($sql, $data = array()) {
        $req = $this->db->prepare($sql);
        $req->execute($data);   
        return $req->rowCount();
    }

    public function delete($sql, $data = array()) {
        $req = $this->db->prepare($sql);
        $req->bindParam($data); 
        $req->execute();  
        return $req->rowCount();	
    }

}


/*
Ressources
http://net.tutsplus.com/tutorials/php/pdo-vs-mysqli-which-should-you-use/
http://net.tutsplus.com/tutorials/php/php-database-access-are-you-doing-it-correctly/
http://net.tutsplus.com/tutorials/php/why-you-should-be-using-phps-pdo-for-database-access/
http://net.tutsplus.com/tutorials/php/creating-a-web-poll-with-php/


http://www.grafikart.fr/tutoriels/php/pdo-php-111


*/



?>