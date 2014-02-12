<?php

class inscription
{

	private static $table = 'inscription';




	function __construct(){}


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


    public static function getByEnfant($id){
        global $db;
        $params = array(
                        ':id' => $id
                        );
        $sql = 'SELECT * FROM '.self::$table.' WHERE ref_enfant=:id';
        $result = $db->query($sql, $params);
        return $result;        
    }


    public static function getBySejour($id){
        global $db;
        $params = array(
                        ':id' => $id
                        );
        $sql = 'SELECT * FROM '.self::$table.' WHERE ref_sejour=:id';
        $result = $db->query($sql, $params);
        return $result;        
    }


    public static function getBySejourBetweenDates($id, $date_from = false, $date_to = false){
        global $db;
        
        $date_from = $date_from->format("Y-m-d H:i:s");
        $date_to = $date_to->format("Y-m-d H:i:s");
        $params = array(
                        ':id' => $id
                        );
        $sql = 'SELECT * FROM '.self::$table.' LEFT JOIN enfant ON inscription.ref_enfant = enfant.id LEFT JOIN structure ON enfant.organization = structure.id LEFT JOIN structure_contact ON enfant.contact = structure_contact.id WHERE ref_sejour=:id AND date_from >= "'.$date_from.'" AND date_to <="'.$date_to.'"';
        $result = $db->query($sql, $params);
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
	public static function getList($limit = false, $offset = 0){
		global $db;
        if(!empty($limit)){
            $data = array();
            $result = $db->query('SELECT * FROM '.self::$table.' LIMIT 5 OFFSET 0');
        }
        else {
            $result = $db->query('SELECT * FROM '.self::$table.' WHERE archived = 0');
        }
		return $result;
	}

    public static function getFromTrash(){
        global $db;
        $result = $db->query('SELECT * FROM '.self::$table.' WHERE archived = 1');
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
     * Remove object
     *
     * @param id of the object
     * @return boolean
     */
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


}

?>