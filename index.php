<?php session_start();


require('config/config.inc.php');

// DB TESTS

$db = new db();

$users = user::get_users();


// END DB TEST



/*
 * Il s'agit du controller principal, on vérifie que l'utilisateurs est connecté
 * si il n'est pas connecté on charge la boite de login
 * Si il est connecté on vérifie la validité de la ressources et on le renvoi vers cette ressources
*/

if ( isset($_GET['logout']) ) {
    user::logout();
}

if ( user::is_logged() ) {
    // if ( isset($_GET['module']) && !empty($_GET['module']) && array_key_exists($_GET['module'], $availableModules) ) {
    //     //include($availableModules[$_GET['module']]);
    // }
    // else {
    //     include('home.php');
    // }

    echo 'hello Mr';
}
else {
    include('login.php');
}









?>
