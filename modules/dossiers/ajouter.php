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


<div class="title">
    <div class="row">
        <div class="col-md-12">
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
                                    <button href="#" class="btn btn-default btn-sm delete-sejour" disabled="disabled">Supprimer ce séjour</button>
                                    <button href="#" class="btn btn-primary btn-sm add-sejour" disabled="disabled">Ajouter un séjour</button>
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
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="form-inscription-lieu-select">Lieu de rendez-vous</label>
                            <div class="col-sm-6" data-toggle="tooltip" title="Renseignez le lieu de rendez-vous.">
                                <div class="ui-select">
                                    <select class="form-control" id="form-inscription-lieu-select" name="form_inscription_lieu">
                                        <option selected="selected" value="">Choisissez le lieu de rendez-vous</option>
                                        <option value="Aulnay sous bois, au Parking d'Intermarché, avenue Antoine Bourdelle">Aulnay sous bois, au Parking d'Intermarché, avenue Antoine Bourdelle</option>
                                        <option value="Aulnay sous Bois, au RER, Dépôt Minute, Place du Général de Gaulle">Aulnay sous Bois, au RER, Dépôt Minute, Place du Général de Gaulle</option>
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
                                <input type="submit" class="btn btn-primary btn-rad btn-lg" name="submit-add" value="Enregistrer le nouveau dossier d'inscription">
                                <span>OU</span>
                                <a href="/dossiers/" class="reset">Annuler</a>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

</div>


<?php ob_start(); ?>
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
        var forms = $('.sejour-form').not('.init'),
            cloned = $('.sejours-group').find('.init').clone();

        if ($('.sejour-form:visible').length < 1) {
            cloned.find('select').attr('data-parsley-required', 'true');
        }
        forms.find('fieldset').attr('disabled', 'disabled');
        $('.sejours-group').append( cloned );
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
        addGroupField( dataSejours );
        $('form').submit(function() {
            $('[disabled]').removeAttr('disabled');
        });

        $('#form-inscription-structure-select').on('change', function () {
            if( $(this).val() == '' ){
                $('#form-inscription-centre-payeur').removeAttr('disabled'); 
                $('#form-inscription-centre-payeur-hidden').attr('disabled', 'disabled'); 
            } else {
                $('#form-inscription-centre-payeur').val('');
                $('#form-inscription-centre-payeur').attr('disabled','disabled');
                $('#form-inscription-centre-payeur-hidden').removeAttr('disabled');
            }
        });

        $('.sejours-group').on('change', '.sejour-form select', function(){
            var sejour_fieldset = $(this).parent(),
                sejour_id = $(this).val(),
                nb_select = $('.sejour-form select').length;

            jQuery.ajax({
                type: 'GET', // Le type de ma requete
                url: '/ajax/get_sejour.php', // L'url vers laquelle la requete sera envoyee
                data: {
                    id: sejour_id
                },
                dataType: 'json',
                success: function(data, textStatus, jqXHR) {
                    //console.log(data);
                    if(data.hours_departure != ''){
                        //console.log(data.hours_departure.min);
                        //console.log(data.hours_departure.min['0']);
                        $('#form-inscription-lieu-select').html('<option selected="selected" value="">Choisissez le lieu de rendez-vous</option>');
                        $('#form-inscription-lieu-select').append('<option data-hour-departure="'+data.hours_departure.hours[0]+'" data-min-departure="'+data.hours_departure.min[0]+'" data-hour-return="'+data.hours_return.hours[0]+'" data-min-return="'+data.hours_return.min[0]+'" value="Aulnay sous bois, au Parking d\'Intermarché, avenue Antoine Bourdelle">Aulnay sous bois, au Parking d\'Intermarché, avenue Antoine Bourdelle</option>');
                        $('#form-inscription-lieu-select').append('<option data-hour-departure="'+data.hours_departure.hours[1]+'" data-min-departure="'+data.hours_departure.min[1]+'" data-hour-return="'+data.hours_return.hours[1]+'" data-min-return="'+data.hours_return.min[1]+'" value="Aulnay sous Bois, au RER, Dépôt Minute, Place du Général de Gaulle">Aulnay sous Bois, au RER, Dépôt Minute, Place du Général de Gaulle</option>');
                        $('#form-inscription-lieu-select').append('<option data-hour-departure="'+data.hours_departure.hours[2]+'" data-min-departure="'+data.hours_departure.min[2]+'" data-hour-return="'+data.hours_return.hours[2]+'" data-min-return="'+data.hours_return.min[2]+'" value="Bonneuil en Valois, au Gite">Bonneuil en Valois, au Gite</option>');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown, data) {
                    console.log(errorThrown);
                }
            }); 
            jQuery.ajax({
                type: 'GET', // Le type de ma requete
                url: '/ajax/get_nb_inscriptions.php', // L'url vers laquelle la requete sera envoyee
                data: {
                    sejour_id: sejour_id,
                },
                dataType: 'json',
                success: function(data, textStatus, jqXHR) {
                    if(data == true){
                        sejour_fieldset.find('.error_nb').remove();
                        sejour_fieldset.prepend('<div class="error_nb alert alert-warning alert-white-alt"><div class="icon"><i class="fa fa-warning"></i></div> <strong>Attention</strong>, il n\y a plus de place sur ce séjour.</div>');
                    }
                    else {
                        sejour_fieldset.find('.error_nb').remove();
                    }
                },
                error: function(jqXHR, textStatus, errorThrown, data) {
                    console.log(errorThrown);
                }
            }); 
            var enfant_id = $('#form-inscription-enfant-select').val();
            if(enfant_id != ''){
                jQuery.ajax({
                    type: 'GET', // Le type de ma requete
                    url: '/ajax/check_register.php', // L'url vers laquelle la requete sera envoyee
                    data: {
                        sejour_id: sejour_id,
                        enfant_id: enfant_id
                    },
                    dataType: 'json',
                    success: function(data, textStatus, jqXHR) {
                        if(data == true){
                            sejour_fieldset.find('.error_check').remove();
                            sejour_fieldset.prepend('<div class="error_check alert alert-danger alert-white-alt"><div class="icon"><i class="fa fa-warning"></i></div> <strong>Attention</strong>, l\'enfant est déjà inscrit à ce séjour.</div>');
                        }
                        else{
                            sejour_fieldset.find('.error_check').remove();
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown, data) {
                        console.log(errorThrown);
                    }
                }); 
            }
            // <option value="Aulnay sous bois, au Parking d'Intermarché, avenue Antoine Bourdelle">Aulnay sous bois, au Parking d'Intermarché, avenue Antoine Bourdelle</option>
            // <option value="Aulnay sous Bois, au RER, Dépôt Minute, Place du Général de Gaulle">Aulnay sous Bois, au RER, Dépôt Minute, Place du Général de Gaulle</option>
            // <option value="Bonneuil en Valois, au Gite">Bonneuil en Valois, au Gite</option>
        });
        $('#form-inscription-lieu-select').on('change', function(){
            //console.log('hello');
            var elem = $(this).find(":selected");
                if(elem.data('hour-departure') != ''){
                //console.log($(this).find(":selected").data('hour-departure'));
                // Aller
                $('#form-inscription-heure-aller').val(elem.data('hour-departure'));
                $('#form-inscription-min-aller').val(elem.data('min-departure'));
                // retour
                $('#form-inscription-heure-retour').val(elem.data('hour-return'));
                $('#form-inscription-min-retour').val(elem.data('min-return'));
            }
            if ($(this).val() != '') {
                $('#form_inscription_lieu_custom').attr('disabled', 'disabled').val('');
            } else {
                $('#form_inscription_lieu_custom').removeAttr('disabled');
            }
        });

        
    });
</script>
<?php $scripts .= ob_get_contents();
ob_end_clean(); ?>


<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>