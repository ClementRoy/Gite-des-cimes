<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
<?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>


<?php $dossier = dossier::get($_GET['id']); ?>

<div class="title">
    <div class="row header">
        <div class="col-md-12">
            <h3>Modifier un dossier d'inscription</h3>
        </div>
    </div>
</div>
<div class="content">

    <?php if($dossier->finished): ?>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-warning">
                    <i class="icon-warning-sign"></i> 
                    Attention ce dossier a déjà été signalé comme finalisé
                </div>
            </div>
        </div>
    <?php endif; ?>


    <div class="row">
        <div class="col-md-12">
            <form id="form-add-sejour" action="/dossiers/infos/id/<?=$dossier->id ?>" method="post" parsley-validate>


                <div class="field-box row">
                    <label class="col-md-2" for="form-inscription-enfant-select">Nom de l'enfant</label>
                    <div class="col-md-4 col-sm-5" data-toggle="tooltip" title="Sélectionnez l'enfant à inscrire">
                        <div class="ui-select">
                            <?php $enfants = enfant::getList(); ?>
                            <select class="form-control" id="form-inscription-enfant-select" name="form_inscription_enfant" parsley-required="true">
                                <option selected="selected">Choisissez l'enfant</option>
                                <?php foreach($enfants as $enfant): ?>
                                    <option <?php if( $enfant->id == $dossier->ref_enfant): ?>selected="selected"<?php endif; ?> value="<?=$enfant->id ?>"><?=$enfant->lastname ?> <?=$enfant->firstname ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>


                <?php // TEMPLATE ?>


                <?php // END OF TEMPLATE  ?>



                <?php //Handle Sejour here ?> 
                <?php $sejours = sejour::getList(); ?>
                <?php $sejours_linked = inscription::getLinkedSejours($dossier->id); ?>
                <?php //tool::output($sejours_linked); ?>

                <?php foreach($sejours_linked as $sejour_linked): ?>

                    <div class="field-box row sejour-select">
                        <label class="col-md-2" for="form-inscription-sejour-select">Séjour</label>
                        <div class="col-md-4 col-sm-5" data-toggle="tooltip" title="Sélectionnez le séjour">
                            <div class="ui-select">
                                <select class="form-control selector" id="form-inscription-sejour-select" name="form_inscription_sejour[]" parsley-required="true">
                                    <option selected="selected">Choisissez le séjour</option>
                                    <?php foreach($sejours as $sejour): ?>
                                        <?php $date_from = new DateTime($sejour->date_from); ?>
                                        <?php $date_to = new DateTime($sejour->date_to); ?>
                                        <?php $nb_weeks = tool::getNbWeeks($date_from, $date_to); ?>

                                        <?php if($date_to->getTimestamp() != '-62169987600'): ?>
                                            <?php $date_to_string = strftime('%d/%m/%Y', $date_to->getTimestamp()); ?>
                                        <?php endif; ?>

                                        <?php if($date_from->getTimestamp() != '-62169987600'): ?>
                                            <?php $date_from_string = strftime('%d/%m/%Y', $date_from->getTimestamp()); ?>
                                        <?php endif; ?>

                                        <option <?php if( $sejour_linked->ref_sejour == $sejour->id ): ?>selected="selected"<?php endif; ?> 
                                            value="<?=$sejour->id ?>"
                                            data-nbweek="<?=$nb_weeks ?>"
                                            data-datesfrom="<?=sejour::getAllBeginsWeek($sejour->id) ?>"
                                            data-datesto="<?=sejour::getAllEndsWeek($sejour->id) ?>"
                                            data-sejour-id="<?=$sejour->id; ?>">
                                            <?=$sejour->name ?> du <?=$date_from_string; ?> au <?=$date_to_string; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <?php $dates_inscriptions = inscription::getBySejourAndDossier($sejour_linked->ref_sejour, $dossier->id); ?>
                    <?php //tool::output($dates_inscriptions); ?>
                    <div class="field-box row date-range">
                        <label class="col-md-2" for="form-inscription-dates">Dates</label>
                        <div class="col-md-10 col-sm-5 inject-dates" data-toggle="tooltip" title="Sélectionnez les dates d'inscription">
                            <?php foreach($dates_inscriptions as $key => $dates_inscription): ?>
                                <?php // Il faut aussi choper le séjour en question ?>
                                <?php $date_from = new DateTime($dates_inscription->date_from); ?>
                                <?php $date_to = new DateTime($dates_inscription->date_to); ?>
                                <?php $date_to_string = strftime('%d/%m/%Y', $date_to->getTimestamp()); ?>
                                <?php $date_from_string = strftime('%d/%m/%Y', $date_from->getTimestamp()); ?>
                                <label style="display: block;">
                                    <input type="checkbox" name="dates[]" value="<?=$date_from_string; ?>#<?=$date_to_string; ?>#<?=$sejour_linked->ref_sejour ?>" checked="checked"> Semaine <?=$key+1 ?> du <?=$date_from_string; ?> au <?=$date_to_string; ?>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="field-box row">
                        <a href="#" class="remove">Retirer cette inscription</a>
                    </div>

                <?php endforeach; ?>


                <button class="btn btn-default duplicate">Inscrire à un autre séjour</button>


                <div class="field-box row">
                    <label class="col-md-2" for="form-inscription-structure-select">Centre payeur</label>
                    <div class="col-md-4 col-sm-5" data-toggle="tooltip" title="Sélectionnez la structure qui s'occupe de cet enfant.">
                        <div class="ui-select">
                            <?php $structures = structure::getList(); ?>
                            <select class="form-control" id="form-inscription-structure-select" name="form_inscription_structure">
                                <option selected="selected">Choisissez la structure</option>
                                <?php foreach($structures as $structure): ?>
                                    <option <?php if( $structure->id == $dossier->ref_structure_payer): ?>selected="selected"<?php endif; ?> value="<?=$structure->id ?>"><?=$structure->name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="field-box row">
                    <label class="col-md-2" for="form-inscription-centre-payeur">Centre payeur <em>Si il n'est pas dans la liste</em></label>
                    <div class="col-md-4 col-sm-5">
                        <input id="form-inscription-centre-payeur" name="form_inscription_structure_name" class="form-control input-sm" type="text" data-toggle="tooltip" title="Renseignez le nom du centre payeur." value="<?=$dossier->structure_payer ?>">
                        <input type="hidden" id="form-inscription-centre-payeur-hidden" name="form_inscription_structure_name" value="" disabled="disabled">                    
                    </div>
                </div>

                <div class="field-box row">
                    <label class="col-md-2">Prise en charge de l'enfant</label>
                    <div class="col-md-4 col-sm-5" data-toggle="tooltip" title="Précisez si l'enfant est pris en charge.">
                        <label class="radio-inline col-md-7" for="form-inscription-supported-oui">
                            <div class="radio" id="uniform-form-inscription-supported-oui">
                                <span>
                                    <input type="radio" name="form_inscription_supported" id="form-inscription-supported-oui" value="1" <?php if($dossier->supported == 1): ?>checked="checked"<?php endif; ?>>
                                </span>
                            </div>
                            Oui
                        </label>
                        <label class="radio-inline col-md-4 col-sm-5" for="form-inscription-supported-non">
                            <div class="radio" id="uniform-form-inscription-supported-non">
                                <span class="checked">
                                    <input type="radio" name="form_inscription_supported" id="form-inscription-supported-non" value="0" <?php if($dossier->supported == 0): ?>checked="checked"<?php endif; ?>>
                                </span>
                            </div>
                            Non
                        </label>
                    </div>
                </div>

                <div class="field-box row">
                    <label class="col-md-2" for="form-inscription-lieu-select">Lieu de rendez-vous</label>
                    <div class="col-md-4 col-sm-5" data-toggle="tooltip" title="Renseignez le lieu de rendez-vous.">
                        <div class="ui-select">
                            <select class="form-control" id="form-inscription-lieu-select" name="form_inscription_lieu">
                                <option selected="selected" value="">Choisissez le lieu de rendez-vous</option>
                                <option <?php if( $dossier->place == "Aulnay sous bois, au Parking d'Intermarché, avenue Antoine Bourdelle"): ?>selected="selected"<?php endif; ?> value="Aulnay sous bois, au Parking d'Intermarché, avenue Antoine Bourdelle">Aulnay sous bois, au Parking d'Intermarché, avenue Antoine Bourdelle</option>
                                <option <?php if( $dossier->place == "Aulnay sous Bois, au RER, Dépôt Minute, Place du Général de Gaulle"): ?>selected="selected"<?php endif; ?> value="Aulnay sous Bois, au RER, Dépôt Minute, Place du Général de Gaulle">Aulnay sous Bois, au RER, Dépôt Minute, Place du Général de Gaulle</option>
                                <option <?php if( $dossier->place == "Bonneuil en Valois, au Gite"): ?>selected="selected"<?php endif; ?> value="Bonneuil en Valois, au Gite">Bonneuil en Valois, au Gite</option>
                            </select>
                        </div>
                    </div>
                </div>


                <div class="field-box row">
                    <label class="col-md-2" for="form-inscription-heure-aller">Heure de rendez-vous</label>
                    <div class="col-md-1 col-sm-5">
                        <?php $hour_departure = explode('h', $dossier->hour_departure); ?>
                        <input id="form-inscription-heure-aller" name="form_inscription_heure_aller" class="form-control adresse-numero pull-left" type="text" data-toggle="tooltip" title="Renseignez l'heure de rendez-vous pour le départ." value="<?=$hour_departure['0'] ?>">
                        <p class="input-suffix">h</p>
                    </div>
                    <div class="col-md-1 col-sm-5">
                        <input id="form-inscription-min-aller" name="form_inscription_min_aller" class="form-control adresse-numero" type="text" data-toggle="tooltip" value="<?=$hour_departure['1'] ?>" title="Renseignez l'heure de rendez-vous pour le départ.">
                    </div>
                </div>

                <div class="field-box row">
                    <label class="col-md-2" for="form-inscription-heure-retour">Heure de rendez-vous pour le retour</label>
                    <div class="col-md-1 col-sm-5">
                        <?php $hour_return = explode('h', $dossier->hour_return); ?>
                        <input id="form-inscription-heure-retour" name="form_inscription_heure_retour" class="form-control adresse-numero pull-left" type="text" data-toggle="tooltip" title="Renseignez l'heure de rendez-vous pour le retour'." value="<?=$hour_return['0'] ?>">
                        <p class="input-suffix">h</p>
                    </div>
                    <div class="col-md-1 col-sm-5">
                        <input id="form-inscription-min-retour" name="form_inscription_min_retour" class="form-control adresse-numero" type="text" data-toggle="tooltip" value="<?=$hour_return['1'] ?>" title="Renseignez l'heure de rendez-vous pour le retour'.">
                    </div>
                </div>

                <div class="field-box row">
                    <label class="col-md-2">Pique Nique</label>
                    <div class="col-md-4 col-sm-5" data-toggle="tooltip" title="Précisez si le trajet nécessite un pique nique.">
                        <label class="radio-inline col-md-7" for="form-inscription-pique-nique-oui">
                            <div class="radio" id="uniform-form-inscription-pique-nique-oui">
                                <span>
                                    <input type="radio" name="form_inscription_pique_nique" id="form-inscription-pique-nique-oui" value="1" <?php if($dossier->pique_nique == 1): ?>checked="checked"<?php endif; ?>>
                                </span>
                            </div>
                            Oui
                        </label>
                        <label class="radio-inline col-md-4 col-sm-5" for="form-inscription-pique-nique-non">
                            <div class="radio" id="uniform-form-inscription-pique-nique-non">
                                <span class="checked">
                                    <input type="radio" name="form_inscription_pique_nique" id="form-inscription-pique-nique-non" value="0" <?php if($dossier->pique_nique == 0): ?>checked="checked"<?php endif; ?>>
                                </span>
                            </div>
                            Non
                        </label>
                    </div>
                </div>

                <div class="field-box row">
                    <label class="col-md-2">Sac de couchage</label>
                    <div class="col-md-4 col-sm-5" data-toggle="tooltip" title="Précisez si le séjour nécessite un sac de couchage.">
                        <label class="radio-inline col-md-7" for="form-inscription-sac-oui">
                            <div class="radio" id="uniform-form-enfant-carnet-vaccination-oui">
                                <span>
                                    <input type="radio" name="form_inscription_sac" id="form-inscription-sac-oui" value="1" <?php if($dossier->sac == 1): ?>checked="checked"<?php endif; ?>>
                                </span>
                            </div>
                            Oui
                        </label>
                        <label class="radio-inline col-md-4 col-sm-5" for="form-inscription-sac-non">
                            <div class="radio" id="uniform-form-inscription-sac-non">
                                <span class="checked">
                                    <input type="radio" name="form_inscription_sac" id="form-inscription-sac-non" value="0"  <?php if($dossier->sac == 0): ?>checked="checked"<?php endif; ?>>
                                </span>
                            </div>
                            Non
                        </label>
                    </div>
                </div>

                <div class="field-box row">
                    <label class="col-md-2" for="form-inscription-note">Notes</label>
                    <div class="col-md-4 col-sm-5">
                        <textarea id="form-inscription-note" name="form_inscription_note" class="form-control" rows="4" data-toggle="tooltip" title="Notes générales au sujet de l'inscription."><?=$dossier->note ?></textarea>
                    </div>
                </div>

                <div class="field-box row">
                    <label class="col-md-2">Inscription finalisée</label>
                    <div class="col-md-4 col-sm-5" data-toggle="tooltip" title="Précisez si l'inscription est finalisé.">
                        <label class="radio-inline col-md-7" for="form-inscription-option-oui">
                            <div class="radio" id="uniform-form-inscription-option-oui">
                                <span>
                                    <input type="radio" name="form_inscription_option" id="form-inscription-option-oui" value="1" <?php if($dossier->finished == 1): ?>checked="checked"<?php endif; ?>>
                                </span>
                            </div>
                            Oui
                        </label>
                        <label class="radio-inline col-md-4 col-sm-5" for="form-inscription-option-non">
                            <div class="radio" id="uniform-form-inscription-option-non">
                                <span class="checked">
                                    <input type="radio" name="form_inscription_option" id="form-inscription-option-non" value="0" <?php if($dossier->finished == 0): ?>checked="checked"<?php endif; ?>>
                                </span>
                            </div>
                            Non
                        </label>
                    </div>
                </div>

                <div class="field-box actions">
                    <div class="col-md-6  col-md-offset-2">
                        <input type="submit" class="btn btn-primary" name="submit-update" value="Modifier le dossier d'inscription">
                        <span>OU</span>
                        <a href="/dossiers/infos/id/<?=$dossier->id ?>" class="reset">Annuler</a>
                    </div>
                </div>


                <script>
                $(function(){

                     $(document).on('change', '.selector', function(){
                                //console.log('triggering select');
                                $sejour = $(this).find('option:selected');

                                var $select = $(this).parents('.sejour-select');
                                //console.log($sejour.data('nbweek'));
                                $dates_from = $sejour.data('datesfrom');
                                $dates_to = $sejour.data('datesto');
                                $sejour_id = $sejour.data('sejour-id');
                                if($sejour.data('nbweek') == 0){
                                    // On ne choisit pas de dates, il s'agit d'un week end
                                    $select.next('.date-range').find('.inject-dates').html('L\'enfant est inscrit sur le week end en intégralité. <input type="hidden" name="dates[]" value="'+$dates_from+'#'+$dates_to+'#'+$sejour_id+'">');
                                }else {
                                    // L'utilisateur peut choisir chaque semaine en checkbox 
                                    console.log($dates_from);
                                    $dates_from = $dates_from.split('#');
                                    $dates_to = $dates_to.split('#');
                                    var date_range = '';
                                    for ( var i = 0; i < $sejour.data('nbweek'); i++ ) {
                                        date_range += '<label style="display: block;"><input type="checkbox" name="dates[]" value="'+$dates_from[i]+'#'+$dates_to[i]+'#'+$sejour_id+'"> Semaine '+(i+1)+' du '+$dates_from[i]+' au '+$dates_to[i]+'</label>';
                                    }
                                    $select.next('.date-range').find('.inject-dates').html(date_range)
                                }

                            });

                            /*
                             Handling Structure Behavior
                             */
                             $('#form-inscription-structure-select').change(function(){
                                //console.log($(this).val());
                                if($(this).val() == 'Choisissez la structure'){
                                    $('#form-inscription-centre-payeur').removeAttr('disabled'); 
                                    $('#form-inscription-centre-payeur-hidden').attr('disabled', 'disabled'); 
                                }else {
                                    $('#form-inscription-centre-payeur').val('');
                                    $('#form-inscription-centre-payeur').attr('disabled','disabled');
                                    $('#form-inscription-centre-payeur-hidden').removeAttr('disabled');
                                }
                            });


                            // Trigger first shot
                            <?php if(isset($_GET['sejour'] )): ?>
                            $('.selector').trigger('change');
                        <?php endif; ?>


                        var i = 1;
                        $('.duplicate').click(function(e){
                            e.preventDefault();
                            $('.sejour-select').first().clone().insertBefore($(this));
                            $('.date-range').first().clone().insertBefore($(this));
                            $('.remove').first().clone().insertBefore($(this));
                            i++;

                        });

                        $('.remove').click(function(e){
                            e.preventDefault();
                            console.log( $(this));
                            $(this).parent().prev('.date-range').remove();
                            $(this).parent().prev('.sejour-select').remove();
                            $(this).remove();
                        });


                    });
</script>

</form>


</div>
</div>

</div>

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>