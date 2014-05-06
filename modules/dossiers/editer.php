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





                <hr>
               






                <div class="field-box row">
                    <label class="col-md-2" for="form-inscription-sejour-select">Séjour(s)</label>
                    <div class="col-md-4">
                        <div class="sejours-group">
                            <div class="sejour-form init" style="display:none;">
                                <fieldset class="form-group">
                                    <select class="form-control input-sm" id="form-inscription-sejour-select" name="form_inscription_sejour[]">
                                        <option value="">Choisissez un séjour</option>
                                    </select>
                                </fieldset>
                            </div>
                        </div>

                          <div class="sejours-group">
                            <div class="sejour-form init" style="display:none;">
                                <fieldset class="form-group">
                                    <select class="form-control input-sm" id="form-inscription-sejour-select" name="form_inscription_sejour[]">
                                        <option value="">Choisissez un séjour</option>
                                    </select>
                                </fieldset>
                            </div>
                        </div>


                        <div class="sejours-controls">
                            <button href="#" class="btn btn-default btn-sm delete-sejour" disabled="disabled">Supprimer ce séjour</button>
                            <button href="#" class="btn btn-primary btn-sm add-sejour" disabled="disabled">Ajouter un séjour</button>
                        </div>
                    </div>
                </div>

                <hr>







                <?php //Handle Sejour here ?> 
                <?php $sejours = sejour::getList(); ?>
                <?php $sejours_linked = inscription::getLinkedSejours($dossier->id); ?>
                <?php tool::output($sejours_linked); ?>

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
                                <option selected="selected" value="">Choisissez la structure</option>
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
    function toDate(timestamp) {
        var date = new Date( timestamp*1000);
        if (date.getDate() < 10) {
            var day = '0' + date.getDate();
        } else {
            var day = date.getDate();
        }
        if ((date.getMonth()+1) < 10) {
            var month = '0' + (date.getMonth()+1);
        } else {
            var month = (date.getMonth()+1);
        }
        date = day + '/' + month + '/' + date.getFullYear();
        return date;
    }

    function toTimestamp(date) {
        date = date.split('/');
        var date = date[1] + ',' + date[0] + ',' + date[2];
        return new Date(date).getTime()/1000;
    }

    function countWeeks(start, end) {

        var period = end - start;

        if ( period < 604800) {
            return 0;
        } else {
            return Math.floor(period/604800);
        }
    }

    function findWithAttr(array, attr, value) {
        for(var i = 0; i < array.length; i += 1) {
            if(array[i][attr] == value) {
                return i;
            }
        }
    }

    function setControls() {

        var add = $('.sejours-controls').find('.add-sejour');
        var remove = $('.sejours-controls').find('.delete-sejour');

        if ( $('.sejour-form').length < 3 ) {
            remove.attr('disabled', 'disabled');
        } else {
            remove.removeAttr('disabled');
        }

        if ( $('.sejour-form:last-child').find('select').val() != '' ) {
            if ( $('.sejour-form:last-child').find('[type="checkbox"]:checked').length ) {
                add.removeAttr('disabled');
            } else {
                add.attr('disabled', 'disabled');
            }
        } else {
            add.attr('disabled', 'disabled');
        }

    }

    function addGroupField(data) {
        var forms = $('.sejour-form').not('.init');
        forms.find('fieldset').attr('disabled', 'disabled');
        $('.sejours-group').append( $('.sejours-group').find('.init').clone() );
        setControls();

        var newSejour = $('.sejour-form:last-child');
        newSejour.removeClass('init').fadeIn();

        var selectSejour = newSejour.find('select');

        for (var i = 0; i < data.length; i++) {
            selectSejour.append('<option value="' + data[i].id + '">' + data[i].name + ' du ' + toDate(data[i].start) + ' au ' + toDate(data[i].end) + '</option>');
        }
    }

    function removeLastGroupField() {
        $('.sejour-form:last-child').remove();
        $('.sejour-form:last-child').find('fieldset').removeAttr('disabled');
        
        setControls();
    }

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

    $(function () {
        var dataSejours = [
            <?php $sejours = sejour::getListFuturSejour(); ?>
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
                end: '<?=$date_to; ?>'
                <?php $i++; ?>
            }<?=(count($sejours) != $i)? ',' : '' ; ?>
            <?php endforeach; ?>
        ];

        $('.sejours-controls').on('click', '.add-sejour', function(e) {
            e.preventDefault();
            newDataSejours = [];

            var lastChecked = $('.sejour-form:last-child').find('input[type="checkbox"]:checked').last();

            var start = lastChecked.data('start');
            var end = lastChecked.data('end');
            var id = lastChecked.data('id');

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

        $('.sejours-controls').on('click', '.delete-sejour', function(e) {
            e.preventDefault();
            removeLastGroupField();
        });

        $('.sejours-group').on('change', 'select', function() {
            setCheckbox( $(this).val(), dataSejours);
        });

        $('.sejours-group').on('change', '[type="checkbox"]', function() {
            setControls();
        });


        $('form').submit(function() {
            $('[disabled]').removeAttr('disabled');
        });

        $('#form-inscription-structure-select').change( function () {
            if( $(this).val() == '' ){
                $('#form-inscription-centre-payeur').removeAttr('disabled'); 
                $('#form-inscription-centre-payeur-hidden').attr('disabled', 'disabled'); 
            } else {
                $('#form-inscription-centre-payeur').val('');
                $('#form-inscription-centre-payeur').attr('disabled','disabled');
                $('#form-inscription-centre-payeur-hidden').removeAttr('disabled');
            }
        });
    });
</script>

</form>


</div>
</div>

</div>

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>