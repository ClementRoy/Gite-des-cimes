<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
<?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>


<!-- Page title -->
<div class="page-head">
    <div class="row">
        <div class="col-md-8">
            <h1>Debug</h1>
        </div>
    </div>
</div>
<!-- /Page title -->

<div class="block-flat">
	<div class="header">							
		<h3>SESSION</h3>
	</div>
	<div class="content" style="max-width:100%;">
		<pre>
			<?php print_r($_SESSION); ?>
		</pre>
	</div>
</div>

<div class="block-flat">
	<div class="header">							
		<h3>SERVER</h3>
	</div>
	<div class="content">
		<pre>
			<?php print_r($_SERVER); ?>
		</pre>
	</div>
</div>

<div class="block-flat">
	<div class="header">							
		<h3>CONSTANTE</h3>
	</div>
	<div class="content">
		<pre>
			<?php print_r(get_defined_constants()); ?>
		</pre>
	</div>
</div>

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>