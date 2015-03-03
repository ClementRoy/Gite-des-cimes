<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
<?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>

<?php $result = contact::add(array()); ?>
<?php $id = contact::getLastID(); ?>

<!-- Page title -->
<div class="page-head">
    <div class="row">
        <div class="col-md-8">
            <h1>Ajouter un contact</h1>
        </div>
    </div>
</div>
<!-- /Page title -->

<div class="row">
    <div class="col-md-9">
        <div class="block-flat">
            <div class="content">


                <form id="form-add-contact" method="post" action="/contacts/infos/id/<?=$id ?>" class="form-horizontal group-border-dashed maped-form" data-parsley-validate>

                    <input type="hidden" value="<?=$id ?>" name="id" />

                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="form-enfant-structure-select">Nom de la structure</label>
                        <div class="col-sm-6" data-toggle="tooltip" title="Sélectionnez la structure qui s'occupe de cet enfant.">
                            <div class="ui-select">
                                <?php $structures = structure::getList(); ?>
                                <select class="form-control" id="form-enfant-structure-select" name="form_contact_structure" data-parsley-required="true">
                                    <option selected="selected" value="">Choisissez la structure</option>
                                    <?php foreach($structures as $structure): ?>
                                        <option value="<?=$structure->id ?>"><?=$structure->name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-4 control-label">Civilité</label>
                        <div class="col-sm-6">
                            <label class="radio-inline" for="form-contact-civility-mme"><input type="radio" class="icheck" name="form_contact_civility" id="form-contact-civility-mme" value="Mme"> Mme</label>
                            <label class="radio-inline" for="form-contact-civility-mr"><input type="radio" class="icheck" name="form_contact_civility" id="form-contact-civility-mr" value="Mr" checked="checked"> Mr</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="form-contact-prenom">Prénom</label>
                        <div class="col-sm-6">
                            <input id="form-contact-prenom" name="form_contact_firstname" class="form-control input-sm" type="text" data-toggle="tooltip" title="Renseignez le prénom du contact.">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="form-contact-nom">Nom</label>
                        <div class="col-sm-6">
                            <input id="form-contact-nom" name="form_contact_lastname" class="form-control input-sm input-sm" type="text" data-toggle="tooltip" title="Renseignez le nom du contact." data-parsley-required="true">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="form-contact-title">Titre</label>
                        <div class="col-sm-6">
                            <input id="form-contact-title" name="form_contact_title" class="form-control" type="text" 
                            data-toggle="tooltip" title="Renseignez le titre de la contact.">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="form-contact-email">Email</label>
                        <div class="col-sm-6">
                            <input id="form-contact-email" name="form_contact_email" type="text" class="form-control input-email"
                            data-toggle="tooltip" title="Renseignez l'email de la contact." 
                            data-parsley-type="email">
                        </div>
                    </div>     

                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="form-contact-phone">Téléphone</label>
                        <div class="col-sm-6">
                            <input id="form-contact-phone" name="form_contact_telephone" type="text" class="form-control input-phone"
                            data-toggle="tooltip" title="Renseignez le numéro de téléphone de la contact.">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="form-contact-mobile-phone">Téléphone mobile</label>
                        <div class="col-sm-6">
                            <input id="form-contact-mobile-phone" name="form_contact_mobile_phone" type="text" class="form-control input-phone"
                            data-toggle="tooltip" title="Renseignez le numéro de téléphone mobile du contact.">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="form-contact-fax">Fax</label>
                        <div class="col-sm-6">
                            <input id="form-contact-fax" name="form_contact_fax" type="text" class="form-control input-phone"
                            data-toggle="tooltip" title="Renseignez le numéro de fax de la contact.">
                            </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="form-contact-note">Notes</label>
                        <div class="col-sm-6">
                            <textarea id="form-contact-note" name="form_contact_note" class="form-control" rows="4" data-toggle="tooltip" title="Notes générales au sujet de la strucure."></textarea>
                        </div>
                    </div>

                    <div class="form-group actions text-center">
                        <div class="col-md-8 col-md-offset-2">
                            <input type="hidden" name="submit-add" value="Enregistrer le nouveau contact">
                            <input type="submit" class="btn btn-primary btn-rad btn-lg" value="Enregistrer le nouveau contact">
                            <span>OU</span>
                            <a href="/contacts/" class="reset">Annuler</a>
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
                    <button class="btn btn-primary btn-block btn-rad">Enregistrer le nouveau contact</button>
                    <a href="/contacts/">Annuler</a>
                </div>
            </div>

            <!-- <div id="form-nav" class="block-flat bars-widget">
            </div> -->
        </div>
    </div>
</div>

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>