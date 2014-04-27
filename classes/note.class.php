<?php

class note
{

	private static $table = 'note';




	function __construct(){}


    /**
     * Get an object from its id
     *
     * @param int id of the object
     * @return object result of the query
     */
    public static function get($ref_enfant, $ref_sejour){
        global $db;
        $params = array(':ref_enfant' => $ref_enfant, ':ref_sejour' => $ref_sejour);
        $sql = 'SELECT * FROM '.self::$table.' WHERE ref_enfant=:ref_enfant AND ref_sejour=:ref_sejour';
        $result = $db->row($sql, $params);
        return $result;
    }


    public static function getNote(){
        global $db;
        $params = array(':id' => $id);
        $sql = 'SELECT * FROM '.self::$table.' WHERE id=:id';
        $result = $db->row($sql, $params);
        return $result;        
    }
 
    public static function getByEnfant($id){
        global $db;
        $params = array(':id' => $id);
        $sql = 'SELECT * FROM '.self::$table.' WHERE ref_enfant=:id';
        $result = $db->query($sql, $params);
        return $result;        
    }

    public static function getBySejour($id){
        global $db;
        $params = array(':id' => $id);
        $sql = 'SELECT * FROM '.self::$table.' WHERE ref_sejour=:id';
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
	public static function getList(){
		global $db;
        $result = $db->query('SELECT * FROM '.self::$table.'');
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
        $result = self::delete($id);
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
        $sql = 'DELETE FROM '.self::$table.' WHERE ref_sejour = "" AND ref_enfant = ""';
        $result = $db->delete($sql);
        return $result;
    }

}

?>