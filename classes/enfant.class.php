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
	public static function getList($limit = false, $offset = false){
		global $db;
		$result = $db->query('SELECT * FROM enfant');
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

		return true;
	}

    /**
     * desc
     *
     * @note 
     *
     * @param
     * @return
     */
	function add($params = array()){
		global $db;

		return true;
	}

    /**
     * desc
     *
     * @note 
     *
     * @param
     * @return
     */
	function remove($id){
		global $db;

		return true;
	}


}

?>