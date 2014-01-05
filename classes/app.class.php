<?php

class app
{

	const VERSION = 'dev';
	public static $name = "Gîte des Cimes";
	
	function __construct()
	{


	}

	public function start(){
		session_start();

		

		$GLOBALS['db'] = new DB();

		$params = array_filter(explode('/', $_SERVER['REQUEST_URI']));
		foreach ($params as $key => $param) {
		    //echo $key.' =>'.$param."\n";
		    if( $key == 1) {
		        $GLOBALS['module'] = $param;
		    }
		    elseif($key == 2) {
		        $GLOBALS['function'] = $param;
		    }
		    else {
		        if($key%2 != 0) {
		            $_GET[$param] = $params[$key+1];
		        }
		    }
		}
		//extract($_GET);
		//extract($_POST);
		extract($GLOBALS);		
	}


	public function handleLogin($user) {

		if( isset($_POST['login']) && !empty($_POST['identifier']) && !empty($_POST['password']) ) {
		    $remember = (isset($_POST['remember'])) ? true : false;
		    $referer = ($_SERVER['REQUEST_URI'] != '/') ? $_SERVER['HTTP_REFERER'] : '/';
		    $user->login($_POST['identifier'], $_POST['password'], $remember, $referer );
		}

		if ( isset($_GET['deconnexion']) ) {
		    $user->logout();
		}
	}


	public function route(){

		if ( user::isLogged() ) {
		    
		    global $module, $function, $modules;

		    $user = new user($_SESSION['Auth']['identifier'], $_SESSION['Auth']['password']);

		    if ( isset($module) && !empty($module) && property_exists($modules, $module) ) {
		        $module = $module;
		        //echo $module;
		         if ( isset($function) && !empty($function) && in_array($function, $modules->$module->functions) ) {
		           $function = $function;
		         }
		         else {
		            $function = $modules->$module->functions[0];
		         }
		    }
		    else {
		        $function = DEFAULT_FUNCTION;
		        $module   = DEFAULT_MODULE;
		    }
		    //echo $_SERVER["DOCUMENT_ROOT"] . '/modules/'.$module.'/'.$function.'.php';
		    include($_SERVER["DOCUMENT_ROOT"] . '/modules/'.$module.'/'.$function.'.php');

		}
		else {
		    include($_SERVER["DOCUMENT_ROOT"] . '/modules/utilisateurs/connexion.php');
		}

	}


	public static function getVar(&$var) {
		return self::$var;
	}


	public function router(){

	}




}

?>