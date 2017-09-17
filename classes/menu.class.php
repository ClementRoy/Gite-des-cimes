<?php

class menu
{
    
    /**
     * desc
     *
     * @note 
     *
     * @param
     * @return
     */
    function __construct()
    {
        # code...
    }



    /**
     * Get an object from its id
     *
     * @param int id of the object
     * @return object result of the query
     */
    public static function getNavbar () {

        $navbar = array(
            'accueil' => array(
                'name' => 'Tableau de bord',
                'icon' => 'dashboard',
                'min_rank' => 1,
                'display' => true,
            ),
            'enfants' => array(
                'name' => 'Enfants',
                'icon' => 'group',
                'min_rank' => 1,
                'display' => true,
                'submenu' => array(
                    'index' => array(
                        'name' => 'Liste des enfants',
                        'min_rank' => 1,
                        'display' => true,
                    ),
                    'ajouter' => array(
                        'name' => 'Ajouter un enfant',
                        'min_rank' => 1,
                        'display' => true,
                    ),
                    'editer' => array(
                        'name' => 'Modifier un enfant',
                        'min_rank' => 1,
                        'display' => false,
                    ),
                )
            ),
            'sejours' => array(
                'name' => 'Séjours',
                'icon' => 'plane',
                'min_rank' => 1,
                'display' => true,
                'submenu' => array(
                    'index' => array(
                        'name' => 'Liste des séjour',
                        'min_rank' => 1,
                        'display' => true,
                    ),
                    'ajouter' => array(
                        'name' => 'Ajouter un séjour',
                        'min_rank' => 1,
                        'display' => true,
                    ),
                    'editer' => array(
                        'name' => 'Modifier un séjour',
                        'min_rank' => 1,
                        'display' => false,
                    ),
                )
            ),
            'dossiers' => array(
                'name' => 'Dossiers d\'inscription',
                'icon' => 'folder-open',
                'min_rank' => 1,
                'display' => true,
                'submenu' => array(
                    'index' => array(
                        'name' => 'Liste des dossiers',
                        'min_rank' => 1,
                        'display' => true,
                    ),
                    'ajouter' => array(
                        'name' => 'Ajouter un nouveau dossier',
                        'min_rank' => 1,
                        'display' => true,
                    ),
                    'editer' => array(
                        'name' => 'Modifier un dossier',
                        'min_rank' => 1,
                        'display' => false,
                    ),
                )
            ),
            'hebergements' => array(
                'name' => 'Hébergements',
                'icon' => 'globe',
                'min_rank' => 1,
                'display' => true,
                'submenu' => array(
                    'index' => array(
                        'name' => 'Liste des hébergements',
                        'min_rank' => 1,
                        'display' => true,
                    ),
                    'ajouter' => array(
                        'name' => 'Ajouter un hébergement',
                        'min_rank' => 1,
                        'display' => true,
                    ),
                    'editer' => array(
                        'name' => 'Modifier un hébergement',
                        'min_rank' => 1,
                        'display' => false,
                    ),
                )
            ),
            'structures' => array(
                'name' => 'Structures',
                'icon' => 'building',
                'min_rank' => 1,
                'display' => true,
                'submenu' => array(
                    'index' => array(
                        'name' => 'Liste des structures',
                        'min_rank' => 1,
                        'display' => true,
                    ),
                    'ajouter' => array(
                        'name' => 'Ajouter une structure',
                        'min_rank' => 1,
                        'display' => true,
                    ),
                    'editer' => array(
                        'name' => 'Modifier une structure',
                        'min_rank' => 1,
                        'display' => false,
                    ),
                )
            ),
            'contacts' => array(
                'name' => 'Contacts',
                'icon' => 'comments',
                'min_rank' => 1,
                'display' => true,
                'submenu' => array(
                    'index' => array(
                        'name' => 'Liste des contacts',
                        'min_rank' => 1,
                        'display' => true,
                    ),
                    'ajouter' => array(
                        'name' => 'Ajouter un contact',
                        'min_rank' => 1,
                        'display' => true,
                    ),
                    'editer' => array(
                        'name' => 'Modifier un contact',
                        'min_rank' => 1,
                        'display' => false,
                    ),
                )
            ),
            'accompagnateurs' => array(
                'name' => 'Accompagnateurs',
                'icon' => 'user',
                'min_rank' => 1,
                'display' => true,
                'submenu' => array(
                    'index' => array(
                        'name' => 'Liste des accompagnateurs',
                        'min_rank' => 1,
                        'display' => true,
                    ),
                    'ajouter' => array(
                        'name' => 'Ajouter un accompagnateur',
                        'min_rank' => 1,
                        'display' => true,
                    ),
                    'editer' => array(
                        'name' => 'Modifier un accompagnateur',
                        'min_rank' => 1,
                        'display' => false,
                    ),
                )
            ),
            'factures' => array(
                'name' => 'Facturations',
                'icon' => 'file-text-o',
                'min_rank' => 3,
                'display' => true,
            ),
            'stats' => array(
                'name' => 'Stats',
                'icon' => 'bar-chart',
                'min_rank' => 3,
                'display' => true,
            ),
             'utilisateurs' => array(
                'name' => 'Utilisateurs',
                'icon' => 'user',
                'min_rank' => 1,
                'display' => false,
                'submenu' => array(
                    'index' => array(
                        'name' => 'Liste des utilisateurs',
                        'min_rank' => 3,
                        'display' => false,
                    ),
                    'ajouter' => array(
                        'name' => 'Ajouter un utilisateurs',
                        'min_rank' => 3,
                        'display' => false,
                    ),
                    'infos' => array(
                        'name' => 'Information',
                        'min_rank' => 1,
                        'display' => false,
                    ),
                    'editer' => array(
                        'name' => 'Modifier',
                        'min_rank' => 3,
                        'display' => false,
                    ),
                )
            ),
             'infos' => array(
                'name' => 'Infos',
                'icon' => 'info',
                'min_rank' => 3,
                'display' => false,
                'submenu' => array(
                    'infos' => array(
                        'name' => 'Infos',
                        'min_rank' => 3,
                        'display' => false,
                    ),
                    'debug' => array(
                        'name' => 'Debug',
                        'min_rank' => 3,
                        'display' => false,
                    ),
                )
            ),
            'corbeille' => array(
                'name' => 'Corbeille',
                'icon' => 'trash',
                'min_rank' => 3,
                'display' => true,
            ),
        );


        $currentYear = date('Y');
        for ($i=$currentYear; $i >= 2014 ; $i--) { 
            $navbar['stats']['submenu']['index/annee/'.$i] =  array( 'name' => 'Année '.$i, 'min_rank' => 3, 'display' => true );

            $navbar['factures']['submenu']['index/annee/'.$i] =  array( 'name' => 'Année '.$i, 'min_rank' => 3, 'display' => true );
        }

        return $navbar;
    }


}
