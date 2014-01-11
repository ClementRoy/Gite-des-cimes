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
        $result = $db->row('SELECT * FROM '.self::$table.' WHERE id=:id', $params);
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
            $result = $db->query('SELECT * FROM '.self::$table);
        }
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
    public static function count(){
        global $db;
        $result = $db->row('SELECT COUNT(*) FROM '.self::$table);
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
    public static function update($data = array(), $id){
        global $db;

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
     * desc
     *
     * @note
     *
     * @param sql 
     * @param params those are transmitted to the sql query
     * @return
     */
    public static function add($data = array()){
        global $db;

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
     * desc
     *
     * @note 
     *
     * @param id id of the child to remove
     * @return
     */
    public static function remove($id){
        global $db;
        $sql = 'DELETE FROM '.self::$table.' WHERE id = :id';
        $result = $db->delete($sql, array('id' => $id));
        return $result;
    }

}

?>