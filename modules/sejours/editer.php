<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>

<?php $sejour = sejour::get($_GET['id']); ?>

<div class="row">
    <div class="col-md-12">
        <div class="block-flat">
            <div class="content">
                <form id="form-edit-sejour" method="post" action="/sejours/infos/id/<?=$sejour->id; ?>" class="form-horizontal group-border-dashed maped-form" parsley-validate  enctype="multipart/form-data">

                     <div class="form-group">
                        <label class="col-md-4 control-label" for="form-sejour-name">Nom du séjour</label>
                        <div class="col-sm-6">
                            <input id="form-sejour-name" name="form_sejour_name" class="form-control" type="text" title="Renseignez le nom du séjour." parsley-required="true" value="<?=$sejour->name; ?>">
                        </div>   
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="form-sejour-date-debut">Dates</label>
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-sm-6">
                                    <input id="form-sejour-date-debut" name="form_sejour_date_debut" type="text" class="form-control input-datepicker"
                                    placeholder="Date de début" title="Renseignez la date à laquelle commence le séjour (jj/mm/aaaa)." 
                                    parsley-regexp="([0-3][0-9]|[1-9])/([1-9]|1[0-2]|0[1-9])/([1-2][0|9][0-9]{2})" value="<?=tool::getDatefromDatetime($sejour->date_from); ?>">
                                </div> 
                                <div class="col-sm-6">
                                    <input id="form-sejour-date-fin" name="form_sejour_date_fin" type="text" class="form-control input-datepicker" 
                                    placeholder="Date de fin" title="Renseignez la date à laquelle se termine le séjour (jj/mm/aaaa)." 
                                    parsley-regexp="([0-3][0-9]|[1-9])/([1-9]|1[0-2]|0[1-9])/([1-2][0|9][0-9]{2})" value="<?=tool::getDatefromDatetime($sejour->date_to); ?>"><!-- parsley-afterdate="#form-sejour-date-debut" CR : not working properly with french dates -->
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
                                        <option <?php if( $hebergement->id == $sejour->ref_hebergement): ?>selected="selected"<?php endif; ?> value="<?=$hebergement->id ?>"><?=$hebergement->name ?></option>
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
                                    placeholder="Minimum" title="Renseignez le nombre d'enfant minimum pour ce séjour." parsley-type="digits" parsley-required="true" value="<?=$sejour->capacity_min; ?>">
                                </div>
                                <div class="col-sm-6">
                                    <input id="form-sejour-capacite-max" name="form_sejour_capacite_max" class="form-control" type="text" 
                                    placeholder="Maximum" title="Renseignez le nombre d'enfant maximum pour ce séjour." parsley-required="true" parsley-type="digits" parsley-greaterorequalthan="#form-sejour-capacite-min" value="<?=$sejour->capacity_max; ?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="form-sejour-numero">Numéro (Jeunesse & Sport)</label>
                        <div class="col-sm-6">
                            <input id="form-sejour-numero" name="form_sejour_numero" class="form-control" type="text" 
                            title="Renseignez le numéro jeunesse & sport du séjour." value="<?=$sejour->numero; ?>">
                        </div>   
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="form-sejour-prix">Prix unitaire</label>
                        <div class="col-sm-1">
                            <input id="form-sejour-prix" name="form_sejour_prix" class="text-right form-control" type="text" 
                            title="Renseignez le prix unitaire du séjour du séjour." parsley-type="number" parsley-required="true" value="<?=$sejour->price; ?>">
                            <span class="input-suffix">€</span>
                        </div>   
                    </div>

                    <?php $ref_accompagnateur = accompagnateur::getBySejour($sejour->id); ?>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Directeur du séjour</label>
                        <?php $accompagnateurs = accompagnateur::getList(); ?>
                        <div class="col-sm-6">
                            <div class="radio">
                                <?php $i = 0; ?>
                                <?php foreach($accompagnateurs as $key => $accompagnateur): ?>
                                <div class="radio">
                                    <label for="form-sejour-accompagnateur-<?=$i; ?>">
                                        <input class="icheck" type="radio" name="form_sejour_accompagnateur" id="form-sejour-accompagnateur-<?=$i; ?>" value="<?=$accompagnateur->id ?>" <?php if( isset($ref_accompagnateur->ref_accompagnateur) && $ref_accompagnateur->ref_accompagnateur == $accompagnateur->id ): ?>checked<?php endif; ?>>
                                        <?=$accompagnateur->lastname ?> <?=$accompagnateur->firstname ?>
                                    </label>
                                </div>
                                <?php $i++; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
        
                    </div>

                    <?php $hours_departure =  unserialize($sejour->hours_departure); ?>
                    <?php $hours_return =  unserialize($sejour->hours_return); ?>
                   
                    
                    <?php $hour_departure = $hours_departure['hours']; ?>
                    <?php $min_departure = $hours_departure['min']; ?>
                    <?php $hour_return = $hours_return['hours']; ?>
                    <?php $min_return = $hours_return['min']; ?>

            

                    <div class="form-group">
                        <div class="clearfix">
                            <h5 class="col-sm-4 control-info">Aulnay sous bois, au Parking d'Intermarché : </h5>
                        </div>

                        <div class="row">
                            <label class="col-md-4 control-label" for="form-inscription-heure-aller-1">Heure de rendez-vous à l'aller</label>
                            <div class="col-md-1 col-sm-6">
                                <input id="form-inscription-heure-aller-1" value="<?=$hour_departure[0] ?>" name="form_sejour_heure_aller[0]" class="form-control adresse-numero pull-left" type="text" title="Renseignez l'heure de rendez-vous à l'aller.">
                                <p class="input-suffix">h</p>
                            </div>
                            <div class="col-md-1 col-sm-5">
                                <input id="form-inscription-min-aller-1" value="<?=$min_departure[0] ?>" name="form_sejour_min_aller[0]" class="form-control adresse-numero" type="text" value="00" title="Renseignez l'heure de rendez-vous à l'aller.">
                            </div>
                        </div>
                        
                        <div class="row">
                            <label class="col-md-4 control-label" for="form-inscription-heure-retour-1">Heure de rendez-vous au retour</label>
                            <div class="col-md-1 col-sm-6">
                                <input id="form-inscription-heure-retour-1" value="<?=$hour_return[0] ?>" name="form_sejour_heure_retour[0]" class="form-control adresse-numero pull-left" type="text" title="Renseignez l'heure de rendez-vous au retour'.">
                                <p class="input-suffix">h</p>
                            </div>
                            <div class="col-md-1 col-sm-5">
                                <input id="form-inscription-min-retour-1" value="<?=$min_return[0] ?>" name="form_sejour_min_retour[0]" class="form-control adresse-numero" type="text" value="00" title="Renseignez l'heure de rendez-vous au retour'.">
                            </div>
                        </div>
                    </div>



                    <div class="form-group">
                        <div class="clearfix">
                            <h5 class="col-sm-4 control-info">Aulnay-sous-Bois, au RER :</h5>
                        </div>

                        <div class="row">
                            <label class="col-md-4 control-label" for="form-inscription-heure-aller-2">Heure de rendez-vous à l'aller</label>
                            <div class="col-md-1 col-sm-6">
                                <input id="form-inscription-heure-aller-2" value="<?=$hour_departure[1] ?>" name="form_sejour_heure_aller[1]" class="form-control adresse-numero pull-left" type="text" title="Renseignez l'heure de rendez-vous à l'aller.">
                                <p class="input-suffix">h</p>
                            </div>
                            <div class="col-md-1 col-sm-5">
                                <input id="form-inscription-min-aller-2" value="<?=$min_departure[1] ?>" name="form_sejour_min_aller[1]" class="form-control adresse-numero" type="text" value="00" title="Renseignez l'heure de rendez-vous à l'aller.">
                            </div>
                        </div>
                        
                        <div class="row">
                            <label class="col-md-4 control-label" for="form-inscription-heure-retour-2">Heure de rendez-vous au retour</label>
                        <div class="col-md-1 col-sm-6">
                            <input id="form-inscription-heure-retour-2" value="<?=$hour_return[1] ?>" name="form_sejour_heure_retour[1]" class="form-control adresse-numero pull-left" type="text" title="Renseignez l'heure de rendez-vous au retour'.">
                            <p class="input-suffix">h</p>
                        </div>
                        <div class="col-md-1 col-sm-5">
                            <input id="form-inscription-min-retour-2" value="<?=$min_return[1] ?>" name="form_sejour_min_retour[1]" class="form-control adresse-numero" type="text" value="00" title="Renseignez l'heure de rendez-vous au retour'.">
                        </div>
                        </div>
                    </div>



                    <div class="form-group">
                        <div class="clearfix">
                            <h5 class="col-sm-4 control-info">Bonneuil en Valois, au Gite :</h5>
                        </div>

                        <div class="row">
                            <label class="col-md-4 control-label" for="form-inscription-heure-aller-3">Heure de rendez-vous à l'aller</label>
                            <div class="col-md-1 col-sm-6">
                                <input id="form-inscription-heure-aller-3" value="<?=$hour_departure[2] ?>" name="form_sejour_heure_aller[2]" class="form-control adresse-numero pull-left" type="text" title="Renseignez l'heure de rendez-vous à l'aller.">
                                <p class="input-suffix">h</p>
                            </div>
                            <div class="col-md-1 col-sm-5">
                                <input id="form-inscription-min-aller-3" value="<?=$min_departure[2] ?>" name="form_sejour_min_aller[2]" class="form-control adresse-numero" type="text" value="00" title="Renseignez l'heure de rendez-vous à l'aller.">
                            </div>
                        </div>
                        
                        <div class="row">
                            <label class="col-md-4 control-label" for="form-inscription-heure-retour-3">Heure de rendez-vous au retour</label>
                            <div class="col-md-1 col-sm-6">
                                <input id="form-inscription-heure-retour-3" value="<?=$hour_return[2] ?>" name="form_sejour_heure_retour[2]" class="form-control adresse-numero pull-left" type="text" title="Renseignez l'heure de rendez-vous au retour'.">
                                <p class="input-suffix">h</p>
                            </div>
                            <div class="col-md-1 col-sm-5">
                                <input id="form-inscription-min-retour-3" value="<?=$min_return[2] ?>" name="form_sejour_min_retour[2]" class="form-control adresse-numero" type="text" value="00" title="Renseignez l'heure de rendez-vous au retour'.">
                            </div>
                        </div>
                    </div>

                    <div class="form-group actions text-center">
                        <div class="col-md-8 col-md-offset-2">
                            <input type="submit" class="btn btn-primary btn-rad btn-lg" name="submit-update" value="Enregistrer les modifications">
                            <span>OU</span>
                            <a href="/sejours/infos/id/<?=$sejour->id; ?>" class="reset">Annuler</a>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>


<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>