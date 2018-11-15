<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>

<?php $result = sejour::add(array()); ?>
<?php $id = sejour::getLastID(); ?>


<!-- Page title -->
<div class="page-head">
    <div class="row">
        <div class="col-md-8">
            <h1>Ajouter un séjour</h1>
        </div>
    </div>
</div>
<!-- /Page title -->


<div class="row">
    <div class="col-md-9">
        <div class="block-flat">
            <div class="content">
                <form id="form-add-sejour" method="post" action="/sejours/infos/id/<?=$id ?>"  class="form-horizontal group-border-dashed maped-form" data-parsley-validate  enctype="multipart/form-data">

                    <input type="hidden" value="<?=$id ?>" name="id" />

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="form-sejour-name">Nom du séjour</label>
                        <div class="col-sm-6">
                            <input id="form-sejour-name" name="form_sejour_name" class="form-control" type="text" title="Renseignez le nom du séjour." data-parsley-required="true">
                        </div>   
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="form-sejour-date-debut">Dates</label>
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-sm-6">
                                    <input id="form-sejour-date-debut" name="form_sejour_date_debut" type="text" class="form-control input-datepicker"
                                    placeholder="Date de début" title="Renseignez la date à laquelle commence le séjour (jj/mm/aaaa)." 
                                    data-parsley-pattern="([0-3][0-9]|[1-9])/([1-9]|1[0-2]|0[1-9])/([1-2][0|9][0-9]{2})">
                                </div> 
                                <div class="col-sm-6">
                                    <input id="form-sejour-date-fin" name="form_sejour_date_fin" type="text" class="form-control input-datepicker" 
                                    placeholder="Date de fin" title="Renseignez la date à laquelle se termine le séjour (jj/mm/aaaa)." 
                                    data-parsley-pattern="([0-3][0-9]|[1-9])/([1-9]|1[0-2]|0[1-9])/([1-2][0|9][0-9]{2})" >
                                </div>
                                <div class="col-xs-12">
                                    <div class="checkbox">
                                        <div class="checkbox">
                                            <label for="form-sejour-entire">
                                                <input class="icheck" type="checkbox" name="form_sejour_entier" id="form-sejour-entire" value="1">
                                                Séjour entier <small>(ce séjour ne repose pas sur le découpage par semaine)</small>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-4 control-label" for="form-enfant-structure-select">Hébergement</label>
                        <div class="col-md-4 col-sm-5"sm-6a-toggle="tooltip" title="Sélectionnez l'hébergement qui accueillera le séjour.">
                            <div class="ui-select">
                                <?php $hebergements = hebergement::getList(); ?>
                                <select class="form-control" id="form-sejour-hebergement-select" name="form_sejour_hebergement">
                                    <option selected="selected">Choisissez l'hébergement</option>
                                    <?php foreach($hebergements as $hebergement): ?>
                                        <option value="<?=$hebergement->id ?>"><?=$hebergement->name ?></option>
                                    <?php endforeach; ?>
                                    <!--<option value="0">Nouvel hébergement</option>-->
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="form-sejour-capacite-min">Capacité</label>
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-sm-6">
                                    <input id="form-sejour-capacite-min" name="form_sejour_capacite_min" class="form-control" type="text" 
                                    placeholder="Minimum" title="Renseignez le nombre d'enfant minimum pour ce séjour." data-parsley-type="digits" data-parsley-required="true">
                                </div>
                                <div class="col-sm-6">
                                    <input id="form-sejour-capacite-max" name="form_sejour_capacite_max" class="form-control" type="text" 
                                    placeholder="Maximum" title="Renseignez le nombre d'enfant maximum pour ce séjour." data-parsley-required="true" data-parsley-type="digits" data-parsley-gte="#form-sejour-capacite-min">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="form-sejour-numero">Numéro (Jeunesse & Sport)</label>
                        <div class="col-sm-6">
                            <input id="form-sejour-numero" name="form_sejour_numero" class="form-control" type="text" 
                            title="Renseignez le numéro jeunesse & sport du séjour.">
                        </div>   
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="form-sejour-prix">Prix unitaire</label>
                        <div class="col-sm-6">
                            <input id="form-sejour-prix" name="form_sejour_prix" class="form-control" type="text" 
                            title="Renseignez le prix unitaire du séjour du séjour." data-parsley-type="number" data-parsley-required="true">
                            <span class="input-suffix">€</span>
                        </div>   
                    </div>


                    <div class="form-group">
                        <label class="col-sm-4 control-label">Directeur du séjour</label>
                        <?php $accompagnateurs = accompagnateur::getList(); ?>
                        <div class="col-sm-6">
                            <div class="radio">
                                <?php $i = 0; ?>
                                <?php foreach($accompagnateurs as $key => $accompagnateur): ?>
                                    <div class="radio">
                                        <label for="form-sejour-accompagnateur-<?=$i; ?>">
                                            <input class="icheck" type="radio" name="form_sejour_accompagnateur" id="form-sejour-accompagnateur-<?=$i; ?>" value="<?=$accompagnateur->id ?>"<?php if($i < 1): ?> checked="checked"<?php endif; ?>>
                                            <?=$accompagnateur->lastname ?> <?=$accompagnateur->firstname ?>
                                        </label>
                                    </div>
                                    <?php $i++; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <div id="form-inscription-horaires">
                        <?php /*
                        <div class="form-group">
                            <h5 class="control-info">Aulnay sous bois, au Parking d'Intermarché : </h5>

                            <div class="row">
                                <label class="col-md-4 control-label" for="form-inscription-heure-aller-1">Heure de rendez-vous à l'aller</label>
                                <div class="col-md-1 col-sm-6">
                                    <input id="form-inscription-heure-aller-1" name="form_sejour_heure_aller[0]" class="form-control adresse-numero pull-left input-hour" type="text" title="Renseignez l'heure de rendez-vous à l'aller.">
                                    <p class="input-suffix">h</p>
                                </div>
                                <div class="col-md-1 col-sm-5">
                                    <input id="form-inscription-min-aller-1" name="form_sejour_min_aller[0]" class="form-control adresse-numero input-minute" type="text" value="00" title="Renseignez l'heure de rendez-vous à l'aller.">
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-md-4 control-label" for="form-inscription-heure-retour-1">Heure de rendez-vous au retour</label>
                                <div class="col-md-1 col-sm-6">
                                    <input id="form-inscription-heure-retour-1" name="form_sejour_heure_retour[0]" class="form-control adresse-numero pull-left input-hour" type="text" title="Renseignez l'heure de rendez-vous au retour'.">
                                    <p class="input-suffix">h</p>
                                </div>
                                <div class="col-md-1 col-sm-5">
                                    <input id="form-inscription-min-retour-1" name="form_sejour_min_retour[0]" class="form-control adresse-numero input-minute" type="text" value="00" title="Renseignez l'heure de rendez-vous au retour'.">
                                </div>
                            </div>
                        </div>
                        */ ?>

                        <div class="form-group">
                            <h5 class="control-info">Gare de Villepinte, Rue Camille Pissarro 93420 Villepinte :</h5>

                            <div class="row">
                                <label class="col-md-4 control-label" for="form-inscription-heure-aller-2">Aller</label>
                                <div class="col-md-1 col-sm-6">
                                    <input id="form-inscription-heure-aller-2" name="form_sejour_heure_aller[1]" class="form-control adresse-numero pull-left input-hour" type="text" title="Renseignez l'heure de rendez-vous à l'aller.">
                                    <p class="input-suffix">h</p>
                                </div>
                                <div class="col-md-1 col-sm-5">
                                    <input id="form-inscription-min-aller-2" name="form_sejour_min_aller[1]" class="form-control adresse-numero input-minute" type="text" value="00" title="Renseignez l'heure de rendez-vous à l'aller.">
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <label class="col-md-4 control-label" for="form-inscription-heure-retour-intermediaire-2">Retour (intermédiaire)</label>
                                <div class="col-md-1 col-sm-6">
                                    <input id="form-inscription-heure-retour-intermediaire-2" name="form_sejour_heure_retour_intermediaire[1]" class="form-control adresse-numero pull-left input-hour" type="text" title="Renseignez l'heure de rendez-vous au retour (intermédiaire).">
                                    <p class="input-suffix">h</p>
                                </div>
                                <div class="col-md-1 col-sm-5">
                                    <input id="form-inscription-min-retour-intermediaire-2" name="form_sejour_min_retour_intermediaire[1]" class="form-control adresse-numero input-minute" type="text" value="00" title="Renseignez l'heure de rendez-vous au retour (intermédiaire).">
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-md-4 control-label" for="form-inscription-heure-aller-intermediaire-2">Aller (intermédiaire)</label>
                                <div class="col-md-1 col-sm-6">
                                    <input id="form-inscription-heure-aller-intermediaire-2" name="form_sejour_heure_aller_intermediaire[1]" class="form-control adresse-numero pull-left input-hour" type="text" title="Renseignez l'heure de rendez-vous à l'aller (intermédiaire).">
                                    <p class="input-suffix">h</p>
                                </div>
                                <div class="col-md-1 col-sm-5">
                                    <input id="form-inscription-min-aller-intermediaire-2" name="form_sejour_min_aller_intermediaire[1]" class="form-control adresse-numero input-minute" type="text" value="00" title="Renseignez l'heure de rendez-vous à l'aller (intermédiaire).">
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <label class="col-md-4 control-label" for="form-inscription-heure-retour-2">Retour</label>
                                <div class="col-md-1 col-sm-6">
                                    <input id="form-inscription-heure-retour-2" name="form_sejour_heure_retour[1]" class="form-control adresse-numero pull-left input-hour" type="text" title="Renseignez l'heure de rendez-vous au retour'.">
                                    <p class="input-suffix">h</p>
                                </div>
                                <div class="col-md-1 col-sm-5">
                                    <input id="form-inscription-min-retour-2" name="form_sejour_min_retour[1]" class="form-control adresse-numero input-minute" type="text" value="00" title="Renseignez l'heure de rendez-vous au retour'.">
                                </div>
                            </div>
                        </div>



                        <div class="form-group">
                            <h5 class="control-info">Bonneuil en Valois, au Gite :</h5>

 
                            <div class="row">
                                <label class="col-md-4 control-label" for="form-inscription-heure-aller-3">Aller</label>
                                <div class="col-md-1 col-sm-6">
                                    <input id="form-inscription-heure-aller-3" name="form_sejour_heure_aller[2]" class="form-control adresse-numero pull-left input-hour" type="text" title="Renseignez l'heure de rendez-vous à l'aller.">
                                    <p class="input-suffix">h</p>
                                </div>
                                <div class="col-md-1 col-sm-5">
                                    <input id="form-inscription-min-aller-3" name="form_sejour_min_aller[2]" class="form-control adresse-numero input-minute" type="text" value="00" title="Renseignez l'heure de rendez-vous à l'aller.">
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <label class="col-md-4 control-label" for="form-inscription-heure-retour-intermediaire-3">Retour (intermédiaire)</label>
                                <div class="col-md-1 col-sm-6">
                                    <input id="form-inscription-heure-retour-intermediaire-3" name="form_sejour_heure_retour_intermediaire[2]" class="form-control adresse-numero pull-left input-hour" type="text" title="Renseignez l'heure de rendez-vous au retour (intermédiaire).">
                                    <p class="input-suffix">h</p>
                                </div>
                                <div class="col-md-1 col-sm-5">
                                    <input id="form-inscription-min-retour-intermediaire-3" name="form_sejour_min_retour_intermediaire[2]" class="form-control adresse-numero input-minute" type="text" value="00" title="Renseignez l'heure de rendez-vous au retour (intermédiaire).">
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-md-4 control-label" for="form-inscription-heure-aller-intermediaire-3">Aller (intermédiaire)</label>
                                <div class="col-md-1 col-sm-6">
                                    <input id="form-inscription-heure-aller-intermediaire-3" name="form_sejour_heure_aller_intermediaire[2]" class="form-control adresse-numero pull-left input-hour" type="text" title="Renseignez l'heure de rendez-vous à l'aller (intermédiaire).">
                                    <p class="input-suffix">h</p>
                                </div>
                                <div class="col-md-1 col-sm-5">
                                    <input id="form-inscription-min-aller-intermediaire-3" name="form_sejour_min_aller_intermediaire[2]" class="form-control adresse-numero input-minute" type="text" value="00" title="Renseignez l'heure de rendez-vous à l'aller (intermédiaire).">
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <label class="col-md-4 control-label" for="form-inscription-heure-retour-3">Retour</label>
                                <div class="col-md-1 col-sm-6">
                                    <input id="form-inscription-heure-retour-3" name="form_sejour_heure_retour[2]" class="form-control adresse-numero pull-left input-hour" type="text" title="Renseignez l'heure de rendez-vous au retour'.">
                                    <p class="input-suffix">h</p>
                                </div>
                                <div class="col-md-1 col-sm-5">
                                    <input id="form-inscription-min-retour-3" name="form_sejour_min_retour[2]" class="form-control adresse-numero input-minute" type="text" value="00" title="Renseignez l'heure de rendez-vous au retour'.">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group actions text-center">
                        <div class="col-md-8 col-md-offset-2">
                            <input type="hidden" name="submit-add" value="Enregister le nouveau séjour">
                            <input type="submit" class="btn btn-primary btn-rad btn-lg" value="Enregister le nouveau séjour">
                            <span>OU</span>
                            <a href="/sejours/" class="reset">Annuler</a>
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
                    <button class="btn btn-primary btn-block btn-rad">Enregister le nouveau séjour</button>
                    <a href="/sejours/">Annuler</a>
                </div>
            </div>

            <div id="form-nav" class="block-flat bars-widget">
                <h4>Vue d'ensemble</h4>
                <ul class="nav form-map">
                    <li><a href="#form-sejour-name">Nom du séjour</a></li>
                    <li><a href="#form-sejour-date-debut">Dates</a></li>
                    <li><a href="#form-sejour-hebergement-select">Hébergement</a></li>
                    <li><a href="#form-sejour-capacite-min">Capacité</a></li>
                    <li><a href="#form-sejour-numero">Numéro (Jeunesse & Sport)</a></li>
                    <li><a href="#form-sejour-prix">Prix unitaire</a></li>
                    <li><a href="#form-sejour-accompagnateur-1">Directeur du séjour</a></li>
                    <li><a href="#form-inscription-horaires">Horaires de rendez-vous</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>