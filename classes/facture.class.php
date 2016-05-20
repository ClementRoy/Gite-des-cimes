<?php

class facture
{

	private static $table = 'facture';

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

    public static function getByStructureAndSeason($structure_id, $season_id, $year){
        global $db;
        $params = array(
            ':structure_id' => $structure_id,
            ':id' => $season_id,
            ':year' => $year,
            );
        $sql = 'SELECT * FROM '.self::$table.' WHERE ref_season=:id AND ref_orga=:structure_id AND year=:year';
        $result = $db->query($sql, $params);
        return $result;
    }


    public static function getAlreadyFactured($structure_id, $season_id, $year) {
        global $db;

        $sql = 'SELECT facture_item.ref_inscription FROM facture_item
                LEFT JOIN facture ON facture_item.ref_facture = facture.id 
                WHERE facture.ref_orga  = "'.$structure_id.'"
                AND facture.ref_season  = "'.$season_id.'"
                AND facture.year = "'.$year.'"';

         //echo $sql;
        $result = $db->query($sql);

        $archived = array();

        foreach ($result as $key => $item) {
            array_push($archived, $item->ref_inscription);
        }
        return $archived; 
    }

    /**
     *
     * On récupère la liste de toutes les inscriptions classées par enfants
     */
    

    public static function getInscriptionsByStructureAndSeason($structure_id, $season_id, $year){
        global $db;
        $number = 0;
        //global $seasons;
        // echo $season_name;

        $season = saison::getByYear($season_id, $year);

        $from = $season['from']->format("Y-m-d H:i:s");
        $to = $season['to']->format("Y-m-d H:i:s");

        if($season['name'] == 'Weekend'){
            $sql = 'SELECT enfant.id, enfant.firstname, enfant.lastname FROM enfant
                    LEFT JOIN dossier ON enfant.id = dossier.ref_enfant 
                    LEFT JOIN inscription ON dossier.id = inscription.ref_dossier 
                    WHERE dossier.ref_structure_payer  = "'.$structure_id.'"
                    AND dossier.finished = 1 
                    AND dossier.archived = 0
                    AND inscription.date_from >= "'.$from.'" 
                    AND inscription.date_to <= "'.$to.'" 
                    AND DATE_ADD(inscription.date_from, INTERVAL 2 DAY) = inscription.date_to
                    GROUP BY enfant.id
                    ORDER BY enfant.firstname';
        } else {
            $sql = 'SELECT enfant.id, enfant.firstname, enfant.lastname FROM enfant
                    LEFT JOIN dossier ON enfant.id = dossier.ref_enfant 
                    LEFT JOIN inscription ON dossier.id = inscription.ref_dossier 
                    WHERE dossier.ref_structure_payer  = "'.$structure_id.'"
                    AND dossier.finished = 1 
                    AND dossier.archived = 0
                    AND inscription.date_from >= "'.$from.'" 
                    AND inscription.date_to <= "'.$to.'" 
                    AND DATE_ADD(inscription.date_from, INTERVAL 2 DAY) != inscription.date_to
                    GROUP BY enfant.id
                    ORDER BY enfant.firstname';
         }
         //echo $sql;
        $result = $db->query($sql);
        return $result;
    }

    public static function getInscriptionByChildBySeason($child_id, $season_id, $year) {
        global $db;
        $number = 0;
        //global $seasons;

        $season = saison::getByYear($season_id, $year);

        $from = $season['from']->format("Y-m-d H:i:s");
        $to = $season['to']->format("Y-m-d H:i:s");

        if($season['name'] == 'Weekend'){
            $sql = 'SELECT inscription.id, inscription.date_from, inscription.date_to, sejour.name, sejour.price FROM inscription
                    LEFT JOIN dossier ON inscription.ref_dossier = dossier.id 
                    LEFT JOIN sejour ON inscription.ref_sejour = sejour.id 
                    LEFT JOIN enfant ON inscription.ref_enfant = enfant.id 
                    WHERE enfant.id  = "'.$child_id.'" 
                    AND dossier.finished = 1 
                    AND dossier.archived = 0
                    AND inscription.date_from >= "'.$from.'" 
                    AND inscription.date_to <= "'.$to.'" 
                    AND DATE_ADD(inscription.date_from, INTERVAL 2 DAY) = inscription.date_to
                    ORDER BY inscription.id';
        }
        else {
            $sql = 'SELECT inscription.id, inscription.date_from, inscription.date_to, sejour.name, sejour.price FROM inscription
                    LEFT JOIN dossier ON inscription.ref_dossier = dossier.id 
                    LEFT JOIN sejour ON inscription.ref_sejour = sejour.id 
                    LEFT JOIN enfant ON inscription.ref_enfant = enfant.id 
                    WHERE enfant.id  = "'.$child_id.'" 
                    AND dossier.finished = 1 
                    AND dossier.archived = 0
                    AND inscription.date_from >= "'.$from.'" 
                    AND inscription.date_to <= "'.$to.'" 
                    AND DATE_ADD(inscription.date_from, INTERVAL 2 DAY) != inscription.date_to
                    ORDER BY enfant.firstname';
         }
         //echo $sql;
        $result = $db->query($sql);
        return $result;
    }


    /**
     * Count the number of entries in the database table
     *
     * @return int number of the entries in the table
     */
    public static function generate($facture_id){
        // global $db;

        ob_start();

        include($_SERVER["DOCUMENT_ROOT"] . '/modules/pdf/facture.php');

        $content = ob_get_clean(); 

        // tool::output( $content );
        try {
            $pdf = new HTML2PDF('P', 'A4', 'fr');
            $pdf->writeHTML($content);

            $pdf->Output($_SERVER["DOCUMENT_ROOT"].'/uploads/'.$facture->number . '.pdf', 'F');
        } catch(HTML2PDF_exception $e) {
            die($e);
        }

        // return $result;
    }


    /**
     * Get back the last number Id from current year.
     * If not exist, start from 01
     *
     * @return int number of the entries in the table
     */
    public static function getLastNumberIdfromYear($number_year){
        global $db;
        $params = array(':number_year' => $number_year);
        $sql = 'SELECT * FROM '.self::$table.' WHERE number_year=:number_year ORDER BY id DESC LIMIT 1';
        $result = $db->row($sql, $params);

        if (empty($result)) {
            $number_id = 0;
        } else {
            $number_id = $result->number_id;
        }

        return $number_id;
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
    
}

?>