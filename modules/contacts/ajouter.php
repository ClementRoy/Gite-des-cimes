    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
    <?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>
    

    <?php if(isset($_POST['submit'])): ?>
        <?php //tool::output($_POST); ?>
        <?php //tool::output($_SESSION); ?>
        <?php 
            extract($_POST);
            $datas = array(
                            ':firstname' => $form_contact_firstname,
                            ':lastname' => $form_contact_lastname,
                            ':title' => $form_contact_title,
                            ':ref_contact' => $form_contact_contact,
                            ':civility' => $form_contact_civility,
                            ':email' => $form_contact_email,
                            ':phone' => $form_contact_telephone,
                            ':mobile_phone' => $form_contact_mobile_phone,
                            ':fax' => $form_contact_fax,
                            ':note' => $form_contact_note
                            );

            $result = contact::add($datas);

        ?>

    <?php if($result): ?>
        <div class="content">
            <div id="pad-wrapper" class="action-page">
                <div class="row header">
                    <div class="col-md-12">
                        <h3>Ajouter un contact</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-success">
                            <i class="icon-ok-sign"></i> 
                            Le contact <?=$form_contact_name; ?> a bien été ajoutée
                        </div>
                        <a href="/contacts/">Retourner à la liste des contacts</a>

                    </div>
                </div>
            </div>
        </div>

    <?php else: ?>

        <div class="content">
            <div id="pad-wrapper" class="action-page">
                <div class="row header">
                    <div class="col-md-12">
                        <h3>Ajouter une contact</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-danger">
                            <i class="icon-remove-sign"></i> 
                            Une erreur s'est produite durant l'ajout de la contact, veuillez réessayer
                        </div>
                        <a href="/contacts/ajouter">Retourner au formulaire d'ajout</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>



    <?php else: ?>
    <div class="content">
        <div id="pad-wrapper" class="form-page">
            <div class="row header">
                <div class="col-md-12">
                    <h3>Ajouter un contact</h3>
                </div>
            </div>

            <form id="form-add-contact" method="post" parsley-validate>
                   <!--  <h2>Informations sur le séjour</h2> -->
                     <div class="row form-wrapper">

                        <div class="field-box row">
                            <label class="col-md-2" for="form-enfant-structure-select">Nom de la structure</label>
                            <div class="col-md-4 col-sm-5" data-toggle="tooltip" title="Sélectionnez la structure qui s'occupe de cet enfant.">
                                <div class="ui-select">
                                    <?php $structures = structure::getList(); ?>
                                    <select id="form-enfant-structure-select" name="form_enfant_structure">
                                        <?php foreach($structures as $structure): ?>
                                        <option selected=""><?=$structure->name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>

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
                                <input id="form-contact-prenom" name="form_contact_firstname" class="form-control input-sm" type="text" data-toggle="tooltip" title="Renseignez le prénom du contact." parsley-required="true">
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
                                data-toggle="tooltip" title="Renseignez le numéro de téléphone mobile du contact." 
                                parsley-type="phone">
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

                        <div class="field-box row">
                            <label class="col-md-2" for="form-contact-note">Notes</label>
                            <div class="col-md-4 col-sm-5">
                                <textarea id="form-contact-note" name="form_contact_note" class="form-control" rows="4" data-toggle="tooltip" title="Notes générales au sujet de la strucure."></textarea>
                            </div>
                        </div>

                        <input type="submit" class="btn-flat primary" name="submit" value="Valider">
                    </div>
            </form>
        </div>
    </div>
    <?php endif; ?>

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>