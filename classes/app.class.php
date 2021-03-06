<?php

class app
{

	const VERSION = 'dev';
	const URL = "http://gitedescimes.local";
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
		        $GLOBALS['view'] = $param;
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
		    
		    global $module, $view, $modules;

		    $user = new user($_SESSION['Auth']['identifier'], $_SESSION['Auth']['password']);

		    if ( isset($module) && !empty($module) && property_exists($modules, $module) ) {
		        $module = $module;
		        //echo $module;
		         if ( isset($view) && !empty($view) && in_array($view, $modules->$module->views) ) {
		           $view = $view;
		         }
		         else {
		            $view = $modules->$module->views[0];
		         }
		    }
		    else {
		        $view = DEFAULT_VIEW;
		        $module   = DEFAULT_MODULE;
		    }
		    //echo $_SERVER["DOCUMENT_ROOT"] . '/modules/'.$module.'/'.$view.'.php';
		    include($_SERVER["DOCUMENT_ROOT"] . '/modules/'.$module.'/'.$view.'.php');

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