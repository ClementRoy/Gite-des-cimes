<?php

class contact
{


    private static $table = "contact_structure";

    /**
     * desc
     *
     * @note 
     *
     * @param
     * @return
     */
	function __construct()
	{
		# code...
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



    // public static function getByName($name){
    //     global $db;
    //     $params = array(
    //                     ':name' => $name
    //                     );
    //     $sql = 'SELECT * FROM '.self::$table.' WHERE id=:id';
    //     $result = $db->row($sql, $params);
    //     return $result;        
    // }


    public static function getByStructure($id){
        global $db;
        $params = array(
                        ':id' => $id
                        );
        $sql = 'SELECT * FROM '.self::$table.' WHERE ref_structure=:id';
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
            $result = $db->query('SELECT * FROM '.self::$table.' LIMIT 5 OFFSET 0', $data);
        }
        else {
            $result = $db->query('SELECT * FROM '.self::$table.' ORDER BY firstname');
        }
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
        $data = array(':id' => $id);
        $sql = 'DELETE FROM '.self::$table.' WHERE id = :id';
        $result = $db->delete($sql, $data);
        return $result;
    }
    
}

?>