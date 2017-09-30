<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
<?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>


<?php $result = dossier::add(array()); ?>
<?php $id = dossier::getLastID(); ?>


<!-- Page title -->
<div class="page-head">
    <div class="row">
        <div class="col-md-8">
            <h1>Ajouter un dossier d'inscription</h1>
        </div>
    </div>
</div>
<!-- /Page title -->


<div class="row">
    <div class="col-md-9">
        <div class="block-flat">
            <div class="content">
                <form id="form-add-dossier" method="post" action="/dossiers/infos/id/<?=$id ?>" class="form-horizontal group-border-dashed maped-form" data-parsley-validate enctype="multipart/form-data">

                    <input type="hidden" value="<?=$id ?>" name="id" />


                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="form-inscription-enfant-select">Nom de l'enfant</label>
                        <div class="col-sm-6" data-toggle="tooltip" title="Sélectionnez l'enfant à inscrire">
                            <div class="ui-select">
                                <?php $enfants = enfant::getList(); ?>
                                <select class="form-control" id="form-inscription-enfant-select" name="form_inscription_enfant" data-parsley-required="true">
                                    <option selected="selected" value="">Choisissez l'enfant</option>
                                    <?php foreach($enfants as $enfant): ?>
                                        <option <?php if( isset($_GET['enfant']) && $enfant->id == $_GET['enfant']): ?>selected="selected"<?php endif; ?> value="<?=$enfant->id ?>"><?=$enfant->lastname ?> <?=$enfant->firstname ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>


                    <?php $sejours = sejour::getListFuturSejour(); ?>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="form-inscription-sejour-select">Séjour(s)</label>
                        <div class="col-sm-6">
                            <div class="sejours-group">
                                <div class="sejour-form init" style="display:none;">
                                    <fieldset>
                                        <select class="form-control input-sm" id="form-inscription-sejour-select" name="form_inscription_sejour[]">
                                            <option value="">Choisissez un séjour</option>
                                        </select>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="sejours-controls">
                                <button id="js_remove_sejour" class="btn btn-default btn-sm delete-sejour" disabled="disabled">Supprimer ce séjour</button>
                                <button id="js_add_sejour" class="btn btn-primary btn-sm add-sejour" disabled="disabled">Ajouter un séjour</button>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="form-inscription-structure-select">Centre payeur</label>
                        <div class="col-sm-6" data-toggle="tooltip" title="Sélectionnez la structure qui s'occupe de cet enfant.">
                            <div class="ui-select">
                                <?php $structures = structure::getPayerStructureList(); ?>
                                <select class="form-control" id="form-inscription-structure-select" name="form_inscription_structure">
                                    <option value="" selected="selected">Choisissez la structure</option>
                                    <?php foreach($structures as $structure): ?>
                                        <option value="<?=$structure->id ?>"><?=$structure->name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="form-inscription-centre-payeur">
                            Autre centre payeur
                             <span class="help-block"><em>Si il n'est pas dans la liste</em></span>
                            </label>
                        <div class="col-sm-6">
                            <input id="form-inscription-centre-payeur" name="form_inscription_structure_name" class="form-control input-sm" type="text" data-toggle="tooltip" title="Renseignez le nom du centre payeur.">
                            <input type="hidden" id="form-inscription-centre-payeur-hidden" name="form_inscription_structure_name" value="" disabled="disabled">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">Prise en charge</label>
                        <div class="col-sm-6">
                            <label class="radio-inline" for="form-inscription-supported-oui"><input type="radio" class="icheck" name="form_inscription_supported" id="form-inscription-supported-oui" value="1"> Oui</label>
                            <label class="radio-inline" for="form-inscription-supported-non"><input type="radio" class="icheck" name="form_inscription_supported" id="form-inscription-supported-non" value="0" checked="checked"> Non</label>
                            <label class="radio-inline" for="form-inscription-supported-partielle"><input type="radio" class="icheck" name="form_inscription_supported" id="form-inscription-supported-partielle" value="2" checked="checked"> Partielle</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">Contrat retourné</label>
                        <div class="col-sm-6">
                            <label class="radio-inline" for="form-inscription-returned-contract-oui"><input type="radio" class="icheck" name="form_inscription_returned_contract" id="form-inscription-returned-contract-oui" value="1"> Oui</label>
                            <label class="radio-inline" for="form-inscription-returned-contract-non"><input type="radio" class="icheck" name="form_inscription_returned_contract" id="form-inscription-returned-contract-non" value="0" checked="checked"> Non</label>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="form-inscription-lieu-select">Lieu de rendez-vous</label>
                        <div class="col-sm-6" data-toggle="tooltip" title="Renseignez le lieu de rendez-vous.">
                            <div class="ui-select">
                                <select class="form-control" id="form-inscription-lieu-select" name="form_inscription_lieu">
                                    <option selected="selected" value="">Choisissez le lieu de rendez-vous</option>
                                    <option value="Gare de Villepinte, Rue Camille Pissarro 93420 Villepinte">Gare de Villepinte, Rue Camille Pissarro 93420 Villepinte</option>
                                    <option value="Bonneuil en Valois, au Gite">Bonneuil en Valois, au Gite</option>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="form_inscription_lieu_custom">
                            Autre lieu de rendez-vous
                             <span class="help-block"><em>Si il n'est pas dans la liste</em></span>
                        </label>
                        <div class="col-sm-6">
                            <input id="form_inscription_lieu_custom" name="form_inscription_lieu_custom" class="form-control" type="text" data-toggle="tooltip" value="" placeholder="Ne renseigner que si le lieu n'est pas dans la liste.">
                        </div>

                    </div>



                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="form-inscription-heure-aller">Heure de rendez-vous à l'aller</label>
                        <div class="col-md-1">
                            <input id="form-inscription-heure-aller" name="form_inscription_heure_aller" class="form-control pull-left input-hour" type="text" data-toggle="tooltip" title="Renseignez l'heure de rendez-vous pour le départ.">
                            <p class="input-suffix">h</p>
                        </div>
                        <div class="col-md-1">
                            <input id="form-inscription-min-aller" name="form_inscription_min_aller" class="form-control input-minute" type="text" data-toggle="tooltip" value="00" title="Renseignez l'heure de rendez-vous pour le départ.">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="form-inscription-heure-retour">Heure de rendez-vous au retour</label>
                        <div class="col-md-1 col-sm-5">
                            <input id="form-inscription-heure-retour" name="form_inscription_heure_retour" class="form-control pull-left input-hour" type="text" data-toggle="tooltip" title="Renseignez l'heure de rendez-vous pour le retour'.">
                            <p class="input-suffix">h</p>
                        </div>
                        <div class="col-md-1 col-sm-5">
                            <input id="form-inscription-min-retour" name="form_inscription_min_retour" class="form-control input-minute" type="text" data-toggle="tooltip" value="00" title="Renseignez l'heure de rendez-vous pour le retour'.">
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-4 control-label">Pique-nique</label>
                        <div class="col-sm-6">
                            <label class="radio-inline" for="form-inscription-pique-nique-oui"><input type="radio" class="icheck" name="form_inscription_pique_nique" id="form-inscription-pique-nique-oui" value="1"> Oui</label>
                            <label class="radio-inline" for="form-inscription-pique-nique-non"><input type="radio" class="icheck" name="form_inscription_pique_nique" id="form-inscription-pique-nique-non" value="0" checked="checked"> Non</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">Sac de couchage</label>
                        <div class="col-sm-6">
                            <label class="radio-inline" for="form-inscription-sac-oui"><input type="radio" class="icheck" name="form_inscription_sac" id="form-inscription-sac-oui" value="1"> Oui</label>
                            <label class="radio-inline" for="form-inscription-sac-non"><input type="radio" class="icheck" name="form_inscription_sac" id="form-inscription-sac-non" value="0" checked="checked"> Non</label>
                        </div>
                    </div>



                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="form-inscription-note">Notes</label>
                        <div class="col-sm-6">
                            <textarea id="form-inscription-note" name="form_inscription_note" class="form-control" rows="4" data-toggle="tooltip" title="Notes générales au sujet de l'inscription."></textarea>
                        </div>
                    </div>




                    <div class="form-group">
                        <label class="col-sm-4 control-label">Inscription finalisée</label>
                        <div class="col-sm-6">
                            <label class="radio-inline" for="form-inscription-option-oui"><input type="radio" class="icheck" name="form_inscription_option" id="form-inscription-option-oui" value="1"> Oui</label>
                            <label class="radio-inline" for="form-inscription-option-non"><input type="radio" class="icheck" name="form_inscription_option" id="form-inscription-option-non" value="0" checked="checked"> Non</label>
                        </div>
                    </div>


                    <div class="form-group actions text-center">
                        <div class="col-md-8 col-md-offset-2">
                            <input type="hidden" name="submit-add" value="Enregistrer le nouveau dossier d'inscription">
                            <input type="submit" class="btn btn-primary btn-rad btn-lg" value="Enregistrer le nouveau dossier d'inscription">
                            <span>OU</span>
                            <a href="/dossiers/" class="reset">Annuler</a>
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
                    <button class="btn btn-primary btn-block btn-rad">Enregistrer le nouveau dossier</button>
                    <a href="/dossiers/">Annuler</a>
                </div>
            </div>

            <!-- <div id="form-nav" class="block-flat bars-widget">
            </div> -->
        </div>
    </div>
</div>

<?php ob_start(); ?>
<script>


    var dataSejours = [
        <?php $i = 0; ?>
        <?php foreach ($sejours as $key => $sejour): ?>
        {
            <?php $date_from = new DateTime($sejour->date_from); ?>
            <?php $date_to = new DateTime($sejour->date_to); ?>
            <?php if($date_to->getTimestamp() != '-62169987600'): ?>
                <?php $date_to = $date_to->getTimestamp(); ?>
            <?php endif; ?>
            <?php if($date_from->getTimestamp() != '-62169987600'): ?>
                <?php $date_from = $date_from->getTimestamp(); ?>
            <?php endif; ?>
            id: <?=$sejour->id; ?>,
            name: '<?=addslashes($sejour->name); ?>',
            start: '<?=$date_from; ?>',
            end: '<?=$date_to; ?>',
            rendez_vous: {
                hours_departure: <?php echo json_encode( unserialize( $sejour->hours_departure ) ); ?>,
                hours_intermediate_return : <?php echo json_encode( unserialize( $sejour->hours_intermediate_return ) ); ?>,
                hours_intermediate_departure : <?php echo json_encode( unserialize( $sejour->hours_intermediate_departure ) ); ?>,
                hours_return : <?php echo json_encode( unserialize( $sejour->hours_return ) ); ?>
            }
            <?php $i++; ?>
        }<?=(count($sejours) != $i)? ',' : '' ; ?>
        <?php endforeach; ?>
    ];


    var $sejoursGroup = $('.sejours-group'),
        $add_sejour = $('#js_add_sejour'),
        $remove_sejour = $('#js_remove_sejour'),
        $rdvPlace = $('#form-inscription-lieu-select'),
        $rdvPlaceCustom = $('#form_inscription_lieu_custom'),
        $rdvDepartureHour = $('#form-inscription-heure-aller'),
        $rdvDepartureMin = $('#form-inscription-min-aller'),
        $rdvReturnHour = $('#form-inscription-heure-retour'),
        $rdvReturnMin = $('#form-inscription-min-retour');



    /*
    * Active ou désactive les controles pour ajouter ou supprimer des séjours
    */
    function setControls() {
        if ( $('.sejour-form').length < 3 ) {
            $remove_sejour.attr('disabled', 'disabled');
        } else {
            $remove_sejour.removeAttr('disabled');
        }
        if ( $('.sejour-form:last-child').find('select').val() != '' ) {
            if ( $('.sejour-form:last-child').find('[type="checkbox"]:checked').length ) {
                $add_sejour.removeAttr('disabled');
            } else {
                $add_sejour.attr('disabled', 'disabled');
            }
        } else {
            $add_sejour.attr('disabled', 'disabled');
        }
    }

    /*
    * Ajoute un nouveau groupe de séjours
    */
    function addGroupField(data) {
        var forms = $('.sejour-form').not('.init'),
            cloned = $sejoursGroup.find('.init').clone();

        if ($('.sejour-form:visible').length < 1) {
            cloned.find('select').attr('data-parsley-required', 'true');
        }
        forms.find('fieldset').attr('disabled', 'disabled');
        $sejoursGroup.append( cloned );
        setControls();

        var newSejour = $('.sejour-form:last-child');
        newSejour.removeClass('init').fadeIn();
        var selectSejour = newSejour.find('select');
        for (var i = 0; i < data.length; i++) {
            selectSejour.append('<option value="' + data[i].id + '">' + data[i].name + ' du ' + toDate(data[i].start) + ' au ' + toDate(data[i].end) + '</option>');
        }
    }

    /*
    * Supprime le dernier groupe de séjours
    */
    function removeLastGroupField() {
        $('.sejour-form:last-child').remove();
        $('.sejour-form:last-child').find('fieldset').removeAttr('disabled');
        
        setControls();
    }



    /*
    * Génére les checkboxs pour un groupe de séjours
    */
    function setCheckbox(selectValue, dataSejours) {
        var disabledBefore = 0;
        if ( $('.sejour-form').length > 2 ) {
            var disabledBefore = $('.sejour-form').eq($('.sejour-form').length-2).find('input[type="checkbox"]:checked').last().data('end');
        }
        setControls();
        $('.sejour-form:last-child').find('.checkbox').remove();
        if ( selectValue != '' ) {
            var selectedId = findWithAttr( dataSejours, 'id', selectValue );
            var start = dataSejours[selectedId].start;
            var end = dataSejours[selectedId].end;
            var id = dataSejours[selectedId].id;
            var nbWeeks = countWeeks( start, end );
            if ( nbWeeks < 1 ) {
                $('.sejour-form:last-child').find('fieldset').append('<div class="checkbox"><label><input type="checkbox" name="dates[]" value="' + toDate(start) + '#' + toDate(end) + '#' + id + '" data-id="' + id + '" data-start="' + start + '" data-end="' + end + '" disabled checked /> L\'enfant est inscrit sur le week end en intégralité.</label></div>');
            } else if ( nbWeeks === 1 ) {
                $('.sejour-form:last-child').find('fieldset').append('<div class="checkbox"><label><input type="checkbox" name="dates[]" value="' + toDate(start) + '#' + toDate(end) + '#' + id + '" data-id="' + id + '" data-start="' + start + '" data-end="' + end + '" disabled checked /> L\'enfant est inscrit sur le séjour en intégralité.</label></div>');
            } else {
                for (var i = 0; i < nbWeeks; i++) {
                    var weekStart = 604800 * parseInt(i) + parseInt(start);
                    var weekEnd = parseInt(weekStart) + 604800 + 5000;
                    var content = '<div class="checkbox"><label><input type="checkbox" name="dates[]" value="' + toDate(weekStart) + '#' + toDate(weekEnd) + '#' + id + '" data-id="' + id + '" data-start="' + weekStart + '" data-end="' + weekEnd + '"';
                    if ( weekEnd <= disabledBefore ) {
                        content = content + ' disabled ';
                    } else if (i < 1) {
                        content = content + ' checked '
                    }
                    content = content + '/><strong>Semaine '+ (i + 1) +'</strong> du ' + toDate(weekStart) + ' au ' + toDate(weekEnd) + '</label></div>';
                    $('.sejour-form:last-child').find('fieldset').append(content);
                }
            }
        }
        setControls();
    }


    /*
    * Retourne les informations d'un séjour via un ID
    */
    function getSejourById(id) {
        for (var i = 0; i < dataSejours.length; i++) {
            if (dataSejours[i].id == id) {
                return dataSejours[i];
                break;
            }
        }
    }


    /*
    * Vide les champs liés au lieu et aux horaires de rendez-vous
    */
    function cleanRendezVous(id) {
        if ($rdvPlace.val() !== '') {
            $rdvPlace.val('');
            $rdvDepartureHour.val('');
            $rdvDepartureMin.val('');
            $rdvReturnHour.val('');
            $rdvReturnMin.val('');
        }
    }


    /*
    * Rempli automatiquement les champs des Rendez-vous en fonction des séjours sélectionnés.
    */
    function setRendezVous(place) {

        if (place !== '' && $sejoursGroup.find('.sejour-form').not('.init').last().find('select').val() !== '') {

            var hoursDeparture = 0,
                minDeparture = 0,
                hoursReturn = 0,
                minReturn = 0;


            $sejoursGroups = $sejoursGroup.find('.sejour-form').not('.init');

            // Pour les dates de départ
            var sejourFirst = $sejoursGroups.first().find('select').val(),
                $checkboxes = $sejoursGroups.first().find('.checkbox'),
                checkedIndex = 0;

            var sejourData = getSejourById(sejourFirst);

            // On regarde quelle est la position de la première checkbox activé
            for (var i = 0; i < $checkboxes.length; i++) {
                if ( $checkboxes.eq(i).find('input[type="checkbox"]').is(':checked') ) {
                    checkedIndex = i;
                    break;
                }
            }

            // Si c'est la première (index 0)
            if ( checkedIndex == 0 || sejourData.rendez_vous.hours_intermediate_departure === false ) {
                // Alors les dates de rendez-vous à l'aller sont les premières

                if ( place == 'Gare de Villepinte, Rue Camille Pissarro 93420 Villepinte' ) {
                    // 1 
                    hoursDeparture = sejourData.rendez_vous.hours_departure.hours[1];
                    minDeparture = sejourData.rendez_vous.hours_departure.min[1];
                } else if ( place == 'Bonneuil en Valois, au Gite' ) {
                    // 2 
                    hoursDeparture = sejourData.rendez_vous.hours_departure.hours[2];
                    minDeparture = sejourData.rendez_vous.hours_departure.min[2];
                }

            } else {
                // Sinon ce sont les dates intermédiaires.
                if ( place == 'Gare de Villepinte, Rue Camille Pissarro 93420 Villepinte' ) {
                    hoursDeparture = sejourData.rendez_vous.hours_intermediate_departure.hours[1];
                    minDeparture = sejourData.rendez_vous.hours_intermediate_departure.min[1];
                } else if ( place == 'Bonneuil en Valois, au Gite' ) {
                    hoursDeparture = sejourData.rendez_vous.hours_intermediate_departure.hours[2];
                    minDeparture = sejourData.rendez_vous.hours_intermediate_departure.min[2];
                }

            }


            $rdvDepartureHour.val(hoursDeparture);
            $rdvDepartureMin.val(minDeparture);


            ///////////////////////////////////////////////////////////////////////////
            ///////////////////////////////////////////////////////////////////////////

            // Pour les dates de retour
            var sejourLast = $sejoursGroups.last().find('select').val(),
                $checkboxes = $sejoursGroups.last().find('.checkbox'),
                checkedIndex = 0;

            var sejourData = getSejourById(sejourLast);

            // On regarde quelle est la position de la première checkbox activé
            for (var i = $checkboxes.length - 1; i >= 0; i--) {
                if ( $checkboxes.eq(i).find('input[type="checkbox"]').is(':checked') ) {
                    checkedIndex = i;
                    break;
                }
            }


            // Si c'est la première (index 0)
            if ( (checkedIndex + 1) == $checkboxes.length || sejourData.rendez_vous.hours_intermediate_return === false ) {
                // Alors les dates de rendez-vous à l'aller sont les premières

                if ( place == 'Gare de Villepinte, Rue Camille Pissarro 93420 Villepinte' ) {
                    // 1 
                    hoursReturn = sejourData.rendez_vous.hours_return.hours[1];
                    minReturn = sejourData.rendez_vous.hours_return.min[1];
                } else if ( place == 'Bonneuil en Valois, au Gite' ) {
                    // 2 
                    hoursReturn = sejourData.rendez_vous.hours_return.hours[2];
                    minReturn = sejourData.rendez_vous.hours_return.min[2];
                }

            } else {
                // Sinon ce sont les dates intermédiaires.
                if ( place == 'Gare de Villepinte, Rue Camille Pissarro 93420 Villepinte' ) {
                    hoursReturn = sejourData.rendez_vous.hours_intermediate_return.hours[1];
                    minReturn = sejourData.rendez_vous.hours_intermediate_return.min[1];
                } else if ( place == 'Bonneuil en Valois, au Gite' ) {
                    hoursReturn = sejourData.rendez_vous.hours_intermediate_return.hours[2];
                    minReturn = sejourData.rendez_vous.hours_intermediate_return.min[2];
                }

            }
            
            $rdvReturnHour.val(hoursReturn);
            $rdvReturnMin.val(minReturn);

        }

        if ( place !== '' ) {
            $rdvPlaceCustom.attr('disabled', 'disabled');
        } else {
            cleanRendezVous();
            $rdvPlaceCustom.removeAttr('disabled');
        }
    }


    $(function () {

        $add_sejour.on('click', function(e) {
            e.preventDefault();
            newDataSejours = [];
            var lastChecked = $('.sejour-form:last-child').find('input[type="checkbox"]:checked').last(),
                start = lastChecked.data('start'),
                end = lastChecked.data('end'),
                id = lastChecked.data('id');
            if( countWeeks(start, end) < 1 ) {
                for (var i = 0; i < dataSejours.length; i++) {
                    if (dataSejours[i].start > end && dataSejours[i].id != id && countWeeks(dataSejours[i].start, dataSejours[i].end) < 1) {
                        newDataSejours.push(dataSejours[i]);
                    }
                }
            } else {
                for (var i = 0; i < dataSejours.length; i++) {
                    if ( dataSejours[i].end > end && dataSejours[i].id != id ) {
                        var nbWeeks = countWeeks(dataSejours[i].start, dataSejours[i].end);
                        var itsIn = 0;
                        if (nbWeeks > 0) {
                            for (var y = 0; y <= nbWeeks; y++) {
                                var weekStart = 604800 * parseInt(y) + parseInt(dataSejours[i].start);
                                if (toDate(weekStart) == toDate(end)) {
                                    itsIn++;
                                }
                            }
                            if (itsIn > 0) {
                                newDataSejours.push(dataSejours[i]);
                            }
                        }
                    }
                }
            }
            addGroupField( newDataSejours );
        });

        $remove_sejour.on('click', function(e) {
            e.preventDefault();
            removeLastGroupField();
            setRendezVous($rdvPlace.val());
        });

        $sejoursGroup.on('change', 'select', function() {
            setCheckbox( $(this).val(), dataSejours);
            setRendezVous($rdvPlace.val());
        });

        $sejoursGroup.on('change', '[type="checkbox"]', function() {
            setControls();
            setRendezVous($rdvPlace.val());
        });

        $('form').submit(function() {
            $('[disabled]').removeAttr('disabled');
        });

        $('#form-inscription-structure-select').on('change', function () {
            if( $(this).val() == '' ){
                $('#form-inscription-centre-payeur').removeAttr('disabled'); 
                $('#form-inscription-centre-payeur-hidden').attr('disabled', 'disabled'); 
            } else {
                $('#form-inscription-centre-payeur').val('').attr('disabled','disabled');
                $('#form-inscription-centre-payeur-hidden').removeAttr('disabled');
            }
        });


        $rdvPlace.on('change', function(){
            var $elem = $(this).find(":selected");
            setRendezVous($elem.val());
        });


    
        addGroupField( dataSejours );
        
    });
</script>
<?php $scripts .= ob_get_contents();
ob_end_clean(); ?>


<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>