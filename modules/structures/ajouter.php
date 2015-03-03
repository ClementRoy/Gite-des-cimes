<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
<?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>


<?php $result = structure::add(array()); ?>
<?php $id = structure::getLastID(); ?>

<!-- Page title -->
<div class="page-head">
    <div class="row">
        <div class="col-md-8">
            <h1>Ajouter une structure</h1>
        </div>
    </div>
</div>
<!-- /Page title -->

<div class="row">
    <div class="col-md-9">
        <div class="block-flat">
            <div class="content">

                <form id="form-add-structure" action="/structures/infos/id/<?=$id ?>" class="form-horizontal group-border-dashed maped-form" method="post" data-parsley-validate>

                    <input type="hidden" value="<?=$id ?>" name="id" />

                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="form-structure-nom">Nom de la structure</label>
                        <div class="col-sm-6">
                            <input id="form-structure-name" name="form_structure_name" class="form-control" type="text" 
                            data-toggle="tooltip" title="Renseignez le nom de la structure." data-parsley-required="true">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="form-structure-service">Nom du service</label>
                        <div class="col-sm-6">
                            <input id="form-structure-service" name="form_structure_service" class="form-control" type="text" 
                            data-toggle="tooltip" title="Renseignez le nom du service.">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">Centre payeur</label>
                        <div class="col-sm-6">
                            <label class="radio-inline" for="form-structure-payeur-oui"><input type="radio" class="icheck" name="form_structure_payer" id="form-structure-payeur-oui" value="1"> Oui</label>
                            <label class="radio-inline" for="form-structure-payeur-non"><input type="radio" class="icheck" name="form_structure_payer" id="form-structure-payeur-non" value="0" checked="checked"> Non</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="form-structure-email">Email</label>
                        <div class="col-sm-6">
                            <input id="form-structure-email" name="form_structure_email" type="text" class="form-control input-email"
                            data-toggle="tooltip" title="Renseignez l'email de la structure." 
                            data-parsley-type="email">
                        </div>
                    </div>     

                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="form-structure-phone">Téléphone</label>
                        <div class="col-sm-6">
                            <input id="form-structure-phone" name="form_structure_telephone" type="text" class="form-control input-phone"
                            data-toggle="tooltip" title="Renseignez le numéro de téléphone de la structure.">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="form-structure-fax">Fax</label>
                        <div class="col-sm-6">
                            <input id="form-structure-fax" name="form_structure_fax" type="text" class="form-control input-phone"
                            data-toggle="tooltip" title="Renseignez le numéro de fax de la structure.">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="form-structure-adresse-numero">Adresse de la structure</label>
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-md-3"><input id="form-structure-adresse-numero" name="form_structure_adresse_numero" class="form-control adresse-numero" type="text" placeholder="N°" data-toggle="tooltip" title="Renseignez le numéro de l'adresse de la structure."></div>
                                <div class="col-md-9"><input id="form-structure-adresse-voirie" name="form_structure_adresse_voirie" class="form-control adresse-voirie" type="text" placeholder="Nom de la voirie" data-toggle="tooltip" title="Renseignez le nom de la voirie de l'adresse de la structure."></div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input id="form-structure-addresse-comp" name="form_structure_addresse_comp" class="form-control addresse-complement" type="text" 
                                    data-toggle="tooltip" title="Renseignez l'addresse complémentaire." placeholder="Complément d'addresse">  
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3"><input id="form-structure-adresse-code-postal" name="form_structure_adresse_code_postal" class="form-control adresse-postal" type="text" placeholder="Code postal" data-toggle="tooltip" title="Renseignez le code postal de la ville de la structure."></div>
                                <div class="col-md-9"><input id="form-structure-adresse-code-ville" name="form_structure_adresse_code_ville" class="form-control adresse-ville" type="text" placeholder="Ville" data-toggle="tooltip" title="Renseignez le nom de la ville de la structure."></div>
                            </div>

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="form-structure-note">Notes</label>
                        <div class="col-sm-6">
                            <textarea id="form-structure-note" name="form_structure_note" class="form-control" rows="4" data-toggle="tooltip" title="Notes générales au sujet de la strucure."></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="form-structure-note">Ajouter les cooronnées d'un contact ?</label>
                        <div class="col-sm-6">
                             <a href="#add_contact" id="add_contact" class="btn btn-prusia btn-rad">Afficher le formulaire d'ajout</a>
                        </div>
                    </div>

                    <div class="hide" id="panel_add_contact">

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
                                <input id="form-contact-nom" name="form_contact_lastname" class="form-control input-sm input-sm" type="text" data-toggle="tooltip" title="Renseignez le nom du contact.">
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
                                data-toggle="tooltip" title="Renseignez le numéro de téléphone de la contact." >
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


                    </div>

                    <div class="form-group actions text-center">
                        <div class="col-md-8 col-md-offset-2">
                            <input type="hidden" name="submit-add" value="Enregistrer la nouvelle structure">
                            <input type="submit" class="btn btn-primary btn-rad btn-lg" value="Enregistrer la nouvelle structure">
                            <span>OU</span>
                            <a href="/structures/" class="reset">Annuler</a>
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
                    <button class="btn btn-primary btn-block btn-rad">Enregistrer la nouvelle structure</button>
                    <a href="/structures/">Annuler</a>
                </div>
            </div>

            <!-- <div id="form-nav" class="block-flat bars-widget">
            </div> -->
        </div>
    </div>
</div>

<?php ob_start(); ?>
<script>
    $(function() {

        $('body').on('click', '#add_contact', function(event) {
            event.preventDefault();
            $('#panel_add_contact').removeClass('hide');
            $(this).attr('id', 'remove_contact').text('Masquer le formulaire d\'ajout');
        });

        $('body').on('click', '#remove_contact', function(event) {
            event.preventDefault();
            $('#panel_add_contact').addClass('hide').find('input').val('');
            $(this).attr('id', 'add_contact').text('Afficher le formulaire d\'ajout');
        });

    });
</script>
<?php $scripts .= ob_get_contents();
ob_end_clean(); ?>

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>