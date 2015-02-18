<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
<?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>

<?php $utilisateur = user::get($_GET['id']); ?>



<!-- Page title -->
<div class="page-head">
    <div class="row">
        <div class="col-md-8">
            <h1>Modifier l'utilisateur</h1>
        </div>
    </div>
</div>
<!-- /Page title -->


<div class="block-flat">
    <div class="content">
        <form id="form-edit-user" method="post" action="/utilisateurs/infos/id/<?=$utilisateur->id ?>" class="form-horizontal group-border-dashed maped-form" parsley-validate>

            <div class="form-group">
                <label class="col-sm-4 control-label" for="form-utilisateur-prenom">Prénom</label>
                <div class="col-sm-6">
                    <input id="form-utilisateur-prenom" name="form_utilisateur_prenom" class="form-control" type="text" data-toggle="tooltip" title="Renseignez le prénom de l'utilisateur." parsley-required="true" value="<?=$utilisateur->firstname; ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="form-utilisateur-nom">Nom</label>
                <div class="col-sm-6">
                    <input id="form-utilisateur-nom" name="form_utilisateur_nom" class="form-control" type="text" data-toggle="tooltip" title="Renseignez le nom de l'utilisateur." parsley-required="true" value="<?=$utilisateur->lastname; ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="form-utilisateur-identifiant">Identifiant</label>
                <div class="col-sm-6">
                    <input id="form-utilisateur-identifiant" name="form_utilisateur_identifiant" class="form-control" type="text" data-toggle="tooltip" title="Renseignez l'identifiant de l'utilisateur." parsley-required="true" value="<?=$utilisateur->identifier; ?>">
                </div>
                </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="form-utilisateur-password">Mot de passe</label>
                <div class="col-sm-6">
                    <input id="form-utilisateur-password" name="form_utilisateur_password" class="form-control" type="text" data-toggle="tooltip" title="Renseignez le mot de passe de l'utilisateur." parsley-required="true">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="form-utilisateur-mail">Adresse e-mail</label>
                <div class="col-sm-6">
                    <input id="form-utilisateur-mail" name="form_utilisateur_mail" class="form-control" type="email" data-toggle="tooltip" title="Renseignez l'adresse e-mail de l'utilisateur." parsley-required="true" value="<?=$utilisateur->email; ?>">
                </div>
            </div>


            <div class="form-group">
                <label class="col-sm-4 control-label">Niveau</label>
                <div class="col-sm-6" data-toggle="tooltip" title="Précisez le niveau d'administration de l'utilisateur">
                    <div class="radio">
                        <label class="radio" for="form-utilisateur-lvl-1">
                            <input class="icheck" type="radio" name="form_utilisateur_lvl" id="form-utilisateur-lvl-1" value="1" <?php if($utilisateur->rank == '1'): ?> checked="checked"<?php endif; ?>>
                            Utilisateur
                        </label>
                    </div>
                    <div class="radio">
                        <label class="radio" for="form-utilisateur-lvl-2">
                            <input class="icheck" type="radio" name="form_utilisateur_lvl" id="form-utilisateur-lvl-2" value="3" <?php if($utilisateur->rank == '3'): ?> checked="checked"<?php endif; ?>>
                            Gestionnaire
                        </label>
                    </div>
                    <div class="radio">
                        <label class="radio" for="form-utilisateur-lvl-3">
                            <input class="icheck" type="radio" name="form_utilisateur_lvl" id="form-utilisateur-lvl-3" value="5" <?php if($utilisateur->rank == '5'): ?> checked="checked"<?php endif; ?>>
                            Administrateur
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group actions text-center">
                <div class="col-md-8 col-md-offset-2">
                    <input type="submit" class="btn btn-primary btn-rad btn-lg" name="submit-update" value="Enregistrer les modifications">
                    <span>OU</span>
                    <a href="/utilisateurs/infos/id/<?=$utilisateur->id; ?>" class="reset">Annuler</a>
                </div>
            </div>

        </form>
    </div>
</div>

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>