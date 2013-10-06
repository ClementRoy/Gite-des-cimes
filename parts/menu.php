<?php 

$modules = array(
	'enfants' => 'Enfants',
	'sejours' => 'Séjours',
	'structures' => 'Structures',
	'contacts' => 'Contacts',
	'convocations' => 'Convocations',
	'factures' => 'Factures'
	);

$path_array = explode('/', $_SERVER['SCRIPT_FILENAME']);

?>
	<div class="navbar navbar-inverse navbar-fixed-top">
	  <div class="container">
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="/">Gîte des cimes</a>
	    </div>
	    <div class="collapse navbar-collapse">
	      <ul class="nav navbar-nav">
	      	<?php foreach($modules as $key => $module): ?>
	        <li <?php if(in_array($key, $path_array)){echo 'class="active"';} ?>>
	        	<a href="/modules/<?php echo $key; ?>/">
	        	<?php echo $module; ?></a>
	        </li>
	    	<?php endforeach; ?>
	      </ul>
	    </div><!--/.nav-collapse -->
	  </div>
	</div>