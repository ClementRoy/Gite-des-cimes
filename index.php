<?php session_start();


require($_SERVER["DOCUMENT_ROOT"] . '/config/config.inc.php');


/*
 Initialisation et connexion à la base de données 
 */
$db = new DB();


// Handle login system
if( isset($_POST['login']) && !empty($_POST['identifier']) && !empty($_POST['password']) ) {
    //print_r($_SERVER);
    extract($_POST);
    $user = new user();
    $remember = (isset($_POST['remember'])) ? true : false;
    $user->login($identifier, $password, $remember, $_SERVER['HTTP_REFERER']);
}

/*
 * Il s'agit du controller principal, on vérifie que l'utilisateurs est connecté
 * si il n'est pas connecté on charge la boite de login
 * Si il est connecté on vérifie la validité de la ressources et on le renvoi vers cette ressources
*/

if ( isset($_GET['logout']) ) {
    user::logout();
}

if ( user::is_logged() ) {
    
    if ( isset($_GET['module']) && !empty($_GET['module']) && array_key_exists($_GET['module'], $modules) ) {
        $module = $_GET['module'];
         if ( isset($_GET['function']) && !empty($_GET['function']) && in_array($_GET['function'], $modules[$module]) ) {
           $function = $_GET['function'];
         }
         else {
            $function = 'index';
         }

    }
    else {
        $function = 'index';
        $module = 'dashboard';
    }
    include($_SERVER["DOCUMENT_ROOT"] . '/modules/'.$module.'/'.$function.'.php');

}
else {
    include($_SERVER["DOCUMENT_ROOT"] . '/modules/users/login.php');
}









?>
