    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
    <?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>
    

    <?php if(isset($_POST['submit'])): ?>
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
                            ':note' => $form_structure_note
                            );

            $result = hebergement::add($datas);

        ?>

    <?php if($result): ?>
        <div class="content">
            <div id="pad-wrapper" class="action-page">
                <div class="row header">
                    <div class="col-md-12">
                        <h3>Ajouter un hébergement</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-success">
                            <i class="icon-ok-sign"></i> 
                            L'hébergement <?=$form_structure_name; ?> a bien été ajoutée
                        </div>
                        <a href="/hebergements/">Retourner à la liste des hébergements</a>

                    </div>
                </div>
            </div>
        </div>

    <?php else: ?>

        <div class="content">
            <div id="pad-wrapper" class="action-page">
                <div class="row header">
                    <div class="col-md-12">
                        <h3>Ajouter une structure</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-danger">
                            <i class="icon-remove-sign"></i> 
                            Une erreur s'est produite durant l'ajout de la structure, veuillez réessayer
                        </div>
                        <a href="/structures/ajouter">Retourner au formulaire d'ajout</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>



    <?php else: ?>
    <div class="content">
        <div id="pad-wrapper" class="form-page">
            <div class="row header">
                <div class="col-md-12">
                    <h3>Ajouter une structure</h3>
                </div>
            </div>

            <form id="form-add-structure" method="post" parsley-validate>
                   <!--  <h2>Informations sur le séjour</h2> -->
                     <div class="row form-wrapper">
                        <div class="field-box row">
                            <label class="col-md-2" for="form-structure-nom">Nom de la structure</label>
                            <div class="col-md-4">
                                <input id="form-structure-name" name="form_structure_name" class="form-control" type="text" 
                                data-toggle="tooltip" title="Renseignez le nom de la structure." parsley-required="true">
                            </div>                            
                        </div>
                        <div class="field-box row">
                            <label class="col-md-2">Centre payeur</label>
                            <div class="col-md-4" data-toggle="tooltip" title="Précisez si cette structure paye les séjours.">
                                <label class="radio-inline col-md-7" for="form-structure-payeur-oui">
                                    <div class="radio" id="uniform-form-structure-payeur-oui">
                                        <span class="checked">
                                            <input type="radio" name="form_structure_payer" id="form-structure-payeur-oui" value="1">
                                        </span>
                                    </div>
                                    Oui
                                </label>
                                <label class="radio-inline col-md-4" for="form-structure-payeur-non">
                                    <div class="radio" id="uniform-form-structure-payeur-non">
                                        <span>
                                            <input type="radio" name="form_structure_payer" id="form-structure-payeur-non" value="0" checked="checked">
                                        </span>
                                    </div>
                                    Non
                                </label>
                            </div>
                        </div>

                        <div class="field-box row">
                            <label class="col-md-2" for="form-structure-email">Email</label>
                            <div class="col-md-4">
                                <input id="form-structure-email" name="form_structure_email" type="text" class="form-control"
                                data-toggle="tooltip" title="Renseignez l'email de la structure." 
                                parsley-type="email">
                            </div>                        
                        </div>     

                        <div class="field-box row">
                            <label class="col-md-2" for="form-structure-phone">Téléphone</label>
                            <div class="col-md-4">
                                <input id="form-structure-phone" name="form_structure_telephone" type="text" class="form-control"
                                data-toggle="tooltip" title="Renseignez le numéro de téléphone de la structure." 
                                parsley-type="phone">
                            </div>                        
                        </div>

                        <div class="field-box row">
                            <label class="col-md-2" for="form-structure-fax">Fax</label>
                            <div class="col-md-4">
                                <input id="form-structure-fax" name="form_structure_fax" type="text" class="form-control"
                                data-toggle="tooltip" title="Renseignez le numéro de fax de la structure." 
                                parsley-type="phone">
                            </div>                        
                        </div>

                        <div class="field-box row">
                                <label class="col-md-2" for="form-structure-adresse-numero">Adresse de la structure</label>
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <input id="form-structure-adresse-numero" name="form_structure_adresse_numero" class="form-control adresse-numero" type="text" placeholder="N°" data-toggle="tooltip" title="Renseignez le numéro de l'adresse de la structure.">
                                        </div>
                                        <div class="col-md-9"><input id="form-structure-adresse-voirie" name="form_structure_adresse_voirie" class="form-control adresse-voirie" type="text" placeholder="Nom de la voirie" data-toggle="tooltip" title="Renseignez le nom de la voirie de l'adresse de la structure."></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4"><input id="form-structure-adresse-code-postal" name="form_structure_adresse_code_postal" class="form-control adresse-postal" type="text" placeholder="Code postal" data-toggle="tooltip" title="Renseignez le code postal de la ville de la structure."></div>
                                        <div class="col-md-8"><input id="form-structure-adresse-code-ville" name="form_structure_adresse_code_ville" class="form-control adresse-ville" type="text" placeholder="Ville" data-toggle="tooltip" title="Renseignez le nom de la ville de la structure."></div>
                                    </div>
                                </div>                            
                        </div>

                        <div class="field-box row">
                            <label class="col-md-2" for="form-structure-note">Notes</label>
                            <div class="col-md-4 col-sm-5">
                                <textarea id="form-structure-note" name="form_structure_note" class="form-control" rows="4" data-toggle="tooltip" title="Notes générales au sujet de la strucure."></textarea>
                            </div>
                        </div>


                        <div class="field-box actions">
                            <div class="col-md-6">
                                <input type="submit" class="btn-flat primary" name="submit" value="Ajouter la structure">
                                <span>OU</span>
                                <a href="/structures/" class="reset">Annuler</a>
                            </div>
                        </div>

                    </div>
            </form>
        </div>
    </div>
    <?php endif; ?>

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>