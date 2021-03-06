<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>


<?php $result = user::add(array()); ?>
<?php $id = user::getLastID(); ?>

<!-- Page title -->
<div class="page-head">
    <div class="row">
        <div class="col-md-8">
            <h1>Ajouter un utilisateur</h1>
        </div>
    </div>
</div>
<!-- /Page title -->

<div class="row">
    <div class="col-md-9">
        <div class="block-flat">
            <div class="content">
                <form id="form-add-user" method="post" action="/utilisateurs/infos/id/<?=$id ?>" class="form-horizontal group-border-dashed maped-form" data-parsley-validate>

                    <input type="hidden" value="<?=$id ?>" name="id" />

                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="form-utilisateur-prenom">Prénom</label>
                        <div class="col-sm-6">
                            <input id="form-utilisateur-prenom" name="form_utilisateur_prenom" class="form-control" type="text" data-toggle="tooltip" title="Renseignez le prénom de l'utilisateur." data-parsley-required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="form-utilisateur-nom">Nom</label>
                        <div class="col-sm-6">
                            <input id="form-utilisateur-nom" name="form_utilisateur_nom" class="form-control" type="text" data-toggle="tooltip" title="Renseignez le nom de l'utilisateur." data-parsley-required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="form-utilisateur-identifiant">Identifiant</label>
                        <div class="col-sm-6">
                            <input id="form-utilisateur-identifiant" name="form_utilisateur_identifiant" class="form-control" type="text" data-toggle="tooltip" title="Renseignez l'identifiant de l'utilisateur." data-parsley-required="true">
                        </div>
                        </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="form-utilisateur-password">Mot de passe</label>
                        <div class="col-sm-6">
                            <input id="form-utilisateur-password" name="form_utilisateur_password" class="form-control" type="text" data-toggle="tooltip" title="Renseignez le mot de passe de l'utilisateur." data-parsley-required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="form-utilisateur-mail">Adresse e-mail</label>
                        <div class="col-sm-6">
                            <input id="form-utilisateur-mail" name="form_utilisateur_mail" class="form-control input-email" type="email" data-toggle="tooltip" title="Renseignez l'adresse e-mail de l'utilisateur." data-parsley-required="true">
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-4 control-label">Niveau</label>
                        <div class="col-sm-6" data-toggle="tooltip" title="Précisez le niveau d'administration de l'utilisateur">
                            <div class="radio">
                                <label class="radio" for="form-utilisateur-lvl-1">
                                    <input class="icheck" type="radio" name="form_utilisateur_lvl" id="form-utilisateur-lvl-1" value="1" checked="">
                                    Utilisateur
                                </label>
                            </div>
                            <div class="radio">
                                <label class="radio" for="form-utilisateur-lvl-2">
                                    <input class="icheck" type="radio" name="form_utilisateur_lvl" id="form-utilisateur-lvl-2" value="2">
                                    Secrétaire
                                </label>
                            </div>
                            <div class="radio">
                                <label class="radio" for="form-utilisateur-lvl-3">
                                    <input class="icheck" type="radio" name="form_utilisateur_lvl" id="form-utilisateur-lvl-3" value="3">
                                    Gestionnaire
                                </label>
                            </div>
                            <div class="radio">
                                <label class="radio" for="form-utilisateur-lvl-4">
                                    <input class="icheck" type="radio" name="form_utilisateur_lvl" id="form-utilisateur-lvl-4" value="5">
                                    Administrateur
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group actions text-center">
                        <div class="col-md-8 col-md-offset-2">
                            <input type="hidden" name="submit-add" value="Enregistrer le nouvel utilisateur">
                            <input type="submit" class="btn btn-primary btn-rad btn-lg" value="Enregistrer le nouvel utilisateur">
                            <span>OU</span>
                            <a href="/utilisateurs/" class="reset">Annuler</a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <div class="col-md-3" style="position:static;">
        <div id="neo-affix">
        
            <div id="allias-submit" class="block-flat bars-widget">
                <div class="form-group text-center">
                    <button class="btn btn-primary btn-block btn-rad">Enregister le nouvel utilisateur</button>
                    <a href="/utilisateurs/">Annuler</a>
                </div>
            </div>

            <!-- <div id="form-nav" class="block-flat bars-widget">
            </div> -->
        </div>
    </div>
</div>

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>