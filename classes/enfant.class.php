<?php

class enfant
{

	private static $table = 'enfant';

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
		$result = $db->row('SELECT * FROM enfant WHERE id=:id', $params);
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
            $result = $db->query('SELECT * FROM enfant LIMIT '.$limit.' OFFSET '.$offset);
        }
        else {
            $result = $db->query('SELECT * FROM enfant');
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
		$result = $db->row('SELECT COUNT(*) FROM enfant');
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
	function update($id, $params = array()){
		global $db;
        $sql = '';
        $db->update($sql, $params);
		return true;
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
	function add($sql, $params = array()){
		global $db;
        $db->insert($sql, $params);
		return true;
	}

    /**
     * desc
     *
     * @note 
     *
     * @param id id of the child to remove
     * @return
     */
	function remove($id){
		global $db;
        $sql = '';
        $db->delete($sql);
		return true;
	}


}

?>