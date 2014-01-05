    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
    <?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>


    <!-- main container -->
    <div class="content">
        <div id="pad-wrapper" class="action-page">
            <div class="row header">
                <div class="col-md-12">
                    <h3>Séjour</h3>
                </div>
            </div>
            <?php if(isset($confirm)): ?>
                <div class="row">
                    <div class="col-md-12">
                        <?php 
                        sejour::remove($_GET['id']);
                        ?>
                        <p>Le séjour a bien été supprimé</p>
                        <a href="/sejours/">Retourner à la liste des séjours</a>
                    </div>                
                </div>
            <?php else: ?>
                <?php $sejour = sejour::get($_GET['id']); ?>
                <div class="row" class="message">
                    <div class="col-md-12 message">
                       <p>Vous êtes sur le point de supprimer le séjour <strong><?=$sejour->name; ?> (<?=$sejour->numero; ?>)</strong>.<br />
                        Cette action est irréversible.</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <a href="/sejours/infos/id/<?=$sejour->id; ?>" class="btn-flat white" data-dismiss="modal">Annuler</a>
                        <a href="/sejours/supprimer/id/<?=$sejour->id; ?>/confirm/true" class="btn-flat danger"><i class="icon-remove"></i> Supprimer</a>
                    </div>                
                </div>


            <?php endif; ?>

            <!-- end users table -->
        </div>
    </div><!-- /.container -->
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>



