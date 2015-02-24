<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
<?php $enfant = enfant::get($_GET['id']); ?>


<?php // Ajout et mise à jour des commentaires ?>
<?php if(isset($_POST['submit-note'])): ?>
    <?php  
        extract($_POST);
        if(!empty($note_id)){
            // update
            $datas = array(
                ':ref_sejour' => $note_ref_sejour,
                ':ref_enfant' => $note_ref_enfant,
                ':message'    => tool::cleanInput($note_message)
                );
            $result = note::update($datas, $note_id);
        } else {
            // add
            $datas = array(
                ':ref_sejour' => $note_ref_sejour,
                ':ref_enfant' => $note_ref_enfant,
                ':message'    => tool::cleanInput($note_message)
                );
            $result = note::add($datas);
        }
    ?>

    <?php if($result): ?>

        <?php tpl::alert('success', 'Le commentaire a bien été enregistré.'); ?>

    <?php else: ?>

        <?php tpl::alert('danger', 'Une erreur s\'est produite durant l\'enregistrement du commentaire =(.'); ?>

    <?php endif; ?>
<?php endif; ?>


<?php // Ajout et mise à jour de la fiche ?>
<?php if(isset($_POST['submit-add']) || isset($_POST['submit-update'])): ?>
    <?php
        extract($_POST);

        if (isset($_POST['submit-add'])) {

            $ref_picture = '';
            if(isset($_FILES['form_enfant_picture']) && !$_FILES['form_enfant_picture']['error']){
                $file = $_FILES['form_enfant_picture'];
                $ref_picture = media::upload($_FILES['form_enfant_picture']);
            }

            $attached_file = '';
            if(isset($_FILES['form_enfant_file']) && !$_FILES['form_enfant_file']['error']){
                $file = $_FILES['form_enfant_file'];
                $attached_file = media::upload($_FILES['form_enfant_file']);
            }

            $birthdate = '';
            if(tool::check($form_enfant_naissance)) {
                $birthdate = tool::generateDatetime($form_enfant_naissance);
            }

            $assurance_validite = '';
            if(tool::check($form_enfant_assurance_validite)) {
                $assurance_validite = tool::generateDatetime($form_enfant_assurance_validite);
            }

            $cpam_validite = '';
            if(tool::check($form_enfant_cpam_validite)) {
                $cpam_validite = tool::generateDatetime($form_enfant_cpam_validite);
            }

            $contact = '';
            if (isset($form_enfant_contact)) {
                $contact = $form_enfant_contact;
            }

        } elseif (isset($_POST['submit-update'])) {

            $ref_picture = $enfant->ref_picture;
            if(isset($_FILES['form_enfant_picture']) && !$_FILES['form_enfant_picture']['error']){
                $file = $_FILES['form_enfant_picture'];
                $ref_picture = media::upload($_FILES['form_enfant_picture']);
            }

            $attached_file = $enfant->attached_file;
            if(isset($_FILES['form_enfant_file']) && !$_FILES['form_enfant_file']['error']){
                $file = $_FILES['form_enfant_file'];
                $attached_file = media::upload($_FILES['form_enfant_file']);
            }

            $birthdate = $enfant->birthdate;
            if(isset($form_enfant_naissance)) {
                $birthdate = tool::generateDatetime($form_enfant_naissance);
            }

            $assurance_validite = $enfant->self_assurance_expiration_date;
            if(isset($form_enfant_assurance_validite)) {
                $assurance_validite = tool::generateDatetime($form_enfant_assurance_validite);
            }

            $cpam_validite = $enfant->cpam_attestation_expiration_date;
            if(isset($form_enfant_cpam_validite)) {
                $cpam_validite = tool::generateDatetime($form_enfant_cpam_validite);
            }

            $contact = $enfant->contact;
            if (isset($form_enfant_contact)) {
                $contact = $form_enfant_contact;
            }

        }


        $datas = array(
            ':firstname' => $form_enfant_prenom,
            ':lastname' => $form_enfant_nom,
            ':ref_picture' => $ref_picture,
            ':attached_file' => $attached_file,
            ':birthdate' => $birthdate,
            ':sex' => $form_enfant_sexe,
            ':registration_by' => $form_enfant_inscription,
            ':organization' => $form_enfant_structure,
            ':contact' => $contact,
            ':guardian' => $form_enfant_responsable,
            ':father_name' => $form_enfant_nom_pere,
            ':father_phone_home' => $form_enfant_telephone_fixe_pere,
            ':father_phone_mobile' => $form_enfant_telephone_portable_pere,
            ':father_phone_pro' => $form_enfant_telephone_professionnel_pere,
            ':father_address_number' => $form_enfant_adresse_numero_pere,
            ':father_address_street' => $form_enfant_adresse_voirie_pere,
            ':father_address_postal_code' => $form_enfant_adresse_code_postal_pere,
            ':father_address_city' => $form_enfant_adresse_code_ville_pere,
            ':mother_name' => $form_enfant_nom_mere,
            ':mother_phone_home' => $form_enfant_telephone_fixe_mere,
            ':mother_phone_mobile' => $form_enfant_telephone_portable_mere,
            ':mother_phone_pro' => $form_enfant_telephone_professionnel_mere,
            ':mother_address_number' => $form_enfant_adresse_numero_mere,
            ':mother_address_street' => $form_enfant_adresse_voirie_mere,
            ':mother_address_postal_code' => $form_enfant_adresse_code_postal_mere,
            ':mother_address_city' => $form_enfant_adresse_code_ville_mere,
            ':guardian_name' => $form_enfant_nom_tuteur,
            ':guardian_phone_home' => $form_enfant_telephone_fixe_tuteur,
            ':guardian_phone_mobile' => $form_enfant_telephone_portable_tuteur,
            ':guardian_phone_pro' => $form_enfant_telephone_professionnel_tuteur,
            ':guardian_address_number' => $form_enfant_adresse_numero_tuteur,
            ':guardian_address_street' => $form_enfant_adresse_voirie_tuteur,
            ':guardian_address_postal_code' => $form_enfant_adresse_code_postal_tuteur,
            ':guardian_address_city' => $form_enfant_adresse_code_ville_tuteur,
            ':emergency_name' => $form_enfant_nom_urgence,
            ':emergency_phone' => $form_enfant_telephone_urgence,
            ':domiciliation' => $form_enfant_domiciliation,
            ':host_family_name' => $form_enfant_nom_famille,
            ':host_family_phone_home' => $form_enfant_telephone_fixe_famille,
            ':host_family_phone_mobile' => $form_enfant_telephone_portable_famille,
            ':host_family_phone_pro' => $form_enfant_telephone_professionnel_famille,
            ':host_family_address_number' => $form_enfant_adresse_numero_famille,
            ':host_family_address_street' => $form_enfant_adresse_voirie_famille,
            ':host_family_address_postal_code' => $form_enfant_adresse_code_postal_famille,
            ':host_family_address_city' => $form_enfant_adresse_code_ville_famille,
            ':image_rights' => $form_enfant_droit_image,
            ':medicals_treatments' => $form_enfant_traitement_medical,
            ':allergies' => $form_enfant_contre_indication,
            ':number_ss' => $form_enfant_numero_securite,
            ':self_assurance' => $form_enfant_assurance,
            ':self_assurance_expiration_date' => $assurance_validite,
            ':cpam_attestation' => $form_enfant_attestation_cpam,
            ':cpam_attestation_expiration_date' => $cpam_validite,
            ':vaccination' => $form_enfant_carnet_vaccination,
            ':health_record' => $form_enfant_fiche_sanitaire,
            ':stay_record' => $form_enfant_fiche_sejour,
            ':note' => $form_enfant_note
        );

        $result = enfant::update($datas, $_GET['id']);


    ?>


    <?php if (isset($_POST['submit-add'])): ?>
        <?php if($result): ?>

            <?php tpl::alert('success', 'La fiche de l\'enfant <strong>'.$form_enfant_prenom.' '.$form_enfant_nom.'</strong> a bien été créé. <a href="/enfants/">Retourner à la liste des enfants</a>'); ?>

        <?php else: ?>

            <?php tpl::alert('danger', 'Une erreur s\'est produite durant la création de la fiche de l\'enfant, veuillez réessayer. <a href="/enfants/ajouter/">Retourner au formulaire d\'ajout</a>'); ?>

        <?php endif; ?>
    <?php endif; ?>


    <?php if (isset($_POST['submit-update'])): ?>
        <?php if($result): ?>

            <?php tpl::alert('success', 'La fiche de l\'enfant <strong>'.$form_enfant_prenom.' '.$form_enfant_nom.'</strong> a bien été modifié. <a href="/enfants/">Retourner à la liste des enfants</a>'); ?>

        <?php else: ?>

            <?php tpl::alert('danger', 'Une erreur s\'est produite durant la modification de la fiche de l\'enfant, veuillez réessayer. <a href="/enfants/editer/'.$_GET['id'].'">Retourner au formulaire de modification</a>'); ?>

        <?php endif; ?>
    <?php endif; ?>
<?php endif; ?>

<?php
    $enfant = enfant::get($_GET['id']);
    $creator = user::get($enfant->creator);
    $editor = user::get($enfant->editor);
    $date_created = new DateTime($enfant->created);
    $date_edited = new DateTime($enfant->edited);
?>



<div class="page-head">
    <div class="row">
        <div class="col-md-8">
             <a href="#" class="trigger dropdown-toggle" data-toggle="dropdown">
                <?php if(!empty($enfant->ref_picture)): ?>
                    <?php $picture = media::get($enfant->ref_picture); ?>
                    <img src="<?php echo '/'.UPLOAD_FOLDER.$picture->file_name; ?>" width="60" class="img-circle"/>
                <?php else: ?>
                    <i class="fa big-icon fa-user"></i>
                <?php endif; ?>
            </a>
            <ul class="dropdown-menu animated fadeInDown">
                <li><a href="/enfants/editer/id/<?=$enfant->id; ?>" class="item"><i class="fa fa-edit"></i> Modifier</a></li>
                <li><a href="#" data-toggle="modal" data-target="#modal-remove" class="item"><i class="fa fa-remove"></i> Supprimer</a></li>
            </ul>

            <h1>
                <?=$enfant->firstname; ?> <strong><?=$enfant->lastname; ?></strong><br />
                <small class="area">
                    <?=($enfant->sex == 'féminin') ? '<i class="icon-female"></i>' : '<i class="icon-male"></i>'; ?>
                    <?php $birthdate = new DateTime($enfant->birthdate); ?>
                    <?php if($birthdate->getTimestamp() != '-62169987600'): ?>
                        <?=strftime('%d %B %Y', $birthdate->getTimestamp()); ?> 
                        (<?=tool::getAgeFromDate($enfant->birthdate); ?> ans)
                    <?php endif; ?>
                </small>
            </h1>
        </div>
        <div class="col-md-4 text-right">
            <!-- <a href="#" data-toggle="modal" data-target="#modal-remove" class="item">Supprimer cette fiche</a> -->
            <a href="/enfants/editer/id/<?=$enfant->id; ?>" class="btn btn-primary btn-rad">Modifier cette fiche</a>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-sm-9">
        <div class="row">
            <div class="col-sm-12">
                <div class="tab-container">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#about">Information</a></li>
                        <li><a data-toggle="tab" href="#coordonnees">Coordonnées</a></li>
                        <li><a data-toggle="tab" href="#dossier">Dossier</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="about" class="tab-pane cont active">

                             <? /*
                            <?php if( $enfant->number_ss == 0 || $enfant->self_assurance <= 0 || $enfant->cpam_attestation <= 0 || empty($enfant->self_assurance_expiration_date) || $enfant->health_record <= 0 || $enfant->vaccination <= 0 ): ?>
                            <div class="alert alert-info alert-white rounded">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <div class="icon"><i class="fa fa-info-circle"></i></div>
                                <strong>Information !</strong> La fiche de l'enfant est pour le moment incomplète.
                            </div>
                            <?php endif; ?>
                             */ ?>

                            <?php if(isset($_POST['activate'])): ?>
                             <div class="alert alert-success alert-white rounded">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <div class="icon"><i class="fa fa-check"></i></div>
                                <strong>C'est fait !</strong> Cette fiche a bien été réactivée !
                            </div>
                            <?php enfant::unarchive($_GET['id']); ?>
                            <?php endif; ?>

                            <?php if($enfant->archived) :?>
                                <div class="alert alert-warning alert-white rounded">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <div class="icon"><i class="fa fa-warning"></i></div>
                                    <strong>Attention !</strong> Cette fiche est archivée voulez-vous la réactiver ?
                                    <form action="" method="post" class="pull-right">
                                        <button class="btn btn-primary" name="activate">Réactiver</button>
                                    </form>
                                </div>
                            <?php endif; ?>

                            <? /*
                            <?php if($enfant->archived) :?>
                            <div class="alert alert-danger">
                                <i class="icon-remove-sign"></i> Cette fiche est archivée voulez-vous la supprimer ?
                                <form action="" method="post" class="pull-right">
                                    <button class="btn btn-danger" name="activate">Supprimer</button>
                                </form>
                            </div>
                            <?php endif; ?>
                            */ ?>
               

                            <table class="no-border no-strip information">
                                <tbody class="no-border-x no-border-y">
                                    <tr>
                                        <td style="width:19%;" class="category"><strong>À propos</strong></td>
                                        <td>
                                            <table class="no-border no-strip skills">
                                                <tbody class="no-border-x no-border-y">
                                                    <tr>
                                                    <td style="width:30%;"><b>Date de naissance</b></td>
                                                    <td>
                                                        <?=($birthdate->getTimestamp() != '-62169987600')? strftime('%d %B %Y', $birthdate->getTimestamp()) : '<em>Non renseignée</em>';?>
                                                        (<?=($birthdate->getTimestamp() != '-62169987600')? tool::getAgeFromDate($enfant->birthdate).' ans' : '<em>Non renseigné</em>';?>)
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width:30%;"><b>Sexe</b></td>
                                                        <td>
                                                            <?=($enfant->sex == 'féminin') ? '<i class="fa fa-female"></i> Féminin' : '<i class="fa fa-male"></i> Masculin'; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width:30%;"><b>Reponsable légal</b></td>
                                                        <td>
                                                            <?php if($enfant->guardian == 'structure'): ?>
                                                            <?php if ($enfant->organization != 0): ?>
                                                            <?php $structure = structure::get($enfant->organization); ?>
                                                            <a href="/structures/infos/id/<?=$structure->id;?>"><?=$structure->name;?></a>
                                                            <?php else: ?>
                                                            Structure
                                                            <?php endif ?>
                                                            <?php elseif($enfant->guardian == 'tuteur'): ?>
                                                            Tuteur
                                                            <!-- <?=(!empty($enfant->guardian_name))? $enfant->guardian_name : EMPTYVAL; ?> -->
                                                            <?php elseif($enfant->guardian == 'parents'): ?>
                                                            Parents
                                                            <!-- <?=(!empty($enfant->father_name))? $enfant->father_name : EMPTYVAL; ?> -->
                                                            <!-- <?=(!empty($enfant->mother_name))? $enfant->mother_name : EMPTYVAL; ?> -->
                                                            <?php elseif($enfant->guardian == 'pere'): ?>
                                                            Père
                                                            <!-- <?=(!empty($enfant->father_name))? $enfant->father_name : EMPTYVAL; ?> -->
                                                            <?php elseif($enfant->guardian == 'mere'): ?>
                                                            Mère
                                                            <!-- <?=(!empty($enfant->mother_name))? $enfant->mother_name : EMPTYVAL; ?> -->
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width:30%;"><b>Domiciliation</b></td>
                                                        <td>
                                                            <?php if ($enfant->domiciliation === 'responsable'): ?>
                                                            Responsable légal
                                                            <?php elseif($enfant->domiciliation === 'famille'): ?>
                                                            Famille d'accueil
                                                            <?php else: ?>
                                                            <?=EMPTYVAL; ?>
                                                            <?php endif ?>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <?php if (tool::check($enfant->note)): ?>
                                    <tr>
                                        <td class="category"><strong>Notes</strong></td>
                                        <td><p><?=$enfant->note;?></p></td>
                                    </tr>
                                    <?php endif ?>
                                    <tr>
                                        <td style="width:19%;" class="category"><strong>Inscription</strong></td>
                                        <td>
                                            <table class="no-border no-strip skills">
                                                <tbody class="no-border-x no-border-y">
                                                    <tr>
                                                        <td style="width:30%;"><b>Inscrit par</b></td>
                                                        <td><?=ucfirst($enfant->registration_by); ?></td>
                                                    </tr>
                                                    <?php if($enfant->registration_by === 'structure'): ?>

                                                        <td style="width:30%;"><b>Structure</b></td>
                                                        <td>
                                                            <?php if ($enfant->organization != 0): ?>
                                                            <?php $structure = structure::get($enfant->organization); ?>
                                                            <a href="/structures/infos/id/<?=$structure->id ?>"><?=$structure->name;?></a>
                                                            <?php else: ?>
                                                            <?=EMPTYVAL; ?>
                                                            <?php endif ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width:30%;"><b>Contact</b></td>
                                                        <td>
                                                            <?php if ($enfant->contact != 0): ?>
                                                            <?php $contact = contact::get($enfant->contact); ?>
                                                            <a href="/contacts/infos/id/<?=$contact->id ?>"><?=$contact->civility.' '.$contact->firstname.' '.$contact->lastname;?></a>
                                                            <?php else: ?>
                                                            <?=EMPTYVAL; ?>
                                                            <?php endif ?>
                                                        </td>
                                                    <?php endif; ?>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        <div id="coordonnees" class="tab-pane cont">
                            <table class="no-border no-strip information">
                                <tbody class="no-border-x no-border-y">
                                    <tr>
                                        <?php if(!empty($enfant->father_name) || !empty($enfant->father_phone_pro) || !empty($enfant->father_phone_mobile) || !empty($enfant->father_phone_home)): ?>
                                        <td style="width:19%;" class="category"><strong>Père</strong></td>
                                        <td>
                                            <table class="no-border no-strip skills">
                                                <tbody class="no-border-x no-border-y">
                                                    <tr>
                                                        <td style="width:30%;"><b>Nom</b></td>
                                                        <td>
                                                            <?=(!empty($enfant->father_name))? $enfant->father_name : EMPTYVAL; ?>
                                                        </td>
                                                    </tr>
                                                    <?php if(!empty($enfant->father_phone_home)): ?>
                                                    <tr>
                                                        <td style="width:30%;"><b>Fixe</b></td>
                                                        <td><?=tool::formatTel($enfant->father_phone_home);?></td>
                                                    </tr>
                                                    <?php endif; ?>
                                                    <?php if(!empty($enfant->father_phone_mobile)): ?>
                                                    <tr>
                                                        <td style="width:30%;"><b>Mobile</b></td>
                                                        <td><?=tool::formatTel($enfant->father_phone_mobile);?></td>
                                                    </tr>
                                                    <?php endif; ?>
                                                    <?php if(!empty($enfant->father_phone_pro)): ?>
                                                    <tr>
                                                        <td style="width:30%;"><b>Tél. pro</b></td>
                                                        <td><?=tool::formatTel($enfant->father_phone_pro);?></td>
                                                    </tr>
                                                    <?php endif; ?>

                                                    <?php if(!empty($enfant->father_address_number) && !empty($enfant->father_address_street) && !empty($enfant->father_address_postal_code) && !empty($enfant->father_address_city)): ?>
                                                        <td style="width:30%;"><b>Adresse</b></td>
                                                        <td> <?=$enfant->father_address_number?> <?=$enfant->father_address_street?><br /><?=$enfant->father_address_postal_code?> <?=$enfant->father_address_city?></td>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </td>
                                        <?php endif; ?>
                                    </tr>
                                    <tr>
                                        <?php if(!empty($enfant->mother_name) || !empty($enfant->mother_phone_pro) || !empty($enfant->mother_phone_mobile) || !empty($enfant->mother_phone_home)): ?>
                                        <td style="width:19%;" class="category"><strong>Mère</strong></td>
                                        <td>
                                            <table class="no-border no-strip skills">
                                                <tbody class="no-border-x no-border-y">
                                                    <tr>
                                                        <td style="width:30%;"><b>Nom</b></td>
                                                        <td>
                                                            <?=(!empty($enfant->mother_name))? $enfant->mother_name : EMPTYVAL; ?>
                                                        </td>
                                                    </tr>
                                                    <?php if(!empty($enfant->mother_phone_home)): ?>
                                                    <tr>
                                                        <td style="width:30%;"><b>Fixe</b></td>
                                                        <td><?=tool::formatTel($enfant->mother_phone_home);?></td>
                                                    </tr>
                                                    <?php endif; ?>
                                                    <?php if(!empty($enfant->mother_phone_mobile)): ?>
                                                    <tr>
                                                        <td style="width:30%;"><b>Mobile</b></td>
                                                        <td><?=tool::formatTel($enfant->mother_phone_mobile);?></td>
                                                    </tr>
                                                    <?php endif; ?>
                                                    <?php if(!empty($enfant->mother_phone_pro)): ?>
                                                    <tr>
                                                        <td style="width:30%;"><b>Tél. pro</b></td>
                                                        <td><?=tool::formatTel($enfant->mother_phone_pro);?></td>
                                                    </tr>
                                                    <?php endif; ?>

                                                    <?php if(!empty($enfant->mother_address_number) && !empty($enfant->mother_address_street) && !empty($enfant->mother_address_postal_code) && !empty($enfant->mother_address_city)): ?>
                                                        <td style="width:30%;"><b>Adresse</b></td>
                                                        <td> <?=$enfant->mother_address_number?> <?=$enfant->mother_address_street?><br /><?=$enfant->mother_address_postal_code?> <?=$enfant->mother_address_city?></td>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </td>
                                        <?php endif; ?>
                                    </tr>
                                    <tr>
                                        <?php if(!empty($enfant->guardian_name) || !empty($enfant->guardian_phone_pro) && !empty($enfant->guardian_phone_mobile) && !empty($enfant->guardian_phone_home)): ?>
                                        <td style="width:19%;" class="category"><strong>Tuteur</strong></td>
                                        <td>
                                            <table class="no-border no-strip skills">
                                                <tbody class="no-border-x no-border-y">
                                                    <tr>
                                                        <td style="width:30%;"><b>Nom</b></td>
                                                        <td>
                                                            <?=(!empty($enfant->guardian_name))? $enfant->guardian_name : EMPTYVAL; ?>
                                                        </td>
                                                    </tr>
                                                    <?php if(!empty($enfant->guardian_phone_home)): ?>
                                                    <tr>
                                                        <td style="width:30%;"><b>Fixe</b></td>
                                                        <td><?=tool::formatTel($enfant->guardian_phone_home);?></td>
                                                    </tr>
                                                    <?php endif; ?>
                                                    <?php if(!empty($enfant->guardian_phone_mobile)): ?>
                                                    <tr>
                                                        <td style="width:30%;"><b>Mobile</b></td>
                                                        <td><?=tool::formatTel($enfant->guardian_phone_mobile);?></td>
                                                    </tr>
                                                    <?php endif; ?>
                                                    <?php if(!empty($enfant->guardian_phone_pro)): ?>
                                                    <tr>
                                                        <td style="width:30%;"><b>Tél. pro</b></td>
                                                        <td><?=tool::formatTel($enfant->guardian_phone_pro);?></td>
                                                    </tr>
                                                    <?php endif; ?>

                                                    <?php if(!empty($enfant->guardian_address_number) && !empty($enfant->guardian_address_street) && !empty($enfant->guardian_address_postal_code) && !empty($enfant->guardian_address_city)): ?>
                                                        <td style="width:30%;"><b>Adresse</b></td>
                                                        <td> <?=$enfant->guardian_address_number?> <?=$enfant->guardian_address_street?><br /><?=$enfant->guardian_address_postal_code?> <?=$enfant->guardian_address_city?></td>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </td>
                                        <?php endif; ?>
                                    </tr>
                                    <tr>
                                        <?php if(!empty($enfant->host_family_name) || !empty($enfant->host_family_phone_pro) || !empty($enfant->host_family_phone_mobile) || !empty($enfant->host_family_phone_home)): ?>
                                        <td style="width:19%;" class="category"><strong>Famille d'accueil</strong></td>
                                        <td>
                                            <table class="no-border no-strip skills">
                                                <tbody class="no-border-x no-border-y">
                                                    <tr>
                                                        <td style="width:30%;"><b>Nom</b></td>
                                                        <td>
                                                            <?=(!empty($enfant->host_family_name))? $enfant->host_family_name : EMPTYVAL; ?>
                                                        </td>
                                                    </tr>
                                                    <?php if(!empty($enfant->host_family_phone_home)): ?>
                                                    <tr>
                                                        <td style="width:30%;"><b>Fixe</b></td>
                                                        <td><?=tool::formatTel($enfant->host_family_phone_home);?></td>
                                                    </tr>
                                                    <?php endif; ?>
                                                    <?php if(!empty($enfant->host_family_phone_mobile)): ?>
                                                    <tr>
                                                        <td style="width:30%;"><b>Mobile</b></td>
                                                        <td><?=tool::formatTel($enfant->host_family_phone_mobile);?></td>
                                                    </tr>
                                                    <?php endif; ?>
                                                    <?php if(!empty($enfant->host_family_phone_pro)): ?>
                                                    <tr>
                                                        <td style="width:30%;"><b>Tél. pro</b></td>
                                                        <td><?=tool::formatTel($enfant->host_family_phone_pro);?></td>
                                                    </tr>
                                                    <?php endif; ?>

                                                    <?php if(!empty($enfant->host_family_address_number) && !empty($enfant->host_family_address_street) && !empty($enfant->host_family_address_postal_code) && !empty($enfant->host_family_address_city)): ?>
                                                        <td style="width:30%;"><b>Adresse</b></td>
                                                        <td> <?=$enfant->host_family_address_number?> <?=$enfant->host_family_address_street?><br /><?=$enfant->host_family_address_postal_code?> <?=$enfant->host_family_address_city?></td>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </td>
                                        <?php endif; ?>
                                    </tr>
                                    <tr>
                                        <?php if(!empty($enfant->emergency_name) || !empty($enfant->emergency_phone)): ?>
                                        <td style="width:19%;" class="category"><strong>Contact d'urgence</strong></td>
                                        <td>
                                            <table class="no-border no-strip skills">
                                                <tbody class="no-border-x no-border-y">
                                                    <tr>
                                                        <td style="width:30%;"><b>Nom</b></td>
                                                        <td>
                                                            <?=(!empty($enfant->emergency_name))? $enfant->emergency_name : EMPTYVAL; ?>
                                                        </td>
                                                    </tr>
                                                    <?php if(!empty($enfant->emergency_phone)): ?>
                                                    <tr>
                                                        <td style="width:30%;"><b>Tél.</b></td>
                                                        <td><?=tool::formatTel($enfant->emergency_phone);?></td>
                                                    </tr>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </td>
                                        <?php endif; ?>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div id="dossier" class="tab-pane cont">
                            <table class="no-border no-strip information">
                                <tbody class="no-border-x no-border-y">
                                    <tr>
                                        <td style="width:19%;" class="category"><strong>Informations</strong></td>
                                        <td>
                                            <table class="no-border no-strip skills">
                                                <tbody class="no-border-x no-border-y">
                                                    <tr>
                                                        <td style="width:30%;"><b>Droit à l'image</b></td>
                                                        <td>
                                                            <?php if($enfant->image_rights == 1): ?>
                                                                Oui
                                                            <?php elseif($enfant->image_rights == 2): ?>
                                                                Non
                                                            <?php else: ?>
                                                                <i class="fa fa-times-circle"></i>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width:30%;"><b>Traitements médicaux</b></td>
                                                        <td>
                                                            <?=($enfant->medicals_treatments > 0)?'Oui':'Non'; ?>
                                                        </td>
                                                    </tr>
                                                    <?php if (!empty($enfant->allergies)): ?>
                                                    <tr>
                                                        <td style="width:30%;"><b>Contre-indications / allergies :</b></td>
                                                        <td>
                                                            <?=$enfant->allergies;?>
                                                        </td>
                                                    </tr>
                                                    <?php endif ?>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:19%;" class="category"><strong>Dossier</strong></td>
                                        <td>
                                            <table class="no-border no-strip skills">
                                                <tbody class="no-border-x no-border-y">
                                                    <tr>
                                                        <td style="width:30%;"><b>N° de sécurité sociale :</b>
                                                        <?php if (isset($enfant->number_ss) && $enfant->number_ss != null): ?>
                                                        <br><small><?=$enfant->number_ss; ?></small>
                                                        <?php endif ?>
                                                        </td>
                                                        <td>
                                                            <?=(isset($enfant->number_ss) && $enfant->number_ss != null)?'<i class="fa fa-check-circle"></i>':'<i class="fa fa-times-circle"></i>'; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width:30%;"><b>Assurance (RC)</b>
                                                        <?php if ($enfant->self_assurance > 0): ?>
                                                        <br><small>Validité : <?=(!empty($enfant->self_assurance_expiration_date))? $enfant->self_assurance_expiration_date : EMPTYVAL; ?></small>
                                                        <?php endif ?>
                                                        </td>
                                                        <td>
                                                            <?=($enfant->self_assurance > 0)?'<i class="fa fa-check-circle"></i>':'<i class="fa fa-times-circle"></i>'; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width:30%;"><b>Attestation CPAM</b>
                                                        <?php if ($enfant->cpam_attestation > 0): ?>
                                                        <br><small>Validité : <?=(!empty($enfant->cpam_attestation_expiration_date))? $enfant->cpam_attestation_expiration_date : EMPTYVAL; ?></small>
                                                        <?php endif ?>
                                                        </td>
                                                        <td>
                                                            <?=($enfant->cpam_attestation > 0)?'<i class="fa fa-check-circle"></i>':'<i class="fa fa-times-circle"></i>'; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width:30%;"><b>Fiche sanitaire de liaison</b></td>
                                                        <td><?=($enfant->health_record > 0)?'<i class="fa fa-check-circle"></i>':'<i class="fa fa-times-circle"></i>'; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width:30%;"><b>Carnet de vaccination</b></td>
                                                        <td><?=($enfant->vaccination > 0)?'<i class="fa fa-check-circle"></i>':'<i class="fa fa-times-circle"></i>'; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width:30%;"><b>Fiche de séjour</b></td>
                                                        <td><?=($enfant->stay_record > 0)?'<i class="fa fa-check-circle"></i>':'<i class="fa fa-times-circle"></i>'; ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <?php if(!empty($enfant->attached_file)): ?>
                                    <?php $file = media::get($enfant->attached_file); ?>
                                    <tr>
                                        <td style="width:19%;" class="category"><strong>Fichier joint :</strong></td>
                                        <td>
                                            <table class="no-border no-strip skills">
                                                <tbody class="no-border-x no-border-y">
                                                    <tr>
                                                        <td style="width:30%;"><b><a href="<?='/'.UPLOAD_FOLDER.$file->file_name; ?>" target="_blank">Télécharger le fichier</a></b></td>
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
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="section-head">
                    <div class="row">
                        <div class="col-md-8">
                            <h3>Séjours de l'enfant</h3>
                        </div>
                        <div class="col-md-4 text-right">
                            <a href="/dossiers/ajouter/enfant/<?=$enfant->id; ?>" class="btn btn-primary"><span>+</span> Inscrire l'enfant à un séjour</a>
                        </div>
                    </div>
                </div>

                <?php $inscriptions = inscription::getByEnfant($enfant->id); ?>
                <?php if(count($inscriptions)>0): ?>
                <div class="block-flat tb-special tb-no-options">
                    <div class="content">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="datatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nom du séjour</th>
                                        <th>Dates</th>
                                        <th>Satut</th>
                                        <th style="width:140px;">Commentaires</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($inscriptions as $key => $inscription): ?>
                                        <?php $sejour = sejour::get($inscription->ref_sejour); ?>
                                        <?php $dossier = dossier::get($inscription->ref_dossier); ?>
                                        <tr>
                                            <td>
                                                <a href="/dossiers/infos/id/<?=$dossier->id; ?>">#<?=$dossier->id ?></a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="/dossiers/infos/id/<?=$dossier->id; ?>" class="item"><i class="fa fa-share"></i> Voir la fiche</a></li>
                                                    <li><a href="/dossiers/editer/id/<?=$dossier->id; ?>" class="item"><i class="fa fa-edit"></i> Modifier</a></li>
                                                    <!-- <li><a href="/dossiers/supprimer/id/<?=$dossier->id; ?>" class="item"><i class="fa fa-remove"></i> Supprimer</a></li> -->
                                                </ul>

                                            </td>
                                            <td>
                                                <a href="/sejours/infos/id/<?=$sejour->id ?>"><?=$sejour->name ?></a>
                                            </td>
                                            <td>
                                                <?php $date_from = new DateTime($inscription->date_from); ?>
                                                <?php $date_to = new DateTime($inscription->date_to); ?>
                                                du <?=strftime('%d %B %Y', $date_from->getTimestamp()); ?>  au <?=strftime('%d %B %Y', $date_to->getTimestamp()); ?> 
                                            </td>
                                            <td>
                                                <?php if($dossier->finished): ?>
                                                    <span class="label label-success">Confirmé</span>
                                                <?php else: ?>
                                                    <span class="label label-danger">Non confirmé</span>
                                                <?php endif; ?>
                                            </td>
                                            <td style="width:140px;">
                                                <?php $note = note::get($enfant->id, $sejour->id) ?>
                                                <a class="btn btn-default btn-xs" data-toggle="popover" data-note="<?php if(!empty($note)): ?><?=$note->message ?><?php endif; ?>" data-note-id="<?php if(!empty($note)): ?><?=$note->id ?><?php endif; ?>" data-ref-sejour="<?=$sejour->id ?>" data-ref-enfant="<?=$enfant->id ?>"> 
                                                    <i class="fa fa-comments"></i> <?=(!empty($note))? 'Modifier la note' : 'Ajouter une note'; ?>
                                                </a>
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
                        <em>Aucun séjour à venir pour cet enfant</em>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">



                <div class="section-head">
                    <div class="row">
                        <div class="col-md-8">
                            <h3>Notes de séjour de l'enfant</h3>
                        </div>
                        <div class="col-md-4 text-right">
                            <a href="/pdf/export_notes/enfant/<?=$enfant->id; ?>" class="btn btn-primary">Exporter les notes</a>
                        </div>
                    </div>
                </div>

                <?php $notes = note::getByEnfant($enfant->id); ?>
                <?php if(count($notes)>0): ?>
                <div class="block-flat tb-special tb-no-options">
                    <div class="content">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="datatable2">
                                <thead>
                                    <tr>
                                        <th style="min-width:150px;">Nom du séjour</th>
                                        <th>Dates</th>
                                        <th>Commentaire</th>
                                        <th>Auteur</th>
                                        <th style="width:140px;">Export</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($notes as $key => $note): ?>
                                        <?php $sejour = sejour::get($note->ref_sejour); ?>
                                        <?php $note_creator = user::get($note->creator); ?>
                                        <?php $note_editor = user::get($note->editor); ?>
                                        <?php $note_date_created = new DateTime($note->created); ?>
                                        <?php $note_date_edited = new DateTime($note->edited); ?>
                                        <tr>
                                            <td>
                                                <a href="/sejours/infos/id/<?=$sejour->id ?>"><?=$sejour->name; ?></a>
                                            </td>
                                            <td>
                                                <?php $date_from = new DateTime($sejour->date_from); ?>
                                                <?php $date_to = new DateTime($sejour->date_to); ?>
                                                <?=strftime('%d %B', $date_from->getTimestamp()); ?>  au <?=strftime('%d %B %Y', $date_to->getTimestamp()); ?> 
                                            </td>
                                            <td>
                                                <?=$note->message; ?>
                                            </td>
                                            <td>
                                                Par <?=$note_editor->firstname ?> <?=substr($note_editor->lastname, 0, 1) ?>., le <?=strftime('%d %B %Y', $note_date_edited->getTimestamp()); ?>
                                            </td>
                                            <td style="width:140px;">
                                                <a href="/pdf/export_note/enfant/<?=$enfant->id; ?>/sejour/<?=$sejour->id ?>"class="btn btn-default btn-xs">
                                                    <i class="fa fa-external-link"></i> Exporter la note
                                                </a>
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
                        <em>Aucun commentaire au sujet de l'enfant pour le moment</em>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="col-sm-3 side-right">
        <?php if(!empty($enfant->father_phone_pro) || !empty($enfant->father_phone_mobile) || !empty($enfant->father_phone_home)): ?>
        <div class="block-flat bars-widget">
            <h4>Père</h4>
            <p>
                <?=(!empty($enfant->father_name))? $enfant->father_name.'<br>' : EMPTYVAL; ?>
                <?=(!empty($enfant->father_phone_home))? '<strong>Fixe :</strong> '.tool::formatTel($enfant->father_phone_home).'<br>' : ''; ?>
                <?=(!empty($enfant->father_phone_mobile))? '<strong>Portable :</strong> '.tool::formatTel($enfant->father_phone_mobile).'<br>' : ''; ?>
                <?=(!empty($enfant->father_phone_pro))? '<strong>Pro :</strong> '.tool::formatTel($enfant->father_phone_pro) : ''; ?>
            </p>
        </div>
        <?php endif; ?>
        <?php if(!empty($enfant->mother_phone_pro) || !empty($enfant->mother_phone_mobile) || !empty($enfant->mother_phone_home)): ?>
        <div class="block-flat bars-widget">
            <h4>Mère</h4>
            <p>
                <?=(!empty($enfant->mother_name))? $enfant->mother_name.'<br>' : EMPTYVAL; ?>
                <?=(!empty($enfant->mother_phone_home))? '<strong>Fixe :</strong> '.tool::formatTel($enfant->mother_phone_home).'<br>' : ''; ?>
                <?=(!empty($enfant->mother_phone_mobile))? '<strong>Portable :</strong> '.tool::formatTel($enfant->mother_phone_mobile).'<br>' : ''; ?>
                <?=(!empty($enfant->mother_phone_pro))? '<strong>Pro :</strong> '.tool::formatTel($enfant->mother_phone_pro) : ''; ?>
            </p>
        </div>
        <?php endif; ?>
        <?php if(!empty($enfant->guardian_phone_pro) && !empty($enfant->guardian_phone_mobile) && !empty($enfant->guardian_phone_home)): ?>
        <div class="block-flat bars-widget">
            <h4>Responsable légale</h4>
            <p>
                <?=(!empty($enfant->guardian_name))? $enfant->guardian_name.'<br>' : EMPTYVAL; ?>
                <?=(!empty($enfant->guardian_phone_home))? '<strong>Fixe :</strong> '.tool::formatTel($enfant->guardian_phone_home).'<br>' : ''; ?>
                <?=(!empty($enfant->guardian_phone_mobile))? '<strong>Portable :</strong> '.tool::formatTel($enfant->guardian_phone_mobile).'<br>' : ''; ?>
                <?=(!empty($enfant->guardian_phone_pro))? '<strong>Pro :</strong> '.tool::formatTel($enfant->guardian_phone_pro) : ''; ?>
            </p>
        </div>
        <?php endif; ?>
        <?php if(!empty($enfant->emergency_phone)): ?>
        <div class="block-flat bars-widget">
            <h4>Contact d'urgence</h4>
            <p>
                <?=(!empty($enfant->emergency_name))? $enfant->emergency_name.'<br>' : EMPTYVAL; ?>
                <strong>Tel :</strong> <?=tool::formatTel($enfant->emergency_phone);?>
            </p>
        </div>
        <?php endif; ?>
        <?php if(!empty($enfant->host_family_phone_pro) || !empty($enfant->host_family_phone_mobile) || !empty($enfant->host_family_phone_home)): ?>
        <div class="block-flat bars-widget">
            <h4>Famille d'accueil</h4>
            <p>
                <?=(!empty($enfant->host_family_name))? $enfant->host_family_name.'<br>' : EMPTYVAL; ?>
                <?=(!empty($enfant->host_family_phone_home))? '<strong>Fixe :</strong> '.tool::formatTel($enfant->host_family_phone_home).'<br>' : ''; ?>
                <?=(!empty($enfant->host_family_phone_mobile))? '<strong>Portable :</strong> '.tool::formatTel($enfant->host_family_phone_mobile).'<br>' : ''; ?>
                <?=(!empty($enfant->host_family_phone_pro))? '<strong>Pro :</strong> '.tool::formatTel($enfant->host_family_phone_pro) : ''; ?>
            </p>
        </div>
        <?php endif; ?>
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
                        Vous êtes sur le point de supprimer la fiche de <strong><?=$enfant->firstname?> <?=$enfant->lastname ?></strong>.<br>
                        Êtes-vous sur de vouloir effectuer cette opération ?
                    </p>
                </div>
            </div>
            <div class="modal-footer">
                <form id="form-remove-children" action="/enfants/" method="post">
                    <a href="#" class="btn btn-default btn-flat" data-dismiss="modal">Annuler</a>
                    <input id="remove-id" type="hidden" name="id" value="<?=$enfant->id;?>">
                    <input type="hidden" name="action" value="supprimer">
                    <input type="hidden" name="confirm" value="true">
                    <input type="submit" class="btn btn-warning btn-flat" value="Supprimer la fiche">
                </form>
            </div>
        </div>
    </div>
</div>


<?php ob_start(); ?>
<script>
    $(function() {
        $('[data-toggle=popover]').popover({
            trigger:"click",
            html: true,
            placement: 'top',
            container: 'body',
            content: '<div class="popover-form clearfix"><form action="" method="post"><div class="form-group"><textarea class="form-control" name="note_message" cols="50" rows="5" placeholder="Entrez un commentaire"></textarea></div> <div class="pull-right"><a href="#" class="btn btn-default btn-sm btn-close">Annuler</a><button type="submit" name="submit-note" class="btn btn-primary btn-sm sumbit-comment">Enregistrer</button></div></form></div>'
        });
        $('[data-toggle=popover]').on('show.bs.popover', function () {
            var note = $(this).data('note');
            var note_id = $(this).data('note-id');
            var ref_sejour = $(this).data('ref-sejour');
            var ref_enfant = $(this).data('ref-enfant');
            setTimeout(function() {
                $('body').find('.popover:last-child').find('form').prepend('<input type="hidden" name="note_ref_sejour" value="'+ref_sejour+'">');
                $('body').find('.popover:last-child').find('form').prepend('<input type="hidden" name="note_ref_enfant" value="'+ref_enfant+'">');
                $('body').find('.popover:last-child').find('form').prepend('<input type="hidden" name="note_id" value="'+note_id+'">');
                $('body').find('.popover:last-child').find('textarea').text(note);
            }, 1);
        });
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