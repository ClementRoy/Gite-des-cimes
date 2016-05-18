<?php

class saison
{
    private static $table = 'saison';

    
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
    public static function get($saison_id){
        global $db;
        $params = array(':id' => $saison_id);
        $sql = 'SELECT * FROM '.self::$table.' WHERE id=:id';
        $result = $db->row($sql, $params);

        return $result;
    }


    /**
     * Get an object from its id
     *
     * @param int id of the object
     * @return object result of the query
     */
    public static function getByYear($saison_id, $year){
        global $db;
        $params = array(':id' => $saison_id);
        $sql = 'SELECT * FROM '.self::$table.' WHERE id=:id';
        $result = $db->row($sql, $params);
        $season = array(
                'name' => $result->name,
                'from' => new DateTime($year . '-' . $result->month_from . '-' . $result->day_from ),
                'to' => new DateTime($year . '-' . $result->month_to . '-' . $result->day_to ),
            );

        return $season;
    }

    /**
     * Get an object from its id
     *
     * @param int id of the object
     * @return object result of the query
     */
    public static function getListAll(){
        global $db;
        $params = array();
        $sql = 'SELECT * FROM '.self::$table;
        $result = $db->query($sql, $params);
        return $result;
    }

    /**
     * Get an object from its id
     *
     * @param int id of the object
     * @return object result of the query
     */
    // public static function getByYear($year){
    //     global $db;
    //     $params = array();
    //     $sql = 'SELECT * FROM '.self::$table;
    //     $result = $db->query($sql, $params);

    //     $seasons = array();

    //     foreach ($result as $key => $season) {
    //         $seasons[$season->name] = array(
    //                 'start' => new DateTime($year . '-' . $season->month_start . '-' . $season->day_start ),
    //                 'end' => new DateTime($year . '-' . $season->month_end . '-' . $season->day_end ),
    //             );
    //         // 'Fevrier' => array(
    //         //     'start' => new DateTime($year.'-02-05'),
    //         //     'end' => new DateTime($year.'-03-04'),
    //         // ),
    //     }
    //     return $seasons;
    // }


    
}

?>