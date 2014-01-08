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

         <?php tool::output($enfant); ?>

            <?php if(isset($_POST['submit'])): ?>
            <?php //tool::output($_POST); ?>
            <?php //tool::output($_SESSION); ?>
            <?php 
                extract($_POST);
                // Create enfant entry
                $birthdate = tool::generateDatetime($form_enfant_naissance);
                $assurance_validite = tool::generateDatetime($form_enfant_assurance_validite);

                $datas = array(
                    ':edited' => tool::currentTime(), 
                    ':editor' => user::getCurrentUser(),                  
                    ':firstname' => $form_enfant_prenom,
                    ':lastname' => $form_enfant_nom,
                    ':birthdate' => $birthdate,
                    ':sex' => $form_enfant_sexe,
                    ':registration_by' => $form_enfant_inscription,
                    ':organization' => $form_enfant_structure,
                    ':contact' => $form_enfant_contact,
                    ':guardian' => $form_enfant_responsable,
                    ':father_name' => $form_enfant_pere_nom,
                    ':father_phone' => $form_enfant_pere_telephone,
                    ':mother_name' => $form_enfant_mere_nom,
                    ':mother_phone' => $form_enfant_mere_telephone,
                    ':guardian_name' => $form_enfant_tuteur_nom,
                    ':guardian_phone' => $form_enfant_tuteur_telephone,
                    ':emergency_name' => $form_enfant_urgence_nom,
                    ':emergency_phone' => $form_enfant_urgence_telephone,
                    ':guardian_address_number' => $form_enfant_responsable_adresse_numero,
                    ':guardian_address_street' => $form_enfant_responsable_adresse_voirie,
                    ':guardian_address_postal_code' => $form_enfant_responsable_adresse_code_postal,
                    ':guardian_address_city' => $form_enfant_responsable_adresse_code_ville,
                    ':domiciliation' => $form_enfant_domiciliation,
                    ':host_family_name' => $form_enfant_famille_nom,
                    ':host_family_phone' => $form_enfant_famille_telephone,
                    ':host_family_address_number' => $form_enfant_famille_adresse_numero,
                    ':host_family_address_street' => $form_enfant_famille_adresse_voirie,
                    ':host_family_address_postal_code' => $form_enfant_famille_adresse_code_postal,
                    ':host_family_address_city' => $form_enfant_famille_adresse_code_ville,
                    ':image_rights' => $form_enfant_droit_image,
                    ':medicals_treatments' => $form_enfant_traitement_medical,
                    ':allergies' => $form_enfant_contre_indication,
                    ':number_ss' => $form_enfant_numero_securite,
                    ':self_assurance' => $form_enfant_assurance,
                    ':self_assurance_expiration_date' => $assurance_validite,
                    ':cpam_attestation' => $form_enfant_attestation_cpam,
                    ':vaccination' => $form_enfant_carnet_vaccination,
                    ':health_record' => $form_enfant_fiche_sanitaire,
                    ':stay_record' => $form_enfant_fiche_sejour,
                    ':id' => $_GET['id']
                    );

                $sql = 'UPDATE enfant SET  
                                edited = :edited
                                editor = :editor
                                firstname = :firstname
                                lastname = :lastname
                                birthdate = :birthdate
                                sex = :sex
                                registration_by = :registration_by
                                organization = :organization
                                contact = :contact
                                guardian = :guardian
                                father_name = :father_name
                                father_phone = :father_phone
                                mother_name = :mother_name
                                mother_phone = :mother_phone
                                guardian_name = :guardian_name
                                guardian_phone = :guardian_phone
                                emergency_name = :emergency_name
                                emergency_phone = :emergency_phone
                                guardian_address_number = :guardian_address_number
                                guardian_address_street = :guardian_address_street
                                guardian_address_postal_code = :guardian_address_postal_code
                                guardian_address_city = :guardian_address_city
                                domiciliation = :domiciliation
                                host_family_name = :host_family_name
                                host_family_phone = :host_family_phone
                                host_family_address_number = :host_family_address_number
                                host_family_address_street = :host_family_address_street
                                host_family_address_postal_code = :host_family_address_postal_code
                                host_family_address_city = :host_family_address_city
                                image_rights = :image_rights
                                medicals_treatments = :medicals_treatments
                                allergies = :allergies
                                number_ss = :number_ss
                                self_assurance = :self_assurance
                                self_assurance_expiration_date = :self_assurance_expiration_date
                                cpam_attestation = :cpam_attestation
                                vaccination = :vaccination
                                health_record = :health_record
                                stay_record = :stay_record
                                WHERE id = :id
                                ';

                $result = enfant::update($sql, $datas);

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
                                        <select id="form-enfant-structure-select" name="form_enfant_structure">
                                            <option selected="">Choisissez une structure</option>
                                            <option>Custom selects</option>
                                            <option>Pure css styles</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="field-box row">
                                <label class="col-md-2" for="form-enfant-contact-select">Nom du contact</label>
                                <div class="col-md-4 col-sm-5" data-toggle="tooltip" title="Sélectionnez le contact responsable de l'enfant.">
                                    <div class="ui-select">
                                        <select id="form-enfant-contact-select" name="form_enfant_contact">
                                            <option selected="">Choisissez un contact</option>
                                            <option>Custom selects</option>
                                            <option>Pure css styles</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div data-group="particulier">
                            <div class="field-box row">
                                <label class="col-md-2">Responsable légal de l'enfant</label>
                                <div class="col-md-4 col-sm-5" data-toggle="tooltip" title="Précisez qui est le responsable légal de l'enfant.">
                                    <label class="radio" for="form-enfant-responsable-parents">
                                        <div class="radio" id="uniform-form-enfant-responsable-parents">
                                            <span <?php if ($enfant->guardian != 'pere' || $enfant->guardian != 'mere' || $enfant->guardian != 'tuteur'): ?> class="checked"<?php endif ?>>
                                                <input type="radio" name="form_enfant_responsable" id="form-enfant-responsable-parents" value="parents" <?php if ($enfant->guardian != 'pere' || $enfant->guardian != 'mere' || $enfant->guardian != 'tuteur'): ?> checked="checked"<?php endif ?>>
                                            </span>
                                        </div>
                                        Parents
                                    </label>
                                    <label class="radio">
                                        <div class="radio" id="uniform-form-enfant-responsable-pere">
                                            <span <?php if ($enfant->guardian == 'pere'): ?> class="checked"<?php endif ?>>
                                                <input type="radio" name="form_enfant_responsable" id="form-enfant-responsable-pere" value="pere"<?php if ($enfant->guardian == 'pere'): ?> checked="checked"<?php endif ?>>
                                            </span>
                                        </div>
                                        Père
                                    </label>
                                    <label class="radio">
                                        <div class="radio" id="uniform-form-enfant-responsable-mere">
                                            <span<?php if ($enfant->guardian == 'mere'): ?> class="checked"<?php endif ?>>
                                                <input type="radio" name="form_enfant_responsable" id="form-enfant-responsable-mere" value="mere"<?php if ($enfant->guardian == 'mere'): ?> checked="checked"<?php endif ?>>
                                            </span>
                                        </div>
                                        Mère
                                    </label>
                                    <label class="radio">
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
                                        <label class="col-md-2" for="form-enfant-pere-nom">Nom du père</label>
                                        <div class="col-md-4 col-sm-5">
                                            <input id="form-enfant-pere-nom" name="form_enfant_pere_nom" class="form-control" type="text" data-toggle="tooltip" title="Renseignez le nom et prénom du père." value="<?=$enfant->father_name; ?>">
                                        </div>                            
                                    </div>
                                    <div class="field-box row">
                                        <label class="col-md-2" for="form-enfant-pere-telephone">Téléphone du père</label>
                                        <div class="col-md-4 col-sm-5">
                                            <input id="form-enfant-pere-telephone" name="form_enfant_pere_telephone" class="form-control" type="text" data-toggle="tooltip" title="Renseignez le numéro de téléphone du père." value="<?=$enfant->father_phone; ?>">
                                        </div>                            
                                    </div>
                                </div>

                                <div data-responsable="mere">
                                    <div class="field-box row">
                                        <label class="col-md-2" for="form-enfant-mere-nom">Nom de la mère</label>
                                        <div class="col-md-4 col-sm-5">
                                            <input id="form-enfant-mere-nom" name="form_enfant_mere_nom" class="form-control" type="text" data-toggle="tooltip" title="Renseignez le nom et prénom de la mère." value="<?=$enfant->mother_name; ?>">
                                        </div>                            
                                    </div>
                                    <div class="field-box row">
                                        <label class="col-md-2" for="form-enfant-mere-telephone">Téléphone de la mère</label>
                                        <div class="col-md-4 col-sm-5">
                                            <input id="form-enfant-mere-telephone" name="form_enfant_mere_telephone" class="form-control" type="text" data-toggle="tooltip" title="Renseignez le numéro de téléphone de la mère." value="<?=$enfant->mother_phone; ?>">
                                        </div>                            
                                    </div>
                                </div>
                            </div>

                            <div data-responsable="tuteur">
                                <div class="field-box row">
                                    <label class="col-md-2" for="form-enfant-tuteur-nom">Nom du tuteur</label>
                                    <div class="col-md-4 col-sm-5">
                                        <input id="form-enfant-tuteur-nom" name="form_enfant_tuteur_nom" class="form-control" type="text" data-toggle="tooltip" title="Renseignez le nom et prénom du tuteur." value="<?=$enfant->guardian_name; ?>">
                                    </div>                            
                                </div>
                                <div class="field-box row">
                                    <label class="col-md-2" for="form-enfant-tuteur-telephone">Téléphone du tuteur</label>
                                    <div class="col-md-4 col-sm-5">
                                        <input id="form-enfant-tuteur-telephone" name="form_enfant_tuteur_telephone" class="form-control" type="text" data-toggle="tooltip" title="Renseignez le numéro de téléphone du tuteur." value="<?=$enfant->guardian_phone; ?>">
                                    </div>                            
                                </div>
                            </div>

                            <div class="field-box row">
                                <label class="col-md-2" for="form-enfant-urgence-nom">Contact d'urgence</label>
                                <div class="col-md-4 col-sm-5">
                                    <input id="form-enfant-urgence-nom" name="form_enfant_urgence_nom" class="form-control" type="text" data-toggle="tooltip" title="Renseignez le nom et prénom de la personne à contacter en cas d'urgence." value="<?=$enfant->emergency_name; ?>">
                                </div>                            
                            </div>
                            <div class="field-box row">
                                <label class="col-md-2" for="form-enfant-urgence-telephone">Téléphone d'urgence</label>
                                <div class="col-md-4 col-sm-5">
                                    <input id="form-enfant-urgence-telephone" name="form_enfant_urgence_telephone" class="form-control" type="text" data-toggle="tooltip" title="Renseignez le numéro de téléphone de la personne à contacter en cas d'urgence." value="<?=$enfant->emergency_phone; ?>">
                                </div>                            
                            </div>

                            <div class="field-box row">
                                <label class="col-md-2" for="form-enfant-responsable-adresse-numero">Adresse du responsable légal</label>
                                <div class="col-md-4 col-sm-5">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <input id="form-enfant-responsable-adresse-numero" name="form_enfant_responsable_adresse_numero" class="form-control adresse-numero" type="text" placeholder="N°" data-toggle="tooltip" title="Renseignez le numéro de l'adresse du responsable légal." value="<?=$enfant->guardian_address_number; ?>">
                                        </div>
                                        <div class="col-md-9">
                                        <input id="form-enfant-responsable-adresse-voirie" name="form_enfant_responsable_adresse_voirie" class="form-control adresse-voirie" type="text" placeholder="Nom de la voirie" data-toggle="tooltip" title="Renseignez le nom de la voirie de l'adresse du responsable légal." value="<?=$enfant->guardian_address_street; ?>">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                        <input id="form-enfant-responsable-adresse-code-postal" name="form_enfant_responsable_adresse_code_postal" class="form-control adresse-postal" type="text" placeholder="Code postal" data-toggle="tooltip" title="Renseignez le code postal de la ville du responsable légal." value="<?=$enfant->guardian_address_postal_code; ?>">
                                        </div>
                                        <div class="col-md-8">
                                        <input id="form-enfant-responsable-adresse-code-ville" name="form_enfant_responsable_adresse_code_ville" class="form-control adresse-ville" type="text" placeholder="Ville" data-toggle="tooltip" title="Renseignez le nom de la ville du responsable légal." value="<?=$enfant->guardian_address_city; ?>">
                                        </div>
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
                                <label class="col-md-2" for="form-enfant-famille-nom">Nom de la famille d'accueil</label>
                                <div class="col-md-4 col-sm-5">
                                    <input id="form-enfant-famille-nom" name="form_enfant_famille_nom" class="form-control" type="text" data-toggle="tooltip" title="Renseignez le nom de la famille d'accueil." value="<?=$enfant->host_family_name; ?>">
                                </div>                            
                            </div>
                            <div class="field-box row">
                                <label class="col-md-2" for="form-enfant-famille-telephone">Téléphone de la famille d'accueil</label>
                                <div class="col-md-4 col-sm-5">
                                    <input id="form-enfant-famille-telephone" name="form_enfant_famille_telephone" class="form-control" type="text" data-toggle="tooltip" title="Renseignez le numéro de téléphone de la famille d'accueil." value="<?=$enfant->host_family_phone; ?>">
                                </div>                            
                            </div>
                            <div class="field-box row">
                                <label class="col-md-2" for="form-enfant-famille-adresse-numero">Adresse de la famille d'accueil</label>
                                <div class="col-md-4 col-sm-5">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <input id="form-enfant-famille-adresse-numero" name="form_enfant_famille_adresse_numero" class="form-control adresse-numero" type="text" placeholder="N°" data-toggle="tooltip" title="Renseignez le numéro de l'adresse de la famille d'accueil." value="<?=$enfant->host_family_address_number; ?>">
                                        </div>
                                        <div class="col-md-9">
                                        <input id="form-enfant-famille-adresse-voirie" name="form_enfant_famille_adresse_voirie" class="form-control adresse-voirie" type="text" placeholder="Nom de la voirie" data-toggle="tooltip" title="Renseignez le nom de la voirie de l'adresse de la famille d'accueil." value="<?=$enfant->host_family_address_street; ?>">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                        <input id="form-enfant-famille-adresse-code-postal" name="form_enfant_famille_adresse_code_postal" class="form-control adresse-postal" type="text" placeholder="Code postal" data-toggle="tooltip" title="Renseignez le code postal de la ville de la famille d'accueil." value="<?=$enfant->host_family_address_postal_code; ?>">
                                        </div>
                                        <div class="col-md-8">
                                        <input id="form-enfant-famille-adresse-code-ville" name="form_enfant_famille_adresse_code_ville" class="form-control adresse-ville" type="text" placeholder="Ville" data-toggle="tooltip" title="Renseignez le nom de la ville de la famille d'accueil." value="<?=$enfant->host_family_address_city; ?>">
                                        </div>
                                    </div>
                                </div>                            
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
                                    <input id="form-enfant-assurance-validite" name="form_enfant_assurance_validite" type="text" class="form-control input-datepicker" value="15/06/2014" data-toggle="tooltip" title="Renseignez la date de fin de validité de l'assurance (jj/mm/aaaa)." value="<?=$enfant->self_assurance_expiration_date; ?>">
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
                        <input type="submit" class="btn-flat primary" name="submit" value="Valider">
                    </div>
            </form>
            <?php endif; ?>
        </div>
    </div>









    <!-- LISTE DES CHAMPS -->
<!--
form-enfant-prenom
form-enfant-nom
form-enfant-naissance

form-enfant-sexe
    form-enfant-sexe-m
    form-enfant-sexe-f

form-enfant-inscription
    form-enfant-inscription-structure
    form-enfant-inscription-particulier

form-enfant-structure-select

form-enfant-contact-select

form-enfant-responsable
    form-enfant-responsable-parents
    form-enfant-responsable-mere
    form-enfant-responsable-pere
    form-enfant-responsable-tuteur

form-enfant-pere-nom
form-enfant-pere-telephone
form-enfant-mere-nom
form-enfant-mere-telephone
form-enfant-tuteur-nom
form-enfant-tuteur-telephone
form-enfant-urgence-nom
form-enfant-urgence-telephone

form-enfant-responsable-adresse-numero
form-enfant-responsable-adresse-voirie
form-enfant-responsable-adresse-code-postal
form-enfant-responsable-adresse-ville

form-enfant-domiciliation
    form-enfant-domiciliation-responsable
    form-enfant-domiciliation-famille

form-enfant-famille-nom
form-enfant-famille-telephone
form-enfant-famille-adresse-numero
form-enfant-famille-adresse-voirie
form-enfant-famille-adresse-code-postal
form-enfant-famille-adresse-ville

form-enfant-droit-image
    form-enfant-droit-image-oui
    form-enfant-droit-image-non

form-enfant-traitement-medical
    form-enfant-traitement-medical-oui
    form-enfant-traitement-medical-non

form-enfant-contre-indication

form-enfant-assurance
    form-enfant-assurance-oui
    form-enfant-assurance-non

form-enfant-assurance-validite

form-enfant-attestation-cpam
    form-enfant-attestation-cpam-oui
    form-enfant-attestation-cpam-non

form-enfant-carnet-vaccination
    form-enfant-carnet-vaccination-oui
    form-enfant-carnet-vaccination-non

form-enfant-fiche-sanitaire
    form-enfant-fiche-sanitaire-oui
    form-enfant-fiche-sanitaire-non

form-enfant-fiche-sejour
    form-enfant-fiche-sejour-oui
    form-enfant-fiche-sejour-non

-->

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>