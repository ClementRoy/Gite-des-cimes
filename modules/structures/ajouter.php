<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
<?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>


<?php $result = structure::add(array()); ?>
<?php $id = structure::getLastID(); ?>

<div class="title">
    <div class="row header">
        <div class="col-md-12">
            <h1>Ajouter une structure</h1>
        </div>
    </div>
</div>
<div class="content">

        <div class="row">
            <div class="col-md-12">

                <form id="form-add-structure" action="/structures/infos/id/<?=$id ?>" method="post" parsley-validate>

                    <input type="hidden" value="<?=$id ?>" name="id" />

                    <div class="field-box row">
                        <label class="col-md-2" for="form-structure-nom">Nom de la structure</label>
                        <div class="col-md-4">
                            <input id="form-structure-name" name="form_structure_name" class="form-control" type="text" 
                            data-toggle="tooltip" title="Renseignez le nom de la structure." parsley-required="true">
                        </div>
                    </div>

                    <div class="field-box row">
                        <label class="col-md-2" for="form-structure-service">Nom du service</label>
                        <div class="col-md-4">
                            <input id="form-structure-service" name="form_structure_service" class="form-control" type="text" 
                            data-toggle="tooltip" title="Renseignez le nom du service.">
                        </div>
                    </div>


                    <div class="field-box row">
                        <label class="col-md-2">Centre payeur</label>
                        <div class="col-md-4" data-toggle="tooltip" title="Précisez si cette structure paye les séjours.">
                            <label class="radio-inline col-md-7" for="form-structure-payeur-oui">
                                <div class="radio" id="uniform-form-structure-payeur-oui">
                                    <span class="checked">
                                        <input type="radio" name="form_structure_payer" id="form-structure-payeur-oui" value="1">
                                    </span>
                                </div>
                                Oui
                            </label>
                            <label class="radio-inline col-md-4" for="form-structure-payeur-non">
                                <div class="radio" id="uniform-form-structure-payeur-non">
                                    <span>
                                        <input type="radio" name="form_structure_payer" id="form-structure-payeur-non" value="0" checked="checked">
                                    </span>
                                </div>
                                Non
                            </label>
                        </div>
                    </div>

                    <div class="field-box row">
                        <label class="col-md-2" for="form-structure-email">Email</label>
                        <div class="col-md-4">
                            <input id="form-structure-email" name="form_structure_email" type="text" class="form-control"
                            data-toggle="tooltip" title="Renseignez l'email de la structure." 
                            parsley-type="email">
                        </div>
                    </div>     

                    <div class="field-box row">
                        <label class="col-md-2" for="form-structure-phone">Téléphone</label>
                        <div class="col-md-4">
                            <input id="form-structure-phone" name="form_structure_telephone" type="text" class="form-control"
                            data-toggle="tooltip" title="Renseignez le numéro de téléphone de la structure.">
                        </div>
                    </div>

                    <div class="field-box row">
                        <label class="col-md-2" for="form-structure-fax">Fax</label>
                        <div class="col-md-4">
                            <input id="form-structure-fax" name="form_structure_fax" type="text" class="form-control"
                            data-toggle="tooltip" title="Renseignez le numéro de fax de la structure.">
                        </div>
                    </div>

                    <div class="field-box row">
                        <label class="col-md-2" for="form-structure-adresse-numero">Adresse de la structure</label>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-3">
                                    <input id="form-structure-adresse-numero" name="form_structure_adresse_numero" class="form-control adresse-numero" type="text" placeholder="N°" data-toggle="tooltip" title="Renseignez le numéro de l'adresse de la structure.">
                                </div>
                                <div class="col-md-9"><input id="form-structure-adresse-voirie" name="form_structure_adresse_voirie" class="form-control adresse-voirie" type="text" placeholder="Nom de la voirie" data-toggle="tooltip" title="Renseignez le nom de la voirie de l'adresse de la structure."></div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input id="form-structure-addresse-comp" name="form_structure_addresse_comp" class="form-control addresse-complement" type="text" 
                                    data-toggle="tooltip" title="Renseignez l'addresse complémentaire." placeholder="Complément d'addresse">  
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><input id="form-structure-adresse-code-postal" name="form_structure_adresse_code_postal" class="form-control adresse-postal" type="text" placeholder="Code postal" data-toggle="tooltip" title="Renseignez le code postal de la ville de la structure."></div>
                                <div class="col-md-8"><input id="form-structure-adresse-code-ville" name="form_structure_adresse_code_ville" class="form-control adresse-ville" type="text" placeholder="Ville" data-toggle="tooltip" title="Renseignez le nom de la ville de la structure."></div>
                            </div>

                        </div>
                    </div>

                    <div class="field-box row">
                        <label class="col-md-2" for="form-structure-note">Notes</label>
                        <div class="col-md-4 col-sm-5">
                            <textarea id="form-structure-note" name="form_structure_note" class="form-control" rows="4" data-toggle="tooltip" title="Notes générales au sujet de la strucure."></textarea>
                        </div>
                    </div>

                    <div class="field-box row">
                        <div class="col-md-5 col-md-offset-2">
                             <a href="#add_contact" id="add_contact" class="btn btn-default">Ajouter les coordonnées d'un contact ?</a>
                        </div>
                    </div>

                    <div class="hide" id="panel_add_contact">
                        <div class="field-box row">
                            <label class="col-md-2">Civilité</label>
                            <div class="col-md-4" data-toggle="tooltip" title="Précisez la civilité du contact">
                                <label class="radio-inline col-md-7" for="form-contact-civility-mme">
                                    <div class="radio" id="uniform-form-contact-civility-mme">
                                        <span class="checked">
                                            <input type="radio" name="form_contact_civility" id="form-contact-civility-mme" value="Mme">
                                        </span>
                                    </div>
                                    Mme
                                </label>
                                <label class="radio-inline col-md-4" for="form-contact-civility-mr">
                                    <div class="radio" id="uniform-form-contact-civility-mr">
                                        <span class="checked">
                                            <input type="radio" name="form_contact_civility" id="form-contact-civility-mr" value="Mr" checked="">
                                        </span>
                                    </div>
                                    Mr
                                </label>
                            </div>
                        </div>

                        <div class="field-box row">
                            <label class="col-md-2" for="form-contact-prenom">Prénom</label>
                            <div class="col-md-4 col-sm-5">
                                <input id="form-contact-prenom" name="form_contact_firstname" class="form-control input-sm" type="text" data-toggle="tooltip" title="Renseignez le prénom du contact.">
                            </div>
                        </div>

                        <div class="field-box row">
                            <label class="col-md-2" for="form-contact-nom">Nom</label>
                            <div class="col-md-4 col-sm-5">
                                <input id="form-contact-nom" name="form_contact_lastname" class="form-control input-sm input-sm" type="text" data-toggle="tooltip" title="Renseignez le nom du contact." parsley-required="true">
                            </div>
                        </div>

                        <div class="field-box row">
                            <label class="col-md-2" for="form-contact-title">Titre</label>
                            <div class="col-md-4">
                                <input id="form-contact-title" name="form_contact_title" class="form-control" type="text" 
                                data-toggle="tooltip" title="Renseignez le titre de la contact." parsley-required="true">
                            </div>
                        </div>

                        <div class="field-box row">
                            <label class="col-md-2" for="form-contact-email">Email</label>
                            <div class="col-md-4">
                                <input id="form-contact-email" name="form_contact_email" type="text" class="form-control"
                                data-toggle="tooltip" title="Renseignez l'email de la contact." 
                                parsley-type="email">
                            </div>
                        </div>     

                        <div class="field-box row">
                            <label class="col-md-2" for="form-contact-phone">Téléphone</label>
                            <div class="col-md-4">
                                <input id="form-contact-phone" name="form_contact_telephone" type="text" class="form-control"
                                data-toggle="tooltip" title="Renseignez le numéro de téléphone de la contact." 
                                parsley-type="phone">
                            </div>
                        </div>

                        <div class="field-box row">
                            <label class="col-md-2" for="form-contact-mobile-phone">Téléphone mobile</label>
                            <div class="col-md-4">
                                <input id="form-contact-mobile-phone" name="form_contact_mobile_phone" type="text" class="form-control"
                                data-toggle="tooltip" title="Renseignez le numéro de téléphone mobile du contact.">
                            </div>
                        </div>

                        <div class="field-box row">
                            <label class="col-md-2" for="form-contact-fax">Fax</label>
                            <div class="col-md-4">
                                <input id="form-contact-fax" name="form_contact_fax" type="text" class="form-control"
                                data-toggle="tooltip" title="Renseignez le numéro de fax de la contact." 
                                parsley-type="phone">
                                </div>
                        </div>                        


                    </div>
                   

                    <div class="field-box actions">
                        <div class="col-md-6  col-md-offset-2">
                            <input type="submit" class="btn btn-primary" name="submit-add" value="Ajouter la structure">
                            <span>OU</span>
                            <a href="/structures/" class="reset">Annuler</a>
                        </div>
                    </div>

                </form>
            </div>
        </div>

</div>

<script>
    $(function () {
        $('#add_contact').click(function(e){
            e.preventDefault();
            $('#panel_add_contact').removeClass('hide');
        })
    });
</script>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>