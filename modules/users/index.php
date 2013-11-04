    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
    <?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>


    <!-- main container -->
    <div class="content">
		<div id="pad-wrapper" class="users-list">
            <div class="row header">
                <h3>Utilisateurs</h3>
                <div class="col-md-10 col-sm-12 col-xs-12 pull-right">
                    <a href="/users/add" class="btn-flat primary pull-right"><span>+</span>
                        Ajouter un utilisateur</a>
                </div>
            </div>

 
        </div>
    </div><!-- /.container -->

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>