<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>


    <?php if(isset($_POST['submit-add'])): ?>
        <?php //tool::output($_POST); ?>
        <?php //tool::output($_SESSION); ?>
        <?php 
        extract($_POST);

        $birthdate = tool::generateDatetime($form_enfant_naissance);
        $assurance_validite = tool::generateDatetime($form_enfant_assurance_validite);
        $cpam_validite = tool::generateDatetime($form_enfant_cpam_validite);


        $datas = array(                
            ':firstname' => $form_enfant_prenom,
            ':lastname' => $form_enfant_nom,
            ':birthdate' => $birthdate,
            ':sex' => $form_enfant_sexe,
            ':registration_by' => $form_enfant_inscription,
            ':organization' => $form_enfant_structure,
            ':contact' => $form_enfant_contact,
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
    <?php if($result): ?>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success">
                    <i class="icon-ok-sign"></i> 
                    L'enfant <strong><?=$form_enfant_prenom; ?> <?=$form_enfant_nom; ?></strong> a bien été ajouté
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger">
                    <i class="icon-remove-sign"></i> 
                    Une erreur s'est produite durant l'ajout de l'enfant, veuillez réessayer
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
                // Create enfant entry
                $birthdate = tool::generateDatetime($form_enfant_naissance);
                $assurance_validite = tool::generateDatetime($form_enfant_assurance_validite);
                $cpam_validite = tool::generateDatetime($form_enfant_cpam_validite);

                $datas = array(                 
                    ':firstname' => $form_enfant_prenom,
                    ':lastname' => $form_enfant_nom,
                    ':birthdate' => $birthdate,
                    ':sex' => $form_enfant_sexe,
                    ':registration_by' => $form_enfant_inscription,
                    ':organization' => $form_enfant_structure,
                    ':contact' => $form_enfant_contact,
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
                <?php //tool::output($result); ?>
                <?php if($result): ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-success">
                            <i class="icon-ok-sign"></i> 
                            L'enfant <strong><?=$form_enfant_prenom; ?> <?=$form_enfant_nom; ?></strong> a bien été modifié
                        </div>
                        <a href="/enfants/" class="btn-flat default">Retourner à la liste des enfants</a>
                    </div>
                </div>
                <?php else: ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-danger">
                            <i class="icon-remove-sign"></i> 
                            Une erreur s'est produite durant l'ajout de l'enfant, veuillez réessayer
                        </div>
                        <a href="/enfants/ajouter" class="btn-flat default">Retourner au formulaire d'ajout</a>
                    </div>
                </div>
                <?php endif; ?>
            <?php endif; ?>


<?php $enfant = enfant::get($_GET['id']); ?>
<?php $creator = user::get($enfant->creator); ?>
<?php $editor = user::get($enfant->editor); ?>
<?php $date_created = new DateTime($enfant->created); ?>
<?php $date_edited = new DateTime($enfant->edited); ?>





<div class="title">
    <div class="row header">
        <div class="col-md-9">

            <h3><a href="#" class="trigger"><i class="big-icon icon-user"></i></a>
                <?=$enfant->firstname; ?> <strong><?=$enfant->lastname; ?></strong><br />
                <small class="area">
                    <?=($enfant->sex == 'féminin') ? '<i class="icon-female"></i>' : '<i class="icon-male"></i>'; ?>
                    <?php $birthdate = new DateTime($enfant->birthdate); ?>
                    <?php if($birthdate->getTimestamp() != '-62169987600'): ?>
                        <?=strftime('%d %B %Y', $birthdate->getTimestamp()); ?> 
                        (<?=tool::getAgeFromDate($enfant->birthdate); ?> ans)
                    <?php endif; ?>
                </small>
            </h3>

            <div class="pop-dialog">
                <div class="pointer">
                    <div class="arrow"></div>
                    <div class="arrow_border"></div>
                </div>
                <div class="body">
                    <div class="menu">
                        <a href="/enfants/editer/id/<?=$enfant->id; ?>" class="item"><i class="icon-edit"></i> Modifier</a>
                        <a href="/enfants/supprimer/id/<?=$enfant->id; ?>" class="item" data-toggle="modal"><i class="icon-remove"></i> Supprimer</a>
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

<div class="content <?=($enfant->archived)?' archived':' ';?>">

    <?php if(isset($_POST['activate'])): ?>
        <div class="alert alert-success">
            <i class="icon-ok-sign"></i>
            Cette fiche a bien été réactivée !
        </div>
        <?php enfant::unarchive($_GET['id']); ?>
    <?php endif; ?>

    <?php if($enfant->archived) :?>
        <div class="alert alert-info">
            <i class="icon-exclamation-sign"></i> Cette fiche est archivée voulez-vous la réactiver ?
            <form action="" method="post" class="pull-right">
                <button class="btn btn-primary" name="activate">Réactiver</button>
            </form>
        </div>
    <?php endif; ?>
    <?php if($enfant->archived) :?>
        <div class="alert alert-danger">
            <i class="icon-remove-sign"></i> Cette fiche est archivée voulez-vous la supprimer ?
            <form action="" method="post" class="pull-right">
                <button class="btn btn-danger" name="activate">Supprimer</button>
            </form>
        </div>
    <?php endif; ?>


    <?php //tool::output($enfant); ?>


    <div class="row">

        <div class="col-md-9 bio">
            <!-- <h6>Ses informations</h6> -->
            <div class="row">

             <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">A propos de l'enfant</div>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <p><strong>Date de naissance :</strong></p>
                            <?php $birthdate = new DateTime($enfant->birthdate); ?>
                            <p><?=($birthdate->getTimestamp() != '-62169987600')? strftime('%d %B %Y', $birthdate->getTimestamp()) : '<em>Non renseignée</em>';?></p>
                        </li>
                        <li class="list-group-item">
                            <p><strong>Age :</strong></p>
                            <p><?=($birthdate->getTimestamp() != '-62169987600')? tool::getAgeFromDate($enfant->birthdate).' ans' : '<em>Non renseigné</em>';?></p>
                        </li>
                        <li class="list-group-item">
                            <p><strong>Sexe :</strong></p>
                            <p><?=($enfant->sex == 'féminin') ? '<i class="icon-female"></i> Féminin' : '<i class="icon-male"></i> Masculin'; ?></p>

                        </li>
                        <li class="list-group-item">
                            <p><strong>Domiciliation :</strong></p>
                            <?php if ($enfant->domiciliation === 'responsable'): ?>
                                <p>Responsable légal</p>
                            <?php elseif($enfant->domiciliation === 'famille'): ?>
                                <p>Famille d'accueil</p>
                            <?php else: ?>
                                <p><?=EMPTYVAL; ?></p>
                            <?php endif ?>
                        </li>
                    </ul>
                </div>
                <?php if (!empty($enfant->note)): ?>
                <div class="panel panel-default">
                    <div class="panel-heading">Notes</div>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <p><?=$enfant->note;?></p>
                        </li>
                    </ul>
                </div>
                <?php endif; ?>
            </div>


            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">Inscription de l'enfant</div>
                    <ul class="list-group">
                        <?php if($enfant->registration_by === 'structure'): ?>
                            <li class="list-group-item">
                                <p><strong>Structure :</strong></p>
                                <?php if ($enfant->organization != 0): ?>
                                    <?php $structure = structure::get($enfant->organization); ?>
                                    <p><a href="/structures/infos/id/<?=$structure->id ?>"><?=$structure->name;?></a></p>
                                <?php else: ?>
                                    <p><?=EMPTYVAL; ?></p>
                                <?php endif ?>
                            </li>
                            <li class="list-group-item">
                                <p><strong>Contact :</strong></p>
                                <?php if ($enfant->contact != 0): ?>
                                    <?php $contact = contact::get($enfant->contact); ?>
                                    <p><a href="/contacts/infos/id/<?=$contact->id ?>"><?=$contact->civility.' '.$contact->firstname.' '.$contact->lastname;?></a></p>
                                <?php else: ?>
                                    <p><?=EMPTYVAL; ?></p>
                                <?php endif ?>
                            </li>
                        <?php else: ?>
                            <li class="list-group-item">
                                <p><?=ucfirst($enfant->registration_by); ?></p>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">Responsable légal de l'enfant</div>
                    <ul class="list-group">
                        <?php if($enfant->guardian == 'structure'): ?>
                            <li class="list-group-item">
                                <p><strong>Structure :</strong></p>
                                <?php if ($enfant->organization != 0): ?>
                                    <p><a href=""><?=$enfant->organization;?></a></p>
                                <?php else: ?>
                                    <p><?=EMPTYVAL; ?></p>
                                <?php endif ?>
                            </li>
                        <?php elseif($enfant->guardian == 'tuteur'): ?>
                            <li class="list-group-item">
                                <p><strong>Tuteur :</strong></p>
                                <p><?=(!empty($enfant->guardian_name))? $enfant->guardian_name : EMPTYVAL; ?> <p><i class="icon-phone"></i><?=(!empty($enfant->guardian_phone))? $enfant->guardian_phone : EMPTYVAL; ?></p>
                            </li>
                        <?php elseif($enfant->guardian == 'parents'): ?>
                            <li class="list-group-item">
                                <p><strong>Père :</strong></p>
                                <p><?=(!empty($enfant->father_name))? $enfant->father_name : EMPTYVAL; ?> <p><i class="icon-phone"></i><?=(!empty($enfant->father_phone))? $enfant->father_phone : EMPTYVAL; ?></p>
                            </li>
                            <li class="list-group-item">
                                <p><strong>Mère :</strong></p>
                                <p><?=(!empty($enfant->mother_name))? $enfant->mother_name : EMPTYVAL; ?> <p><i class="icon-phone"></i><?=(!empty($enfant->mother_phone))? $enfant->mother_phone : EMPTYVAL; ?></p>
                            </li>
                        <?php elseif($enfant->guardian == 'pere'): ?>
                            <li class="list-group-item">
                                <p><strong>Père :</strong></p>
                                <p><?=(!empty($enfant->father_name))? $enfant->father_name : EMPTYVAL; ?> <p><i class="icon-phone"></i><?=(!empty($enfant->father_phone))? $enfant->father_phone : EMPTYVAL; ?></p>
                            </li>
                        <?php elseif($enfant->guardian == 'mere'): ?>
                            <li class="list-group-item">
                                <p><strong>Adresse  :</strong></p>
                                <p><?=(!empty($enfant->guardian_address_number) && !empty($enfant->guardian_address_street) && !empty($enfant->guardian_address_postal_code) && !empty($enfant->guardian_address_city))? $enfant->guardian_address_number.' '.$enfant->guardian_address_street.', <br />'.$enfant->guardian_address_postal_code.' '.$enfant->guardian_address_city : EMPTYVAL; ?></p>
                            </li>

                        <?php else: ?>
                            <li class="list-group-item">Aucun responsable légal de défini pour le moment</li>
                        <?php endif; ?>
                    </ul>
                </div>

                <?php if ($enfant->domiciliation == 'famille'): ?>
                <div class="panel panel-default">
                    <div class="panel-heading">Famille d'accueil</div>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <p><strong>Nom de la famille d'accueil :</strong></p>
                            <?=(!empty($enfant->host_family_name))? $enfant->host_family_name : EMPTYVAL; ?>
                            <p><i class="icon-phone"></i><?=(!empty($enfant->host_family_phone))? $enfant->host_family_phone : EMPTYVAL; ?></p>
                        </li>
                        <li class="list-group-item">
                            <p><strong>Adresse de la famille d'accueil :</strong></p>
                            <p><?=(!empty($enfant->host_family_address_number) && !empty($enfant->host_family_address_street) && !empty($enfant->host_family_address_postal_code) && !empty($enfant->host_family_address_city))? $enfant->host_family_address_number.' '.$enfant->host_family_address_street.', <br />'.$enfant->host_family_address_postal_code.' '.$enfant->host_family_address_city : EMPTYVAL; ?></p>
                        </li>
                    </ul>
                </div>
                <?php endif ?>

                <?php if (!empty($enfant->emergency_name)): ?>
                <div class="panel panel-default noheader">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <p><strong>Urgence :</strong></p>
                            <p><?=$enfant->emergency_name;?> <?php if (!empty($enfant->host_family_phone)): ?><p><i class="icon-phone"></i><?=$enfant->emergency_phone;?></span><?php endif ?></p>
                        </li>
                    </ul>
                </div>
                <?php endif ?>

            </div>

            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">Dossier</div>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <p><strong>Droit à l'image :</strong> <span class="pull-right"><?=($enfant->image_rights > 0)?'Oui':'Non'; ?></span></p>
                        </li>
                        <li class="list-group-item">
                            <p><strong>Traitements médicaux :</strong> <span class="pull-right"><?=($enfant->medicals_treatments > 0)?'Oui':'Non'; ?></span></p>
                        </li>
                        <?php if (!empty($enfant->allergies)): ?>
                            <li class="list-group-item">
                                <p><strong>Contre-indications / allergies :</strong></span></p>
                                <p><?=$enfant->allergies;?></p>
                            </li>   
                        <?php endif ?>
                        <li class="list-group-item">
                            <p><strong>N° de sécurité sociale :</strong><span class="pull-right"><?=(isset($enfant->number_ss) && $enfant->number_ss != null)?'<i class="icon-ok-sign"></i>':'<i class="icon-remove-sign"></i>'; ?></span></p>
                            <?php if (isset($enfant->number_ss) && $enfant->number_ss != null): ?>
                                <p><?=$enfant->number_ss;?></p>
                            <?php endif ?>
                        </li>
                        <li class="list-group-item">
                            <p><strong>Assurance (RC) :</strong><span class="pull-right"><?=($enfant->self_assurance > 0)?'<i class="icon-ok-sign"></i>':'<i class="icon-remove-sign"></i>'; ?></span></p>
                            <?php if ($enfant->self_assurance > 0): ?>
                                <p><small>Validité : <?=(!empty($enfant->self_assurance_expiration_date))? $enfant->self_assurance_expiration_date : EMPTYVAL; ?></small></p>
                            <?php endif ?>
                        </li>
                        <li class="list-group-item">
                            <p><strong>Attestation CPAM :</strong><span class="pull-right"><?=($enfant->cpam_attestation > 0)?'<i class="icon-ok-sign"></i>':'<i class="icon-remove-sign"></i>'; ?></span></p>
                            <?php if ($enfant->cpam_attestation > 0): ?>
                                <p><small>Validité : <?=(!empty($enfant->cpam_attestation_expiration_date))? $enfant->cpam_attestation_expiration_date : EMPTYVAL; ?></small></p>
                            <?php endif ?>
                        </li>
                        <li class="list-group-item">
                            <p><strong>Fiche sanitaire de liaison :</strong><span class="pull-right"><?=($enfant->health_record > 0)?'<i class="icon-ok-sign"></i>':'<i class="icon-remove-sign"></i>'; ?></span></p>
                        </li>
                        <li class="list-group-item">
                            <p><strong>Carnet de vaccination :</strong><span class="pull-right"><?=($enfant->vaccination > 0)?'<i class="icon-ok-sign"></i>':'<i class="icon-remove-sign"></i>'; ?></span></p>

                        </li>
                        <li class="list-group-item">
                            <p><strong>Fiche de séjour :</strong><span class="pull-right"><?=($enfant->stay_record > 0)?'<i class="icon-ok-sign"></i>':'<i class="icon-remove-sign"></i>'; ?></span></p>
                        </li>
                    </ul>
                </div>
            </div>
            </div>
            </div>



        <div class="col-md-3 address">
        <div class="row">
            <?php  
/*
[guardian] => 
    [father_name] => 
    [father_phone_home] => 06 13 88 8
    [father_phone_mobile] => 
    [father_phone_pro] => 
    [father_address_number] => 
    [father_address_street] => 
    [father_address_postal_code] => 
    [father_address_city] => 
    [mother_name] => Mme MALAMBA Attie
    [mother_phone_home] => 
    [mother_phone_mobile] => 
    [mother_phone_pro] => 
    [mother_address_number] => 
    [mother_address_street] => 
    [mother_address_postal_code] => 
    [mother_address_city] => 
    [guardian_name] => 
    [guardian_phone_home] => 
    [guardian_phone_mobile] => 
    [guardian_phone_pro] => 
    [emergency_name] => 
    [emergency_phone] => 
    [guardian_address_number] => 
    [guardian_address_street] => 
    [guardian_address_postal_code] => 0
    [guardian_address_city] => 
    [domiciliation] => responsable
    [host_family_name] => 
    [host_family_phone_home] => 
    [host_family_phone_mobile] => 
    [host_family_phone_pro] => 
    [host_family_address_number] => 
    [host_family_address_street] => 
    [host_family_address_postal_code] => 0
    [host_family_address_city] => 
*/

    ?>
    <div class="contact">
        <?php if(!empty($enfant->father_phone_pro) || !empty($enfant->father_phone_mobile) || !empty($enfant->father_phone_home)): ?>
            <h6>Père</h6>
            <p><?=(!empty($enfant->father_name))? $enfant->father_name : EMPTYVAL; ?> 
                <p><?=(!empty($enfant->father_phone_home))? '<i class="icon-phone"></i> <strong>Fixe :</strong> '.$enfant->father_phone_home : ''; ?></span>
                <p><?=(!empty($enfant->father_phone_mobile))? '<i class="icon-phone"></i> <strong>Portable :</strong> '.$enfant->father_phone_mobile : ''; ?></span>
                <p><?=(!empty($enfant->father_phone_pro))? '<i class="icon-phone"></i> <strong>Pro :</strong> '.$enfant->father_phone_pro : ''; ?></span>
            <?php endif; ?>

        </p>
<!--
    [father_address_number] => 
    [father_address_street] => 
    [father_address_postal_code] => 
    [father_address_city] => 
-->
</div>
<div class="contact">
    <?php if(!empty($enfant->mother_phone_pro) || !empty($enfant->mother_phone_mobile) || !empty($enfant->mother_phone_home)): ?>
        <h6>Mère</h6>
        <p><?=(!empty($enfant->mother_name))? $enfant->mother_name : EMPTYVAL; ?>
            <p><?=(!empty($enfant->mother_phone_home))? '<i class="icon-phone"></i> <strong>Fixe :</strong> '.$enfant->mother_phone_home : ''; ?></span>
            <p><?=(!empty($enfant->mother_phone_mobile))? '<i class="icon-phone"></i> <strong>Portable :</strong> '.$enfant->mother_phone_mobile : ''; ?></span>
            <p><?=(!empty($enfant->mother_phone_pro))? '<i class="icon-phone"></i> <strong>Pro :</strong> '.$enfant->mother_phone_pro : ''; ?></span>
        <?php endif; ?>
    </p>
<!--
    [mother_address_number] => 
    [mother_address_street] => 
    [mother_address_postal_code] => 
    [mother_address_city] => 
-->
</div>
<div class="contact">
    <?php if(!empty($enfant->guardian_phone_pro) && !empty($enfant->guardian_phone_mobile) && !empty($enfant->guardian_phone_home)): ?>
        <h6>Responsable légale</h6>
        <p><?=(!empty($enfant->guardian_name))? $enfant->guardian_name : EMPTYVAL; ?> 
            <p><?=(!empty($enfant->guardian_phone_home))? '<i class="icon-phone"></i> <strong>Fixe :</strong> '.$enfant->guardian_phone_home : ''; ?></span>
            <p><?=(!empty($enfant->guardian_phone_mobile))? '<i class="icon-phone"></i> <strong>Portable :</strong> '.$enfant->guardian_phone_mobile : ''; ?></span>
            <p><?=(!empty($enfant->guardian_phone_pro))? '<i class="icon-phone"></i> <strong>Pro :</strong> '.$enfant->guardian_phone_pro : ''; ?></span>
        <?php endif; ?>

    </p>
<!--
    [guardian_address_number] => 
    [guardian_address_street] => 
    [guardian_address_postal_code] => 0
    [guardian_address_city] => 
-->
</div>
<div class="contact">
    <?php if(!empty($enfant->emergency_phone)): ?>
        <h6>Contact d'urgence</h6>
        <p><?=(!empty($enfant->emergency_name))? $enfant->emergency_name : EMPTYVAL; ?></p> 
        <p><p><i class="icon-phone"></i> <?=$enfant->emergency_phone;?></p>
    <?php endif; ?>
</div>
<div class="contact">
    <?php if(!empty($enfant->host_family_phone_pro) || !empty($enfant->host_family_phone_mobile) || !empty($enfant->host_family_phone_home)): ?>
        <h6>Famille d'accueil</h6>
        <p><?=(!empty($enfant->host_family_name))? $enfant->host_family_name : EMPTYVAL; ?> 
            <p><?=(!empty($enfant->host_family_phone_home))? '<i class="icon-phone"></i> <strong>Fixe :</strong> '.$enfant->host_family_phone_home : ''; ?></span>
            <p><?=(!empty($enfant->host_family_phone_mobile))? '<i class="icon-phone"></i> <strong>Portable :</strong> '.$enfant->host_family_phone_mobile : ''; ?></span>
            <p><?=(!empty($enfant->host_family_phone_pro))? '<i class="icon-phone"></i> <strong>Pro :</strong> '.$enfant->host_family_phone_pro : ''; ?></span>
        <?php endif; ?>
    </p>
<!--
    [host_family_address_number] => 
    [host_family_address_street] => 
    [host_family_address_postal_code] => 0
    [host_family_address_city] => 
-->
</div>
</div>
</div>

</div>
</div>




        <div class="title">
            <div class="row header">
                <div class="col-md-8">
                    <h4>Séjours de l'enfant</h4>
                </div>
                <div class="col-md-4 text-right">
                    <a href="/inscriptions/ajouter/enfant/<?=$enfant->id; ?>" class="btn btn-primary"><span>+</span> Inscrire à un séjour</a>
                </div>
            </div>
        </div>


<div class="content content-table">

            <div class="row">
                <div class="col-md-12">

    <?php $inscriptions = inscription::getByEnfant($enfant->id); ?>
    <?php //tool::output($inscriptions); ?>
    <?php if(count($inscriptions)>0): ?>
        <table class="datatable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>
                        Nom du séjour
                    </th>
                    <th>
                        <span class="line"></span>
                        Dates
                    </th>
                    <th>
                        <span class="line"></span>
                        Note
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($inscriptions as $key => $inscription): ?>
                    <?php $sejour = sejour::get($inscription->ref_sejour); ?>
                    <tr>
                        <td>
                            <a href="/inscriptions/infos/id/<?=$inscription->id; ?>">#<?=$key+1 ?></a>
                            <div class="pop-dialog tr">
                                <div class="pointer">
                                    <div class="arrow"></div>
                                    <div class="arrow_border"></div>
                                </div>
                                <div class="body">
                                    <div class="menu">
                                        <a href="/inscriptions/infos/id/<?=$inscription->id; ?>" class="item"><i class="icon-share"></i> Voir la fiche</a>
                                        <a href="/inscriptions/editer/id/<?=$inscription->id; ?>" class="item"><i class="icon-edit"></i> Modifier</a>
                                        <a href="/inscriptions/supprimer/id/<?=$inscription->id; ?>" class="item"><i class="icon-remove"></i> Supprimer</a>
                                    </div>
                                </div>
                            </div> 
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
                            <?=$inscription->note ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Aucun séjour à venir pour cet enfant</p>
    <?php endif; ?>



</div>
</div>
</div>


<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>
