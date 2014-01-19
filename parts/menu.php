<?php 

$menus = array(
	'accueil' => array(
		'name' => 'Accueil',
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
						'index' => 'Liste des contact',
						'ajouter' => 'Ajouter un contact'
					)
	),
);
/*
	'convocations' => array(
		'name' => 'Convocations',
		'icon' => 'file-text-alt'),
	'factures' => array(
		'name' => 'Factures',
		'icon' => 'edit')
*/

// Build active element from REQUEST URI
$path_array = explode('/', $_SERVER['REQUEST_URI']);

// Set default path
if($path_array['1'] == ''){
	$path_array['1']  = 'accueil';
}

?>


    <!-- sidebar -->
    <div id="sidebar-nav">
        <ul id="dashboard-menu">

			<?php foreach($menus as $key => $menu): ?>
			<?php if(in_array($key, $path_array)): ?>

		       <li class="active">
					<div class="pointer">
					<div class="arrow"></div>
					<div class="arrow_border"></div>
					</div>
			<?php else: ?>
				<li>
			<?php endif; ?>

					<?php if( isset($menu['submenu']) && count($menu['submenu']) > 0): ?>
	                <a class="dropdown-toggle" href="#">
	                    <i class="icon-<?=$menu['icon']; ?>"></i>
	                    <span><?=$menu['name']; ?></span>
	                    <i class="icon-chevron-down"></i>
	                </a>
	                <ul class="submenu <?php if(in_array($key, $path_array)): ?>active<?php endif; ?>">
	                	<?php foreach($menu['submenu'] as $subKey => $submenu): ?>
	                    <li><a href="/<?=$key; ?>/<?=$subKey; ?>/" class="<?php if(in_array($subKey, $path_array) && in_array($key, $path_array)): ?>active<?php endif; ?>"><?=$submenu ?></a></li>
	                	<?php endforeach; ?>
	                </ul>
					<?php else: ?>
		        	<a href="/<?=$key; ?>/">
			        	<i class="icon-<?=$menu['icon']; ?>"></i>
			        	<span><?=$menu['name']; ?></span>
		        	</a>
					<?php endif; ?>

		        </li>
	    	<?php endforeach; ?>
        </ul>
    </div>
    <!-- end sidebar -->