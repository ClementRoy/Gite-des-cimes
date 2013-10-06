<?php

ini_set('display_errrors', 1);
ini_set('log_errros', 1);
ini_set('error_log', dirname(__FILE__) . '/log.txt');
error_reporting(E_ALL);

function __autoload($class_name) {  
    $class_name = strtolower($class_name);  
    include_once (dirname(__FILE__) . '/classes/' . $class_name . '.class.php');  
} 

?>