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


    public static function getByDossier($id){
        global $db;
        $params = array(
                        ':id' => $id
                        );
        $sql = 'SELECT * FROM '.self::$table.' WHERE ref_dossier=:id';
        $result = $db->query($sql, $params);
        return $result;        
    }


    public static function getLinkedSejours($id){
        global $db;
        $params = array(
                        ':id' => $id
                        );
        $sql = 'SELECT DISTINCT ref_sejour FROM '.self::$table.' WHERE ref_dossier=:id ORDER BY date_from';
        //echo $sql;
        $result = $db->query($sql, $params);
        return $result;        
    }

    public static function getByEnfant($id){
        global $db;
        $params = array(
                        ':id' => $id
                        );
        $sql = 'SELECT * FROM '.self::$table.' WHERE ref_enfant=:id ORDER BY date_from DESC';
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

    public static function getBySejourAndDossier($sejour_id, $dossier_id){
        global $db;
        $params = array(
                        ':sejour_id' => $sejour_id,
                        ':dossier_id' => $dossier_id
                        );
        $sql = 'SELECT * FROM '.self::$table.' WHERE ref_sejour=:sejour_id AND ref_dossier = :dossier_id';
        $result = $db->query($sql, $params);
        return $result;        
    }


    public static function getUnconfirmedBySejour($id) {
        global $db;
        $params = array(
                        ':id' => $id
                        );
        $sql = 'SELECT * FROM '.self::$table.' WHERE ref_sejour=:id';
        $result = $db->query($sql, $params);
        return $result;
    }

    public static function getUnconfirmedBySejourBetweenDates($id, $date_from = false, $date_to = false) {
        global $db;
        $params = array(
                        ':id' => $id
                        );
        $date_from = $date_from->format("Y-m-d H:i:s");
        $date_to = $date_to->format("Y-m-d H:i:s");
        $sql = 'SELECT * FROM '.self::$table.' 
        LEFT JOIN dossier ON inscription.ref_dossier = dossier.id  
        WHERE dossier.finished = 0 AND
        ref_sejour=:id AND date_from <= "'.$date_from.'" AND date_to >="'.$date_to.'"';
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
        // Ne pas faire un étoile ici ....
        $sql = 'SELECT *, inscription.id as inscription_id, dossier.id as dossier_id FROM '.self::$table.' 
                LEFT JOIN dossier ON inscription.ref_dossier = dossier.id 
                LEFT JOIN enfant ON inscription.ref_enfant = enfant.id 
                LEFT JOIN structure ON enfant.organization = structure.id 
                LEFT JOIN structure_contact ON enfant.contact = structure_contact.id 
                WHERE '.self::$table.'.ref_sejour=:id AND '.self::$table.'.date_from <= "'.$date_from.'" AND '.self::$table.'.date_to >="'.$date_to.'" ORDER BY enfant.lastname';
        $result = $db->query($sql, $params);
        return $result;
    }


    public static function getBySejourBetweenDatesFinished($id, $date_from = false, $date_to = false){
        global $db;
        
        $date_from = $date_from->format("Y-m-d H:i:s");
        $date_to = $date_to->format("Y-m-d H:i:s");
        $params = array(
                        ':id' => $id
                        );
        // Ne pas faire un étoile ici ....
        $sql = 'SELECT *, inscription.id as inscription_id, dossier.id as dossier_id FROM '.self::$table.' 
                LEFT JOIN dossier ON inscription.ref_dossier = dossier.id 
                LEFT JOIN enfant ON inscription.ref_enfant = enfant.id 
                LEFT JOIN structure ON enfant.organization = structure.id 
                LEFT JOIN structure_contact ON enfant.contact = structure_contact.id 
                WHERE '.self::$table.'.ref_sejour=:id AND dossier.finished = 1 AND '.self::$table.'.date_from <= "'.$date_from.'" AND '.self::$table.'.date_to >="'.$date_to.'" ORDER BY enfant.lastname';
        $result = $db->query($sql, $params);
        return $result;
    }

    public static function getDateDeparture($dossier_id){
        global $db;
        $params = array(
                        ':id' => $dossier_id
                        );
        $sql = 'SELECT MIN(date_from) as date_departure FROM '.self::$table.' WHERE ref_dossier = :id';
        $result = $db->row($sql, $params);
        return $result;
    }

    public static function getDateReturn($dossier_id){
        global $db;
        $params = array(
                        ':id' => $dossier_id
                        );
        $sql = 'SELECT MAX(date_to) as date_return FROM '.self::$table.' WHERE ref_dossier = :id';
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
            $result = $db->query('SELECT * FROM '.self::$table.' LIMIT 5 OFFSET 0');
        }
        else {
            $result = $db->query('SELECT * FROM '.self::$table.'');
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

    public static function deleteByDossier($id){
        global $db;
        $data = array(':id' => $id);
        $sql = 'DELETE FROM '.self::$table.' WHERE ref_dossier = :id';
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