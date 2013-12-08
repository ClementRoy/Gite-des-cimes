    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
    <?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>

    
    <?php $sejour = sejour::get($id); ?>


    <!-- main container -->
    <div class="content">
		<div id="pad-wrapper" class="users-profil">
                <div class="row header">
                    <div class="col-md-5">
                    <h3><?=$sejour->name; ?></h3>
                    </div>
                    <div class="col-md-5 text-right pull-right">
                        <a href="/sejours/supprimer/id/<?=$sejour->id; ?>" class="btn-flat danger"><i class="icon-remove"></i> Supprimer</a>
                        <a href="/sejours/editer/id/<?=$sejour->id; ?>" class="btn-flat default"><i class="icon-edit"></i> Modifier</a>
                    </div>
                </div>

            <div class="row profile">
                <!-- bio, new note & orders column -->
                <div class="col-md-9 bio">
                <?php tool::output($sejour); ?>
                </div>
            </div>

        </div>
    </div><!-- /.container -->

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>