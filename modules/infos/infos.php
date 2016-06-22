<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
<?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>



<!-- Page title -->
<div class="page-head">
    <div class="row">
        <div class="col-md-8">
            <h1>
            	Infos
            </h1>
        </div>
    </div>
</div>
<!-- /Page title -->


<div class="block-flat">
    <div class="content">
        <h2>Version</h2>
		<p>Dev</p>
        <?php phpinfo(); ?>
    </div>
</div>




<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>