    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
    <?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>
    

    <?php if(isset($validate)): ?>
        <?php  
            $datas = array(
                            ':identifier' => $form_structure_identifiant,
                            ':name' => $form_structure_nom,
                            ':paying' => $form_structure_payeur,
                            ':email' => $form_structure_email,
                            ':phone' => $form_structure_telephone,
                            ':address_number' => $form_structure_adresse_numero,
                            ':address_street' => $form_structure_adresse_voirie,
                            ':address_postal_code' => $form_structure_adresse_code_postal,
                            ':address_city' => $form_structure_adresse_code_ville
                            );

            $sql = 'INSERT INTO 
                    structure (identifier, name, paying, email, phone, address_number, address_street, address_postal_code, address_city) 
                    value (:identifier, :name, :paying, :email, :phone, :address_number, :address_street, :address_postal_code, :address_city)';

            structure::add($sql, $datas);

        ?>
    <?php tool::output($_POST); ?>
    <div class="content">
        <div id="pad-wrapper" class="form-page">
            <div class="row header">
                <div class="col-md-12">
                    <h3>Ajouter un séjour</h3>
                </div>
            </div>
        </div>

        <p>La structure <?=$form_sejour_name; ?> a bien été ajouté</p>
        <a href="/structure/index/">Retourner à la liste des séjours</a>
    </div>
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
                            <label class="col-md-2">Structure payante</label>
                            <div class="col-md-4" data-toggle="tooltip" title="Précisez si cette structure paye les séjours.">
                                <label class="radio-inline col-md-7" for="form-structure-payeur-oui">
                                    <div class="radio" id="uniform-form-structure-payeur-oui">
                                        <span class="checked">
                                            <input type="radio" name="form_structure_payeur_oui" id="form-structure-payeur-oui" value="oui">
                                        </span>
                                    </div>
                                    Oui
                                </label>
                                <label class="radio-inline col-md-4" for="form-structure-payeur-non">
                                    <div class="radio" id="uniform-form-structure-payeur-non">
                                        <span class="checked">
                                            <input type="radio" name="form_structure_payeur_non" id="form-structure-payeur-non" value="non" checked="">
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
                                <input id="form-structure-phone" name="form_structure_email" type="text" class="form-control"
                                data-toggle="tooltip" title="Renseignez le numéro de téléphone de la structure." 
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


                        <input type="submit" class="btn-flat primary" name="validate" value="Valider">
                    </div>
            </form>
        </div>
    </div>
    <?php endif; ?>

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>