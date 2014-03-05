<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
<?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>


    <div class="title">
        <div class="row header">
            <div class="col-md-12">
                <h3>Ajouter un hébergement</h3>
            </div>
        </div>
    </div>
    <div class="content">

    <?php if(isset($_POST['submit'])): ?>
    <?php //tool::output($_POST); ?>
    <?php //tool::output($_SESSION); ?>
    <?php 
    extract($_POST);
    $datas = array(
        ':name' => $form_hebergement_name,
        ':address_number' => $form_hebergement_adresse_numero,
        ':address_street' => $form_hebergement_adresse_voirie,
        ':address_postal_code' => $form_hebergement_adresse_code_postal,
        ':address_city' => $form_hebergement_adresse_code_ville,
        ':note' => $form_hebergement_note
        );

    $result = hebergement::add($datas);

    ?>
    <?php if($result): ?>

            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success">
                        <i class="icon-ok-sign"></i> 
                        L'hébergement <?=$form_hebergement_name; ?> a bien été ajoutée
                    </div>
                    <a href="/hebergements/">Retourner à la liste des hébergements</a>

                </div>
            </div>

    <?php else: ?>

            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger">
                        <i class="icon-remove-sign"></i> 
                        Une erreur s'est produite durant l'ajout de l'hébergement, veuillez réessayer
                    </div>
                    <a href="/hebergements/ajouter">Retourner au formulaire d'ajout</a>
                </div>
            </div>

    <?php endif; ?>



<?php else: ?>

        <form id="form-add-hebergement" method="post" parsley-validate>
            <div class="row">
                <div class="field-box row">
                    <label class="col-md-2" for="form-hebergement-nom">Nom de l'hébergement</label>
                    <div class="col-md-4">
                        <input id="form-hebergement-name" name="form_hebergement_name" class="form-control" type="text" 
                        data-toggle="tooltip" title="Renseignez le nom de l'hébergement." parsley-required="true">
                    </div>                            
                </div>

                <div class="field-box row">
                    <label class="col-md-2" for="form-hebergement-adresse-numero">Adresse de l'hébergement</label>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-3">
                                <input id="form-hebergement-adresse-numero" name="form_hebergement_adresse_numero" class="form-control adresse-numero" type="text" placeholder="N°" data-toggle="tooltip" title="Renseignez le numéro de l'adresse de l'hébergement.">
                            </div>
                            <div class="col-md-9"><input id="form-hebergement-adresse-voirie" name="form_hebergement_adresse_voirie" class="form-control adresse-voirie" type="text" placeholder="Nom de la voirie" data-toggle="tooltip" title="Renseignez le nom de la voirie de l'adresse de l'hébergement."></div>
                        </div>

                        <div class="row">
                            <div class="col-md-4"><input id="form-hebergement-adresse-code-postal" name="form_hebergement_adresse_code_postal" class="form-control adresse-postal" type="text" placeholder="Code postal" data-toggle="tooltip" title="Renseignez le code postal de la ville de l'hébergement."></div>
                            <div class="col-md-8"><input id="form-hebergement-adresse-code-ville" name="form_hebergement_adresse_code_ville" class="form-control adresse-ville" type="text" placeholder="Ville" data-toggle="tooltip" title="Renseignez le nom de la ville de l'hébergement."></div>
                        </div>
                    </div>                            
                </div>

                <div class="field-box row">
                    <label class="col-md-2" for="form-hebergement-note">Notes</label>
                    <div class="col-md-4 col-sm-5">
                        <textarea id="form-hebergement-note" name="form_hebergement_note" class="form-control" rows="4" data-toggle="tooltip" title="Notes générales au sujet de la strucure."></textarea>
                    </div>
                </div>

                <div class="field-box actions">
                    <div class="col-md-6">
                        <input type="submit" class="btn-flat primary" name="submit" value="Ajouter l'hébergement">
                        <span>OU</span>
                        <a href="/hebergements/" class="reset">Annuler</a>
                    </div>
                </div>

            </div>
        </form>
<?php endif; ?>
    </div>

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>