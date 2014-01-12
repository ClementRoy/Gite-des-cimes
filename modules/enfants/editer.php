    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
    <?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>


     <?php $enfant = enfant::get($_GET['id']); ?>
       
    <div class="content">
        <div id="pad-wrapper" class="form-page">
            <div class="row header">
                <div class="col-md-12">
                    <h3>Editer <?=$enfant->firstname.' '.$enfant->lastname; ?></h3>
                </div>
            </div>

         <?php //tool::output($enfant); ?>

            <?php if(isset($_POST['submit'])): ?>
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
                            L'enfant <?=$form_enfant_prenom; ?> <?=$form_enfant_nom; ?> a bien été modifié
                        </div>
                        <a href="/enfants/">Retourner à la liste des enfants</a>
                    </div>
                </div>
                <?php else: ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-danger">
                            <i class="icon-remove-sign"></i> 
                            Une erreur s'est produite durant l'ajout de l'enfant, veuillez réessayer
                        </div>
                        <a href="/enfants/ajouter">Retourner au formulaire d'ajout</a>
                    </div>
                </div>
                <?php endif; ?>
            <?php else: ?>
            <form id="form-add-children" method="post" parsley-validate>
                   <!--  <h2>Informations sur l'enfant</h2> -->
                     <div class="row form-wrapper">
                        <div class="field-box row">
                            <label class="col-md-2" for="form-enfant-prenom">Prénom</label>
                            <div class="col-md-4 col-sm-5">
                                <input id="form-enfant-prenom" name="form_enfant_prenom" class="form-control" type="text" data-toggle="tooltip" title="Renseignez le prénom de l'enfant." parsley-required="true" value="<?=$enfant->firstname; ?>">
                            </div>                            
                        </div>
                        <div class="field-box row">
                            <label class="col-md-2" for="form-enfant-nom">Nom</label>
                            <div class="col-md-4 col-sm-5">
                                <input id="form-enfant-nom" name="form_enfant_nom" class="form-control" type="text" data-toggle="tooltip" title="Renseignez le nom de l'enfant." parsley-required="true" value="<?=$enfant->lastname; ?>">
                            </div>                            
                        </div>
                        <div class="field-box row">
                            <label class="col-md-2" for="form-enfant-naissance">Date de naissance</label>
                            <div class="col-md-4 col-sm-5">
                                <input parsley-regexp="([0-3][0-9]|[1-9])/([1-9]|1[0-2]|0[1-9])/([1-2][0|9][0-9]{2})" id="form-enfant-naissance"  name="form_enfant_naissance" type="text" class="form-control input-datepicker" placeholder="JJ/MM/AAAA" data-toggle="tooltip" title="Renseignez la date de naissance de l'enfant (jj/mm/aaaa)." value="<?=tool::getDatefromDatetime($enfant->birthdate) ?>">
                            </div>                            
                        </div>
                        <div class="field-box row">
                            <label class="col-md-2">Sexe de l'enfant</label>
                            <div class="col-md-4 col-sm-5" data-toggle="tooltip" title="Précisez le sexe de l'enfant.">
                                <label class="radio" for="form-enfant-sexe-m">
                                    <div class="radio" id="uniform-form-enfant-sex-m">
                                        <span<?php if ($enfant->sex != 'féminin'): ?> class="checked"<?php endif ?>>
                                            <input type="radio" name="form_enfant_sexe" id="form-enfant-sexe-m" value="masculin"<?php if ($enfant->sex != 'féminin'): ?> checked="checked"<?php endif ?>>
                                        </span>
                                    </div>
                                    Masculin
                                </label>
                                <label class="radio" for="form-enfant-sexe-f">
                                    <div class="radio" id="uniform-form-enfant-sex-f">
                                        <span<?php if ($enfant->sex == 'féminin'): ?> class="checked"<?php endif ?>>
                                            <input type="radio" name="form_enfant_sexe" id="form-enfant-sexe-f" value="féminin"<?php if ($enfant->sex == 'féminin'): ?> checked="checked"<?php endif ?>>
                                        </span>
                                    </div>
                                    Féminin
                                </label>
                            </div>                            
                        </div>

                        <!-- <h2>Informations administratives</h2> -->
                        <div class="field-box row">
                            <label class="col-md-2">L'enfant est inscrit par</label>
                            <div class="col-md-4 col-sm-5" data-toggle="tooltip" title="Précisez qui a inscrit cet enfant au séjour/week-end.">
                                <label class="radio" for="form-enfant-inscription-structure">
                                    <div class="radio" id="uniform-form-enfant-inscription-structure">
                                        <span <?php if ($enfant->registration_by != 'particulier'): ?> class="checked"<?php endif ?>>
                                            <input type="radio" name="form_enfant_inscription" id="form-enfant-inscription-structure" value="structure"<?php if ($enfant->registration_by != 'particulier'): ?> checked="checked"<?php endif ?>>
                                        </span>
                                    </div>
                                    Une structure
                                </label>
                                <label class="radio" for="form-enfant-inscription-particulier">
                                    <div class="radio" id="uniform-form-enfant-inscription-particulier">
                                        <span<?php if ($enfant->registration_by == 'particulier'): ?> class="checked"<?php endif ?>>
                                            <input type="radio" name="form_enfant_inscription" id="form-enfant-inscription-particulier" value="particulier"<?php if ($enfant->registration_by == 'particulier'): ?> checked="checked"<?php endif ?>>
                                        </span>
                                    </div>
                                    Un particulier
                                </label>
                            </div>                            
                        </div>


                            <div data-group="structure">
                                <div class="field-box row">
                                    <label class="col-md-2" for="form-enfant-structure-select">Nom de la structure</label>
                                    <div class="col-md-4 col-sm-5" data-toggle="tooltip" title="Sélectionnez la structure qui s'occupe de cet enfant.">
                                        <div class="ui-select">
                                            <?php $structures = structure::getList(); ?>
                                            <select id="form-enfant-structure-select" name="form_enfant_structure">
                                                <option value="" selected="selected">Sélectionnez la structure</option>
                                                <?php foreach($structures as $structure): ?>
                                                <option value="<?=$structure->id ?>" <?php if($structure->id == $enfant->organization): ?>selected="selected"<?php endif; ?>><?=$structure->name ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <?php //TODO : ajouter la possibilité de créer une sutrcutre à la volée ?>
                                    </div>
                                </div>
                                <div class="field-box row">
                                    <label class="col-md-2" for="form-enfant-contact-select">Nom du contact</label>
                                    <div class="col-md-4 col-sm-5" data-toggle="tooltip" title="Sélectionnez le contact responsable de l'enfant.">
                                        <div class="ui-select">
                                            <select id="form-enfant-contact-select" name="form_enfant_contact">
                                                <option selected="">Sélectionnez un contact</option>
                                            </select>
                                        </div>
                                        <?php // TODO : ajouter la possibilité de créer une structure à la volée ?>
                                    </div>
                                </div>
                            </div>

                            <div class="field-box row">
                                <label class="col-md-2">Responsable légal de l'enfant</label>
                                <div class="col-md-4 col-sm-5" data-toggle="tooltip" title="Précisez qui est le responsable légal de l'enfant.">
                                    <label class="radio" for="form-enfant-responsable-structure">
                                        <div class="radio" id="uniform-form-enfant-responsable-structure">
                                            <span <?php if ($enfant->guardian == 'structure'): ?> class="checked"<?php endif ?>>
                                                <input type="radio" name="form_enfant_responsable" id="form-enfant-responsable-structure" value="structure" <?php if ($enfant->guardian == 'structure'): ?> checked="checked"<?php endif ?>>
                                            </span>
                                        </div>
                                        Structure
                                    </label>
                                    <label class="radio" for="form-enfant-responsable-parents">
                                        <div class="radio" id="uniform-form-enfant-responsable-parents">
                                            <span <?php if ($enfant->guardian == 'parents'): ?> class="checked"<?php endif ?>>
                                                <input type="radio" name="form_enfant_responsable" id="form-enfant-responsable-parents" value="parents" <?php if ($enfant->guardian == 'parents'): ?> checked="checked"<?php endif ?>>
                                            </span>
                                        </div>
                                        Parents
                                    </label>
                                    <label class="radio" for="form-enfant-responsable-pere">
                                        <div class="radio" id="uniform-form-enfant-responsable-pere">
                                            <span <?php if ($enfant->guardian == 'pere'): ?> class="checked"<?php endif ?>>
                                                <input type="radio" name="form_enfant_responsable" id="form-enfant-responsable-pere" value="pere"<?php if ($enfant->guardian == 'pere'): ?> checked="checked"<?php endif ?>>
                                            </span>
                                        </div>
                                        Père
                                    </label>
                                    <label class="radio" for="form-enfant-responsable-mere">
                                        <div class="radio" id="uniform-form-enfant-responsable-mere">
                                            <span<?php if ($enfant->guardian == 'mere'): ?> class="checked"<?php endif ?>>
                                                <input type="radio" name="form_enfant_responsable" id="form-enfant-responsable-mere" value="mere"<?php if ($enfant->guardian == 'mere'): ?> checked="checked"<?php endif ?>>
                                            </span>
                                        </div>
                                        Mère
                                    </label>
                                    <label class="radio" for="form-enfant-responsable-tuteur">
                                        <div class="radio" id="uniform-form-enfant-responsable-tuteur">
                                            <span<?php if ($enfant->guardian == 'tuteur'): ?> class="checked"<?php endif ?>>
                                                <input type="radio" name="form_enfant_responsable" id="form-enfant-responsable-tuteur" value="tuteur"<?php if ($enfant->guardian == 'tuteur'): ?> checked="checked"<?php endif ?>>
                                            </span>
                                        </div>
                                        Tuteur
                                    </label>
                                </div>                            
                            </div>

                            <div data-responsable="parents">
                                <div data-responsable="pere">
                                    <div class="field-box row">
                                        <label class="col-md-2" for="form-enfant-nom-pere">Nom du père</label>
                                        <div class="col-md-4 col-sm-5">
                                            <input id="form-enfant-nom-pere" value="<?=$enfant->father_name; ?>" name="form_enfant_nom_pere" class="form-control input-sm" type="text" data-toggle="tooltip" title="Renseignez le nom et prénom du père.">
                                        </div>
                                    </div>
                                    <div class="field-box row">
                                        <label class="col-md-2" for="form-enfant-telephone-fixe-pere">Téléphone fixe</label>
                                        <div class="col-md-4 col-sm-5">
                                            <input id="form-enfant-telephone-pere" value="<?=$enfant->father_phone_home; ?>" name="form_enfant_telephone_fixe_pere" class="form-control input-sm" type="text" data-toggle="tooltip" title="Renseignez le numéro de téléphone fixe du père.">
                                        </div>
                                    </div>
                                    <div class="field-box row">
                                        <label class="col-md-2" for="form-enfant-telephone-portable-pere">Téléphone portable</label>
                                        <div class="col-md-4 col-sm-5">
                                            <input id="form-enfant-telephone-pere" value="<?=$enfant->father_phone_mobile; ?>" name="form_enfant_telephone_portable_pere" class="form-control input-sm" type="text" data-toggle="tooltip" title="Renseignez le numéro de téléphone portable du père.">
                                        </div>
                                    </div>
                                    <div class="field-box row">
                                        <label class="col-md-2" for="form-enfant-telephone-professionnel-pere">Téléphone professionnel</label>
                                        <div class="col-md-4 col-sm-5">
                                            <input id="form-enfant-professionnel-pere" value="<?=$enfant->father_phone_pro; ?>" name="form_enfant_telephone_professionnel_pere" class="form-control input-sm" type="text" data-toggle="tooltip" title="Renseignez le numéro de téléphone professionnel du père.">
                                        </div>
                                    </div>
                                    <div class="field-box row">
                                        <label class="col-md-2" for="form-enfant-adresse-numero-pere">Adresse du père</label>
                                        <div class="col-md-4 col-sm-5">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <input id="form-enfant-adresse-numero-pere" value="<?=$enfant->father_address_number; ?>" name="form_enfant_adresse_numero_pere" class="form-control input-sm adresse-numero" type="text" placeholder="N°" data-toggle="tooltip" title="Renseignez le numéro de l'adresse du père.">
                                                </div>
                                                <div class="col-md-9"><input id="form-enfant-adresse-voirie-pere" value="<?=$enfant->father_address_street; ?>" name="form_enfant_adresse_voirie_pere" class="form-control input-sm adresse-voirie" type="text" placeholder="Nom de la voirie" data-toggle="tooltip" title="Renseignez le nom de la voirie de l'adresse du père."></div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-4"><input id="form-enfant-adresse-code-postal-pere" value="<?=$enfant->father_address_postal_code; ?>" name="form_enfant_adresse_code_postal_pere" class="form-control input-sm adresse-postal" type="text" placeholder="Code postal" data-toggle="tooltip" title="Renseignez le code postal de la ville du père."></div>
                                                <div class="col-md-8"><input id="form-enfant-adresse-code-ville-pere" value="<?=$enfant->father_address_city; ?>" name="form_enfant_adresse_code_ville_pere" class="form-control input-sm adresse-ville" type="text" placeholder="Ville" data-toggle="tooltip" title="Renseignez le nom de la ville du père."></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div data-responsable="mere">
                                    <div class="field-box row">
                                        <label class="col-md-2" for="form-enfant-nom-mere">Nom de la mère</label>
                                        <div class="col-md-4 col-sm-5">
                                            <input id="form-enfant-nom-mere" value="<?=$enfant->mother_name; ?>" name="form_enfant_nom_mere" class="form-control input-sm" type="text" data-toggle="tooltip" title="Renseignez le nom et prénom de la mère.">
                                        </div>
                                    </div>
                                    <div class="field-box row">
                                        <label class="col-md-2" for="form-enfant-telephone-fixe-mere">Téléphone fixe</label>
                                        <div class="col-md-4 col-sm-5">
                                            <input id="form-enfant-telephone-fixe-mere" value="<?=$enfant->mother_phone_home; ?>" name="form_enfant_telephone_fixe_mere" class="form-control input-sm" type="text" data-toggle="tooltip" title="Renseignez le numéro de téléphone fixe de la mère.">
                                        </div>
                                    </div>
                                    <div class="field-box row">
                                        <label class="col-md-2" for="form-enfant-telephone-portable-mere">Téléphone portable</label>
                                        <div class="col-md-4 col-sm-5">
                                            <input id="form-enfant-telephone-portable-mere" value="<?=$enfant->mother_phone_mobile; ?>" name="form_enfant_telephone_portable_mere" class="form-control input-sm" type="text" data-toggle="tooltip" title="Renseignez le numéro de téléphone portable de la mère.">
                                        </div>
                                    </div>
                                    <div class="field-box row">
                                        <label class="col-md-2" for="form-enfant-telephone-professionnel-mere">Téléphone professionnel</label>
                                        <div class="col-md-4 col-sm-5">
                                            <input id="form-enfant-telephone-professionnel-mere" value="<?=$enfant->mother_phone_pro; ?>" name="form_enfant_telephone_professionnel_mere" class="form-control input-sm" type="text" data-toggle="tooltip" title="Renseignez le numéro de téléphone professionnel de la mère.">
                                        </div>
                                    </div>
                                    <div class="field-box row">
                                        <label class="col-md-2" for="form-enfant-adresse-numero-mere">Adresse de la mère</label>
                                        <div class="col-md-4 col-sm-5">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <input id="form-enfant-adresse-numero-mere" value="<?=$enfant->mother_address_number; ?>" name="form_enfant_adresse_numero_mere" class="form-control input-sm adresse-numero" type="text" placeholder="N°" data-toggle="tooltip" title="Renseignez le numéro de l'adresse de la mère.">
                                                </div>
                                                <div class="col-md-9"><input id="form-enfant-adresse-voirie-mere" value="<?=$enfant->mother_address_street; ?>" name="form_enfant_adresse_voirie_mere" class="form-control input-sm adresse-voirie" type="text" placeholder="Nom de la voirie" data-toggle="tooltip" title="Renseignez le nom de la voirie de l'adresse de la mère."></div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-4"><input id="form-enfant-adresse-code-postal-mere" value="<?=$enfant->mother_address_postal_code; ?>" name="form_enfant_adresse_code_postal_mere" class="form-control input-sm adresse-postal" type="text" placeholder="Code postal" data-toggle="tooltip" title="Renseignez le code postal de la ville de la mère."></div>
                                                <div class="col-md-8"><input id="form-enfant-adresse-code-ville-mere" value="<?=$enfant->mother_address_city; ?>" name="form_enfant_adresse_code_ville_mere" class="form-control input-sm adresse-ville" type="text" placeholder="Ville" data-toggle="tooltip" title="Renseignez le nom de la ville de la mère."></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div data-responsable="tuteur">
                                <div class="field-box row">
                                    <label class="col-md-2" for="form-enfant-nom-tuteur">Nom du tuteur</label>
                                    <div class="col-md-4 col-sm-5">
                                        <input id="form-enfant-nom-tuteur" value="<?=$enfant->guardian_name; ?>" name="form_enfant_nom_tuteur" class="form-control input-sm" type="text" data-toggle="tooltip" title="Renseignez le nom et prénom du tuteur.">
                                    </div>
                                </div>
                                <div class="field-box row">
                                    <label class="col-md-2" for="form-enfant-telephone-fixe-tuteur">Téléphone fixe</label>
                                    <div class="col-md-4 col-sm-5">
                                        <input id="form-enfant-telephone-fixe-tuteur" value="<?=$enfant->guardian_phone_home; ?>" name="form_enfant_telephone_fixe_tuteur" class="form-control input-sm" type="text" data-toggle="tooltip" title="Renseignez le numéro de téléphone fixe du tuteur.">
                                    </div>
                                </div>
                                <div class="field-box row">
                                    <label class="col-md-2" for="form-enfant-telephone-portable-tuteur">Téléphone portable</label>
                                    <div class="col-md-4 col-sm-5">
                                        <input id="form-enfant-telephone-portable-tuteur" value="<?=$enfant->guardian_phone_mobile; ?>" name="form_enfant_telephone_portable_tuteur" class="form-control input-sm" type="text" data-toggle="tooltip" title="Renseignez le numéro de téléphone portable du tuteur.">
                                    </div>
                                </div>
                                <div class="field-box row">
                                    <label class="col-md-2" for="form-enfant-telephone-travail-tuteur">Téléphone professionnel</label>
                                    <div class="col-md-4 col-sm-5">
                                        <input id="form-enfant-telephone-professionnel-tuteur" value="<?=$enfant->guardian_phone_pro; ?>" name="form_enfant_telephone_professionnel_tuteur" class="form-control input-sm" type="text" data-toggle="tooltip" title="Renseignez le numéro de téléphone professionnel du tuteur.">
                                    </div>
                                </div>
                                <div class="field-box row">
                                    <label class="col-md-2" for="form-enfant-adresse-numero-tuteur">Adresse du tuteur</label>
                                    <div class="col-md-4 col-sm-5">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <input id="form-enfant-adresse-numero-tuteur" value="<?=$enfant->guardian_address_number; ?>" name="form_enfant_adresse_numero_tuteur" class="form-control input-sm adresse-numero" type="text" placeholder="N°" data-toggle="tooltip" title="Renseignez le numéro de l'adresse du tuteur.">
                                            </div>
                                            <div class="col-md-9"><input id="form-enfant-adresse-voirie-tuteur" value="<?=$enfant->guardian_address_street; ?>" name="form_enfant_adresse_voirie_tuteur" class="form-control input-sm adresse-voirie" type="text" placeholder="Nom de la voirie" data-toggle="tooltip" title="Renseignez le nom de la voirie de l'adresse du tuteur."></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4"><input id="form-enfant-adresse-code-postal-tuteur" value="<?=$enfant->guardian_address_postal_code; ?>" name="form_enfant_adresse_code_postal_tuteur" class="form-control input-sm adresse-postal" type="text" placeholder="Code postal" data-toggle="tooltip" title="Renseignez le code postal de la ville du tuteur."></div>
                                            <div class="col-md-8"><input id="form-enfant-adresse-code-ville-tuteur" value="<?=$enfant->guardian_address_city; ?>" name="form_enfant_adresse_code_ville_tuteur" class="form-control input-sm adresse-ville" type="text" placeholder="Ville" data-toggle="tooltip" title="Renseignez le nom de la ville du tuteur."></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <div class="field-box row">
                            <label class="col-md-2">Domiciliation de l'enfant</label>
                            <div class="col-md-4 col-sm-5" data-toggle="tooltip" title="Précisez chez qui habite l'enfant.">
                                <label class="radio" for="form-enfant-domiciliation-responsable">
                                    <div class="radio" id="uniform-form-enfant-domiciliation-responsable">
                                        <span<?php if ($enfant->domiciliation != 'famille'): ?> class="checked"<?php endif ?>>
                                            <input type="radio" name="form_enfant_domiciliation" id="form-enfant-domiciliation-responsable" value="responsable"<?php if ($enfant->domiciliation != 'famille'): ?> checked="checked"<?php endif ?>>
                                        </span>
                                    </div>
                                    Responsable légal
                                </label>
                                <label class="radio" for="form-enfant-domiciliation-famille">
                                    <div class="radio" id="uniform-form-enfant-domiciliation-famille">
                                        <span<?php if ($enfant->domiciliation == 'famille'): ?> class="checked"<?php endif ?>>
                                            <input type="radio" name="form_enfant_domiciliation" id="form-enfant-domiciliation-famille" value="famille"<?php if ($enfant->domiciliation == 'famille'): ?> checked="checked"<?php endif ?>>
                                        </span>
                                    </div>
                                    Famille d'accueil
                                </label>
                            </div>
                        </div>

                        <div data-domiciliation="famille">
                            <div class="field-box row">
                                <label class="col-md-2" for="form-enfant-nom-famille">Nom de la famille d'accueil</label>
                                <div class="col-md-4 col-sm-5">
                                    <input id="form-enfant-nom-famille" value="<?=$enfant->host_family_name; ?>" name="form_enfant_nom_famille" class="form-control input-sm" type="text" data-toggle="tooltip" title="Renseignez le nom de la famille d'accueil.">
                                </div>
                            </div>

                            <div class="field-box row">
                                <label class="col-md-2" for="form-enfant-telephone-fixe-famille">Téléphone fixe</label>
                                <div class="col-md-4 col-sm-5">
                                    <input id="form-enfant-pere-telephone" value="<?=$enfant->host_family_phone_home; ?>" name="form_enfant_telephone_fixe_famille" class="form-control input-sm" type="text" data-toggle="tooltip" title="Renseignez le numéro de téléphone fixe de la famille d'accueil.">
                                </div>
                            </div>
                            <div class="field-box row">
                                <label class="col-md-2" for="form-enfant-telephone-portable-famille">Téléphone portable</label>
                                <div class="col-md-4 col-sm-5">
                                    <input id="form-enfant-telephone-portable-famille" value="<?=$enfant->host_family_phone_mobile; ?>" name="form_enfant_telephone_portable_famille" class="form-control input-sm" type="text" data-toggle="tooltip" title="Renseignez le numéro de téléphone portable de la famille d'accueil.">
                                </div>
                            </div>
                            <div class="field-box row">
                                <label class="col-md-2" for="form-enfant-telephone-professionnel-famille">Téléphone professionnel</label>
                                <div class="col-md-4 col-sm-5">
                                    <input id="form-enfant-telephone-professionnel-famille" value="<?=$enfant->host_family_phone_pro; ?>" name="form_enfant_telephone_professionnel_famille" class="form-control input-sm" type="text" data-toggle="tooltip" title="Renseignez le numéro de téléphone professionnel de la famille d'accueil.">
                                </div>
                            </div>

                            <div class="field-box row">
                                <label class="col-md-2" for="form-enfant-adresse-numero-famille">Adresse de la famille d'accueil</label>
                                <div class="col-md-4 col-sm-5">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <input id="form-enfant-adresse-numero-famille" value="<?=$enfant->host_family_address_number; ?>" name="form_enfant_adresse_numero_famille" class="form-control input-sm adresse-numero" type="text" placeholder="N°" data-toggle="tooltip" title="Renseignez le numéro de l'adresse de la famille d'accueil.">
                                        </div>
                                        <div class="col-md-9"><input id="form-enfant-adresse-voirie-famille" value="<?=$enfant->host_family_address_street; ?>" name="form_enfant_adresse_voirie_famille" class="form-control input-sm adresse-voirie" type="text" placeholder="Nom de la voirie" data-toggle="tooltip" title="Renseignez le nom de la voirie de l'adresse de la famille d'accueil."></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4"><input id="form-enfant-adresse-code-postal-famille" value="<?=$enfant->host_family_address_postal_code; ?>" name="form_enfant_adresse_code_postal_famille" class="form-control input-sm adresse-postal" type="text" placeholder="Code postal" data-toggle="tooltip" title="Renseignez le code postal de la ville de la famille d'accueil."></div>
                                        <div class="col-md-8"><input id="form-enfant-adresse-code-ville-famille" value="<?=$enfant->host_family_address_city; ?>" name="form_enfant_adresse_code_ville_famille" class="form-control input-sm adresse-ville" type="text" placeholder="Ville" data-toggle="tooltip" title="Renseignez le nom de la ville de la famille d'accueil."></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="field-box row">
                            <label class="col-md-2" for="form-enfant-nom-urgence">Contact d'urgence</label>
                            <div class="col-md-4 col-sm-5">
                                <input id="form-enfant-nom-urgence" value="<?=$enfant->emergency_name; ?>" name="form_enfant_nom_urgence" class="form-control input-sm" type="text" data-toggle="tooltip" title="Renseignez le nom et prénom de la personne à contacter en cas d'urgence.">
                            </div>
                        </div>
                        <div class="field-box row">
                            <label class="col-md-2" for="form-enfant-telephone-urgence">Téléphone d'urgence</label>
                            <div class="col-md-4 col-sm-5">
                                <input id="form-enfant-telephone-urgence" value="<?=$enfant->emergency_phone; ?>" name="form_enfant_telephone_urgence" class="form-control input-sm" type="text" data-toggle="tooltip" title="Renseignez le numéro de téléphone de la personne à contacter en cas d'urgence.">
                            </div>
                        </div>

                        <div class="field-box row">
                            <label class="col-md-2">Droit à l'image</label>
                            <div class="col-md-4 col-sm-5" data-toggle="tooltip" title="Précisez si des photos/vidéos de l'enfant peuvent être utilisé par le gîte.">
                                <label class="radio-inline col-md-7" for="form-enfant-droit-image-oui">
                                    <div class="radio" id="uniform-form-enfant-droit-image-oui">
                                        <span<?php if ($enfant->image_rights): ?> class="checked"<?php endif ?>>
                                            <input type="radio" name="form_enfant_droit_image" id="form-enfant-droit-image-oui" value="1"<?php if ($enfant->image_rights): ?> checked="checked"<?php endif ?>>
                                        </span>
                                    </div>
                                    Oui
                                </label>
                                <label class="radio-inline col-md-4 col-sm-5" for="form-enfant-droit-image-non">
                                    <div class="radio" id="uniform-form-enfant-droit-image-non">
                                        <span<?php if (!$enfant->image_rights): ?> class="checked"<?php endif ?>>
                                            <input type="radio" name="form_enfant_droit_image" id="form-enfant-droit-image-non" value="0"<?php if (!$enfant->image_rights): ?> checked="checked"<?php endif ?>>
                                        </span>
                                    </div>
                                    Non
                                </label>
                            </div>
                        </div>
     

                    <!-- <h2>Informations sanitaires</h2> -->
                        <div class="field-box row">
                            <label class="col-md-2">Traitement(s) médical(s)</label>
                            <div class="col-md-4 col-sm-5" data-toggle="tooltip" title="Précisez si l'enfant suit un traitement médical.">
                                <label class="radio-inline col-md-7" for="form-enfant-traitement-medical-oui">
                                    <div class="radio" id="uniform-form-enfant-traitement-medical-oui">
                                        <span<?php if ($enfant->medicals_treatments): ?> class="checked"<?php endif ?>>
                                            <input type="radio" name="form_enfant_traitement_medical" id="form-enfant-traitement-medical-oui"<?php if ($enfant->medicals_treatments): ?> checked="checked"<?php endif ?>>
                                        </span>
                                    </div>
                                    Oui
                                </label>
                                <label class="radio-inline col-md-4 col-sm-5" for="form-enfant-traitement-medical-non">
                                    <div class="radio" id="uniform-form-enfant-traitement-medical-non">
                                        <span<?php if (!$enfant->medicals_treatments): ?> class="checked"<?php endif ?>>
                                            <input type="radio" name="form_enfant_traitement_medical" id="form-enfant-traitement-medical-non" value="0"<?php if (!$enfant->medicals_treatments): ?> checked="checked"<?php endif ?>>
                                        </span>
                                    </div>
                                    Non
                                </label>
                            </div>
                        </div>
                        <div class="field-box row">
                            <label class="col-md-2" for="form-enfant-contre-indication">Contre-indications / allergies</label>
                            <div class="col-md-4 col-sm-5">
                                <textarea id="form-enfant-contre-indication" name="form_enfant_contre_indication" class="form-control" rows="4" data-toggle="tooltip" title="Renseignez les contre-indication(s) et/ou allergie(s) connue(s) de l'enfant."><?=$enfant->allergies; ?></textarea>
                            </div>
                        </div>

                        <div class="field-box row">
                            <label class="col-md-2" for="form-enfant-numero-securite">N° de sécurité sociale</label>
                            <div class="col-md-4 col-sm-5">
                                <input id="form-enfant-numero-securite" name="form_enfant_numero_securite" class="form-control" type="text" data-toggle="tooltip" title="Renseignez le numéro de sécurité sociale de l'enfant." value="<?=$enfant->number_ss; ?>">
                            </div>                            
                        </div>

                        <div class="field-box row">
                            <label class="col-md-2">Assurance (RC)</label>
                            <div class="col-md-4 col-sm-5" data-toggle="tooltip" title="Précisez si l'enfant est convert par une assurance (responsabilité civile).">
                                <label class="radio-inline col-md-7" for="form-enfant-assurance-oui">
                                    <div class="radio" id="uniform-form-enfant-assurance-oui">
                                        <span<?php if ($enfant->self_assurance): ?> class="checked"<?php endif ?>>
                                            <input type="radio" name="form_enfant_assurance" id="form-enfant-assurance-oui" value="1"<?php if ($enfant->self_assurance): ?> checked="checked"<?php endif ?>>
                                        </span>
                                    </div>
                                    Oui
                                </label>
                                <label class="radio-inline col-md-4 col-sm-5">
                                    <div class="radio" id="uniform-form-enfant-assurance-non">
                                        <span<?php if (!$enfant->self_assurance): ?> class="checked"<?php endif ?>>
                                            <input type="radio" name="form_enfant_assurance" id="form-enfant-assurance-non" value="0"<?php if (!$enfant->self_assurance): ?> checked="checked"<?php endif ?>>
                                        </span>
                                    </div>
                                    Non
                                </label>
                            </div>
                        </div>
                        <div data-assurance="oui">
                            <div class="field-box row">
                                <label class="col-md-2" for="form-enfant-assurance-validite">Date de fin de validité</label>
                                <div class="col-md-4 col-sm-5">
                                    <input id="form-enfant-assurance-validite" name="form_enfant_assurance_validite" type="text" class="form-control input-datepicker" value="<?=$enfant->self_assurance_expiration_date; ?>" data-toggle="tooltip" title="Renseignez la date de fin de validité de l'assurance (jj/mm/aaaa)." value="<?=$enfant->self_assurance_expiration_date; ?>">
                                </div>                            
                            </div>
                        </div>
                        <div class="field-box row">
                            <label class="col-md-2">Attestation CPAM</label>
                            <div class="col-md-4 col-sm-5" data-toggle="tooltip" title="Précisez si l'attestation CPAM est dans le dossier de l'enfant.">
                                <label class="radio-inline col-md-7" for="form-enfant-attestation-cpam-oui">
                                    <div class="radio" id="uniform-form-enfant-attestation-cpam-oui">
                                        <span<?php if ($enfant->cpam_attestation): ?> class="checked"<?php endif ?>>
                                            <input type="radio" name="form_enfant_attestation_cpam" id="form-enfant-attestation-cpam-oui" value="1"<?php if ($enfant->cpam_attestation): ?> checked="checked"<?php endif ?>>
                                        </span>
                                    </div>
                                    Oui
                                </label>
                                <label class="radio-inline col-md-4 col-sm-5">
                                    <div class="radio" id="uniform-form-enfant-attestation-cpam-non">
                                        <span<?php if (!$enfant->cpam_attestation): ?> class="checked"<?php endif ?>>
                                            <input type="radio" name="form_enfant_attestation_cpam" id="form-enfant-attestation-cpam-non" value="0"<?php if (!$enfant->cpam_attestation): ?> checked="checked"<?php endif ?>>
                                        </span>
                                    </div>
                                    Non
                                </label>
                            </div>
                        </div>
                        <div data-cpam="oui">
                            <div class="field-box row">
                                <label class="col-md-2" for="form-enfant-cpam-validite">Date de fin de validité</label>
                                <div class="col-md-4 col-sm-5">
                                    <input id="form-enfant-cpam-validite" name="form_enfant_cpam_validite" type="text" value="<?=$enfant->cpam_attestation_expiration_date; ?>" class="form-control input-datepicker" data-toggle="tooltip" title="Renseignez la date de fin de validité de l'attestation CPAM (jj/mm/aaaa).">
                                </div>                            
                            </div>
                        </div>
                        <div class="field-box row">
                            <label class="col-md-2">Carnet de vaccination</label>
                            <div class="col-md-4 col-sm-5" data-toggle="tooltip" title="Précisez si le carnet de vaccination est dans le dossier de l'enfant.">
                                <label class="radio-inline col-md-7" for="form-enfant-carnet-vaccination-oui">
                                    <div class="radio" id="uniform-form-enfant-carnet-vaccination-oui">
                                        <span<?php if ($enfant->vaccination): ?> class="checked"<?php endif ?>>
                                            <input type="radio" name="form_enfant_carnet_vaccination" id="form-enfant-carnet-vaccination-oui" value="1"<?php if ($enfant->vaccination): ?> checked="checked"<?php endif ?>>
                                        </span>
                                    </div>
                                    Oui
                                </label>
                                <label class="radio-inline col-md-4 col-sm-5" for="form-enfant-carnet-vaccination-non">
                                    <div class="radio" id="uniform-form-enfant-carnet-vaccination-non">
                                        <span<?php if (!$enfant->vaccination): ?> class="checked"<?php endif ?>>
                                            <input type="radio" name="form_enfant_carnet_vaccination" id="form-enfant-carnet-vaccination-non" value="0"<?php if (!$enfant->vaccination): ?> checked="checked"<?php endif ?>>
                                        </span>
                                    </div>
                                    Non
                                </label>
                            </div>
                        </div>
                        <div class="field-box row">
                            <label class="col-md-2">Fiche sanitaire de liaison</label>
                            <div class="col-md-4 col-sm-5" data-toggle="tooltip" title="Précisez si la fiche sanitaire de liaison est dans le dossier de l'enfant.">
                                <label class="radio-inline col-md-7" for="form-enfant-fiche-sanitaire-oui">
                                    <div class="radio" id="uniform-form-enfant-fiche-sanitaire-oui">
                                        <span<?php if ($enfant->health_record): ?> class="checked"<?php endif ?>>
                                            <input type="radio" name="form_enfant_fiche_sanitaire" id="form-enfant-fiche-sanitaire-oui" value="1"<?php if ($enfant->health_record): ?> checked="checked"<?php endif ?>>
                                        </span>
                                    </div>
                                    Oui
                                </label>
                                <label class="radio-inline col-md-4 col-sm-5" for="form-enfant-fiche-sanitaire-non">
                                    <div class="radio" id="uniform-form-enfant-fiche-sanitaire-non">
                                        <span<?php if (!$enfant->health_record): ?> class="checked"<?php endif ?>>
                                            <input type="radio" name="form_enfant_fiche_sanitaire" id="form-enfant-fiche-sanitaire-non" value="0"<?php if (!$enfant->health_record): ?> checked="checked"<?php endif ?>>
                                        </span>
                                    </div>
                                    Non
                                </label>
                            </div>
                        </div>
                        <div class="field-box row">
                            <label class="col-md-2">Fiche de séjour</label>
                            <div class="col-md-4 col-sm-5" data-toggle="tooltip" title="Précisez si la fiche de séjour est dans le dossier de l'enfant.">
                                <label class="radio-inline col-md-7" for="form-enfant-fiche-sejour-oui">
                                    <div class="radio" id="uniform-form-enfant-fiche-sejour-oui">
                                        <span<?php if ($enfant->stay_record): ?> class="checked"<?php endif ?>>
                                            <input type="radio" name="form_enfant_fiche_sejour" id="form-enfant-fiche-sejour-oui" value="1"<?php if ($enfant->stay_record): ?> checked="checked"<?php endif ?>>
                                        </span>
                                    </div>
                                    Oui
                                </label>
                                <label class="radio-inline col-md-4 col-sm-5" for="form-enfant-fiche-sejour-non">
                                    <div class="radio" id="uniform-form-enfant-fiche-sejour-non">
                                        <span<?php if (!$enfant->stay_record): ?> class="checked"<?php endif ?>>
                                            <input type="radio" name="form_enfant_fiche_sejour" id="form-enfant-fiche-sejour-non" value="0"<?php if (!$enfant->stay_record): ?> checked="checked"<?php endif ?>>
                                        </span>
                                    </div>
                                    Non
                                </label>
                            </div>
                        </div>
                         <div class="field-box row">
                            <label class="col-md-2" for="form-enfant-note">Notes</label>
                            <div class="col-md-4 col-sm-5">
                                <textarea id="form-enfant-note" name="form_enfant_note" class="form-control" rows="4" data-toggle="tooltip" title="Notes générales au sujet de l'enfant."><?=$enfant->note; ?></textarea>
                            </div>
                        </div>
                        <input type="submit" class="btn-flat primary" name="submit" value="Valider">
                    </div>
            </form>
            <?php endif; ?>
        </div>
    </div>

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>