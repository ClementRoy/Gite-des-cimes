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
ini_set('display_errrors', 1);
ini_set('log_errros', 1);
ini_set('error_log', dirname(__FILE__) . '/error.log');
error_reporting(E_ALL);


/*
Fonction d'autoload des classes PHP
Toutes les classes doivent être dans le dossiers /classes
 */
function __autoload($class_name) {  
    $class_name = strtolower($class_name);  
    if(file_exists($_SERVER["DOCUMENT_ROOT"] . '/classes/' . $class_name . '.class.php')) {
        include_once ($_SERVER["DOCUMENT_ROOT"] . '/classes/' . $class_name . '.class.php');  
    } else {
        throw new Exception("Unable to load $class_name.");
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
$modules = array(
					'dashboard',
					'enfants',
					'sejours',
					'structures',
					'contacts',
					'convocations',
					'factures',
					'animateurs',
					'vehicules',
					'users'
	);


/*
Tous les widgets sont dans /widgets
Les widgets sont appelés sur le dashboard (module)
Chaque widget est dans un fichier comme suit : /widgets/[widget_name].widget.php
Chaque fichier est inclus directement dans le module dashboard
 */
$widgets = array(
		'incomplete_fiche',
		'timeline_sejours'
	);

?>