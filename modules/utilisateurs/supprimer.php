    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
    <?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>


    <!-- main container -->
    <div class="content">
        <div id="pad-wrapper">
            <div class="row header">
                <h3>Utilisateur</h3>
            </div>
            <?php if(isset($confirm)): ?>
            <div class="row">
                <div class="col-md-12">
                    <?php 
                        user::remove($id);
                    ?>
                    <p>L'utilisateur a bien été supprimé</p>
                    <a href="/utilisateurs/">Retourner à la liste des utilisateurs</a>
                </div>                
            </div>
            <?php else: ?>
            <?php $utilisateur = user::get($id); ?>
            <div class="row">
                <div class="col-md-12">
                    <p>Confirmer la suppression de <?=$utilisateur->firstname; ?> <?=$utilisateur->lastname; ?></p>
                    <a href="/utilisateurs/supprimer/id/<?=$utilisateur->id; ?>/confirm/true" class="btn-flat primary pull-right">Confirmer</a>
                    <a href="/utilisateurs/" class="btn-flat secondary pull-right">Annuler</a>
                </div>                
            </div>
            <?php endif; ?>

            <!-- end users table -->
        </div>
    </div><!-- /.container -->
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>



