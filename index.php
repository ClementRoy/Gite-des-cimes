<?php session_start();


require($_SERVER["DOCUMENT_ROOT"] . '/config/config.inc.php');


/*
 Initialisation et connexion à la base de données 
 */
$db = new DB();

$user = new user();

// Handle login system
if( isset($_POST['login']) && !empty($_POST['identifier']) && !empty($_POST['password']) ) {
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

//print_r($_SERVER);

if ( isset($_GET['deconnexion']) ) {
    $user->logout();
}

if ( user::is_logged() ) {
    
    $user = new user($_SESSION['Auth']['identifier'], $_SESSION['Auth']['password']);

    if ( isset($_GET['module']) && !empty($_GET['module']) && array_key_exists($_GET['module'], $modules) ) {
        $module = $_GET['module'];
         if ( isset($_GET['function']) && !empty($_GET['function']) && in_array($_GET['function'], $modules[$module]) ) {
           $function = $_GET['function'];
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
