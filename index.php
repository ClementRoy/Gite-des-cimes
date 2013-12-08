<?php 

session_start();


require($_SERVER["DOCUMENT_ROOT"] . '/config/config.inc.php');


/*

*/
$params = array_filter(explode('/', $_SERVER['REQUEST_URI']));

foreach ($params as $key => $param) {
    //echo $key.' =>'.$param."\n";
    if( $key == 1) {
        $_GET['module'] = $param;
    }
    elseif($key == 2) {
        $_GET['function'] = $param;
    }
    else {
        if($key%2 != 0) {
            $_GET[$param] = $params[$key+1];
        }
    }
}

extract($_GET);
extract($_POST);

/*
 Initialisation et connexion à la base de données 
 */
$db = new DB();

$user = new user();

// Handle login system
if( isset($login) && !empty($identifier) && !empty($password) ) {
    //print_r($_SERVER);
    extract($_POST);
    $remember = (isset($remember)) ? true : false;
    $referer = ($_SERVER['REQUEST_URI'] != '/') ? $_SERVER['HTTP_REFERER'] : '/';
    $user = new user();
    $user->login($identifier, $password, $remember, $referer );
}


/*
 * Il s'agit du controller principal, on vérifie que l'utilisateurs est connecté
 * si il n'est pas connecté on charge la boite de login
 * Si il est connecté on vérifie la validité de la ressources et on le renvoi vers cette ressources
*/

// play with $_SERVER['REQUEST_URI']
// [REQUEST_URI] => /utilisateurs/infos/1

if ( isset($deconnexion) ) { // TODO there is a bug here
    $user->logout();
    //header();
}

if ( user::isLogged() ) {
    
    $user = new user($_SESSION['Auth']['identifier'], $_SESSION['Auth']['password']);

    if ( isset($module) && !empty($module) && array_key_exists($module, $modules) ) {
        $module = $module;
         if ( isset($function) && !empty($function) && in_array($function, $modules[$module]) ) {
           $function = $function;
         }
         else {
            $function = $modules[$module][0];
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









?>
