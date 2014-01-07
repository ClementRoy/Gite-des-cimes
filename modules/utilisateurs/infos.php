    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
    <?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>

    
    <?php $utilisateur = user::get($_GET['id']); ?>


    <!-- main container -->
    <div class="content">
      <div id="pad-wrapper" class="users-profil">
        <div class="row header img">
            <div class="col-md-5">
                <img src="http://placehold.it/70x70" class="img-circle" alt="">
                <h3><?=$utilisateur->firstname; ?> <?=$utilisateur->lastname; ?></h3>
            </div>
            <div class="col-md-5 text-right pull-right">
                <!-- <a href="/utilisateurs/supprimer/id/<?=$utilisateur->id; ?>" class="btn-flat danger"><i class="icon-remove"></i> Supprimer</a> -->
                      <button class="btn-flat danger" data-toggle="modal" data-target="#remove-modal">
                      <i class="icon-remove"></i> Supprimer
                    </button>

                <a href="/utilisateurs/editer/id/<?=$utilisateur->id; ?>" class="btn-flat default"><i class="icon-edit"></i> Modifier</a>
            </div>
        </div>


            <!-- Modal -->
            <div class="modal fade" id="remove-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h6 class="modal-title" id="myModalLabel">Supprimer cette fiche</h6>
                  </div>
                  <div class="modal-body">
                    <p>Vous êtes sur le point de supprimer l'utilisateur de <strong><?=$utilisateur->firstname; ?> <?=$utilisateur->lastname; ?></strong>.<br />
                    Cette action est irréversible.</p>
                  </div>
                  <div class="modal-footer">
                    <a class="btn-flat white" data-dismiss="modal">Annuler</a>
                    <a href="/utilisateurs/supprimer/id/<?=$utilisateur->id; ?>/confirm/true" class="btn-flat danger"><i class="icon-remove"></i> Supprimer</a>
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->



        <div class="row">

            <div class="col-md-6">
                <dl>
                    <dt>Prénom :</dt> <dd><?=$utilisateur->firstname; ?></dd>
                </dl>
                <dl>
                    <dt>Identifiant :</dt> <dd><?=$utilisateur->identifier; ?></dd>
                </dl>
                <dl>
                    <dt>Rôle :</dt>
                    <dd>
                        <?php if ($user->rank == 1): ?>
                            Utilisateur
                        <?php elseif ($user->rank == 3): ?>
                            Gestionnaire
                        <?php elseif ($user->rank == 5): ?>
                            Administrateur
                        <?php endif; ?>
                    </dd>

                </dl>
            </div>
            <div class="col-md-6">

                <dl>
                    <dt>Nom :</dt>
                    <dd><?=$utilisateur->lastname; ?></dd>
                </dl>
                <dl>
                    <dt>Email</dt>
                    <dd><a href="mailto:<?=$utilisateur->email;?>" target="_blank"><?=$utilisateur->email;?></a></dd>
                </dl>
            </div>
        </div>
        <?php //tool::output($utilisateur); ?>
    </div>

</div>
</div><!-- /.container -->

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>