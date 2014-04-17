<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
<?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>

<?php $accompagnateur = accompagnateur::get($_GET['id']); ?>


<div class="title">
    <div class="row header">
        <div class="col-md-12">
            <h1>Modifier un accompagnateur</h1>
        </div>
    </div>
</div>
<div class="content">

        <div class="row">
            <div class="col-md-12">
                <form id="form-add-children" method="post" action="/accompagnateurs/infos/id/<?=$accompagnateur->id; ?>" parsley-validate>
                        <div class="field-box row">
                            <label class="col-md-2" for="form-utilisateur-prenom">Prénom</label>
                            <div class="col-md-5">
                                <input id="form-utilisateur-prenom" name="form_utilisateur_prenom" class="form-control" type="text" data-toggle="tooltip" title="Renseignez le prénom de l'accompagnateur." parsley-required="true" value="<?=$accompagnateur->firstname; ?>">
                            </div>
                        </div>
                        <div class="field-box row">
                            <label class="col-md-2" for="form-utilisateur-nom">Nom</label>
                            <div class="col-md-5">
                                <input id="form-utilisateur-nom" name="form_utilisateur_nom" class="form-control" type="text" data-toggle="tooltip" title="Renseignez le nom de l'accompagnateur." parsley-required="true" value="<?=$accompagnateur->lastname; ?>">
                            </div>
                        </div>
                        <div class="field-box row">
                            <label class="col-md-2" for="form-utilisateur-identifiant">Numéro de téléphone</label>
                            <div class="col-md-5">
                                <input id="form-utilisateur-identifiant" name="form_utilisateur_identifiant" class="form-control" type="text" data-toggle="tooltip" title="Renseignez l'identifiant de l'accompagnateur." disabled parsley-required="true" value="<?=$accompagnateur->identifier; ?>">
                            </div>
                        </div>                        
                        <div class="field-box row">
                            <label class="col-md-2">Niveau</label>
                            <div class="col-md-5" data-toggle="tooltip" title="Précisez le niveau d'administration de l'utilisateur">
                                <label class="radio" for="form-utilisateur-lvl-1">
                                    <div class="radio" id="uniform-form-utilisateur-lvl-1">
                                        <span class="checked">
                                            <input type="radio" name="form_utilisateur_lvl" id="form-utilisateur-lvl-1" value="1" <?php if($accompagnateur->rank == '1') echo 'checked' ?>>
                                        </span>
                                    </div>
                                    Administrateur
                                </label>
                                <label class="radio" for="form-utilisateur-lvl-2">
                                    <div class="radio" id="uniform-form-utilisateur-lvl-2">
                                        <span>
                                            <input type="radio" name="form_utilisateur_lvl" id="form-utilisateur-lvl-2" value="3" <?php if($accompagnateur->rank == '3') echo 'checked' ?>>
                                        </span>
                                    </div>
                                    Animateur
                                </label>
                            </div>
                        </div>

                        <div class="field-box actions">
                            <div class="col-md-6  col-md-offset-2">
                                <input type="submit" class="btn btn-primary" name="submit-update" value="valider">
                                <span>OU</span>
                                <a href="/accompagnateurs/" class="reset">Annuler</a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
    </div>

    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>