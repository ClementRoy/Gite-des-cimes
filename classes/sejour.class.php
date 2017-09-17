<?php

class sejour
{
    private static $table = 'sejour';

    
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
            $result = $db->query('SELECT * FROM '.self::$table.' LIMIT 5 OFFSET 0 ORDER BY date_from', $data);
        }
        else {
            $result = $db->query('SELECT * FROM '.self::$table.' WHERE archived = 0 ORDER BY date_from');
        }
        return $result;
    }


    public static function getListPastSejour(){
        $date = new DateTime();
        $datetime = $date->format("Y-m-d H:i:s");
        global $db;
        $result = $db->query('SELECT * FROM '.self::$table.' WHERE archived = 0 AND date_to <= "'.$datetime.'" ORDER BY date_from DESC' );
        return $result;
    }


    public static function getListFuturSejour(){
        $date = new DateTime();
        $datetime = $date->format("Y-m-d H:i:s");
        global $db;
        $result = $db->query('SELECT * FROM '.self::$table.' WHERE archived = 0 AND date_to >= "'.$datetime.'" ORDER BY date_from');

        return $result;
    }


    public static function getBySaison($saison_id, $year){
        global $db;
        $season = saison::get($saison_id);
        // tool::output( $season );

        $date_from = $year . '-' . str_pad($season->month_from, 2, '0', STR_PAD_LEFT) . '-' . str_pad($season->day_from, 2, '0', STR_PAD_LEFT) . ' 00:00:00';
        $date_to = $year . '-' . str_pad($season->month_to, 2, '0', STR_PAD_LEFT) . '-' . str_pad($season->day_to, 2, '0', STR_PAD_LEFT) . ' 00:00:00';

        // tool::output( $date_from );
        // tool::output( $date_to );

        $results = $db->query('SELECT * FROM '.self::$table.' WHERE archived = 0 AND date_from >= "'.$date_from.'"  AND date_to <= "'.$date_to.'" ORDER BY date_from');
            
        $new_results = array();
        //for ($i=0; $i < count($results); $i++) {
        foreach ($results as $key => $result) {
           $date_from = new DateTime($result->date_from);
           $date_to = new DateTime($result->date_to);

            if ($season->name != 'Weekend') {
                if ( ( $date_to->getTimestamp() - $date_from->getTimestamp() ) > 172800) {
                    array_push($new_results, $result);
                }
            } else {
                if ( ( $date_to->getTimestamp() - $date_from->getTimestamp() ) < 172800) {
                    array_push($new_results, $result);
                }
            }

        }

        return $new_results;
    }


    public static function getListByHebergement(){
        return false;
    }

    public static function getFromTrash(){
        global $db;
        $result = $db->query('SELECT * FROM '.self::$table.' WHERE archived = 1 ORDER BY name');
        return $result;
    }



    public static function getAllBeginsWeek($sejour_id){
        $sejour = self::get($sejour_id);
        $date_from = new DateTime($sejour->date_from);
        $date_to = new DateTime($sejour->date_to);
        $nb_weeks = tool::getNbWeeks($date_from, $date_to);

        if($nb_weeks > 0){
             $date_from_string = strftime('%d/%m/%Y', $date_from->getTimestamp());
            for ($i=1; $i < $nb_weeks; ++$i) { 
                $date_from->modify("+1 weeks");
                $date_from_string .= '#'.strftime('%d/%m/%Y', $date_from->getTimestamp());
            }
        }else {
            $date_from_string = strftime('%d/%m/%Y', $date_from->getTimestamp());
        }
        
        return $date_from_string;
    }

    public static function getAllEndsWeek($sejour_id){
        $sejour = self::get($sejour_id);
        $date_from = new DateTime($sejour->date_from);
        $date_to = new DateTime($sejour->date_to);
        $nb_weeks = tool::getNbWeeks($date_from, $date_to);

        if($nb_weeks > 0){
            $date_to_string = '';
            for ($i=0; $i < $nb_weeks; ++$i) { 
                $date_from->modify("+1 weeks");
                if($i > 0){
                    $date_to_string .= '#';
                }
                $date_to_string .= strftime('%d/%m/%Y', $date_from->getTimestamp());
            }
        }else {
            $date_to_string = strftime('%d/%m/%Y', $date_to->getTimestamp());
        }
        
        return $date_to_string;
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