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

        if(isset($form_contact_firstname) && !empty($form_contact_firstname)){
          $datas = array(
              ':firstname' => tool::cleanInput($form_contact_firstname),
              ':lastname' => tool::cleanInput($form_contact_lastname),
              ':title' => tool::cleanInput($form_contact_title),
              ':ref_structure' => $_GET['id'],
              ':civility' => tool::cleanInput($form_contact_civility),
              ':email' => tool::cleanInput($form_contact_email),
              ':phone' => $form_contact_telephone,
              ':mobile_phone' => $form_contact_mobile_phone,
              ':fax' => $form_contact_fax,
              );

          $result_2 = contact::add($datas);
        }


        ?>

        <?php if($result): ?>
            <div class="alert alert-success rounded">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <i class="fa fa-check-sign"></i>La structure <strong><?=$form_structure_name; ?></strong> a bien été ajoutée
            </div>
        <?php else: ?>
            <div class="alert alert-danger rounded">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <i class="fa fa-times-circle sign"></i>Une erreur s'est produite durant l'ajout de la structure, veuillez réessayer
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

          <div class="alert alert-success rounded">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <i class="fa fa-check sign"></i>
              La structure <strong><?=$form_structure_name; ?></strong> a bien été modifée<br>
              <a href="/structures/">Retourner à la liste des structures</a>
          </div>

        <?php else: ?>

          <div class="alert alert-danger">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <i class="fa fa-times-circle sign"></i>
              Une erreur s'est produite durant la modification de la structure, veuillez réessayer<br>
              <a href="/structures/editer/<?=$structure->id ?>">Retourner au formulaire d'édition</a>
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



<div class="page-head">
    <div class="row">
        <div class="col-md-8">
             <a href="#" class="trigger dropdown-toggle" data-toggle="dropdown">
                <i class="fa big-icon fa-building"></i>
            </a>
            <ul class="dropdown-menu animated fadeInDown">
                <li><a href="/structures/editer/id/<?=$structure->id; ?>" class="item"><i class="fa fa-edit"></i> Modifier</a></li>
                <li><a href="#" data-toggle="modal" data-target="#modal-remove" class="item"><i class="fa fa-remove"></i> Supprimer</a></li>
            </ul>

            <h1>
                <?=$structure->name; ?>
            </h1>
        </div>
        <div class="col-md-4 text-right">
            <!-- <a href="#" data-toggle="modal" data-target="#modal-remove" class="item">Supprimer cette fiche</a> -->
            <a href="/structures/editer/id/<?=$structure->id; ?>" class="btn btn-primary btn-rad">Modifier cette structure</a>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-sm-9">
        <div class="row">
            <div class="col-md-12">

                <div class="block-flat">
                    <div class="content">
                        <table class="no-border no-strip information">
                            <tbody class="no-border-x no-border-y">
                                <tr>
                                    <td style="width:19%;" class="category"><strong>Coordonnées</strong></td>
                                    <td>
                                        <table class="no-border no-strip skills">
                                            <tbody class="no-border-x no-border-y">

                                                <tr>
                                                    <td style="width:30%;">Email</td>
                                                    <td><?=(!empty($structure->email)) ? $structure->email : EMPTYVAL; ?></td>
                                                </tr>

                                                <tr>
                                                    <td style="width:30%;">Téléphone</td>
                                                    <td><?=(!empty($structure->phone)) ? tool::formatTel($structure->phone) : EMPTYVAL; ?></td>
                                                </tr>

                                                <tr>
                                                    <td style="width:30%;">Fax</td>
                                                    <td><?=(!empty($structure->fax)) ? tool::formatTel($structure->fax) : EMPTYVAL; ?></td>
                                                </tr>

                                                <tr>
                                                    <td style="width:30%;">Adresse</td>
                                                    <td>
                                                        <?=$structure->address_number; ?> <?=$structure->address_street; ?><br />
                                                        <?=$structure->address_postal_code; ?> <?=$structure->address_city; ?>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:19%;" class="category"><strong>Autres informations</strong></td>
                                    <td>
                                        <table class="no-border no-strip skills">
                                            <tbody class="no-border-x no-border-y">

                                                <tr>
                                                    <td style="width:30%;">Service</td>
                                                    <td><?=(!empty($structure->service)) ? $structure->service : EMPTYVAL; ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:30%;">Structure payeuse</td>
                                                    <td><?=($structure->payer>0)?'Oui':'Non'; ?></td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </td>
                                </tr>

                                <?php if (tool::check($structure->note)): ?>
                                <tr>
                                    <td style="width:19%;" class="category"><strong>Notes</strong></td>
                                    <td>
                                        <table class="no-border no-strip skills">
                                            <tbody class="no-border-x no-border-y">

                                                <tr>
                                                    <td><?=$structure->note; ?></td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <?php endif; ?>

                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
        </div>


        <div class="row">
            <div class="col-sm-12">
                <div class="section-head">
                    <div class="row">
                        <div class="col-md-8">
                            <h3>Les contacts associés</h3>
                        </div>
                    </div>
                </div>

                <?php if(!empty($contacts)): ?>
                    <div class="block-flat tb-special tb-no-options">
                        <div class="content">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="datatable">
                                    <thead>
                                        <tr>
                                            <th>Prénom</th>
                                            <th>Nom</th>
                                            <th>Email</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($contacts as $contact): ?>
                                            <tr>
                                                <td>
                                                    <a href="/contacts/infos/id/<?=$contact->id ?>"><?=$contact->firstname ?></a>
                                                    <ul class="dropdown-menu">
                                                    <li><a href="/contacts/infos/id/<?=$contact->id ?>" class="item"><i class="fa fa-share"></i> Voir le contact</a></li>
                                                    <li><a href="/contacts/editer/id/<?=$contact->id ?>" class="item"><i class="fa fa-edit"></i> Modifier le contact</a></li>
                                                    </ul>
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
                            </div>
                        </div>
                    </div>
                    <?php ob_start(); ?>
                    <script>
                        $('#datatable').dataTable({
                            'bFilter': false,
                            'bLengthChange': false,
                            'iDisplayLength': 50,
                            'oLanguage': {
                                'sInfo': '_START_ - _END_ sur _TOTAL_ ',
                                'oPaginate': {
                                    'sFirst': '',
                                    'sPrevious': '',
                                    'sNext': '',
                                    'sLast': ''
                                }
                            }
                        });
                    </script>
                    <?php $scripts .= ob_get_contents();
                    ob_end_clean(); ?>
                <?php else: ?>
                    <div class="block-flat">
                        <em>Aucun contact n'est enregistré pour cette structure</em>
                    </div>
                <?php endif; ?>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-12">
                <div class="section-head">
                    <div class="row">
                        <div class="col-md-8">
                            <h3>Les enfants affiliés</h3>
                        </div>
                    </div>
                </div>

                <?php if(!empty($enfants)): ?>
                    <div class="block-flat tb-special tb-no-options">
                        <div class="content">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="datatable2">
                                    <thead>
                                        <tr>
                                            <th>Prénom</th>
                                            <th>Nom</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($enfants as $enfant): ?>
                                            <tr>
                                                <td>
                                                    <a href="/enfants/infos/id/<?=$enfant->id ?>"><?=$enfant->firstname ?></a>
                                                    <ul class="dropdown-menu">
                                                    <li><a href="/enfants/infos/id/<?=$enfant->id ?>" class="item"><i class="fa fa-share"></i> Voir la fiche</a></li>
                                                    <li><a href="/enfants/editer/id/<?=$enfant->id ?>" class="item"><i class="fa fa-edit"></i> Modifier la fiche</a></li>
                                                    </ul>
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
                    </div>
                    <?php ob_start(); ?>
                    <script>
                        $('#datatable2').dataTable({
                            'bFilter': false,
                            'bLengthChange': false,
                            'iDisplayLength': 50,
                            'oLanguage': {
                                'sInfo': '_START_ - _END_ sur _TOTAL_ ',
                                'oPaginate': {
                                    'sFirst': '',
                                    'sPrevious': '',
                                    'sNext': '',
                                    'sLast': ''
                                }
                            }
                        });
                    </script>
                    <?php $scripts .= ob_get_contents();
                    ob_end_clean(); ?>
                <?php else: ?>
                    <div class="block-flat">
                        <em>Aucun enfant n'est enregistré pour cette structure</em>
                    </div>
                <?php endif; ?>
            </div>
        </div>


    </div>


    <div class="col-sm-3">
        <?php $geo = tool::getLatLng($structure->address_number.' '.$structure->address_street.' '.$structure->address_postal_code.' '.$structure->address_city); ?>
        <div class="block-flat bars-widget">
            <div class="gmap-sm">
                <a href="https://www.google.fr/maps/place/<?=$structure->address_number; ?>+<?=$structure->address_street; ?>,+<?=$structure->address_postal_code; ?>+<?=$structure->address_city; ?>/">
                    <img src="https://maps.googleapis.com/maps/api/staticmap?center=<?=$geo[0]; ?>,<?=$geo[1]; ?>&zoom=12&size=210x200&scale=2&markers=<?=$geo[0]; ?>,<?=$geo[1]; ?>&sensor=false" width="100%" alt="">
                </a>
            </div>

            <address>
                <p>
                    <strong><?=$structure->name; ?></strong>
                    <?php if ( !empty($structure->address_number) OR !empty($structure->address_street) ): ?>
                        <br><?=$structure->address_number; ?> <?=$structure->address_street; ?>
                        <br><?=$structure->address_postal_code; ?> <?=$structure->address_city; ?>
                    <?php endif; ?>
                </p>
                <?php if(!empty($structure->phone)): ?>
                    <p>Tél : <?=(!empty($structure->phone)) ? tool::formatTel($structure->phone) : EMPTYVAL; ?></p>
                <?php endif; ?>
                <?php if(!empty($structure->emal)): ?>
                    <p>Email : <a href="mailto:<?=(!empty($structure->email)) ? $structure->email : EMPTYVAL; ?>"><?=(!empty($structure->email)) ? $structure->email : EMPTYVAL; ?></a></p>
                <?php endif; ?>
            </address>
        </div>
    </div>

</div>


<div class="modal fade" id="modal-remove" tabindex="-1" role="dialog" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <div class="i-circle warning"><i class="fa fa-warning"></i></div>
                    <h4>Attention !</h4>
                    <p>
                        Vous êtes sur le point de supprimer la structure <strong><?=$structure->name?></strong>.<br>
                        Êtes-vous sur de vouloir effectuer cette opération ?
                    </p>
                </div>
            </div>
            <div class="modal-footer">
                <form id="form-remove-structure" action="/structures/" method="post">
                    <a href="#" class="btn btn-default btn-flat" data-dismiss="modal">Annuler</a>
                    <input id="remove-id" type="hidden" name="id" value="<?=$structure->id;?>">
                    <input type="hidden" name="action" value="supprimer">
                    <input type="hidden" name="confirm" value="true">
                    <input type="submit" class="btn btn-warning btn-flat" value="Supprimer la strucutre">
                </form>
            </div>
        </div>
    </div>
</div>




<?php ob_start(); ?>
<script>
    $(function() {

        $('[data-toggle=popover]').on('click', function (e) {
            e.preventDefault();
            $('[data-toggle=popover]').not(this).popover('hide');
        });
        $('body').on('click', '.btn-close', function (e) {
            e.preventDefault();
            $('[data-toggle=popover]').popover('hide');
        });

    });
</script>
<?php $scripts .= ob_get_contents();
ob_end_clean(); ?>

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>