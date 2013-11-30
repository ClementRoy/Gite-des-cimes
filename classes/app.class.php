<?php

class app
{

	const VERSION = 'dev';
	public static $name = "Gîte des Cimes";
	
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
	public static function getVar(&$var) {
		return self::$var;
	}

}

?>