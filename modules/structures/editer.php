<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>

<?php $structure = structure::get($_GET['id']); ?>

<!-- Page title -->
<div class="page-head">
    <div class="row">
        <div class="col-md-8">
            <h1>Modifier la structure</h1>
        </div>
    </div>
</div>
<!-- /Page title -->


<div class="block-flat">
    <div class="content">

        <form id="form-edit-structure" action="/structures/infos/id/<?=$structure->id ?>" class="form-horizontal group-border-dashed maped-form" method="post" data-parsley-validate>

            <div class="form-group">
                <label class="col-sm-4 control-label" for="form-structure-nom">Nom de la structure</label>
                <div class="col-sm-6">
                    <input id="form-structure-name" name="form_structure_name" class="form-control" type="text" 
                    data-toggle="tooltip" title="Renseignez le nom de la structure." data-parsley-required="true" value="<?=$structure->name ?>">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-4 control-label" for="form-structure-service">Nom du service</label>
                <div class="col-sm-6">
                    <input id="form-structure-service" name="form_structure_service" class="form-control" type="text" 
                    data-toggle="tooltip" title="Renseignez le nom du service." value="<?=$structure->service ?>">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-4 control-label">Centre payeur</label>
                <div class="col-sm-6">
                    <label class="radio-inline" for="form-structure-payeur-oui"><input type="radio" class="icheck" name="form_structure_payer" id="form-structure-payeur-oui" value="1" <?php if($structure->payer == 1): ?>checked="checked"<?php endif; ?>> Oui</label>
                    <label class="radio-inline" for="form-structure-payeur-non"><input type="radio" class="icheck" name="form_structure_payer" id="form-structure-payeur-non" value="0" <?php if($structure->payer == 0): ?>checked="checked"<?php endif; ?>> Non</label>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-4 control-label" for="form-structure-email">Email</label>
                <div class="col-sm-6">
                    <input id="form-structure-email" name="form_structure_email" type="text" class="form-control input-email"
                    data-toggle="tooltip" title="Renseignez l'email de la structure." 
                    data-parsley-type="email" value="<?=$structure->email ?>">
                </div>
            </div>     

            <div class="form-group">
                <label class="col-sm-4 control-label" for="form-structure-phone">Téléphone</label>
                <div class="col-sm-6">
                    <input id="form-structure-phone" name="form_structure_telephone" type="text" class="form-control input-phone"
                    data-toggle="tooltip" title="Renseignez le numéro de téléphone de la structure." value="<?=$structure->phone ?>">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-4 control-label" for="form-structure-fax">Fax</label>
                <div class="col-sm-6">
                    <input id="form-structure-fax" name="form_structure_fax" type="text" class="form-control input-phone"
                    data-toggle="tooltip" title="Renseignez le numéro de fax de la structure." value="<?=$structure->fax ?>">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-4 control-label" for="form-structure-adresse-numero">Adresse de la structure</label>
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-md-3"><input id="form-structure-adresse-numero" name="form_structure_adresse_numero" class="form-control adresse-numero" type="text" placeholder="N°" data-toggle="tooltip" title="Renseignez le numéro de l'adresse de la structure." value="<?=$structure->address_number ?>"></div>
                        <div class="col-md-9"><input id="form-structure-adresse-voirie" name="form_structure_adresse_voirie" class="form-control adresse-voirie" type="text" placeholder="Nom de la voirie" data-toggle="tooltip" title="Renseignez le nom de la voirie de l'adresse de la structure." value="<?=$structure->address_street ?>"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <input id="form-structure-addresse-comp" name="form_structure_addresse_comp" class="form-control addresse-complement" type="text" 
                            data-toggle="tooltip" title="Renseignez l'addresse complémentaire." placeholder="Complément d'addresse" value="<?=$structure->address_comp ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3"><input id="form-structure-adresse-code-postal" name="form_structure_adresse_code_postal" class="form-control adresse-postal" type="text" placeholder="Code postal" data-toggle="tooltip" title="Renseignez le code postal de la ville de la structure." value="<?=$structure->address_postal_code ?>"></div>
                        <div class="col-md-9"><input id="form-structure-adresse-code-ville" name="form_structure_adresse_code_ville" class="form-control adresse-ville" type="text" placeholder="Ville" data-toggle="tooltip" title="Renseignez le nom de la ville de la structure." value="<?=$structure->address_city ?>"></div>
                    </div>

                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-4 control-label" for="form-structure-note">Notes</label>
                <div class="col-sm-6">
                    <textarea id="form-structure-note" name="form_structure_note" class="form-control" rows="4" data-toggle="tooltip" title="Notes générales au sujet de la strucure."><?=$structure->note; ?></textarea>
                </div>
            </div>



            <div class="form-group actions text-center">
                <div class="col-md-8 col-md-offset-2">
                    <input type="submit" class="btn btn-primary btn-rad btn-lg" name="submit-update" value="Modifier la structure">
                    <span>OU</span>
                    <a href="/structures/infos/id/<?=$structure->id; ?>" class="reset">Annuler</a>
                </div>
            </div>

        </form>
    </div>
</div>

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>