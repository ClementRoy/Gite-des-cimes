<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>


<?php $result = accompagnateur::add(array()); ?>
<?php $id = accompagnateur::getLastID(); ?>

<div class="title">
    <div class="row header">
        <div class="col-md-12">
            <h1>Ajouter un accompagnateur</h1>
        </div>
    </div>
</div>
<div class="content">

        <div class="row">
            <div class="col-md-12">
                <form id="form-add-user" method="post" action="/accompagnateurs/infos/id/<?=$id ?>" parsley-validate>

                    <input type="hidden" value="<?=$id ?>" name="id" />

                    <div class="field-box row">
                        <label class="col-md-2" for="form-utilisateur-prenom">Prénom</label>
                        <div class="col-md-5">
                            <input id="form-utilisateur-prenom" name="form_utilisateur_prenom" class="form-control" type="text" data-toggle="tooltip" title="Renseignez le prénom de l'utilisateur." parsley-required="true">
                        </div>
                    </div>
                    <div class="field-box row">
                        <label class="col-md-2" for="form-utilisateur-nom">Nom</label>
                        <div class="col-md-5">
                            <input id="form-utilisateur-nom" name="form_utilisateur_nom" class="form-control" type="text" data-toggle="tooltip" title="Renseignez le nom de l'utilisateur." parsley-required="true">
                        </div>
                    </div>
                    <div class="field-box row">
                        <label class="col-md-2" for="form-utilisateur-tel">Numéro de téléphone</label>
                        <div class="col-md-5">
                            <input id="form-utilisateur-identifiant" name="form_utilisateur_tel" class="form-control" type="text" data-toggle="tooltip" title="Renseignez le numéro de téléphone de l'accomagnateur." parsley-required="true">
                        </div>
                    </div>
                    <div class="field-box row">
                        <label class="col-md-2" for="form-utilisateur-mail">Adresse e-mail</label>
                        <div class="col-md-5">
                            <input id="form-utilisateur-mail" name="form_utilisateur_mail" class="form-control" type="email" data-toggle="tooltip" title="Renseignez l'adresse e-mail de l'accompagnateur." parsley-required="true">
                        </div>
                    </div>
                    <div class="field-box row">
                        <label class="col-md-2">Niveau</label>
                        <div class="col-md-5" data-toggle="tooltip" title="Précisez le niveau de l'accompagnateur">
                            <label class="radio" for="form-utilisateur-lvl-1">
                                <div class="radio" id="uniform-form-utilisateur-lvl-1">
                                    <span class="checked">
                                        <input type="radio" name="form_utilisateur_lvl" id="form-utilisateur-lvl-1" value="1" checked="">
                                    </span>
                                </div>
                                Administrateur
                            </label>
                            <label class="radio" for="form-utilisateur-lvl-2">
                                <div class="radio" id="uniform-form-utilisateur-lvl-2">
                                    <span>
                                        <input type="radio" name="form_utilisateur_lvl" id="form-utilisateur-lvl-2" value="0">
                                    </span>
                                </div>
                                Animateur
                            </label>
                        </div>
                    </div>
                    <div class="field-box actions">
                        <div class="col-md-6  col-md-offset-2">
                            <input type="submit" class="btn btn-primary" name="submit-add" value="Ajouter l'accompagnateur">
                            <span>OU</span>
                            <a href="/accompagnateurs/" class="reset">Annuler</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

</div>

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>

