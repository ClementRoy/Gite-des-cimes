<?php

/*
On inclue les identifiants de connexion MySQL
*/
require('mysql.php');


/*
Gestion d'affichage des erreurs
Environnement de développement
Attention à modifier les valeur lors du passage en production
Toutes les erreurs php sont loggués dans error.log
 */

date_default_timezone_set('Europe/Paris');
setlocale(LC_TIME, "fr_FR.UTF-8");


/*
Fonction d'autoload des classes PHP
Toutes les classes doivent être dans le dossiers /classes
 */
function __autoload($class_name) { 
    $class_name = strtolower($class_name);  
    if(file_exists($_SERVER["DOCUMENT_ROOT"] . '/classes/' . $class_name . '.class.php')) {
        include_once ($_SERVER["DOCUMENT_ROOT"] . '/classes/' . $class_name . '.class.php');  
    } else {
        throw new Exception("Unable to load $class_name");
    }
} 



/*
Liste des modules actifs du site
Tous les modules sont dans /modules
Par défaut l'index.php du module est chargé
Le nom du dossier doit être le même que le module /modules/[module_name]
Un module peut-être accessible via le menu principal ou à travers d'autres modules
Certains sont même abstrait
 */

$GLOBALS['modules'] = JSON::get(dirname(__FILE__) . '/modules.json');

define('DEFAULT_MODULE', 'accueil');
define('DEFAULT_VIEW', 'index');

define('EMPTYVAL', '–');

define('UPLOAD_FOLDER','uploads/');

/*
Tous les widgets sont dans /widgets
Les widgets sont appelés sur le dashboard (module)
Chaque widget est dans un fichier comme suit : /widgets/[widget_name].widget.php
Chaque fichier est inclus directement dans le module dashboard
 */

$GLOBALS['widgets'] = JSON::get(dirname(__FILE__) . '/widgets.json');


define('ADMIN', 'mail@clementroy.fr');





?>