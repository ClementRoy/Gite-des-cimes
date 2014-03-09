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
                L'enfant <strong><?=$form_enfant_prenom; ?> <?=$form_enfant_nom; ?></strong> a bien été modifié
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

            <h1><a href="#" class="trigger"><i class="big-icon icon-user"></i></a>
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

<div class="row">
    <div class="col-md-9">

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

                <div class="col-md-12">
                    <h3 id="a-propos">À propos de l'enfant</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <p>
                                <strong>Date de naissance :</strong> 
                                <?php $birthdate = new DateTime($enfant->birthdate); ?>
                                <?=($birthdate->getTimestamp() != '-62169987600')? strftime('%d %B %Y', $birthdate->getTimestamp()) : '<em>Non renseignée</em>';?>
                                (<?=($birthdate->getTimestamp() != '-62169987600')? tool::getAgeFromDate($enfant->birthdate).' ans' : '<em>Non renseigné</em>';?>)
                            </p>

                            <p>
                                <strong>Reponsable légal :</strong>
                                <?php if($enfant->guardian == 'structure'): ?>
                                    <?php if ($enfant->organization != 0): ?>
                                        <?php $structure = structure::get($enfant->organization); ?>
                                        <a href=""><?=$structure->name;?></a>
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
                            </p>

                        </div>

                        <div class="col-md-6">
                            <p>
                                <strong>Sexe :</strong>
                                <?=($enfant->sex == 'féminin') ? '<i class="icon-female"></i> Féminin' : '<i class="icon-male"></i> Masculin'; ?>
                            </p>


                            <p>
                                <strong>Domiciliation :</strong>
                                <?php if ($enfant->domiciliation === 'responsable'): ?>
                                    Responsable légal
                                <?php elseif($enfant->domiciliation === 'famille'): ?>
                                    Famille d'accueil
                                <?php else: ?>
                                    <?=EMPTYVAL; ?>
                                <?php endif ?>
                            </p>
                        </div>


                        <?php if (!empty($enfant->note)): ?>
                            <div class="col-md-12">
                                <p><strong>Notes :</strong><br />
                                    <?=$enfant->note;?></p>
                                </div>
                            <?php endif; ?>
                        </div>

                        <hr>
                        <h3 id="inscription">Inscription</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <?php if($enfant->registration_by === 'structure'): ?>

                                    <p>
                                        <strong>Structure :</strong>
                                        <?php if ($enfant->organization != 0): ?>
                                            <?php $structure = structure::get($enfant->organization); ?>
                                            <a href="/structures/infos/id/<?=$structure->id ?>"><?=$structure->name;?></a>
                                        <?php else: ?>
                                            <?=EMPTYVAL; ?>
                                        <?php endif ?>
                                    </p>

                                    <p>
                                        <strong>Contact :</strong>
                                        <?php if ($enfant->contact != 0): ?>
                                            <?php $contact = contact::get($enfant->contact); ?>
                                            <a href="/contacts/infos/id/<?=$contact->id ?>"><?=$contact->civility.' '.$contact->firstname.' '.$contact->lastname;?></a>
                                        <?php else: ?>
                                            <?=EMPTYVAL; ?>
                                        <?php endif ?>
                                    </p>
                                <?php else: ?>
                                    <?=ucfirst($enfant->registration_by); ?>
                                <?php endif; ?>
                            </div>
                        </div>

                        <hr>

                        <h3 id="coordonnees">Coordonnées</h3>
                        <div class="row">
                            <?php if(!empty($enfant->father_name) || !empty($enfant->father_phone_pro) || !empty($enfant->father_phone_mobile) || !empty($enfant->father_phone_home)): ?>
                                <div class="col-md-4">
                                    <p>
                                        <strong>Père :</strong><br>
                                        <?=(!empty($enfant->father_name))? $enfant->father_name : EMPTYVAL; ?><br>
                                        <?=(!empty($enfant->father_phone_home))? '<i class="icon-phone"></i> <strong>Fixe :</strong> '.$enfant->father_phone_home : ''; ?><br>
                                        <?=(!empty($enfant->father_phone_mobile))? '<i class="icon-phone"></i> <strong>Portable :</strong> '.$enfant->father_phone_mobile : ''; ?><br>
                                        <?=(!empty($enfant->father_phone_pro))? '<i class="icon-phone"></i> <strong>Pro :</strong> '.$enfant->father_phone_pro : ''; ?>
                                    </p>
                                    <?php if(!empty($enfant->father_address_number) &&
                                        !empty($enfant->father_address_street) &&
                                        !empty($enfant->father_address_postal_code) &&
                                        !empty($enfant->father_address_city)): ?>
                                        <p>
                                            <strong><i class="icon-home"></i> Adresse :</strong><br>
                                            <?=$enfant->father_address_number?> <?=$enfant->father_address_street?> <br />
                                            <?=$enfant->father_address_postal_code?> <?=$enfant->father_address_city?>
                                        </p>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                            <?php if(!empty($enfant->mother_name) || !empty($enfant->mother_phone_pro) || !empty($enfant->mother_phone_mobile) || !empty($enfant->mother_phone_home)): ?>
                                <div class="col-md-4">
                                    <p>
                                        <strong>Mère :</strong><br>
                                        <?=(!empty($enfant->mother_name))? $enfant->mother_name : EMPTYVAL; ?><br>
                                        <?=(!empty($enfant->mother_phone_home))? '<i class="icon-phone"></i> <strong>Fixe :</strong> '.$enfant->mother_phone_home : ''; ?><br>
                                        <?=(!empty($enfant->mother_phone_mobile))? '<i class="icon-phone"></i> <strong>Portable :</strong> '.$enfant->mother_phone_mobile : ''; ?><br>
                                        <?=(!empty($enfant->mother_phone_pro))? '<i class="icon-phone"></i> <strong>Pro :</strong> '.$enfant->mother_phone_pro : ''; ?>
                                    </p>
                                    <?php if(!empty($enfant->mother_address_number) &&
                                        !empty($enfant->mother_address_street) &&
                                        !empty($enfant->mother_address_postal_code) &&
                                        !empty($enfant->mother_address_city)): ?>
                                        <p>
                                            <strong><i class="icon-home"></i> Adresse :</strong><br>
                                            <?=$enfant->mother_address_number?> <?=$enfant->mother_address_street?> <br />
                                            <?=$enfant->mother_address_postal_code?> <?=$enfant->mother_address_city?>
                                        </p>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                            <?php if(!empty($enfant->guardian_name) || !empty($enfant->guardian_phone_pro) && !empty($enfant->guardian_phone_mobile) && !empty($enfant->guardian_phone_home)): ?>
                                <div class="col-md-4">
                                    <p>
                                        <strong>Tuteur :</strong><br>
                                        <?=(!empty($enfant->guardian_name))? $enfant->guardian_name : EMPTYVAL; ?><br>
                                        <?=(!empty($enfant->guardian_phone_home))? '<i class="icon-phone"></i> <strong>Fixe :</strong> '.$enfant->guardian_phone_home : ''; ?><br>
                                        <?=(!empty($enfant->guardian_phone_mobile))? '<i class="icon-phone"></i> <strong>Portable :</strong> '.$enfant->guardian_phone_mobile : ''; ?><br>
                                        <?=(!empty($enfant->guardian_phone_pro))? '<i class="icon-phone"></i> <strong>Pro :</strong> '.$enfant->guardian_phone_pro : ''; ?>
                                    </p>
                                    <?php if(!empty($enfant->guardian_address_number) &&
                                        !empty($enfant->guardian_address_street) &&
                                        !empty($enfant->guardian_address_postal_code) &&
                                        !empty($enfant->guardian_address_city)): ?>
                                        <p>
                                            <strong><i class="icon-home"></i> Adresse :</strong><br>
                                            <?=$enfant->guardian_address_number?> <?=$enfant->guardian_address_street?> <br />
                                            <?=$enfant->guardian_address_postal_code?> <?=$enfant->guardian_address_city?>
                                        </p>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                            <?php if(!empty($enfant->host_family_name) || !empty($enfant->host_family_phone_pro) || !empty($enfant->host_family_phone_mobile) || !empty($enfant->host_family_phone_home)): ?>
                                <div class="col-md-4">
                                    <p>
                                    <strong>Famille d'accueil :</strong><br>
                                        <?=(!empty($enfant->host_family_name))? $enfant->host_family_name : EMPTYVAL; ?><br>
                                        <?=(!empty($enfant->host_family_phone_home))? '<i class="icon-phone"></i> <strong>Fixe :</strong> '.$enfant->host_family_phone_home : ''; ?><br>
                                        <?=(!empty($enfant->host_family_phone_mobile))? '<i class="icon-phone"></i> <strong>Portable :</strong> '.$enfant->host_family_phone_mobile : ''; ?><br>
                                        <?=(!empty($enfant->host_family_phone_pro))? '<i class="icon-phone"></i> <strong>Pro :</strong> '.$enfant->host_family_phone_pro : ''; ?>
                                    </p>
                                    <?php if(!empty($enfant->host_family_address_number) &&
                                        !empty($enfant->host_family_address_street) &&
                                        !empty($enfant->host_family_address_postal_code) &&
                                        !empty($enfant->host_family_address_city)): ?>
                                        <p>
                                            <strong><i class="icon-home"></i> Adresse :</strong><br>
                                            <?=$enfant->host_family_address_number?> <?=$enfant->host_family_address_street?> <br />
                                            <?=$enfant->host_family_address_postal_code?> <?=$enfant->host_family_address_city?>
                                        </p>
                                    <?php endif; ?>

                                </div>
                            <?php endif; ?>
                            <?php if(!empty($enfant->emergency_name) || !empty($enfant->emergency_phone)): ?>
                                <div class="col-md-4">
                                    <p>
                                        <strong>Contact d'urgence :</strong><br>
                                        <?=(!empty($enfant->emergency_name))? $enfant->emergency_name : EMPTYVAL; ?><br>
                                        <i class="icon-phone"></i> <?=(!empty($enfant->emergency_phone))? $enfant->emergency_phone : EMPTYVAL; ?>
                                    </p>
                                </div>
                            <?php endif; ?>
                        </div>

                        <hr>
                        <h3 id="dossier">Dossier de l'enfant</h3>
                        <div class="row">
                            <div class="col-md-4">
                                <p>
                                    <strong>Droit à l'image :</strong>
                                    <?=($enfant->image_rights > 0)?'Oui':'Non'; ?>
                                </p>

                                <p>
                                    <strong>Traitements médicaux :</strong>
                                    <?=($enfant->medicals_treatments > 0)?'Oui':'Non'; ?>
                                </p>


                                <?php if (!empty($enfant->allergies)): ?>
                                    <p>
                                        <strong>Contre-indications / allergies :</strong><br />
                                        <?=$enfant->allergies;?>
                                    </p>
                                <?php endif ?>


                                <p>
                                    <strong>N° de sécurité sociale :</strong>
                                    <?=(isset($enfant->number_ss) && $enfant->number_ss != null)?'<i class="icon-ok-sign"></i>':'<i class="icon-remove-sign"></i>'; ?>
                                    <?php if (isset($enfant->number_ss) && $enfant->number_ss != null): ?>
                                        <p><?=$enfant->number_ss;?></p>
                                    <?php endif ?>
                                </p>
                            </div>
                            <div class="col-md-4">
                                <p>
                                    <strong>Assurance (RC) :</strong>
                                    <?=($enfant->self_assurance > 0)?'<i class="icon-ok-sign"></i>':'<i class="icon-remove-sign"></i>'; ?>
                                </p>
                                <?php if ($enfant->self_assurance > 0): ?>
                                    <p>
                                        <strong>Validité :</strong>
                                        <?=(!empty($enfant->self_assurance_expiration_date))? $enfant->self_assurance_expiration_date : EMPTYVAL; ?>
                                    </p>
                                <?php endif ?>


                                <p>
                                    <strong>Attestation CPAM :</strong>
                                    <?=($enfant->cpam_attestation > 0)?'<i class="icon-ok-sign"></i>':'<i class="icon-remove-sign"></i>'; ?>
                                </p>

                                <?php if ($enfant->cpam_attestation > 0): ?>
                                    <p>
                                        <strong>Validité :</strong>
                                        <?=(!empty($enfant->cpam_attestation_expiration_date))? $enfant->cpam_attestation_expiration_date : EMPTYVAL; ?>
                                    </p>
                                <?php endif ?>
                            </div>
                            <div class="col-md-4">
                                <p>
                                    <strong>Fiche sanitaire de liaison :</strong>
                                    <?=($enfant->health_record > 0)?'<i class="icon-ok-sign"></i>':'<i class="icon-remove-sign"></i>'; ?>
                                </p>


                                <p>
                                    <strong>Carnet de vaccination :</strong>
                                    <?=($enfant->vaccination > 0)?'<i class="icon-ok-sign"></i>':'<i class="icon-remove-sign"></i>'; ?>
                                </p>


                                <p>
                                    <strong>Fiche de séjour :</strong>
                                    <?=($enfant->stay_record > 0)?'<i class="icon-ok-sign"></i>':'<i class="icon-remove-sign"></i>'; ?>
                                </p>
                            </div>
                        </div>

                    </div>



                </div>
            </div>



            <div class="title">
                <div class="row header">
                    <div class="col-md-8">
                        <h2>Séjours de l'enfant</h2>
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

        </div>
        <div class="col-md-3 address">
            <div class="row">
                <?php  


                ?>
                <div class="contact">
                    <?php if(!empty($enfant->father_phone_pro) || !empty($enfant->father_phone_mobile) || !empty($enfant->father_phone_home)): ?>
                        <h6>Père</h6>
                        <p><?=(!empty($enfant->father_name))? $enfant->father_name : EMPTYVAL; ?></p>
                        <p><?=(!empty($enfant->father_phone_home))? '<i class="icon-phone"></i> <strong>Fixe :</strong> '.$enfant->father_phone_home : ''; ?></p>
                        <p><?=(!empty($enfant->father_phone_mobile))? '<i class="icon-phone"></i> <strong>Portable :</strong> '.$enfant->father_phone_mobile : ''; ?></p>
                        <p><?=(!empty($enfant->father_phone_pro))? '<i class="icon-phone"></i> <strong>Pro :</strong> '.$enfant->father_phone_pro : ''; ?></p>
                    <?php endif; ?>
                </div>
                <div class="contact">
                    <?php if(!empty($enfant->mother_phone_pro) || !empty($enfant->mother_phone_mobile) || !empty($enfant->mother_phone_home)): ?>
                        <h6>Mère</h6>
                        <p><?=(!empty($enfant->mother_name))? $enfant->mother_name : EMPTYVAL; ?></p>
                        <p><?=(!empty($enfant->mother_phone_home))? '<i class="icon-phone"></i> <strong>Fixe :</strong> '.$enfant->mother_phone_home : ''; ?></p>
                        <p><?=(!empty($enfant->mother_phone_mobile))? '<i class="icon-phone"></i> <strong>Portable :</strong> '.$enfant->mother_phone_mobile : ''; ?></p>
                        <p><?=(!empty($enfant->mother_phone_pro))? '<i class="icon-phone"></i> <strong>Pro :</strong> '.$enfant->mother_phone_pro : ''; ?></p>
                    <?php endif; ?>
                </div>
                <div class="contact">
                    <?php if(!empty($enfant->guardian_phone_pro) && !empty($enfant->guardian_phone_mobile) && !empty($enfant->guardian_phone_home)): ?>
                        <h6>Responsable légale</h6>
                        <p><?=(!empty($enfant->guardian_name))? $enfant->guardian_name : EMPTYVAL; ?> 
                            <p><?=(!empty($enfant->guardian_phone_home))? '<i class="icon-phone"></i> <strong>Fixe :</strong> '.$enfant->guardian_phone_home : ''; ?></p>
                            <p><?=(!empty($enfant->guardian_phone_mobile))? '<i class="icon-phone"></i> <strong>Portable :</strong> '.$enfant->guardian_phone_mobile : ''; ?></p>
                            <p><?=(!empty($enfant->guardian_phone_pro))? '<i class="icon-phone"></i> <strong>Pro :</strong> '.$enfant->guardian_phone_pro : ''; ?></p>
                        <?php endif; ?>

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
                                <p><?=(!empty($enfant->host_family_phone_home))? '<i class="icon-phone"></i> <strong>Fixe :</strong> '.$enfant->host_family_phone_home : ''; ?></p>
                                <p><?=(!empty($enfant->host_family_phone_mobile))? '<i class="icon-phone"></i> <strong>Portable :</strong> '.$enfant->host_family_phone_mobile : ''; ?></p>
                                <p><?=(!empty($enfant->host_family_phone_pro))? '<i class="icon-phone"></i> <strong>Pro :</strong> '.$enfant->host_family_phone_pro : ''; ?></p>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>


    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>