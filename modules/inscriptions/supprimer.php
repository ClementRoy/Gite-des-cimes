    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
    <?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>


    <!-- main container -->
    <div class="content">
        <div id="pad-wrapper" class="action-page">
            <div class="row header">
                <div class="col-md-12">
                    <h3>Inscriptions</h3>
                </div>
            </div>
            <?php if(isset($_GET['confirm'])): ?>
                <div class="row">
                    <div class="col-md-12">
                        <?php 
                            $result = inscription::remove($_GET['id']);
                        ?>
                        <p>L'inscription a bien été supprimé</p>
                        <a href="/inscriptions/">Retourner à la liste des inscriptions</a>
                    </div>                
                </div>
            <?php else: ?>
                <?php $inscription = inscription::get($_GET['id']); ?>
                <div class="row" class="message">
                    <div class="col-md-12 message">
                       <p>Vous êtes sur le point de supprimer l'inscription <strong><?=$inscription->id; ?> </strong>.<br /></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <a href="/inscriptions/infos/id/<?=$inscription->id; ?>" class="btn-flat white" data-dismiss="modal">Annuler</a>
                        <a href="/inscriptions/supprimer/id/<?=$inscription->id; ?>/confirm/true" class="btn-flat danger"><i class="icon-remove"></i> Supprimer</a>
                    </div>                
                </div>


            <?php endif; ?>

            <!-- end users table -->
        </div>
    </div><!-- /.container -->
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>



