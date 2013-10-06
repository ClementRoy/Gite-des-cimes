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
			<li class="dropdown">
	        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
	        <ul class="dropdown-menu">
	          <li><a href="#">Action</a></li>
	          <li><a href="#">Another action</a></li>
	          <li><a href="#">Something else here</a></li>
	          <li><a href="#">Separated link</a></li>
	          <li><a href="#">One more separated link</a></li>
	        </ul>
	      </li>

	      </ul>

    <form class="navbar-form navbar-right" role="search">
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Mots clefs">
      </div>
    </form>

	    </div><!--/.nav-collapse -->
	  </div>
	</div>


<div class="container">
	<ol class="breadcrumb">
		<li><a href="#">Home</a></li>
		<li><a href="#">Library</a></li>
		<li class="active">Data</li>
	</ol>	
	
</div>

