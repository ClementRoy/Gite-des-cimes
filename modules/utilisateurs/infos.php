    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
    <?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>

    
    <?php $utilisateur = user::get($id); ?>


    <!-- main container -->
    <div class="content">
		<div id="pad-wrapper" class="users-profil">
                <div class="row header img">
                    <div class="col-md-5">
                    <img src="http://placehold.it/70x70" class="img-circle" alt="">
                    <h3><?=$utilisateur->firstname; ?> <?=$utilisateur->lastname; ?></h3>
                    </div>
                    <div class="col-md-5 text-right pull-right">
                        <a href="/utilisateurs/supprimer/id/<?=$utilisateur->id; ?>" class="btn-flat danger"><i class="icon-remove"></i> Supprimer</a>
                        <a href="/utilisateurs/editer/id/<?=$utilisateur->id; ?>" class="btn-flat default"><i class="icon-edit"></i> Modifier</a>
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-6">
                        <dl>
                            <dt>Prénom :</dt> <dd><?=$utilisateur->firstname; ?></dd>
                        </dl>
                        <dl>
                            <dt>Identifiant :</dt> <dd><?=$utilisateur->identifier; ?></dd>
                        </dl>
                        <dl>
                            <dt>Rank :</dt> <dd><?=$utilisateur->rank; ?></dd>
                        </dl>
                    </div>
                    <div class="col-md-6">

                        <dl>
                            <dt>Nom :</dt>
                            <dd><?=$utilisateur->lastname; ?></dd>
                        </dl>
                        <dl>
                            <dt>Mot de passe :</dt>
                            <dd><?=$utilisateur->password; ?></dd>
                        </dl>
                    </div>
                </div>
                <?php //tool::output($utilisateur); ?>
            </div>

        </div>
    </div><!-- /.container -->

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>