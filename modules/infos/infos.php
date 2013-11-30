<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
<?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>


	<!-- main container -->
    <div class="content">
		<div id="pad-wrapper">
			<h1>Debug</h1>

			<div class="row">
			    <div class="col-sm-12">
			        <h2>SESSION</h2>
			        <?php tool::output($_SESSION); ?>
			    </div>
			</div>
			<div class="row">
			    <div class="col-sm-12">
			        <h2>SERVER</h2>
			        <?php tool::output($_SERVER); ?>
			    </div>
			</div>
			<div class="row">
			    <div class="col-sm-12">
			        <h2>CONSTANTE</h2>
			        <?php tool::output(get_defined_constants()); ?>
			    </div>
			</div>

		</div>
	</div>




<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>