<?php 

require($_SERVER["DOCUMENT_ROOT"] . '/config/config.inc.php');


$app = new app();

$app->start();

$user = new user();

$app->handleLogin($user);

$app->route();


/*
ressources 


http://tutorialzine.com/2013/07/50-must-have-plugins-for-extending-twitter-bootstrap/
http://jschr.github.io/bootstrap-modal/
http://bootstraphero.com/the-big-badass-list-of-twitter-bootstrap-resources
http://bootsnipp.com/resources


*/

?>
