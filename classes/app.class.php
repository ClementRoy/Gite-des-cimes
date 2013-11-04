<?php

class app
{


	public static $name = "Gîte des Cimes";
	
	function __construct()
	{
		# code...
	}

	public static function getVar(&$var) {
		return self::$var;
	}


}

?>