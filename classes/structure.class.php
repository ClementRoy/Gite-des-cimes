<?php
class structure
{

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
     * desc
     *
     * @note 
     *
     * @param
     * @return
     */
    public static function get($id){
        global $db;
        $params = array(
                        'id' => $id
                        );
        $result = $db->row('SELECT * FROM structure WHERE id=:id', $params);
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
            $result = $db->query("SELECT * FROM structure LIMIT 5 OFFSET 0", $data);
        }
        else {
            $result = $db->query('SELECT * FROM structure');
        }
        return $result;
    }

}

?>