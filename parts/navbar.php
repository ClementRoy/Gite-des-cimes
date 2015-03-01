<?php

$navbar = array(
    'accueil' => array(
        'name' => 'Tableau de bord',
        'icon' => 'dashboard',
    ),
    'enfants' => array(
        'name' => 'Enfants',
        'icon' => 'group',
        'submenu' => array(
                        'index' => 'Liste des enfants',
                        'ajouter' => 'Ajouter un enfant'
                    )
    ),
    'sejours' => array(
        'name' => 'Séjours',
        'icon' => 'plane',
        'submenu' => array(
                        'index' => 'Liste des séjours',
                        'ajouter' => 'Ajouter un séjour'
                    )
    ),
    'dossiers' => array(
        'name' => 'Dossiers d\'inscription',
        'icon' => 'folder-open',
        'submenu' => array(
                        'index' => 'Liste des dossiers',
                        'ajouter' => 'Ajouter un nouveau dossier'
                    )
    ),
    'hebergements' => array(
        'name' => 'Hébergements',
        'icon' => 'globe',
        'submenu' => array(
                        'index' => 'Liste des hébergements',
                        'ajouter' => 'Ajouter un hébergement'
                    )
    ),
    'structures' => array(
        'name' => 'Structures',
        'icon' => 'building',
        'submenu' => array(
                        'index' => 'Liste des structures',
                        'ajouter' => 'Ajouter une structure'
                    )
    ),
    'contacts' => array(
        'name' => 'Contacts',
        'icon' => 'comments',
        'submenu' => array(
                        'index' => 'Liste des contacts',
                        'ajouter' => 'Ajouter un contact'
                    )
    ),
    'accompagnateurs' => array(
        'name' => 'Accompagnateurs',
        'icon' => 'user',
        'submenu' => array(
                        'index' => 'Liste des accompagnateurs',
                        'ajouter' => 'Ajouter un accompagnateur'
                    )
    ),
    'stats' => array(
        'name' => 'Stats',
        'icon' => 'bar-chart',
    ),
    'corbeille' => array(
        'name' => 'Corbeille',
        'icon' => 'trash'
    ),
);


    $currentYear = date('Y');
    for ($i=$currentYear; $i >= 2014 ; $i--) { 
        $navbar['stats']['submenu']['index/annee/'.$i] =  'Année '.$i;
    }


/*
    'convocations' => array(
        'name' => 'Convocations',
        'icon' => 'file-text-alt'),
    'factures' => array(
        'name' => 'Factures',
        'icon' => 'edit')

    'export' => array(
        'name' => 'Export',
        'icon' => 'cog'
    ),
    
*/

// Build active element from REQUEST URI
$path_array = explode('/', $_SERVER['REQUEST_URI']);

// Set default path
if($path_array['1'] == ''){
    $path_array['1']  = 'accueil';
}

?>


<div class="cl-sidebar">
    <div class="cl-toggle"><i class="fa fa-bars"></i></div>
    <div class="cl-navblock">
        <div class="menu-space">
            <div class="content">
                <!--LOGO-->
                <div class="sidebar-logo">
                    <div class="logo">
                        <a href="/"><img src="/assets/img/icon-home.png" class="logo-img" width="40" height="40" alt=""><span class="visible-hover">Gite des cîmes</span></a>
                    </div>
                </div>

                <ul class="cl-vnavigation">
                    <?php foreach($navbar as $key => $menu): ?>
                    <?php if( isset($menu['submenu']) && count($menu['submenu']) > 0): ?>
                    <li class="parent<?php if(in_array($key, $path_array)): ?><?php endif; ?>"><a href="#"><i class="fa fa-<?=$menu['icon']; ?>"></i><span class="visible-hover"><?=$menu['name']; ?></span></a>
                        <ul class="sub-menu<?php if(in_array($key, $path_array)): ?> active<?php endif; ?>">
                            <?php foreach($menu['submenu'] as $subKey => $submenu): ?>
                            <li><a href="/<?=$key; ?>/<?=$subKey; ?>/" class="<?php if(in_array($subKey, $path_array) && in_array($key, $path_array)): ?>active<?php endif; ?>"><?=$submenu ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <?php else: ?>
                    <li <?php if(in_array($key, $path_array)): ?> class="active"<?php endif; ?>><a href="/<?=$key; ?>/"><i class="fa fa-<?=$menu['icon']; ?>"></i><span class="visible-hover"><?=$menu['name']; ?></span></a></li>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </ul>

            </div>
        </div>
    </div>
</div>