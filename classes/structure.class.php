<?php
class structure
{

    private static $table = "structure";

    /**
     * desc
     *
     * @note 
     *
     * @param
     * @return
     */	
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

    /**
     * desc
     *
     * @note 
     *
     * @param
     * @return
     */
    public static function getByName($name){
        echo $name;
        global $db;
        $params = array(
                        ':name' => '%'.$name.'%'
                        );
        $sql = 'SELECT * FROM '.self::$table.' WHERE name LIKE :name';
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
    public static function getList($limit = false, $offset = 0){
        global $db;
        if(!empty($limit)){
            $data = array();
            $result = $db->query('SELECT * FROM '.self::$table.' LIMIT 5 OFFSET 0', $data);
        }
        else {
            $result = $db->query('SELECT * FROM '.self::$table.' WHERE archived = 0 ORDER BY name');
        }
        return $result;
    }

    public static function getListAll(){
        global $db;
        $result = $db->query('SELECT * FROM '.self::$table.' ORDER BY name');
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
    public static function getPayerStructureList(){
        global $db;
        $result = $db->query('SELECT * FROM '.self::$table.' WHERE archived = 0 AND payer = 1 ORDER BY name');
        
        return $result;
    }


   /**
     *  On récupètre toutes les inscriptions d'une période classés par structure
     *
     * On lsite les structures qui ont des inscription par saisons
     *
     *
     *
     * SELECT ALL inscription 
     * LEFT JOIN DOSSIER ref_dossier = dossier.id
     * GROUP BY dossier.ref_structure_payer
     */
    public static function getPayerStructuresBySeason($season_id, $year){
        global $db;
        $number = 0;

        $season = saison::getByYear($season_id, $year);

        // tool::output( $season );
        $from = $season['from']->format("Y-m-d H:i:s");
        $to = $season['to']->format("Y-m-d H:i:s");

        if($season['name'] == 'Weekend'){
            $sql = 'SELECT structure.id, structure.name FROM structure
                    LEFT JOIN dossier ON structure.id = dossier.ref_structure_payer 
                    LEFT JOIN inscription ON dossier.id = inscription.ref_dossier 
                    WHERE dossier.finished = 1 
                    AND dossier.archived = 0
                    AND inscription.date_from >= "'.$from.'" 
                    AND inscription.date_to <= "'.$to.'" 
                    AND DATE_ADD(inscription.date_from, INTERVAL 2 DAY) = inscription.date_to
                    GROUP BY structure.id
                    ORDER BY structure.name';
        }
        else {
            $sql = 'SELECT structure.id, structure.name FROM structure
                    LEFT JOIN dossier ON structure.id = dossier.ref_structure_payer 
                    LEFT JOIN inscription ON dossier.id = inscription.ref_dossier 
                    WHERE dossier.finished = 1 
                    AND dossier.archived = 0
                    AND inscription.date_from >= "'.$from.'" 
                    AND inscription.date_to <= "'.$to.'" 
                    AND DATE_ADD(inscription.date_from, INTERVAL 2 DAY) != inscription.date_to
                    GROUP BY dossier.ref_structure_payer
                    ORDER BY structure.name';
        }
        // echo $sql;
        $result = $db->query($sql);
        return $result;

    }
    

    public static function getFromTrash(){
        global $db;
        $result = $db->query('SELECT * FROM '.self::$table.' WHERE archived = 1 ORDER BY name');
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

    public static function getLastID(){
        global $db;
        return $db->lastInsertId('id');
    }
    
    public static function cleanEmpty(){
        global $db;
        $sql = 'DELETE FROM '.self::$table.' WHERE name = ""';
        $result = $db->delete($sql);
        return $result;
    }

}

?>