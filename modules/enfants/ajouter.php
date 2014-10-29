<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
<?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>

<?php $result = enfant::add(array()); ?>
<?php $id = enfant::getLastID(); ?>

<div class="title">
    <div class="row header">
        <div class="col-md-12">
            <h1>Ajouter un enfant</h1>
        </div>
    </div>
</div>
<div class="content">
    <div class="row">
        <div class="col-md-10">
            
            <form id="form-add-children" method="post" action="/enfants/infos/id/<?=$id ?>" class="maped-form" parsley-validate enctype="multipart/form-data">
                <input type="hidden" value="<?=$id ?>" name="id" />
                <div class="row form-wrapper">
                    <div class="field-box row">
                        <label class="col-md-2" for="form-enfant-prenom">Prénom</label>
                        <div class="col-md-5">
                            <input id="form-enfant-prenom" name="form_enfant_prenom" class="form-control" type="text" data-toggle="tooltip" title="Renseignez le prénom de l'enfant." parsley-required="true">
                        </div>
                    </div>
                    <div class="field-box row">
                        <label class="col-md-2" for="form-enfant-nom">Nom</label>
                        <div class="col-md-5">
                            <input id="form-enfant-nom" name="form_enfant_nom" class="form-control" type="text" data-toggle="tooltip" title="Renseignez le nom de l'enfant." parsley-required="true">
                        </div>
                    </div>

                    <div class="field-box row">
                        <label class="col-md-2" for="form-enfant-picture">Photo</label>
                        <div class="col-md-5">
                            <input type="file" name="form_enfant_picture" id="form-enfant-picture">
                        </div>
                    </div>

                    <div class="field-box row">
                        <label class="col-md-2" for="form-enfant-naissance">Date de naissance</label>
                        <div class="col-md-5">
                            <input parsley-regexp="([0-3][0-9]|[1-9])/([1-9]|1[0-2]|0[1-9])/([1-2][0|9][0-9]{2})" id="form-enfant-naissance"  name="form_enfant_naissance" type="text" class="form-control input-datepicker" placeholder="JJ/MM/AAAA" data-toggle="tooltip" title="Renseignez la date de naissance de l'enfant (jj/mm/aaaa).">
                        </div>
                    </div>

                    <div class="field-box row">
                        <label class="col-md-2">Sexe de l'enfant</label>
                        <div class="col-md-5" data-toggle="tooltip" title="Précisez le sexe de l'enfant.">
                            <label class="radio-inline col-md-6" for="form-enfant-sexe-m">
                                <input type="radio" name="form_enfant_sexe" id="form-enfant-sexe-m" value="masculin" checked="checked">
                                Masculin
                            </label>
                            <label class="radio-inline col-md-4" for="form-enfant-sexe-f"> 
                                <input type="radio" name="form_enfant_sexe" id="form-enfant-sexe-f" value="féminin">
                                Féminin
                            </label>
                        </div>
                    </div>


                    <!-- <h2>Informations administratives</h2> -->
                    <div class="field-box row">
                        <label class="col-md-2">L'enfant est inscrit par</label>
                        <div class="col-md-5" data-toggle="tooltip" title="Précisez qui a inscrit cet enfant au séjour/week-end.">
                            <div class="radio">
                                <label for="form-enfant-inscription-structure">
                                    <input type="radio" name="form_enfant_inscription" id="form-enfant-inscription-structure" value="structure" checked="checked">
                                    Une structure
                                </label>
                            </div>
                            <div class="radio">
                                <label for="form-enfant-inscription-particulier">
                                    <input type="radio" name="form_enfant_inscription" id="form-enfant-inscription-particulier" value="particulier">
                                    Un particulier
                                </label>
                            </div>
                        </div>
                    </div>


                    <div data-group="structure">
                        <div class="field-box row">
                            <label class="col-md-2" for="form-enfant-structure-select">Nom de la structure</label>
                            <div class="col-md-5" data-toggle="tooltip" title="Sélectionnez la structure qui s'occupe de cet enfant.">
                                <div class="ui-select">
                                    <?php $structures = structure::getList(); ?>
                                    <select class="form-control" id="form-enfant-structure-select" name="form_enfant_structure">
                                        <option value="" selected="selected">Sélectionnez la structure</option>
                                        <?php foreach($structures as $structure): ?>
                                            <option value="<?=$structure->id ?>"><?=$structure->name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <?php //TODO : ajouter la possibilité de créer une sutrcutre à la volée ?>
                            </div>
                        </div>
                        <div class="field-box row">
                            <label class="col-md-2" for="form-enfant-contact-select">Nom du contact</label>
                            <div class="col-md-5" data-toggle="tooltip" title="Sélectionnez le contact responsable de l'enfant.">
                                <div class="ui-select">
                                    <select class="form-control" id="form-enfant-contact-select" name="form_enfant_contact">
                                        <option selected="">Sélectionnez un contact</option>
                                    </select>
                                </div>
                                <?php // TODO : ajouter la possibilité de créer une structure à la volée ?>
                            </div>
                        </div>
                    </div>

                    <div class="field-box row">
                        <label class="col-md-2">Responsable légal de l'enfant</label>
                        <div class="col-md-5" data-toggle="tooltip" title="Précisez qui est le responsable légal de l'enfant.">
                            <div class="radio">
                                <label for="form-enfant-responsable-defaut">
                                    <input type="radio" name="form_enfant_responsable" id="form-enfant-responsable-defaut" value="" checked="cheked">
                                    Non renseigné
                                </label>
                            </div>
                            <div class="radio">
                                <label for="form-enfant-responsable-structure">
                                    <input type="radio" name="form_enfant_responsable" id="form-enfant-responsable-structure" value="structure">
                                    Structure
                                </label>
                            </div>
                            <div class="radio">
                                <label for="form-enfant-responsable-parents">

                                    <input type="radio" name="form_enfant_responsable" id="form-enfant-responsable-parents" value="parents">
                                    Parents
                                </label>
                            </div>
                            <div class="radio">
                                <label for="form-enfant-responsable-pere">
                                    <input type="radio" name="form_enfant_responsable" id="form-enfant-responsable-pere" value="pere">
                                    Père
                                </label>
                            </div>
                            <div class="radio">
                                <label for="form-enfant-responsable-mere">

                                    <input type="radio" name="form_enfant_responsable" id="form-enfant-responsable-mere" value="mere">
                                    Mère
                                </label>
                            </div>
                            <div class="radio">
                                <label for="form-enfant-responsable-tuteur">
                                    <input type="radio" name="form_enfant_responsable" id="form-enfant-responsable-tuteur" value="tuteur">
                                    Tuteur
                                </label>
                            </div>
                        </div>
                    </div>

                    <div data-responsable="parents">
                        <div data-responsable="pere">
                            <div class="field-box row">
                                <label class="col-md-2" for="form-enfant-nom-pere">Nom du père</label>
                                <div class="col-md-5">
                                    <input id="form-enfant-nom-pere" name="form_enfant_nom_pere" class="form-control" type="text" data-toggle="tooltip" title="Renseignez le nom et prénom du père.">
                                </div>
                            </div>
                            <div class="field-box row">
                                <label class="col-md-2" for="form-enfant-telephone-fixe-pere">Téléphone fixe</label>
                                <div class="col-md-5">
                                    <input id="form-enfant-telephone-pere" name="form_enfant_telephone_fixe_pere" class="form-control input-phone" type="text" data-toggle="tooltip" title="Renseignez le numéro de téléphone fixe du père.">
                                </div>
                            </div>
                            <div class="field-box row">
                                <label class="col-md-2" for="form-enfant-telephone-portable-pere">Téléphone portable</label>
                                <div class="col-md-5">
                                    <input id="form-enfant-telephone-pere" name="form_enfant_telephone_portable_pere" class="form-control input-phone" type="text" data-toggle="tooltip" title="Renseignez le numéro de téléphone portable du père.">
                                </div>
                            </div>
                            <div class="field-box row">
                                <label class="col-md-2" for="form-enfant-telephone-professionnel-pere">Téléphone professionnel</label>
                                <div class="col-md-5">
                                    <input id="form-enfant-professionnel-pere" name="form_enfant_telephone_professionnel_pere" class="form-control input-phone" type="text" data-toggle="tooltip" title="Renseignez le numéro de téléphone professionnel du père.">
                                </div>
                            </div>
                            <div class="field-box row">
                                <label class="col-md-2" for="form-enfant-adresse-numero-pere">Adresse du père</label>
                                <div class="col-md-5">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <input id="form-enfant-adresse-numero-pere" name="form_enfant_adresse_numero_pere" class="form-control adresse-numero" type="text" placeholder="N°" data-toggle="tooltip" title="Renseignez le numéro de l'adresse du père.">
                                        </div>
                                        <div class="col-md-9"><input id="form-enfant-adresse-voirie-pere" name="form_enfant_adresse_voirie_pere" class="form-control adresse-voirie" type="text" placeholder="Nom de la voirie" data-toggle="tooltip" title="Renseignez le nom de la voirie de l'adresse du père."></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4"><input id="form-enfant-adresse-code-postal-pere" name="form_enfant_adresse_code_postal_pere" class="form-control adresse-postal" type="text" placeholder="Code postal" data-toggle="tooltip" title="Renseignez le code postal de la ville du père."></div>
                                        <div class="col-md-8"><input id="form-enfant-adresse-code-ville-pere" name="form_enfant_adresse_code_ville_pere" class="form-control adresse-ville" type="text" placeholder="Ville" data-toggle="tooltip" title="Renseignez le nom de la ville du père."></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div data-responsable="mere">
                            <div class="field-box row">
                                <label class="col-md-2" for="form-enfant-nom-mere">Nom de la mère</label>
                                <div class="col-md-5">
                                    <input id="form-enfant-nom-mere" name="form_enfant_nom_mere" class="form-control" type="text" data-toggle="tooltip" title="Renseignez le nom et prénom de la mère.">
                                </div>
                            </div>
                            <div class="field-box row">
                                <label class="col-md-2" for="form-enfant-telephone-fixe-mere">Téléphone fixe</label>
                                <div class="col-md-5">
                                    <input id="form-enfant-telephone-fixe-mere" name="form_enfant_telephone_fixe_mere" class="form-control input-phone" type="text" data-toggle="tooltip" title="Renseignez le numéro de téléphone fixe de la mère.">
                                </div>
                            </div>
                            <div class="field-box row">
                                <label class="col-md-2" for="form-enfant-telephone-portable-mere">Téléphone portable</label>
                                <div class="col-md-5">
                                    <input id="form-enfant-telephone-portable-mere" name="form_enfant_telephone_portable_mere" class="form-control input-phone" type="text" data-toggle="tooltip" title="Renseignez le numéro de téléphone portable de la mère.">
                                </div>
                            </div>
                            <div class="field-box row">
                                <label class="col-md-2" for="form-enfant-telephone-professionnel-mere">Téléphone professionnel</label>
                                <div class="col-md-5">
                                    <input id="form-enfant-telephone-professionnel-mere" name="form_enfant_telephone_professionnel_mere" class="form-control input-phone" type="text" data-toggle="tooltip" title="Renseignez le numéro de téléphone professionnel de la mère.">
                                </div>
                            </div>
                            <div class="field-box row">
                                <label class="col-md-2" for="form-enfant-adresse-numero-mere">Adresse de la mère</label>
                                <div class="col-md-5">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <input id="form-enfant-adresse-numero-mere" name="form_enfant_adresse_numero_mere" class="form-control adresse-numero" type="text" placeholder="N°" data-toggle="tooltip" title="Renseignez le numéro de l'adresse de la mère.">
                                        </div>
                                        <div class="col-md-9"><input id="form-enfant-adresse-voirie-mere" name="form_enfant_adresse_voirie_mere" class="form-control adresse-voirie" type="text" placeholder="Nom de la voirie" data-toggle="tooltip" title="Renseignez le nom de la voirie de l'adresse de la mère."></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4"><input id="form-enfant-adresse-code-postal-mere" name="form_enfant_adresse_code_postal_mere" class="form-control adresse-postal" type="text" placeholder="Code postal" data-toggle="tooltip" title="Renseignez le code postal de la ville de la mère."></div>
                                        <div class="col-md-8"><input id="form-enfant-adresse-code-ville-mere" name="form_enfant_adresse_code_ville_mere" class="form-control adresse-ville" type="text" placeholder="Ville" data-toggle="tooltip" title="Renseignez le nom de la ville de la mère."></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div data-responsable="tuteur">
                        <div class="field-box row">
                            <label class="col-md-2" for="form-enfant-nom-tuteur">Nom du tuteur</label>
                            <div class="col-md-5">
                                <input id="form-enfant-nom-tuteur" name="form_enfant_nom_tuteur" class="form-control" type="text" data-toggle="tooltip" title="Renseignez le nom et prénom du tuteur.">
                            </div>
                        </div>
                        <div class="field-box row">
                            <label class="col-md-2" for="form-enfant-telephone-fixe-tuteur">Téléphone fixe</label>
                            <div class="col-md-5">
                                <input id="form-enfant-telephone-fixe-tuteur" name="form_enfant_telephone_fixe_tuteur" class="form-control input-phone" type="text" data-toggle="tooltip" title="Renseignez le numéro de téléphone fixe du tuteur.">
                            </div>
                        </div>
                        <div class="field-box row">
                            <label class="col-md-2" for="form-enfant-telephone-portable-tuteur">Téléphone portable</label>
                            <div class="col-md-5">
                                <input id="form-enfant-telephone-portable-tuteur" name="form_enfant_telephone_portable_tuteur" class="form-control input-phone" type="text" data-toggle="tooltip" title="Renseignez le numéro de téléphone portable du tuteur.">
                            </div>
                        </div>
                        <div class="field-box row">
                            <label class="col-md-2" for="form-enfant-telephone-travail-tuteur">Téléphone professionnel</label>
                            <div class="col-md-5">
                                <input id="form-enfant-telephone-professionnel-tuteur" name="form_enfant_telephone_professionnel_tuteur" class="form-control input-phone" type="text" data-toggle="tooltip" title="Renseignez le numéro de téléphone professionnel du tuteur.">
                            </div>
                        </div>
                        <div class="field-box row">
                            <label class="col-md-2" for="form-enfant-adresse-numero-tuteur">Adresse du tuteur</label>
                            <div class="col-md-5">
                                <div class="row">
                                    <div class="col-md-3">
                                        <input id="form-enfant-adresse-numero-tuteur" name="form_enfant_adresse_numero_tuteur" class="form-control adresse-numero" type="text" placeholder="N°" data-toggle="tooltip" title="Renseignez le numéro de l'adresse du tuteur.">
                                    </div>
                                    <div class="col-md-9"><input id="form-enfant-adresse-voirie-tuteur" name="form_enfant_adresse_voirie_tuteur" class="form-control adresse-voirie" type="text" placeholder="Nom de la voirie" data-toggle="tooltip" title="Renseignez le nom de la voirie de l'adresse du tuteur."></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"><input id="form-enfant-adresse-code-postal-tuteur" name="form_enfant_adresse_code_postal_tuteur" class="form-control adresse-postal" type="text" placeholder="Code postal" data-toggle="tooltip" title="Renseignez le code postal de la ville du tuteur."></div>
                                    <div class="col-md-8"><input id="form-enfant-adresse-code-ville-tuteur" name="form_enfant_adresse_code_ville_tuteur" class="form-control adresse-ville" type="text" placeholder="Ville" data-toggle="tooltip" title="Renseignez le nom de la ville du tuteur."></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="field-box row">
                        <label class="col-md-2">Domiciliation de l'enfant</label>
                        <div class="col-md-5" data-toggle="tooltip" title="Précisez chez qui habite l'enfant.">
                            <div class="radio">
                                <label for="form-enfant-domiciliation-responsable">
                                    <input type="radio" name="form_enfant_domiciliation" id="form-enfant-domiciliation-responsable" value="responsable" checked="checked">
                                    Responsable légal
                                </label>
                            </div>
                            <div class="radio">
                                <label for="form-enfant-domiciliation-famille">
                                    <input type="radio" name="form_enfant_domiciliation" id="form-enfant-domiciliation-famille" value="famille">
                                    Famille d'accueil
                                </label>
                            </div>
                        </div>
                    </div>

                    <div data-domiciliation="famille">
                        <div class="field-box row">
                            <label class="col-md-2" for="form-enfant-nom-famille">Nom de la famille d'accueil</label>
                            <div class="col-md-5">
                                <input id="form-enfant-nom-famille" name="form_enfant_nom_famille" class="form-control" type="text" data-toggle="tooltip" title="Renseignez le nom de la famille d'accueil.">
                            </div>
                        </div>

                        <div class="field-box row">
                            <label class="col-md-2" for="form-enfant-telephone-fixe-famille">Téléphone fixe</label>
                            <div class="col-md-5">
                                <input id="form-enfant-telephone-fixe-famille" name="form_enfant_telephone_fixe_famille" class="form-control input-phone" type="text" data-toggle="tooltip" title="Renseignez le numéro de téléphone fixe de la famille d'accueil.">
                            </div>
                        </div>
                        <div class="field-box row">
                            <label class="col-md-2" for="form-enfant-telephone-portable-famille">Téléphone portable</label>
                            <div class="col-md-5">
                                <input id="form-enfant-telephone-portable-famille" name="form_enfant_telephone_portable_famille" class="form-control input-phone" type="text" data-toggle="tooltip" title="Renseignez le numéro de téléphone portable de la famille d'accueil.">
                            </div>
                        </div>
                        <div class="field-box row">
                            <label class="col-md-2" for="form-enfant-telephone-professionnel-famille">Téléphone professionnel</label>
                            <div class="col-md-5">
                                <input id="form-enfant-telephone-professionnel-famille" name="form_enfant_telephone_professionnel_famille" class="form-control input-phone" type="text" data-toggle="tooltip" title="Renseignez le numéro de téléphone professionnel de la famille d'accueil.">
                            </div>
                        </div>

                        <div class="field-box row">
                            <label class="col-md-2" for="form-enfant-adresse-numero-famille">Adresse de la famille d'accueil</label>
                            <div class="col-md-5">
                                <div class="row">
                                    <div class="col-md-3">
                                        <input id="form-enfant-adresse-numero-famille" name="form_enfant_adresse_numero_famille" class="form-control adresse-numero" type="text" placeholder="N°" data-toggle="tooltip" title="Renseignez le numéro de l'adresse de la famille d'accueil.">
                                    </div>
                                    <div class="col-md-9"><input id="form-enfant-adresse-voirie-famille" name="form_enfant_adresse_voirie_famille" class="form-control adresse-voirie" type="text" placeholder="Nom de la voirie" data-toggle="tooltip" title="Renseignez le nom de la voirie de l'adresse de la famille d'accueil."></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"><input id="form-enfant-adresse-code-postal-famille" name="form_enfant_adresse_code_postal_famille" class="form-control adresse-postal" type="text" placeholder="Code postal" data-toggle="tooltip" title="Renseignez le code postal de la ville de la famille d'accueil."></div>
                                    <div class="col-md-8"><input id="form-enfant-adresse-code-ville-famille" name="form_enfant_adresse_code_ville_famille" class="form-control adresse-ville" type="text" placeholder="Ville" data-toggle="tooltip" title="Renseignez le nom de la ville de la famille d'accueil."></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="field-box row">
                        <label class="col-md-2" for="form-enfant-nom-urgence">Contact d'urgence</label>
                        <div class="col-md-5">
                            <input id="form-enfant-nom-urgence" name="form_enfant_nom_urgence" class="form-control" type="text" data-toggle="tooltip" title="Renseignez le nom et prénom de la personne à contacter en cas d'urgence.">
                        </div>
                    </div>
                    <div class="field-box row">
                        <label class="col-md-2" for="form-enfant-telephone-urgence">Téléphone d'urgence</label>
                        <div class="col-md-5">
                            <input id="form-enfant-telephone-urgence" name="form_enfant_telephone_urgence" class="form-control input-phone" type="text" data-toggle="tooltip" title="Renseignez le numéro de téléphone de la personne à contacter en cas d'urgence.">
                        </div>
                    </div>

                    <div class="field-box row">
                        <label class="col-md-2">Droit à l'image</label>
                        <div class="col-md-5" data-toggle="tooltip" title="Précisez si des photos/vidéos de l'enfant peuvent être utilisé par le gîte.">
                            <label class="radio-inline col-md-3" for="form-enfant-droit-image-non-fourni">
                                <input type="radio" name="form_enfant_droit_image" id="form-enfant-droit-image-non-fourni" value="0" checked="checked">
                                Non fourni
                            </label>
                            <label class="radio-inline col-md-3" for="form-enfant-droit-image-oui">
                                <input type="radio" name="form_enfant_droit_image" id="form-enfant-droit-image-oui" value="1">
                                Oui
                            </label>
                            <label class="radio-inline col-md-3" for="form-enfant-droit-image-non">
                                <input type="radio" name="form_enfant_droit_image" id="form-enfant-droit-image-non" value="2">
                                Non
                            </label>
                        </div>
                    </div>


                    <!-- <h2>Informations sanitaires</h2> -->
                    <div class="field-box row">
                        <label class="col-md-2">Traitement(s) médical(s)</label>
                        <div class="col-md-5" data-toggle="tooltip" title="Précisez si l'enfant suit un traitement médical.">
                            <label class="radio-inline col-md-6" for="form-enfant-traitement-medical-oui">
                                <input type="radio" name="form_enfant_traitement_medical" id="form-enfant-traitement-medical-oui" value="1">
                                Oui
                            </label>
                            <label class="radio-inline col-md-4" for="form-enfant-traitement-medical-non">
                                <input type="radio" name="form_enfant_traitement_medical" id="form-enfant-traitement-medical-non" value="0" checked="checked">
                                Non
                            </label>
                        </div>
                    </div>
                    <div class="field-box row">
                        <label class="col-md-2" for="form-enfant-contre-indication">Contre-indications / allergies</label>
                        <div class="col-md-5">
                            <textarea id="form-enfant-contre-indication" name="form_enfant_contre_indication" class="form-control" rows="4" data-toggle="tooltip" title="Renseignez les contre-indication(s) et/ou allergie(s) connue(s) de l'enfant."></textarea>
                        </div>
                    </div>

                    <div class="field-box row">
                        <label class="col-md-2" for="form-enfant-numero-securite">N° de sécurité sociale</label>
                        <div class="col-md-5">
                            <input id="form-enfant-numero-securite" name="form_enfant_numero_securite" class="form-control input-securite-social" type="text" data-toggle="tooltip" title="Renseignez le numéro de sécurité sociale de l'enfant.">
                        </div>
                    </div>

                    <div class="field-box row">
                        <label class="col-md-2">Assurance (RC)</label>
                        <div class="col-md-5" data-toggle="tooltip" title="Précisez si l'enfant est convert par une assurance (responsabilité civile).">
                            <label class="radio-inline col-md-6" for="form-enfant-assurance-oui">
                                <input type="radio" name="form_enfant_assurance" id="form-enfant-assurance-oui" value="1">
                                Oui
                            </label>
                            <label class="radio-inline col-md-4">
                                <input type="radio" name="form_enfant_assurance" id="form-enfant-assurance-non" value="0" checked="checked">
                                Non
                            </label>
                        </div>
                    </div>

                    <div data-assurance="oui">
                        <div class="field-box row">
                            <label class="col-md-2" for="form-enfant-assurance-validite">Date de fin de validité</label>
                            <div class="col-md-5">
                                <input id="form-enfant-assurance-validite" name="form_enfant_assurance_validite" type="text" class="form-control input-datepicker" value="15/06/2014" data-toggle="tooltip" title="Renseignez la date de fin de validité de l'assurance (jj/mm/aaaa).">
                            </div>
                        </div>
                    </div>
                    <div class="field-box row">
                        <label class="col-md-2">Attestation CPAM</label>
                        <div class="col-md-5" data-toggle="tooltip" title="Précisez si l'attestation CPAM est dans le dossier de l'enfant.">
                            <label class="radio-inline col-md-6" for="form-enfant-attestation-cpam-oui">
                                <input type="radio" name="form_enfant_attestation_cpam" id="form-enfant-attestation-cpam-oui" value="1">
                                Oui
                            </label>
                            <label class="radio-inline col-md-4" for="form-enfant-attestation-cpam-non">
                                <input type="radio" name="form_enfant_attestation_cpam" id="form-enfant-attestation-cpam-non" value="0" checked="checked">
                                Non
                            </label>
                        </div>
                    </div>
                    <div data-cpam="oui">
                        <div class="field-box row">
                            <label class="col-md-2" for="form-enfant-cpam-validite">Date de fin de validité</label>
                            <div class="col-md-5">
                                <input id="form-enfant-cpam-validite" name="form_enfant_cpam_validite" type="text" class="form-control input-datepicker" data-toggle="tooltip" title="Renseignez la date de fin de validité de l'attestation CPAM (jj/mm/aaaa).">
                            </div>
                        </div>
                    </div>
                    <div class="field-box row">
                        <label class="col-md-2">Carnet de vaccination</label>
                        <div class="col-md-5" data-toggle="tooltip" title="Précisez si le carnet de vaccination est dans le dossier de l'enfant.">
                            <label class="radio-inline col-md-6" for="form-enfant-carnet-vaccination-oui">
                                <input type="radio" name="form_enfant_carnet_vaccination" id="form-enfant-carnet-vaccination-oui" value="1">
                                Oui
                            </label>
                            <label class="radio-inline col-md-4" for="form-enfant-carnet-vaccination-non">
                                <input type="radio" name="form_enfant_carnet_vaccination" id="form-enfant-carnet-vaccination-non" value="0" checked="checked">
                                Non
                            </label>
                        </div>
                    </div>
                    <div class="field-box row">
                        <label class="col-md-2">Fiche sanitaire de liaison</label>
                        <div class="col-md-5" data-toggle="tooltip" title="Précisez si la fiche sanitaire de liaison est dans le dossier de l'enfant.">
                            <label class="radio-inline col-md-6" for="form-enfant-fiche-sanitaire-oui">
                                <input type="radio" name="form_enfant_fiche_sanitaire" id="form-enfant-fiche-sanitaire-oui" value="1">
                                Oui
                            </label>
                            <label class="radio-inline col-md-4" for="form-enfant-fiche-sanitaire-non">
                                <input type="radio" name="form_enfant_fiche_sanitaire" id="form-enfant-fiche-sanitaire-non" value="0" checked="checked">
                                Non
                            </label>
                        </div>
                    </div>
                    <div class="field-box row">
                        <label class="col-md-2">Fiche de séjour</label>
                        <div class="col-md-5" data-toggle="tooltip" title="Précisez si la fiche de séjour est dans le dossier de l'enfant.">
                            <label class="radio-inline col-md-6" for="form-enfant-fiche-sejour-oui">
                                <input type="radio" name="form_enfant_fiche_sejour" id="form-enfant-fiche-sejour-oui" value="1">
                                Oui
                            </label>
                            <label class="radio-inline col-md-4" for="form-enfant-fiche-sejour-non">
                                <input type="radio" name="form_enfant_fiche_sejour" id="form-enfant-fiche-sejour-non" value="0" checked="checked">
                                Non
                            </label>
                        </div>
                    </div>

                    <div class="field-box row">
                        <label class="col-md-2" for="form-enfant-note">Notes</label>
                        <div class="col-md-5">
                            <textarea id="form-enfant-note" name="form_enfant_note" class="form-control" rows="4" data-toggle="tooltip" title="Notes générales au sujet de l'enfant."></textarea>
                        </div>
                    </div>

                    <div class="field-box row">
                        <label class="col-md-2" for="form-enfant-file">Fichier joint</label>
                        <div class="col-md-5">
                            <input type="file" name="form_enfant_file" id="form-enfant-file">
                        </div>
                    </div>

                    <div class="field-box actions">
                        <div class="col-md-6 col-md-offset-2">
                            <input type="submit" class="btn btn-primary" name="submit-add" value="Ajouter l'enfant">
                            <span>OU</span>
                            <a href="/enfants/" class="reset">Annuler</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-md-2">
            <div class="form-nav" id="form-nav" data-spy="affix" data-offset-top="196">
                <h6>Vue d'ensemble</h6>
                <ul class="form-map">
                    <li><a href="#form-enfant-prenom">Prénom</a></li>
                    <li><a href="#form-enfant-nom">Nom</a></li>
                    <li><a href="#form-enfant-naissance">Date de naissance</a></li>
                    <li><a href="#form-enfant-sexe-m">Sexe de l'enfant</a></li>
                    <li><a href="#form-enfant-inscription-structure">L'enfant est inscrit par</a></li>
                    <div data-group="structure">
                        <li><a href="#form-enfant-structure-select">Nom de la structure</a></li>
                        <li><a href="#form-enfant-contact-select">Nom du contact</a></li>
                    </div>
                    <li><a href="#form-enfant-responsable-structure">Responsable légal de l'enfant</a></li>
                    <div data-responsable="parents">
                        <div data-responsable="pere">
                            <li><a href="#form-enfant-nom-pere">Nom du père</a></li>
                            <li><a href="#form-enfant-telephone-pere">Téléphone fixe</a></li>
                            <li><a href="#form-enfant-telephone-pere">Téléphone portable</a></li>
                            <li><a href="#form-enfant-professionnel-pere">Téléphone professionnel</a></li>
                            <li><a href="#form-enfant-adresse-numero-pere">Adresse du père</a></li>
                        </div>
                        <div data-responsable="mere">
                            <li><a href="#form-enfant-nom-mere">Nom de la mère</a></li>
                            <li><a href="#form-enfant-telephone-fixe-mere">Téléphone fixe</a></li>
                            <li><a href="#form-enfant-telephone-portable-mere">Téléphone portable</a></li>
                            <li><a href="#form-enfant-telephone-professionnel-mere">Téléphone professionnel</a></li>
                            <li><a href="#form-enfant-adresse-numero-mere">Adresse de la mère</a></li>
                        </div>
                    </div>
                    <div data-responsable="tuteur">
                        <li><a href="#form-enfant-nom-tuteur">Nom du tuteur</a></li>
                        <li><a href="#form-enfant-telephone-fixe-tuteur">Téléphone fixe</a></li>
                        <li><a href="#form-enfant-telephone-portable-tuteur">Téléphone portable</a></li>
                        <li><a href="#form-enfant-telephone-professionnel-tuteur">Téléphone professionnel</a></li>
                        <li><a href="#form-enfant-adresse-numero-tuteur">Adresse du tuteur</a></li>
                    </div>
                    <li><a href="#form-enfant-domiciliation-responsable">Domiciliation de l'enfant</a></li>
                    <div data-domiciliation="famille">
                        <li><a href="#form-enfant-nom-famille">Nom de la famille d'accueil</a></li>
                        <li><a href="#form-enfant-telephone-fixe-famille">Téléphone fixe</a></li>
                        <li><a href="#form-enfant-telephone-portable-famille">Téléphone portable</a></li>
                        <li><a href="#form-enfant-telephone-professionnel-famille">Téléphone professionnel</a></li>
                        <li><a href="#form-enfant-adresse-numero-famille">Adresse de la famille d'accueil</a></li>
                    </div>
                    <li><a href="#form-enfant-nom-urgence">Contact d'urgence</a></li>
                    <li><a href="#form-enfant-telephone-urgence">Téléphone d'urgence</a></li>
                    <li><a href="#form-enfant-droit-image-oui">Droit à l'image</a></li>
                    <li><a href="#form-enfant-traitement-medical-oui">Traitement(s) médical(s)</a></li>
                    <li><a href="#form-enfant-contre-indication">Contre-indications / allergies</a></li>
                    <li><a href="#form-enfant-numero-securite">N° de sécurité sociale</a></li>
                    <li><a href="#form-enfant-assurance-oui">Assurance (RC)</a></li>
                    <div data-assurance="oui">
                        <li><a href="#form-enfant-assurance-validite">Date de fin de validité</a></li>
                    </div>
                    <li><a href="#form-enfant-attestation-cpam-oui">Attestation CPAM</a></li>
                    <div data-cpam="oui">
                        <li><a href="#form-enfant-cpam-validite">Date de fin de validité</a></li>
                    </div>
                    <li><a href="#form-enfant-carnet-vaccination-oui">Carnet de vaccination</a></li>
                    <li><a href="#form-enfant-fiche-sanitaire-oui">Fiche sanitaire de liaison</a></li>
                    <li><a href="#form-enfant-fiche-sejour-oui">Fiche de séjour</a></li>
                    <li><a href="#form-enfant-note">Notes</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>