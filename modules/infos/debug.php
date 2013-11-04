<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
<?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>


	<!-- main container -->
    <div class="content">
		<div id="pad-wrapper">
			<h1>Debug</h1>

			<div class="row">
			    <div class="col-sm-4">
			        <h2>SERVER</h2>
			        <pre>
			        <?php var_dump($_SERVER); ?>
			   	 	</pre>
			    </div>
			    <div class="col-sm-4">
			        <h2>CONSTANTE</h2>
			        <pre>
			        <?php var_dump(get_defined_constants()); ?>
			    	</pre>
			    </div>
			    <div class="col-sm-4">
			        <h2>SESSION</h2>
			        <pre>
			        <?php var_dump($_SESSION); ?>
			    	</pre>
			    </div>
			 
			</div>

		</div>
	</div>




<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>