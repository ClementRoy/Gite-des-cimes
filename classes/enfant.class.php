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
     * See quickly all the available methods
     *
     * @return array of the methods and their parameters name
     */
	private function methods(){
		$methods = array(
						'get' => array('id'),
						'getList' => array(),
						'count' => array(),
						'update' => array(),
						'add' => array(),
						'remove' => array()
						);

		return $methods;
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
	public static function getList(){
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
		var_dump($result);
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

	}


}

?>