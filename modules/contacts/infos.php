    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
    <?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>

    
    <?php // TODO : ne pas oublier de lister les contacts associés  ?>
    <?php $contact = contact::get($_GET['id']); ?>
    <?php 
      if($contact->ref_structure) {
        $structure = structure::get($contact->ref_structure);
      }
    ?>
    <?php 
        $enfants = enfant::getByContact($contact->id);
    ?>
    <?php $creator = user::get($contact->creator); ?>
    <?php $editor = user::get($contact->editor); ?>
    <?php $date_created = new DateTime($contact->created); ?>
    <?php $date_edited = new DateTime($contact->edited); ?>


  

    <!-- main container -->
    <div class="content">
      <div id="pad-wrapper" class="users-profil">
        <div class="row header icon">
            <div class="col-md-5">
                <i class="big-icon icon-comments"></i>
                <h3><?=$contact->firstname; ?> <?=$contact->lastname; ?></h3>
            </div>
            <div class="col-md-5 text-right pull-right">
                      <button class="btn-flat danger" data-toggle="modal" data-target="#remove-modal">
                      <i class="icon-remove"></i> Supprimer
                    </button>

                <a href="/contacts/editer/id/<?=$contact->id; ?>" class="btn-flat default"><i class="icon-edit"></i> Modifier</a>
                     <button class="metadata btn-flat white" data-container="body" data-toggle="popover" data-placement="bottom" data-html="true" data-content="<p><strong>Créé par :</strong><br/> <?=$creator->firstname; ?>,<br />le <?=strftime('%d %B %Y', $date_created->getTimestamp()); ?></p><p><strong>Edité par :</strong><br/> <?=$editor->firstname ?> ,le <?=strftime('%d %B %Y', $date_edited->getTimestamp()); ?></p>" data-original-title="Informations" title="">
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
                    <p>Vous êtes sur le point de supprimer le contact  <strong>"<?=$contact->name; ?>"</strong>.<br />
                    Cette action est irréversible.</p>
                  </div>
                  <div class="modal-footer">
                    <a class="btn-flat white" data-dismiss="modal">Annuler</a>
                    <a href="/contacts/supprimer/id/<?=$contact->id; ?>/confirm/true" class="btn-flat danger"><i class="icon-remove"></i> Supprimer</a>
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
  

        <?php tool::output($contact); ?>

        <p><strong>Structure</strong> : <a href="/structures/infos/id/<?$structure->id ?>"><?=$structure->name ?></a></p>

        <?php if(count($enfants) > 0): ?>
        <div class="row">
            <h4>Les enfants affiliés</h4>

                <table class="table table-hover extendlink">
                    <thead>
                        <tr>
                            <th class="col-md-1">
                                Prénom
                            </th>
                            <th class="col-md-3">
                                <span class="line"></span>
                                Nom
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php foreach($enfants as $enfant): ?>
                        <tr>
                            <td>
                                <a href="/enfants/infos/id/<?=$enfant->id ?>"><?=$enfant->firstname ?></a>
                            </td>
                            <td>
                                <a href="/enfants/infos/id/<?=$enfant->id ?>"><?=$enfant->lastname ?></a>
                            </td>
                        </tr>
                      <?php endforeach; ?>
                        </tbody>
                </table>
        </div>
        <?php endif; ?>


        
        <?php tool::output($structure); ?>
    </div>

</div>
</div><!-- /.container -->

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>