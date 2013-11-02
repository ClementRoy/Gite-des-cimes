<?php 

$modules = array(
	'enfants' => array(
		'name' => 'Enfants',
		'icon' => 'group'),
	'sejours' => array(
		'name' => 'Séjours',
		'icon' => 'plane'),
	'structures' => array(
		'name' => 'Structures',
		'icon' => 'building'),
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

$path_array = explode('/', $_SERVER['SCRIPT_FILENAME']);
?>


    <!-- sidebar -->
    <div id="sidebar-nav">
        <ul id="dashboard-menu">
	        <li>
	        	<a href="../../">
	        		<i class="icon-dashboard"></i>
	        		<span>Accueil</span>
	        	</a>
	        </li>
       

			<?php foreach($modules as $key => $module): ?>
			<?php if(in_array($key, $path_array)): ?>

		       <li class="active">
					<div class="pointer">
					<div class="arrow"></div>
					<div class="arrow_border"></div>
					</div>
			<?php else: ?>
				<li>
			<?php endif; ?>
		        	<a href="/modules/<?php echo $key; ?>/">
			        	<i class="icon-<?php echo $module['icon']; ?>"></i>
			        	<span><?php echo $module['name']; ?></span>
		        	</a>
		        </li>
	    	<?php endforeach; ?>
        </ul>
    </div>
    <!-- end sidebar -->