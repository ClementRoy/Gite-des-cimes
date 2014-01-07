<?php 

require($_SERVER["DOCUMENT_ROOT"] . '/config/config.inc.php');

$app = new app();

$app->start();

$user = new user();

$app->handleLogin($user);

$app->route();


?>
