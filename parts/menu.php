<?php 

$menus = array(
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
	'structures' => array(
		'name' => 'Structures',
		'icon' => 'building',
		'submenu' => array(
						'index' => 'Liste des séjours',
						'ajouter' => 'Ajouter un séjour'
					)
	),
	'contacts' => array(
		'name' => 'Contacts',
		'icon' => 'comments'),
	'convocations' => array(
		'name' => 'Convocations',
		'icon' => 'file-text-alt'),
	'factures' => array(
		'name' => 'Factures',
		'icon' => 'edit')
	);

$path_array = explode('/', $_SERVER['REQUEST_URI']);

?>


    <!-- sidebar -->
    <div id="sidebar-nav">
        <ul id="dashboard-menu">
	        <li>
	        	<a href="/">
	        		<i class="icon-dashboard"></i>
	        		<span>Accueil</span>
	        	</a>
	        </li>
       

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
	                <ul class="submenu">
	                	<?php foreach($menu['submenu'] as $subKey => $submenu): ?>
	                    <li><a href="/<?=$key; ?>/<?=$subKey; ?>/"><?=$submenu ?></a></li>
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