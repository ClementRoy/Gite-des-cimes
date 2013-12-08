    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
    <?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>


    <!-- main container -->
    <div class="content">
        <div id="pad-wrapper">
            <div class="row header">
                <h3>Les enfants</h3>
            </div>
            <?php if(isset($confirm)): ?>
            <div class="row">
                <div class="col-md-12">
                    <?php 
                        enfant::remove($id);
                    ?>
                    <p>L'enfant a bien été supprimé</p>
                    <a href="/enfants/">Retourner à la liste des enfants</a>
                </div>                
            </div>
            <?php else: ?>
            <?php $enfant = enfant::get($id); ?>
            <div class="row">
                <div class="col-md-12">
                    <p>Confirmer la suppression de <?=$enfant->firstname; ?> <?=$enfant->lastname; ?></p>
                    <a href="/enfants/remove/id/<?=$enfant->id; ?>/confirm/true" class="btn-flat primary pull-right">Confirmer</a>
                    <a href="/enfants/" class="btn-flat secondary pull-right">Annuler</a>
                </div>                
            </div>
            <?php endif; ?>

            <!-- end users table -->
        </div>
    </div><!-- /.container -->
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>



