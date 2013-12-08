<?php

class sejour
{

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
        $result = $db->row('SELECT * FROM sejour WHERE id=:id', $params);
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
            $result = $db->query("SELECT * FROM sejour LIMIT 5 OFFSET 0", $data);
        }
        else {
            $result = $db->query('SELECT * FROM sejour');
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
        $result = $db->row('SELECT COUNT(*) FROM sejour');
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
    public static function update($id, $params = array()){
        global $db;
        $sql = '';
        $result = $db->update($sql, $params);
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
    public static function add($sql, $params = array()){
        global $db;
        $result = $db->insert($sql, $params);
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
        $sql = 'DELETE FROM sejour WHERE id = :id';
        $result = $db->delete($sql, array('id' => $id));
        return $result;
    }

}

?>