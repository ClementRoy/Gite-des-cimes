    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
    <?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>


    <!-- main container -->
    <div class="content">
        <div id="pad-wrapper" class="action-page">
            <div class="row header">
            <div class="col-md-12">
                <h3>Suppression</h3>
                </div>
            </div>
            <?php if(isset($confirm)): ?>
            <div class="row">
                <div class="col-md-12">
                    <?php 
                        enfant::remove($_GET['id']);
                    ?>
                    <div class="alert alert-danger">
                        <i class="icon-remove-sign"></i>
                        La fiche a bien été supprimé
                    </div>
                    <a href="/enfants/">Retourner à la liste des enfants</a>
                </div>                
            </div>
            <?php else: ?>

            <?php $enfant = enfant::get($_GET['id']); ?>
            <div class="row">
                <div class="col-md-12 message">
                     <p>Vous êtes sur le point de supprimer la fiche de <strong><?=$enfant->firstname; ?> <?=$enfant->lastname; ?></strong>.<br />
                    Cette action est irréversible.</p>
                </div>
            </div>

             <div class="row">
                <div class="col-md-12">
                    <a href="/enfants/infos/id/<?=$enfant->id; ?>" class="btn-flat white" data-dismiss="modal">Annuler</a>
                    <a href="/enfants/supprimer/id/<?=$enfant->id; ?>/confirm/true" class="btn-flat danger"><i class="icon-remove"></i> Supprimer</a>
                </div>                
            </div>

            <?php endif; ?>

            <!-- end users table -->
        </div>
    </div><!-- /.container -->
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>



