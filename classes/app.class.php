<?php

class app
{

	const VERSION = 'dev';
	public static $name = "Gîte des Cimes";
	
	function __construct()
	{
		# code...
		session_start();
		$GLOBALS['db'] = new DB();
		extract($GLOBALS);

	}


	public function route(){
		
	}


    /**
     * desc
     *
     * @note 
     *
     * @param
     * @return
     */
	public static function getVar(&$var) {
		return self::$var;
	}


	public function router(){

	}




}

?>