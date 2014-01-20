    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
    <?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>

    
    <?php $utilisateur = user::get($_GET['id']); ?>
    <?php $creator = user::get($utilisateur->creator); ?>
    <?php $editor = user::get($utilisateur->editor); ?>
    <?php $date_created = new DateTime($utilisateur->created); ?>
    <?php $date_edited = new DateTime($utilisateur->edited); ?>
    
    <!-- main container -->
    <div class="content">
      <div id="pad-wrapper" class="users-profil">

    <?php if(isset($_POST['activate'])):
            enfant::unarchive($_GET['id']);
    ?>
            <div class="alert alert-success">
                <i class="icon-ok-sign"></i>
                Cette fiche a bien été réactivée !
            </div>
    <?php
          endif;
    ?>


        <div class="row header icon">
            <div class="col-md-7">
                <a href="#" class="trigger"><i class="big-icon icon-user"></i></a>
                <div class="pop-dialog">
                    <div class="pointer">
                        <div class="arrow"></div>
                        <div class="arrow_border"></div>
                    </div>
                    <div class="body">
                        <!--<a href="#" class="close-icon"><i class="icon-remove-sign"></i></a>-->
                        <div class="menu">
                            <a href="/utilisateurs/editer/id/<?=$utilisateur->id; ?>" class="item"><i class="icon-edit"></i> Modifier</a>
                            <a href="/utilisateurs/supprimer/id/<?=$utilisateur->id; ?>" class="item" data-toggle="modal"><i class="icon-remove"></i> Supprimer</a>
                            <!--<a href="#" class="item" data-container="body" data-toggle="popover" data-placement="bottom" data-html="true" data-content="<strong>Créé par :</strong><br/> <a href='/utilisateurs/infos/<?=$creator->id; ?>'><?=$creator->firstname; ?></a>, le <?=strftime('%d %B %Y', $date_created->getTimestamp()); ?> <br /><strong>Edité par :</strong><br/> <?=$editor->firstname ?> ,le <?=strftime('%d %B %Y', $date_edited->getTimestamp()); ?> " data-original-title="Informations" title=""><i class="icon-info-sign"></i> Informations</a>-->
                            <!--<div class="footer">
                                <a href="#" class="logout">Supprimer</a>
                            </div>-->
                        </div>
                    </div>
                </div>
                <h3><?=$utilisateur->firstname; ?> <?=$utilisateur->lastname; ?><small><?php if ($utilisateur->rank == 1): ?>Utilisateur<?php elseif ($utilisateur->rank == 3): ?>Gestionnaire<?php elseif ($utilisateur->rank == 5): ?>Administrateur<?php endif; ?></small></h3>
            </div>
            <div class="col-md-3 text-right pull-right">
                <!-- <a href="/utilisateurs/supprimer/id/<?=$utilisateur->id; ?>" class="btn-flat danger"><i class="icon-remove"></i> Supprimer</a> -->      
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
                        <?php if ($utilisateur->rank == 1): ?>
                            Utilisateur
                        <?php elseif ($utilisateur->rank == 3): ?>
                            Gestionnaire
                        <?php elseif ($utilisateur->rank == 5): ?>
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

       <!-- <small class="metadata pull-right">Créé par <?=$creator->firstname; ?> le <?=strftime('%d %B %Y', $date_created->getTimestamp()); ?>, modifié par <?=$editor->firstname ?> le <?=strftime('%d %B %Y', $date_edited->getTimestamp()); ?> </small> -->
    </div>

</div>
</div><!-- /.container -->

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>