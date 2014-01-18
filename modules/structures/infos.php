    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
    <?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>

    
    <?php // TODO : ne pas oublier de lister les contacts associés  ?>
    <?php $structure = structure::get($_GET['id']); ?>
    <?php $contacts = contact::getByStructure($structure->id); ?>
    <?php $enfants = enfant::getByStructure($structure->id); ?>
    <?php $creator = user::get($structure->creator); ?>
    <?php $editor = user::get($structure->editor); ?>
    <?php $date_created = new DateTime($structure->created); ?>
    <?php $date_edited = new DateTime($structure->edited); ?>

    <!-- main container -->
    <div class="content">
      <div id="pad-wrapper" class="users-profil">
        <div class="row header icon">
          <div class="col-md-5">
            <i class="big-icon icon-building"></i>
            <h3><?=$structure->name; ?></h3>
          </div>
          <div class="col-md-5 text-right pull-right">
            <button class="btn-flat danger" data-toggle="modal" data-target="#remove-modal">
              <i class="icon-remove"></i> Supprimer
            </button>
            <a href="/structures/editer/id/<?=$structure->id; ?>" class="btn-flat default"><i class="icon-edit"></i> Modifier</a>
            <button class="metadata btn-flat white" data-container="body" data-toggle="popover" data-placement="bottom" data-html="true" data-content="<p><strong>Créé par :</strong><br/> <?=$creator->firstname; ?>, <br>le <?=strftime('%d %B %Y', $date_created->getTimestamp()); ?> </p><p><strong>Edité par :</strong><br/> <?=$editor->firstname ?>, <br>le <?=strftime('%d %B %Y', $date_edited->getTimestamp()); ?></p>" data-original-title="Informations" title="">
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


          <div class="col-md-9 bio">
            <div class="row">
              <div class="col-md-6">
                <div class="panel panel-default">
                  <div class="panel-heading">Coordonnées</div>
                  <ul class="list-group">
                    <li class="list-group-item">
                      <p><strong>Email :</strong></p>
                      <p><?=(!empty($structure->email)) ? $structure->email : EMPTYVAL; ?></p>
                    </li>
                    <li class="list-group-item">
                      <p><strong>Adresse :</strong></p>
                      <p><?=$structure->address_number; ?> <?=$structure->address_street; ?><br />
                        <?=$structure->address_postal_code; ?> <?=$structure->address_city; ?>
                      </p>    
                    </li>
                    <li class="list-group-item">
                      <p><strong>Téléphone :</strong></p>
                      <p><?=(!empty($structure->phone)) ? $structure->phone : EMPTYVAL; ?></p>
                    </li>
                    <li class="list-group-item">
                      <p><strong>Fax :</strong></p>
                      <p><?=(!empty($structure->fax)) ? $structure->fax : EMPTYVAL; ?></p>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="col-md-6">
                <div class="panel panel-default">
                  <div class="panel-heading">Informations</div>
                  <ul class="list-group">
                    <li class="list-group-item">
                      <p><strong>Nom de la structure :</strong></p>
                      <p><?=(!empty($structure->name)) ? $structure->name : EMPTYVAL; ?></p>
                    </li>
                    <?php if (!isset($structure->service)): ?>
                      <li class="list-group-item">
                        <p><strong>Service :</strong></p>
                        <p><?=(!empty($structure->service)) ? $structure->service : EMPTYVAL; ?></p>
                      </li>
                    <?php endif ?>

                    <li class="list-group-item">
                      <p><strong>Structure payeuse  :</strong></p>
                      <p><?=($structure->payer>0)?'Oui':'Non'; ?></p>    
                    </li>
                  </ul>
                </div>
              </div>

            </div>
            <h4>Ses contacts</h4>

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
                  <th class="col-md-5">
                    <span class="line"></span>
                    Email
                  </th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($contacts as $contact): ?>
                  <tr>
                    <td>
                      <a href="/contacts/infos/id/<?=$contact->id ?>"><?=$contact->firstname ?></a>
                    </td>
                    <td>
                      <a href="/contacts/infos/id/<?=$contact->id ?>"><?=$contact->lastname ?></a>
                    </td>
                    <td>
                      <a href="/contacts/infos/id/<?=$contact->id ?>"><?=$contact->email ?></a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>


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
          <div class="col-md-3 address">
            <h6>Coordonnées</h6>
            <?php $geo = tool::getLatLng($structure->address_number.' '.$structure->address_street.' '.$structure->address_postal_code.' '.$structure->address_city); ?>
            <img src="https://maps.googleapis.com/maps/api/staticmap?center=<?=$geo[0]; ?>,<?=$geo[1]; ?>&zoom=12&size=210x200&scale=2&markers=<?=$geo[0]; ?>,<?=$geo[1]; ?>&sensor=false" width="100%" alt="">
            <ul>
              <li><strong>Adresse</strong></li>
              <li><?=$structure->address_number; ?> <?=$structure->address_street; ?></li>
              <li><?=$structure->address_postal_code; ?> <?=$structure->address_city; ?></li>
              
            </ul>
            <ul>
              <li><strong>Téléphone :</strong></li>
              <li><i class="icon-phone"></i><?=(!empty($structure->phone)) ? $structure->phone : EMPTYVAL; ?></li>
            </ul>

            <ul>
              <li><strong>Email :</strong></li>
              <li><i class="icon-envelope"></i><?=(!empty($structure->email)) ? $structure->email : EMPTYVAL; ?></li>
            </ul>
          </div>
        </div>
        <?php //tool::output($structure); ?>
        <?php //tool::output($contacts); ?>
      </div>

    </div>
  </div><!-- /.container -->

  <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>