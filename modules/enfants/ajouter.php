    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
    <?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>


    <div class="content">
        <div id="pad-wrapper" class="form-page">
            <div class="row header">
                <div class="col-md-12">
                    <h1>Ajouter un enfant</h1>
                </div>
            </div>
            <div id="wizard">
                <h2>Informations sur l'enfant</h2>
                <div class="row form-wrapper">
                    <form>
                        <div class="field-box row">
                            <label class="col-md-2" for="form-enfant-prenom">Prénom</label>
                            <div class="col-md-5">
                                <input id="form-enfant-prenom" class="form-control" type="text" data-toggle="tooltip" title="Renseignez le prénom de l'enfant.">
                            </div>                            
                        </div>
                        <div class="field-box row">
                            <label class="col-md-2" for="form-enfant-nom">Nom</label>
                            <div class="col-md-5">
                                <input id="form-enfant-nom" class="form-control" type="text" data-toggle="tooltip" title="Renseignez le nom de l'enfant.">
                            </div>                            
                        </div>
                        <div class="field-box row">
                            <label class="col-md-2" for="form-enfant-naissance">Date de naissance</label>
                            <div class="col-md-5">
                                <input id="form-enfant-naissance" type="text" class="form-control input-datepicker" value="01/01/2000" data-toggle="tooltip" title="Renseignez la date de naissance de l'enfant (jj/mm/aaaa).">
                            </div>                            
                        </div>
                        <div class="field-box row">
                            <label class="col-md-2">Sexe de l'enfant</label>
                            <div class="col-md-5" data-toggle="tooltip" title="Précisez le sexe de l'enfant.">
                                <label class="radio" for="form-enfant-sexe-m">
                                    <div class="radio" id="uniform-form-enfant-sex-m">
                                        <span class="checked">
                                            <input type="radio" name="form-enfant-sexe" id="form-enfant-sexe-m" value="masculin" checked="">
                                        </span>
                                    </div>
                                    Masculin
                                </label>
                                <label class="radio" for="form-enfant-sexe-f">
                                    <div class="radio" id="uniform-form-enfant-sex-f">
                                        <span>
                                            <input type="radio" name="form-enfant-sexe" id="form-enfant-sexe-f" value="féminin">
                                        </span>
                                    </div>
                                    Féminin
                                </label>
                            </div>                            
                        </div>
                    </form>
                </div>

                <h2>Informations administratives</h2>
                <div class="row form-wrapper">
                    <form>
                        <div class="field-box row">
                            <label class="col-md-2">L'enfant est inscrit par</label>
                            <div class="col-md-5" data-toggle="tooltip" title="Précisez qui a inscrit cet enfant au séjour/week-end.">
                                <label class="radio" for="form-enfant-inscription-structure">
                                    <div class="radio" id="uniform-form-enfant-inscription-structure">
                                        <span class="checked">
                                            <input type="radio" name="form-enfant-inscription" id="form-enfant-inscription-structure" value="structure" checked="">
                                        </span>
                                    </div>
                                    Une structure
                                </label>
                                <label class="radio" for="form-enfant-inscription-particulier">
                                    <div class="radio" id="uniform-form-enfant-inscription-particulier">
                                        <span>
                                            <input type="radio" name="form-enfant-inscription" id="form-enfant-inscription-particulier" value="particulier">
                                        </span>
                                    </div>
                                    Un particulier
                                </label>
                            </div>                            
                        </div>


                        <div data-group="structure">
                            <div class="field-box row">
                                <label class="col-md-2" for="form-enfant-structure-select">Nom de la structure</label>
                                <div class="col-md-5" data-toggle="tooltip" title="Sélectionnez la structure qui s'occupe de cet enfant.">
                                    <div class="ui-select">
                                        <select id="form-enfant-structure-select">
                                            <option selected="">Choisissez une structure</option>
                                            <option>Custom selects</option>
                                            <option>Pure css styles</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="field-box row">
                                <label class="col-md-2" for="form-enfant-contact-select">Nom du contact</label>
                                <div class="col-md-5" data-toggle="tooltip" title="Sélectionnez le contact responsable de l'enfant.">
                                    <div class="ui-select">
                                        <select id="form-enfant-contact-select">
                                            <option selected="">Choisissez un contact</option>
                                            <option>Custom selects</option>
                                            <option>Pure css styles</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div data-group="particulier">
                            <div class="field-box row">
                                <label class="col-md-2">Responsable légal de l'enfant</label>
                                <div class="col-md-5" data-toggle="tooltip" title="Précisez qui est le responsable légal de l'enfant.">
                                    <label class="radio" for="form-enfant-responsable-parents">
                                        <div class="radio" id="uniform-form-enfant-responsable-parents">
                                            <span class="checked">
                                                <input type="radio" name="form-enfant-responsable" id="form-enfant-responsable-parents" value="parents" checked="">
                                            </span>
                                        </div>
                                        Parents
                                    </label>
                                    <label class="radio">
                                        <div class="radio" id="uniform-form-enfant-responsable-pere">
                                            <span class="checked">
                                                <input type="radio" name="form-enfant-responsable" id="form-enfant-responsable-pere" value="pere">
                                            </span>
                                        </div>
                                        Père
                                    </label>
                                    <label class="radio">
                                        <div class="radio" id="uniform-form-enfant-responsable-mere">
                                            <span class="checked">
                                                <input type="radio" name="form-enfant-responsable" id="form-enfant-responsable-mere" value="mere">
                                            </span>
                                        </div>
                                        Mère
                                    </label>
                                    <label class="radio">
                                        <div class="radio" id="uniform-form-enfant-responsable-tuteur">
                                            <span class="checked">
                                                <input type="radio" name="form-enfant-responsable" id="form-enfant-responsable-tuteur" value="tuteur">
                                            </span>
                                        </div>
                                        Tuteur
                                    </label>
                                </div>                            
                            </div>

                            <div data-responsable="parents">
                                <div data-responsable="pere">
                                    <div class="field-box row">
                                        <label class="col-md-2" for="form-enfant-pere-nom">Nom du père</label>
                                        <div class="col-md-5">
                                            <input id="form-enfant-pere-nom" class="form-control" type="text" data-toggle="tooltip" title="Renseignez le nom et prénom du père.">
                                        </div>                            
                                    </div>
                                    <div class="field-box row">
                                        <label class="col-md-2" for="form-enfant-pere-telephone">Téléphone du père</label>
                                        <div class="col-md-5">
                                            <input id="form-enfant-pere-telephone" class="form-control" type="text" data-toggle="tooltip" title="Renseignez le numéro de téléphone du père.">
                                        </div>                            
                                    </div>
                                </div>

                                <div data-responsable="mere">
                                    <div class="field-box row">
                                        <label class="col-md-2" for="form-enfant-mere-nom">Nom de la mère</label>
                                        <div class="col-md-5">
                                            <input id="form-enfant-mere-nom" class="form-control" type="text" data-toggle="tooltip" title="Renseignez le nom et prénom de la mère.">
                                        </div>                            
                                    </div>
                                    <div class="field-box row">
                                        <label class="col-md-2" for="form-enfant-mere-telephone">Téléphone de la mère</label>
                                        <div class="col-md-5">
                                            <input id="form-enfant-mere-telephone" class="form-control" type="text" data-toggle="tooltip" title="Renseignez le numéro de téléphone de la mère.">
                                        </div>                            
                                    </div>
                                </div>
                            </div>

                            <div data-responsable="tuteur">
                                <div class="field-box row">
                                    <label class="col-md-2" for="form-enfant-tuteur-nom">Nom du tuteur</label>
                                    <div class="col-md-5">
                                        <input id="form-enfant-tuteur-nom" class="form-control" type="text" data-toggle="tooltip" title="Renseignez le nom et prénom du tuteur.">
                                    </div>                            
                                </div>
                                <div class="field-box row">
                                    <label class="col-md-2" for="form-enfant-tuteur-telephone">Téléphone du tuteur</label>
                                    <div class="col-md-5">
                                        <input id="form-enfant-tuteur-telephone" class="form-control" type="text" data-toggle="tooltip" title="Renseignez le numéro de téléphone du tuteur.">
                                    </div>                            
                                </div>
                            </div>

                            <div class="field-box row">
                                <label class="col-md-2" for="form-enfant-urgence-nom">Contact d'urgence</label>
                                <div class="col-md-5">
                                    <input id="form-enfant-urgence-nom" class="form-control" type="text" data-toggle="tooltip" title="Renseignez le nom et prénom de la personne à contacter en cas d'urgence.">
                                </div>                            
                            </div>
                            <div class="field-box row">
                                <label class="col-md-2" for="form-enfant-urgence-telephone">Téléphone d'urgence</label>
                                <div class="col-md-5">
                                    <input id="form-enfant-urgence-telephone" class="form-control" type="text" data-toggle="tooltip" title="Renseignez le numéro de téléphone de la personne à contacter en cas d'urgence.">
                                </div>                            
                            </div>

                            <div class="field-box row">
                                <label class="col-md-2" for="form-enfant-responsable-adresse-numero">Adresse du responsable légal</label>
                                <div class="col-md-5">
                                    <div class="row">
                                        <div class="col-md-3">
                                        <input id="form-enfant-responsable-adresse-numero" class="form-control adresse-numero" type="text" placeholder="N°" data-toggle="tooltip" title="Renseignez le numéro de l'adresse du responsable légal.">
                                        </div>
                                        <div class="col-md-9"><input id="form-enfant-responsable-adresse-voirie" class="form-control adresse-voirie" type="text" placeholder="Nom de la voirie" data-toggle="tooltip" title="Renseignez le nom de la voirie de l'adresse du responsable légal."></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4"><input id="form-enfant-responsable-adresse-code-postal" class="form-control adresse-postal" type="text" placeholder="Code postal" data-toggle="tooltip" title="Renseignez le code postal de la ville du responsable légal."></div>
                                        <div class="col-md-8"><input id="form-enfant-responsable-adresse-code-ville" class="form-control adresse-ville" type="text" placeholder="Ville" data-toggle="tooltip" title="Renseignez le nom de la ville du responsable légal."></div>
                                    </div>
                                </div>                            
                            </div>

                        </div>

                        <div class="field-box row">
                            <label class="col-md-2">Domiciliation de l'enfant</label>
                            <div class="col-md-5" data-toggle="tooltip" title="Précisez chez qui habite l'enfant.">
                                <label class="radio" for="form-enfant-domiciliation-responsable">
                                    <div class="radio" id="uniform-form-enfant-domiciliation-responsable">
                                        <span class="checked">
                                            <input type="radio" name="form-enfant-domiciliation" id="form-enfant-domiciliation-responsable" value="responsable" checked="">
                                        </span>
                                    </div>
                                    Responsable légal
                                </label>
                                <label class="radio" for="form-enfant-domiciliation-famille">
                                    <div class="radio" id="uniform-form-enfant-domiciliation-famille">
                                        <span class="checked">
                                            <input type="radio" name="form-enfant-domiciliation" id="form-enfant-domiciliation-famille" value="famille">
                                        </span>
                                    </div>
                                    Famille d'accueil
                                </label>
                            </div>
                        </div>

                        <div data-domiciliation="famille">
                            <div class="field-box row">
                                <label class="col-md-2" for="form-enfant-famille-nom">Nom de la famille d'accueil</label>
                                <div class="col-md-5">
                                    <input id="form-enfant-famille-nom" class="form-control" type="text" data-toggle="tooltip" title="Renseignez le nom de la famille d'accueil.">
                                </div>                            
                            </div>
                            <div class="field-box row">
                                <label class="col-md-2" for="form-enfant-famille-telephone">Téléphone de la famille d'accueil</label>
                                <div class="col-md-5">
                                    <input id="form-enfant-famille-telephone" class="form-control" type="text" data-toggle="tooltip" title="Renseignez le numéro de téléphone de la famille d'accueil.">
                                </div>                            
                            </div>
                            <div class="field-box row">
                                <label class="col-md-2" for="form-enfant-famille-adresse-numero">Adresse de la famille d'accueil</label>
                                <div class="col-md-5">
                                    <div class="row">
                                        <div class="col-md-3">
                                        <input id="form-enfant-famille-adresse-numero" class="form-control adresse-numero" type="text" placeholder="N°" data-toggle="tooltip" title="Renseignez le numéro de l'adresse de la famille d'accueil.">
                                        </div>
                                        <div class="col-md-9"><input id="form-enfant-famille-adresse-voirie" class="form-control adresse-voirie" type="text" placeholder="Nom de la voirie" data-toggle="tooltip" title="Renseignez le nom de la voirie de l'adresse de la famille d'accueil."></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4"><input id="form-enfant-famille-adresse-code-postal" class="form-control adresse-postal" type="text" placeholder="Code postal" data-toggle="tooltip" title="Renseignez le code postal de la ville de la famille d'accueil."></div>
                                        <div class="col-md-8"><input id="form-enfant-famille-adresse-code-ville" class="form-control adresse-ville" type="text" placeholder="Ville" data-toggle="tooltip" title="Renseignez le nom de la ville de la famille d'accueil."></div>
                                    </div>
                                </div>                            
                            </div>
                        </div>

                        <div class="field-box row">
                            <label class="col-md-2">Droit à l'image</label>
                            <div class="col-md-5" data-toggle="tooltip" title="Précisez si des photos/vidéos de l'enfant peuvent être utilisé par le gîte.">
                                <label class="radio-inline col-md-7" for="form-enfant-droit-image-oui">
                                    <div class="radio" id="uniform-form-enfant-droit-image-oui">
                                        <span class="checked">
                                            <input type="radio" name="form-enfant-droit-image" id="form-enfant-droit-image-oui" value="oui">
                                        </span>
                                    </div>
                                    Oui
                                </label>
                                <label class="radio-inline col-md-5" for="form-enfant-droit-image-non">
                                    <div class="radio" id="uniform-form-enfant-droit-image-non">
                                        <span class="checked">
                                            <input type="radio" name="form-enfant-droit-image" id="form-enfant-droit-image-non" value="non" checked="">
                                        </span>
                                    </div>
                                    Non
                                </label>
                            </div>
                        </div>

                    </form>
                </div>

                <h2>Informations sanitaires</h2>
                <div class="row form-wrapper">
                    <form>
                        <div class="field-box row">
                            <label class="col-md-2">Traitement(s) médical(s)</label>
                            <div class="col-md-5" data-toggle="tooltip" title="Précisez si l'enfant suit un traitement médical.">
                                <label class="radio-inline col-md-7" for="form-enfant-traitement-medical-oui">
                                    <div class="radio" id="uniform-form-enfant-traitement-medical-oui">
                                        <span class="checked">
                                            <input type="radio" name="form-enfant-traitement-medical" id="form-enfant-traitement-medical-oui" value="oui">
                                        </span>
                                    </div>
                                    Oui
                                </label>
                                <label class="radio-inline col-md-5" for="form-enfant-traitement-medical-non">
                                    <div class="radio" id="uniform-form-enfant-traitement-medical-non">
                                        <span class="checked">
                                            <input type="radio" name="form-enfant-traitement-medical" id="form-enfant-traitement-medical-non" value="non" checked="">
                                        </span>
                                    </div>
                                    Non
                                </label>
                            </div>
                        </div>
                        <div class="field-box row">
                            <label class="col-md-2" for="form-enfant-contre-indication">Contre-indications / allergies</label>
                            <div class="col-md-5">
                                <textarea id="form-enfant-contre-indication" class="form-control" rows="4" data-toggle="tooltip" title="Renseignez les contre-indication(s) et/ou allergie(s) connue(s) de l'enfant."></textarea>
                            </div>
                        </div>

                        <div class="field-box row">
                            <label class="col-md-2">Assurance (RC)</label>
                            <div class="col-md-5" data-toggle="tooltip" title="Précisez si l'enfant est convert par une assurance (responsabilité civile).">
                                <label class="radio-inline col-md-7" for="form-enfant-assurance-oui">
                                    <div class="radio" id="uniform-form-enfant-assurance-oui">
                                        <span class="checked">
                                            <input type="radio" name="form-enfant-assurance" id="form-enfant-assurance-oui" value="oui">
                                        </span>
                                    </div>
                                    Oui
                                </label>
                                <label class="radio-inline col-md-5">
                                    <div class="radio" id="uniform-form-enfant-assurance-non">
                                        <span class="checked">
                                            <input type="radio" name="form-enfant-assurance" id="form-enfant-assurance-non" value="non" checked="">
                                        </span>
                                    </div>
                                    Non
                                </label>
                            </div>
                        </div>
                        <div data-assurance="oui">
                            <div class="field-box row">
                                <label class="col-md-2" for="form-enfant-assurance-validite">Date de fin de validité</label>
                                <div class="col-md-5">
                                    <input id="form-enfant-assurance-validite" type="text" class="form-control input-datepicker" value="15/06/2014" data-toggle="tooltip" title="Renseignez la date de fin de validité de l'assurance (jj/mm/aaaa).">
                                </div>                            
                            </div>
                        </div>
                        <div class="field-box row">
                            <label class="col-md-2">Attestation CPAM</label>
                            <div class="col-md-5" data-toggle="tooltip" title="Précisez si l'attestation CPAM est dans le dossier de l'enfant.">
                            <label class="radio-inline col-md-7" for="form-enfant-attestation-cpam-oui">
                                <div class="radio" id="uniform-form-enfant-attestation-cpam-oui">
                                    <span class="checked">
                                        <input type="radio" name="form-enfant-attestation-cpam" id="form-enfant-attestation-cpam-oui" value="oui">
                                    </span>
                                </div>
                                Oui
                            </label>
                            <label class="radio-inline col-md-5">
                                <div class="radio" id="uniform-form-enfant-attestation-cpam-non">
                                    <span class="checked">
                                        <input type="radio" name="form-enfant-attestation-cpam" id="form-enfant-attestation-cpam-non" value="non" checked="">
                                    </span>
                                </div>
                                Non
                            </label>
                            </div>
                        </div>

                        <div class="field-box row">
                            <label class="col-md-2">Carnet de vaccination</label>
                            <div class="col-md-5" data-toggle="tooltip" title="Précisez si le carnet de vaccination est dans le dossier de l'enfant.">
                            <label class="radio-inline col-md-7" for="form-enfant-carnet-vaccination-oui">
                                <div class="radio" id="uniform-form-enfant-carnet-vaccination-oui">
                                    <span class="checked">
                                        <input type="radio" name="form-enfant-carnet-vaccination" id="form-enfant-carnet-vaccination-oui" value="oui">
                                    </span>
                                </div>
                                Oui
                            </label>
                            <label class="radio-inline col-md-5" for="form-enfant-carnet-vaccination-non">
                                <div class="radio" id="uniform-form-enfant-carnet-vaccination-non">
                                    <span class="checked">
                                        <input type="radio" name="form-enfant-carnet-vaccination" id="form-enfant-carnet-vaccination-non" value="non" checked="">
                                    </span>
                                </div>
                                Non
                            </label>
                            </div>
                        </div>
                        <div class="field-box row">
                            <label class="col-md-2">Fiche sanitaire de liaison</label>
                            <div class="col-md-5" data-toggle="tooltip" title="Précisez si la fiche sanitaire de liaison est dans le dossier de l'enfant.">
                            <label class="radio-inline col-md-7" for="form-enfant-fiche-sanitaire-oui">
                                <div class="radio" id="uniform-form-enfant-fiche-sanitaire-oui">
                                    <span class="checked">
                                        <input type="radio" name="form-enfant-fiche-sanitaire" id="form-enfant-fiche-sanitaire-oui" value="oui">
                                    </span>
                                </div>
                                Oui
                            </label>
                            <label class="radio-inline col-md-5" for="form-enfant-fiche-sanitaire-non">
                                <div class="radio" id="uniform-form-enfant-fiche-sanitaire-non">
                                    <span class="checked">
                                        <input type="radio" name="form-enfant-fiche-sanitaire" id="form-enfant-fiche-sanitaire-non" value="non" checked="">
                                    </span>
                                </div>
                                Non
                            </label>
                            </div>
                        </div>
                        <div class="field-box row">
                            <label class="col-md-2">Fiche de séjour</label>
                            <div class="col-md-5" data-toggle="tooltip" title="Précisez si la fiche de séjour est dans le dossier de l'enfant.">
                            <label class="radio-inline col-md-7" for="form-enfant-fiche-sejour-oui">
                                <div class="radio" id="uniform-form-enfant-fiche-sejour-oui">
                                    <span class="checked">
                                        <input type="radio" name="form-enfant-fiche-sejour" id="form-enfant-fiche-sejour-oui" value="oui">
                                    </span>
                                </div>
                                Oui
                            </label>
                            <label class="radio-inline col-md-5" for="form-enfant-fiche-sejour-non">
                                <div class="radio" id="uniform-form-enfant-fiche-sejour-non">
                                    <span class="checked">
                                        <input type="radio" name="form-enfant-fiche-sejour" id="form-enfant-fiche-sejour-non" value="non" checked="">
                                    </span>
                                </div>
                                Non
                            </label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>









    <!-- LISTE DES CHAMPS -->
<!--
form-enfant-prenom
form-enfant-nom
form-enfant-naissance

form-enfant-sexe
    form-enfant-sexe-m
    form-enfant-sexe-f

form-enfant-inscription
    form-enfant-inscription-structure
    form-enfant-inscription-particulier

form-enfant-structure-select

form-enfant-contact-select

form-enfant-responsable
    form-enfant-responsable-parents
    form-enfant-responsable-mere
    form-enfant-responsable-pere
    form-enfant-responsable-tuteur

form-enfant-pere-nom
form-enfant-pere-telephone
form-enfant-mere-nom
form-enfant-mere-telephone
form-enfant-tuteur-nom
form-enfant-tuteur-telephone
form-enfant-urgence-nom
form-enfant-urgence-telephone

form-enfant-responsable-adresse-numero
form-enfant-responsable-adresse-voirie
form-enfant-responsable-adresse-code-postal
form-enfant-responsable-adresse-ville

form-enfant-domiciliation
    form-enfant-domiciliation-responsable
    form-enfant-domiciliation-famille

form-enfant-famille-nom
form-enfant-famille-telephone
form-enfant-famille-adresse-numero
form-enfant-famille-adresse-voirie
form-enfant-famille-adresse-code-postal
form-enfant-famille-adresse-ville

form-enfant-droit-image
    form-enfant-droit-image-oui
    form-enfant-droit-image-non

form-enfant-traitement-medical
    form-enfant-traitement-medical-oui
    form-enfant-traitement-medical-non

form-enfant-contre-indication

form-enfant-assurance
    form-enfant-assurance-oui
    form-enfant-assurance-non

form-enfant-assurance-validite

form-enfant-attestation-cpam
    form-enfant-attestation-cpam-oui
    form-enfant-attestation-cpam-non

form-enfant-carnet-vaccination
    form-enfant-carnet-vaccination-oui
    form-enfant-carnet-vaccination-non

form-enfant-fiche-sanitaire
    form-enfant-fiche-sanitaire-oui
    form-enfant-fiche-sanitaire-non

form-enfant-fiche-sejour
    form-enfant-fiche-sejour-oui
    form-enfant-fiche-sejour-non

-->
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>