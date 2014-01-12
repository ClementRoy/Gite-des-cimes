    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
    <?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>

    
    <?php // TODO : ne pas oublier de lister les contacts associés  ?>
    <?php $contact = contact::get($_GET['id']); ?>
    <?php $creator = user::get($contact->creator); ?>
    <?php $editor = user::get($contact->editor); ?>
    <?php $date_created = new DateTime($contact->created); ?>
    <?php $date_edited = new DateTime($contact->edited); ?>

    <!-- main container -->
    <div class="content">
      <div id="pad-wrapper" class="users-profil">
        <div class="row header img">
            <div class="col-md-5">
                <h3><?=$contact->firstname; ?></h3>
            </div>
            <div class="col-md-5 text-right pull-right">
                      <button class="btn-flat danger" data-toggle="modal" data-target="#remove-modal">
                      <i class="icon-remove"></i> Supprimer
                    </button>

                <a href="/structures/editer/id/<?=$structure->id; ?>" class="btn-flat default"><i class="icon-edit"></i> Modifier</a>
                     <button class="metadata btn btn-default" data-container="body" data-toggle="popover" data-placement="bottom" data-html="true" data-content="<strong>Créé par :</strong><br/> <?=$creator->firstname; ?>, le <?=strftime('%d %B %Y', $date_created->getTimestamp()); ?> <br /><strong>Edité par :</strong><br/> <?=$editor->firstname ?> ,le <?=strftime('%d %B %Y', $date_edited->getTimestamp()); ?> " data-original-title="Informations" title="">
                      <i class="icon-info-sign"></i>
                    </button>           
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
                    <p>Vous êtes sur le point de supprimer la structure  <strong>"<?=$structure->name; ?>"</strong>.<br />
                    Cette action est irréversible.</p>
                  </div>
                  <div class="modal-footer">
                    <a class="btn-flat white" data-dismiss="modal">Annuler</a>
                    <a href="/structures/supprimer/id/<?=$structure->id; ?>/confirm/true" class="btn-flat danger"><i class="icon-remove"></i> Supprimer</a>
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->



        <div class="row">

        </div>
        <?php tool::output($structure); ?>
    </div>

</div>
</div><!-- /.container -->

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>