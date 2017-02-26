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
    public static function getBySejour($sejour_id){

        $seasons = saison::getListAll();
        $sejour = sejour::get($sejour_id);
        // tool::output( $sejour );
        // tool::output( $seasons );
        $date_from = new DateTime($sejour->date_from);
        $date_from_day = strftime('%d', $date_from->getTimestamp());
        $date_from_month = strftime('%m', $date_from->getTimestamp());

        $date_to = new DateTime($sejour->date_to);
        $date_to_day = strftime('%d', $date_to->getTimestamp());
        $date_to_month = strftime('%m', $date_to->getTimestamp());

        $sejour_season = false;

        if ( ( $date_to->getTimestamp() - $date_from->getTimestamp() ) > 172800) {
            foreach ($seasons as $season) {
                if ( intval($date_from_month) >= intval($season->month_from)
                    && intval($date_to_month) <= intval($season->month_to)
                    && intval($season->id) !== 5 ) {
                        $sejour_season = $season;
                }
            }

        } else {
            $sejour_season = $seasons[4];
        }
        
        return $sejour_season;
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