<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
<?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>

<?php $result = hebergement::add(array()); ?>
<?php $id = hebergement::getLastID(); ?>


<!-- Page title -->
<div class="page-head">
    <div class="row">
        <div class="col-md-8">
            <h1>Ajouter un hébergement</h1>
        </div>
    </div>
</div>
<!-- /Page title -->



<div class="block-flat">
    <div class="content">


        <form id="form-add-hebergement" method="post" action="/hebergements/infos/id/<?=$id ?>" class="form-horizontal group-border-dashed maped-form" data-parsley-validate>

            <input type="hidden" value="<?=$id ?>" name="id" />


            <div class="row">
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="form-hebergement-nom">Nom de l'hébergement</label>
                    <div class="col-sm-6">
                        <input id="form-hebergement-name" name="form_hebergement_name" class="form-control" type="text" 
                        data-toggle="tooltip" title="Renseignez le nom de l'hébergement." data-parsley-required="true">
                    </div>                            
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label" for="form-hebergement-adresse-numero">Adresse de l'hébergement</label>
                    <div class="col-sm-6">
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

                <div class="form-group">
                    <label class="col-sm-4 control-label" for="form-hebergement-note">Notes</label>
                    <div class="col-sm-6">
                        <textarea id="form-hebergement-note" name="form_hebergement_note" class="form-control" rows="4" data-toggle="tooltip" title="Notes générales au sujet de la strucure."></textarea>
                    </div>
                </div>


                <div class="form-group actions text-center">
                    <div class="col-md-8 col-md-offset-2">
                        <input type="submit" class="btn btn-primary btn-rad btn-lg" name="submit-add" value="Ajouter l'hébergement">
                        <span>OU</span>
                        <a href="/hebergements/" class="reset">Annuler</a>
                    </div>
                </div>

            </div>
        </form>

    </div>
</div>


<?php ob_start(); ?>
<script>
    $(function() {
    });
</script>
<?php $scripts .= ob_get_contents();
ob_end_clean(); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>