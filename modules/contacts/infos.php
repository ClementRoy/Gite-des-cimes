    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
    <?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>

    
    <?php // TODO : ne pas oublier de lister les contacts associés  ?>
    <?php $contact = contact::get($_GET['id']); ?>
    <?php 
      if($contact->ref_structure && $contact->ref_structure != 0) {
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
                <a href="#" class="trigger"><i class="big-icon icon-comments"></i></a>
                <div class="pop-dialog">
                    <div class="pointer">
                        <div class="arrow"></div>
                        <div class="arrow_border"></div>
                    </div>
                    <div class="body">
                        <!--<a href="#" class="close-icon"><i class="icon-remove-sign"></i></a>-->
                        <div class="menu">
                            <a href="/contacts/editer/id/<?=$contact->id; ?>" class="item"><i class="icon-edit"></i> Modifier</a>
                            <a href="/contacts/supprimer/id/<?=$contact->id; ?>" class="item" data-toggle="modal"><i class="icon-remove"></i> Supprimer</a>
                            <!--<a href="#" class="item" data-container="body" data-toggle="popover" data-placement="bottom" data-html="true" data-content="<strong>Créé par :</strong><br/> <a href='/utilisateurs/infos/<?=$creator->id; ?>'><?=$creator->firstname; ?></a>, le <?=strftime('%d %B %Y', $date_created->getTimestamp()); ?> <br /><strong>Edité par :</strong><br/> <?=$editor->firstname ?> ,le <?=strftime('%d %B %Y', $date_edited->getTimestamp()); ?> " data-original-title="Informations" title=""><i class="icon-info-sign"></i> Informations</a>-->
                            <!--<div class="footer">
                                <a href="#" class="logout">Supprimer</a>
                            </div>-->
                        </div>
                    </div>
                </div>                
                <h3><?=$contact->civility; ?> <?=$contact->firstname; ?> <?=$contact->lastname; ?><small><?=$contact->title ?></small></h3>
            </div>
            <div class="col-md-5 text-right pull-right">
                <!--<button class="btn-flat danger" data-toggle="modal" data-target="#remove-modal">
                  <i class="icon-remove"></i> Supprimer
                </button>

                <a href="/contacts/editer/id/<?=$contact->id; ?>" class="btn-flat default"><i class="icon-edit"></i> Modifier</a>
                 <button class="metadata btn-flat white" data-container="body" data-toggle="popover" data-placement="bottom" data-html="true" data-content="<p><strong>Créé par :</strong><br/> <?=$creator->firstname; ?>,<br />le <?=strftime('%d %B %Y', $date_created->getTimestamp()); ?></p><p><strong>Edité par :</strong><br/> <?=$editor->firstname ?> ,le <?=strftime('%d %B %Y', $date_edited->getTimestamp()); ?></p>" data-original-title="Informations" title="">
                  <i class="icon-info-sign"></i>
                </button>-->           
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
  

        <?php //tool::output($contact); ?>

        <div class="row">

            <div class="col-md-12">

                <?php if( isset($contact->email) && !empty($contact->email) ): ?>
                <p><strong>Email</strong> : <a href="mailto:<?=$contact->email ?>"><?=$contact->email ?></a></p>
                <?php endif; ?>  

                <?php if( isset($contact->phone) && !empty($contact->phone) ): ?>
                <p><strong>Téléphone</strong> : <?=$contact->phone ?></p>
                <?php endif; ?>  

                <?php if( isset($contact->mobile_phone) && !empty($contact->mobile_phone) ): ?>
                <p><strong>Téléphone portable</strong> : <?=$contact->mobile_phone ?></p>
                <?php endif; ?>  

                <?php if( isset($contact->fax) && !empty($contact->fax) ): ?>
                <p><strong>Fax</strong> : <?=$contact->fax ?></p>
                <?php endif; ?>  

                <?php if( isset($contact->note) && !empty($contact->note) ): ?>
                <p><strong>Note</strong> : <?=$contact->note ?></p>
                <?php endif; ?>  

                <?php if( isset($contact->structure) && !empty($contact->structure) ): ?>
                <p><strong>Structure</strong> : <a href="/structures/infos/id/<?=$structure->id ?>"><?=$structure->name ?></a></p>
                <?php endif; ?>                
            </div>


        </div>

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


        
        <?php //tool::output($structure); ?>
    </div>

</div>
</div><!-- /.container -->

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>