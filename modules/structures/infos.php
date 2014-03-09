<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
<?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>

    <?php if(isset($_POST['submit-add'])): ?>
        <?php 
        extract($_POST);
        $datas = array(
            ':name' => $form_structure_name,
            ':service' => $form_structure_service,
            ':payer' => $form_structure_payer,
            ':email' => $form_structure_email,
            ':phone' => $form_structure_telephone,
            ':fax' => $form_structure_fax,
            ':address_number' => $form_structure_adresse_numero,
            ':address_street' => $form_structure_adresse_voirie,
            ':address_postal_code' => $form_structure_adresse_code_postal,
            ':address_city' => $form_structure_adresse_code_ville,
            ':address_comp' => $form_structure_addresse_comp,
            ':note' => $form_structure_note
            );

        $result = structure::update($datas, $_GET['id']);

        ?>

        <?php if($result): ?>

            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success">
                        <i class="icon-ok-sign"></i> 
                        La structure <strong><?=$form_structure_name; ?></strong> a bien été ajoutée
                    </div>
                </div>
            </div>

        <?php else: ?>


            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger">
                        <i class="icon-remove-sign"></i> 
                        Une erreur s'est produite durant l'ajout de la structure, veuillez réessayer
                    </div>
                </div>
            </div>
        <?php endif; ?>



    <?php endif; ?>

    <?php if(isset($_POST['submit-update'])): ?>
        <?php //tool::output($_POST); ?>
        <?php //tool::output($_SESSION); ?>
        <?php 
        extract($_POST);
        $datas = array(
            ':name' => $form_structure_name,
            ':service' => $form_structure_service,
            ':payer' => $form_structure_payer,
            ':email' => $form_structure_email,
            ':phone' => $form_structure_telephone,
            ':fax' => $form_structure_fax,
            ':address_number' => $form_structure_adresse_numero,
            ':address_street' => $form_structure_adresse_voirie,
            ':address_postal_code' => $form_structure_adresse_code_postal,
            ':address_city' => $form_structure_adresse_code_ville,
            ':address_comp' => $form_structure_addresse_comp,
            ':note' => $form_structure_note
            );

        $result = structure::update($datas,  $_GET['id']);
        ?>

        <?php if($result): ?>

            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success">
                        <i class="icon-ok-sign"></i> 
                        La structure <strong><?=$form_structure_name; ?></strong> a bien été modifée
                    </div>
                    <a href="/structures/">Retourner à la liste des structures</a>

                </div>
            </div>

        <?php else: ?>


            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger">
                        <i class="icon-remove-sign"></i> 
                        Une erreur s'est produite durant la modification de la structure, veuillez réessayer
                    </div>
                    <a href="/structures/editer/<?=$structure->id ?>">Retourner au formulaire d'édition</a>
                </div>
            </div>
        <?php endif; ?>



    <?php endif; ?>

<?php // TODO : ne pas oublier de lister les contacts associés  ?>
<?php $structure = structure::get($_GET['id']); ?>
<?php $contacts = contact::getByStructure($structure->id); ?>
<?php $enfants = enfant::getByStructure($structure->id); ?>
<?php $creator = user::get($structure->creator); ?>
<?php $editor = user::get($structure->editor); ?>
<?php $date_created = new DateTime($structure->created); ?>
<?php $date_edited = new DateTime($structure->edited); ?>


<div class="title">
  <div class="row header">
    <div class="col-md-9">

      <h1><a href="#" class="trigger"><i class="big-icon icon-building"></i></a>

        <?=$structure->name; ?>
      </h1>

      <div class="pop-dialog">
        <div class="pointer">
          <div class="arrow"></div>
          <div class="arrow_border"></div>
        </div>
        <div class="body">
          <div class="menu">
            <a href="/structures/editer/id/<?=$structure->id; ?>" class="item"><i class="icon-edit"></i> Modifier</a>
            <a href="/structures/supprimer/id/<?=$structure->id; ?>" class="item" data-toggle="modal"><i class="icon-remove"></i> Supprimer</a>

          </div>
        </div>
      </div>

    </div>

    <div class="col-md-3 text-right">
      <div class="col-md-4 text-right pull-right">
        <i class="icon-cog"></i>
      </div>
    </div>
  </div>
</div>

<div class="row">
<div class="col-md-9">
  <div class="content <?=($structure->archived)?' archived':' ';?>">
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
        <h4>Coordonnées des contacts</h4>

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
    </div>
    <div class="col-md-3 address">
     <div class="contact">
      <h6><strong>Adresse</strong></h6>
      <?php $geo = tool::getLatLng($structure->address_number.' '.$structure->address_street.' '.$structure->address_postal_code.' '.$structure->address_city); ?>
      <img src="https://maps.googleapis.com/maps/api/staticmap?center=<?=$geo[0]; ?>,<?=$geo[1]; ?>&zoom=12&size=210x200&scale=2&markers=<?=$geo[0]; ?>,<?=$geo[1]; ?>&sensor=false" width="100%" alt="">
      
      <p><?=$structure->address_number; ?> <?=$structure->address_street; ?></p>
      <p><?=$structure->address_postal_code; ?> <?=$structure->address_city; ?></p>

    </div>
    <?php if(!empty($structure->email)): ?>
    <div class="contact">
      <h6><strong>Téléphone :</strong></h6>
      <p><i class="icon-phone"></i> <?=(!empty($structure->phone)) ? $structure->phone : EMPTYVAL; ?></p>
      </div>
       <?php endif; ?>

      <?php if(!empty($structure->email)): ?>
        <div class="contact">
          <h6><strong>Email :</strong></h6>
          <p><i class="icon-envelope"></i> <a href="mailto:<?=(!empty($structure->email)) ? $structure->email : EMPTYVAL; ?>"><?=(!empty($structure->email)) ? $structure->email : EMPTYVAL; ?></a></p>
        </div>
    <?php endif; ?>
    </div>
  </div>
  </div>
  <?php //tool::output($structure); ?>
  <?php //tool::output($contacts); ?>
</div>

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>