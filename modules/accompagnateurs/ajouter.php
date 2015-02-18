<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>


<?php $result = accompagnateur::add(array()); ?>
<?php $id = accompagnateur::getLastID(); ?>

<!-- Page title -->
<div class="page-head">
    <div class="row">
        <div class="col-md-8">
            <h1>Ajouter un accompagnateur</h1>
        </div>
    </div>
</div>
<!-- /Page title -->



<div class="block-flat">
    <div class="content">

        <form id="form-add-accompagnateur" method="post" action="/accompagnateurs/infos/id/<?=$id ?>" class="form-horizontal group-border-dashed maped-form" parsley-validate>

            <input type="hidden" value="<?=$id ?>" name="id" />


            <div class="form-group">
                <label class="col-sm-4 control-label" for="form-accompagnateur-prenom">Prénom</label>
                <div class="col-sm-6">
                    <input id="form-accompagnateur-prenom" name="form_accompagnateur_prenom" class="form-control" type="text" data-toggle="tooltip" title="Renseignez le prénom de l'accompagnateur." parsley-required="true">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="form-accompagnateur-nom">Nom</label>
                <div class="col-sm-6">
                    <input id="form-accompagnateur-nom" name="form_accompagnateur_nom" class="form-control" type="text" data-toggle="tooltip" title="Renseignez le nom de l'accompagnateur." parsley-required="true">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="form-accompagnateur-tel">Numéro de téléphone</label>
                <div class="col-sm-6">
                    <input id="form-accompagnateur-tel" name="form_accompagnateur_tel" class="form-control" type="text" data-toggle="tooltip" title="Renseignez le numéro de téléphone de l'accomagnateur." parsley-required="true">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="form-accompagnateur-email">Adresse e-mail</label>
                <div class="col-sm-6">
                    <input id="form-accompagnateur-email" name="form_accompagnateur_email" class="form-control" type="email" data-toggle="tooltip" title="Renseignez l'adresse e-mail de l'accompagnateur." parsley-required="true">
                </div>
            </div>
            <?php /* ?>
            <div class="form-group">
                <label class="col-sm-4 control-label">Niveau</label>
                <div class="col-sm-6" data-toggle="tooltip" title="Précisez le niveau de l'accompagnateur">
                    <label class="radio" for="form-accompagnateur-lvl-1">
                        <div class="radio" id="uniform-form-accompagnateur-lvl-1">
                            <span class="checked">
                                <input type="radio" name="form_accompagnateur_lvl" id="form-accompagnateur-lvl-1" value="1" checked="">
                            </span>
                        </div>
                        Administrateur
                    </label>
                    <label class="radio" for="form-accompagnateur-lvl-2">
                        <div class="radio" id="uniform-form-accompagnateur-lvl-2">
                            <span>
                                <input type="radio" name="form_accompagnateur_lvl" id="form-accompagnateur-lvl-2" value="0">
                            </span>
                        </div>
                        Animateur
                    </label>
                </div>
            </div>
            <?php */ ?>

            <div class="form-group actions text-center">
                <div class="col-md-8 col-md-offset-2">
                    <input type="submit" class="btn btn-primary btn-rad btn-lg" name="submit-add" value="Enregistrer le nouvel accompagnateur">
                    <span>OU</span>
                    <a href="/accompagnateurs/" class="reset">Annuler</a>
                </div>
            </div>

        </form>
    </div>
</div>

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>

