    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
    <?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>


    <!-- main container -->
    <div class="content">
		<div id="pad-wrapper" class="users-list">
            <div class="row header">
                <h3>Utilisateur</h3>
                <div class="col-md-10 col-sm-12 col-xs-12 pull-right">
                    <?php $user = user::get($id); ?>
                    <?php tool::output($user); ?>
                </div>
            </div>

 
        </div>
    </div><!-- /.container -->

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>