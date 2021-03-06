<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
<?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>

<?php $accompagnateur = accompagnateur::get($_GET['id']); ?>



<!-- Page title -->
<div class="page-head">
    <div class="row">
        <div class="col-md-8">
            <h1>Modifier la fiche d'un accompagnateur</h1>
        </div>
    </div>
</div>
<!-- /Page title -->

<div class="row">
    <div class="col-md-9">
        <div class="block-flat">
            <div class="content">

                <form id="form-add-contact" method="post" action="/accompagnateurs/infos/id/<?=$accompagnateur->id ?>" class="form-horizontal group-border-dashed maped-form" data-parsley-validate>

                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="form-accompagnateur-prenom">Prénom</label>
                        <div class="col-sm-6">
                            <input id="form-accompagnateur-prenom" name="form_accompagnateur_prenom" class="form-control" type="text" data-toggle="tooltip" title="Renseignez le prénom de l'accompagnateur." data-parsley-required="true" value="<?=$accompagnateur->firstname; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="form-accompagnateur-nom">Nom</label>
                        <div class="col-sm-6">
                            <input id="form-accompagnateur-nom" name="form_accompagnateur_nom" class="form-control" type="text" data-toggle="tooltip" title="Renseignez le nom de l'accompagnateur." data-parsley-required="true" value="<?=$accompagnateur->lastname; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="form-accompagnateur-tel">Numéro de téléphone</label>
                        <div class="col-sm-6">
                            <input id="form-accompagnateur-tel" name="form_accompagnateur_tel" class="form-control input-phone" type="text" data-toggle="tooltip" title="Renseignez le numéro de téléphone de l'accompagnateur." value="<?=$accompagnateur->tel; ?>">
                        </div>
                    </div>  
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="form-accompagnateur-email">Adresse e-mail</label>
                        <div class="col-sm-6">
                            <input id="form-accompagnateur-email" name="form_accompagnateur_email" class="form-control input-email" type="email" data-toggle="tooltip" title="Renseignez l'adresse e-mail de l'accompagnateur." value="<?=$accompagnateur->email; ?>">
                        </div>
                    </div>
                    <?php /* ?>                      
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Niveau</label>
                        <div class="col-sm-6" data-toggle="tooltip" title="Précisez le niveau d'administration de l'accompagnateur">
                            <label class="radio" for="form-accompagnateur-lvl-1">
                                <div class="radio" id="uniform-form-accompagnateur-lvl-1">
                                    <span class="checked">
                                        <input type="radio" name="form_accompagnateur_lvl" id="form-accompagnateur-lvl-1" value="1" <?php if($accompagnateur->rank == '1') echo 'checked' ?>>
                                    </span>
                                </div>
                                Administrateur
                            </label>
                            <label class="radio" for="form-accompagnateur-lvl-2">
                                <div class="radio" id="uniform-form-accompagnateur-lvl-2">
                                    <span>
                                        <input type="radio" name="form_accompagnateur_lvl" id="form-accompagnateur-lvl-2" value="3" <?php if($accompagnateur->rank == '3') echo 'checked' ?>>
                                    </span>
                                </div>
                                Animateur
                            </label>
                        </div>
                    </div>
                    <?php */ ?>

                    <div class="form-group actions text-center">
                        <div class="col-md-8 col-md-offset-2">
                            <input type="hidden" name="submit-update" value="Enregistrer les modifications">
                            <input type="submit" class="btn btn-primary btn-rad btn-lg" value="Enregistrer les modifications">
                            <span>OU</span>
                            <a href="/accompagnateurs/infos/id/<?=$accompagnateur->id ?>" class="reset">Annuler</a>
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
                    <button class="btn btn-primary btn-block btn-rad">Enregistrer les modifications</button>
                    <a href="/accompagnateurs/infos/id/<?=$accompagnateur->id ?>">Annuler</a>
                </div>
            </div>

            <!-- <div id="form-nav" class="block-flat bars-widget">
            </div> -->
        </div>
    </div>
</div>

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>