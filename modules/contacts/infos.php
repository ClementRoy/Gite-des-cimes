<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>


    <?php if(isset($_POST['submit-add'])): ?>
        <?php //tool::output($_POST); ?>
        <?php //tool::output($_SESSION); ?>
        <?php 
            extract($_POST);
            $datas = array(
                ':firstname' => tool::cleanInput($form_contact_firstname),
                ':lastname' => tool::cleanInput($form_contact_lastname),
                ':title' => tool::cleanInput($form_contact_title),
                ':ref_structure' => $form_contact_structure,
                ':civility' => tool::cleanInput($form_contact_civility),
                ':email' => tool::cleanInput($form_contact_email),
                ':phone' => $form_contact_telephone,
                ':mobile_phone' => $form_contact_mobile_phone,
                ':fax' => $form_contact_fax,
                ':note' => $form_contact_note
                );

            $result = contact::update($datas, $_GET['id']);

        ?>

        <?php if($result): ?>

            <?php tpl::alert('success', 'La fiche du contact <strong>'.$form_contact_firstname.' '.$form_contact_lastname.'</strong> a bien été créé. <a href="/contacts/">Retourner à la liste des contacts</a>'); ?>

        <?php else: ?>

            <?php tpl::alert('danger', 'Une erreur s\'est produite durant la création de la fiche contact, veuillez réessayer. <a href="/contacts/ajouter/">Retourner au formulaire de modification</a>'); ?>

        <?php endif; ?>



    <?php endif; ?>


   <?php if(isset($_POST['submit-update'])): ?>
        <?php //tool::output($_POST); ?>
        <?php //tool::output($_SESSION); ?>
        <?php 
            extract($_POST);
            $datas = array(
                ':firstname' => $form_contact_firstname,
                ':lastname' => $form_contact_lastname,
                ':title' => $form_contact_title,
                ':ref_structure' => $form_contact_structure,
                ':civility' => $form_contact_civility,
                ':email' => $form_contact_email,
                ':phone' => $form_contact_telephone,
                ':mobile_phone' => $form_contact_mobile_phone,
                ':fax' => $form_contact_fax,
                ':note' => $form_contact_note
                );

            $result = contact::update($datas, $_GET['id']);
        ?>

        <?php if($result): ?>

            <?php tpl::alert('success', 'La fiche du contact <strong>'.$form_contact_firstname.' '.$form_contact_lastname.'</strong> a bien été modifié. <a href="/contacts/">Retourner à la liste des contacts</a>'); ?>

        <?php else: ?>

            <?php tpl::alert('danger', 'Une erreur s\'est produite durant la modification de la fiche contact, veuillez réessayer. <a href="/contacts/editer/'.$_GET['id'].'">Retourner au formulaire de modification</a>'); ?>
            
        <?php endif; ?>


    <?php endif; ?>


<?php
    $contact = contact::get($_GET['id']);

    if($contact->ref_structure && $contact->ref_structure != 0) {
        $structure = structure::get($contact->ref_structure);
    }

    $enfants = enfant::getByContact($contact->id);
    $creator = user::get($contact->creator);
    $editor = user::get($contact->editor);
    $date_created = new DateTime($contact->created);
    $date_edited = new DateTime($contact->edited);
?>


<div class="page-head">
    <div class="row">
        <div class="col-md-8">
             <a href="#" class="trigger dropdown-toggle" data-toggle="dropdown">
                <i class="fa big-icon fa-comments"></i>
            </a>
            <ul class="dropdown-menu animated fadeInDown">
                <li><a href="/contacts/editer/id/<?=$contact->id; ?>" class="item"><i class="fa fa-edit"></i> Modifier</a></li>
                <li><a href="#" data-toggle="modal" data-target="#modal-remove" class="item"><i class="fa fa-remove"></i> Supprimer</a></li>
            </ul>

            <h1>
                <?=$contact->civility; ?> <?=$contact->firstname; ?> <strong><?=$contact->lastname; ?></strong><br />
                <small class="area"><?=$contact->title ?></small>
            </h1>
        </div>
        <div class="col-md-4 text-right">
            <!-- <a href="#" data-toggle="modal" data-target="#modal-remove" class="item">Supprimer cette fiche</a> -->
            <a href="/contacts/editer/id/<?=$contact->id; ?>" class="btn btn-primary btn-rad">Modifier ce contact</a>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-sm-9">
        <div class="row">
            <div class="col-sm-12">
                

                <div class="block-flat">

                    <table class="no-border no-strip information">
                        <tbody class="no-border-x no-border-y">
                            <tr>
                                <td style="width:19%;" class="category"><strong>Informations</strong></td>
                                <td>
                                    <table class="no-border no-strip skills">
                                        <tbody class="no-border-x no-border-y">

                                            <tr>
                                                <td style="width: 20%;">Structure</td>
                                                <td><?=(!empty($structure->name)) ? '<a href="/structures/infos/id/'.$structure->id.'">'.$structure->name.'</a>' : EMPTYVAL; ?></td>
                                            </tr>

                                            <tr>
                                                <td style="width: 20%;">Email</td>
                                                <td><?=(!empty($contact->email)) ? '<a href="mailto:'.$contact->email.'">'.$contact->email.'</a>' : EMPTYVAL; ?></td>
                                            </tr>


                                            <tr>
                                                <td style="width: 20%;">Téléphone</td>
                                                <td><?=(!empty($contact->phone)) ? tool::formatTel($contact->phone) : EMPTYVAL; ?></td>
                                            </tr>


                                            <tr>
                                                <td style="width: 20%;">Téléphone portable</td>
                                                <td><?=(!empty($contact->mobile_phone)) ? tool::formatTel($contact->mobile_phone) : EMPTYVAL; ?></td>
                                            </tr>

                                            <tr>
                                                <td style="width: 20%;">Fax</td>
                                                <td><?=(!empty($contact->fax)) ? tool::formatTel($contact->fax) : EMPTYVAL; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>

                            <?php if( isset($contact->note) && !empty($contact->note) ): ?>
                            <tr>
                                <td style="width:19%;" class="category"><strong>Notes</strong></td>
                                <td>
                                    <table class="no-border no-strip skills">
                                        <tbody class="no-border-x no-border-y">
   
                                                <tr>
                                                    <td><?=$contact->note ?></td>
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

        <div class="row">
            <div class="col-sm-12">
                <div class="section-head">
                    <div class="row">
                        <div class="col-md-8">
                            <h3>Les enfants affiliés</h3>
                        </div>
                    </div>
                </div>

                <?php if(count($enfants) > 0): ?>
                <div class="block-flat tb-special tb-no-options">
                    <div class="content">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="datatable">
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
                    $('#datatable').dataTable({
                        'bFilter': false,
                        'bLengthChange': false,
                        'iDisplayLength': 20,
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
                        <em>Aucun enfant n'est affilié à ce contact</em>
                    </div>
                <?php endif; ?>
            </div>
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
                        Vous êtes sur le point de supprimer le contact <strong><?=$contact->civility ?> <?=$contact->lastname ?> <?=$contact->firstname ?></strong>.<br>
                        Êtes-vous sur de vouloir effectuer cette opération ?
                    </p>
                </div>
            </div>
            <div class="modal-footer">
                <form id="form-remove-contact" action="/contacts/" method="post">
                    <a href="#" class="btn btn-default btn-flat" data-dismiss="modal">Annuler</a>
                    <input id="remove-id" type="hidden" name="id" value="<?=$contact->id;?>">
                    <input type="hidden" name="action" value="supprimer">
                    <input type="hidden" name="confirm" value="true">
                    <input type="submit" class="btn btn-warning btn-flat" value="Supprimer le contact">
                </form>
            </div>
        </div>
    </div>
</div>


<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>