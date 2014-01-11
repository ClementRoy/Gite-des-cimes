    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
    <?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>


    <!-- main container -->
    <div class="content">
        <div id="pad-wrapper" class="action-page">
            <div class="row header">
                <div class="col-md-12">
                    <h3>Utilisateur</h3>
                </div>
            </div>
            <?php if(isset($_GET['confirm'])): ?>
                <div class="row">
                    <div class="col-md-12">
                        <?php 
                        user::remove($_GET['id']);
                        ?>
                        <div class="alert alert-danger">
                            <i class="icon-remove-sign"></i>
                            L'utilisateur a bien été supprimé
                        </div>
                        <a href="/utilisateurs/">Retourner à la liste des utilisateurs</a>

                    </div>                
                </div>
            <?php else: ?>
                <?php $utilisateur = user::get($_GET['id']); ?>
                <div class="row" class="message">
                    <div class="col-md-12 message">
                       <p>Vous êtes sur le point de supprimer l'utilisateur <strong><?=$utilisateur->firstname; ?> <?=$utilisateur->lastname; ?></strong>.<br />
                        Cette action est irréversible.</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <a href="/utilisateurs/infos/id/<?=$utilisateur->id; ?>" class="btn-flat white" data-dismiss="modal">Annuler</a>
                        <a href="/utilisateurs/supprimer/id/<?=$utilisateur->id; ?>/confirm/true" class="btn-flat danger"><i class="icon-remove"></i> Supprimer</a>
                    </div>                
                </div>


            <?php endif; ?>

            <!-- end users table -->
        </div>
    </div><!-- /.container -->
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>



