<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
<?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>


<?php $dossier = dossier::get($_GET['id']); ?>

<!-- Page title -->
<div class="page-head">
    <div class="row">
        <div class="col-md-8">
            <h1>Modifier le dossier d'inscription</h1>
        </div>
    </div>
</div>
<!-- /Page title -->


<div class="row">
    <div class="col-md-9">
        <div class="block-flat">
            <div class="content">
                <form id="form-edit-dossier" method="post" action="/dossiers/infos/id/<?=$dossier->id ?>" class="form-horizontal group-border-dashed maped-form" data-parsley-validate enctype="multipart/form-data">

                    <?php if($dossier->finished): ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-warning">
                                    <i class="fa fa-warning-sign"></i> 
                                    Attention ce dossier a déjà été signalé comme finalisé
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>


                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="form-inscription-enfant-select">Nom de l'enfant</label>
                        <div class="col-sm-6" data-toggle="tooltip" title="Sélectionnez l'enfant à inscrire">
                            <div class="ui-select">
                                <?php $enfants = enfant::getList(); ?>
                                <select class="form-control" id="form-inscription-enfant-select" name="form_inscription_enfant" data-parsley-required="true">
                                    <option selected="selected" value="">Choisissez l'enfant</option>
                                    <?php foreach($enfants as $enfant): ?>
                                        <option <?php if( $enfant->id == $dossier->ref_enfant): ?>selected="selected"<?php endif; ?> value="<?=$enfant->id ?>"><?=$enfant->lastname ?> <?=$enfant->firstname ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>


                    <?php
                        $sejours = sejour::getListFuturSejour();
                        $inscriptions = inscription::getByDossier($dossier->id);
                        $inscriptions_ids = array();
                        foreach ($inscriptions as $inscription) {
                            array_push($inscriptions_ids, $inscription->id);
                        }
                        $facture_inscriptions = facture_item::getByInscriptions($inscriptions_ids);
                    ?>
                    <?php if ( count($facture_inscriptions) > 0 ): ?>
                        <input type="hidden" name="already_factured" value="1">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Séjour(s)</label>
                            <div class="col-sm-6">

                                <ul class="list-group">

                                    <?php foreach($inscriptions as $inscription): ?>
                                    <?php $sejour = sejour::get($inscription->ref_sejour); ?>
                                    <?php $date_from = new DateTime($inscription->date_from); ?>
                                    <?php $date_to = new DateTime($inscription->date_to); ?>
                                    <li class="list-group-item">
                                        <a href="/sejours/infos/id/<?=$sejour->id; ?>"><?=$sejour->name; ?></a> du <?=strftime("%d %B %Y", $date_from->getTimestamp()) ?> au <?=strftime("%d %B %Y", $date_to->getTimestamp()) ?>
                                    </li>
                                    <?php endforeach; ?>

                                </ul>

                                <div class="alert alert-warning">Ces inscriptions sont déjà facturées, vous ne pouvez donc plus les modifier.</div>

                            </div>
                        </div>

                    <?php else: ?>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Séjour(s)</label>
                            <div class="col-sm-6">
                                <div class="sejours-group">
                                    <div class="sejour-form init" style="display:none;">
                                        <fieldset>
                                            <select class="form-control input-sm" name="form_inscription_sejour[]">
                                                <option value="">Choisissez un séjour</option>
                                            </select>
                                        </fieldset>
                                    </div>

                                    <?php
                                        $sejours = sejour::getList();
                                        $sejours_linked = inscription::getLinkedSejours($dossier->id);
                                        $l = 0;
                                    ?>
                                    <?php foreach($sejours_linked as $sejour_linked): ?>
                                        <div class="sejour-form">
                                            <fieldset <?=(count($sejours_linked) > $l+1)? 'disabled' : ''; ?>>
                                                <select class="form-control input-sm" name="form_inscription_sejour[]">
                                                    <option value="">Choisissez un séjour</option>
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
                                                        <option <?php if( $sejour_linked->ref_sejour == $sejour->id ): ?>selected="selected"<?php endif; ?> data-entire="<?=$sejour->entire; ?>" data-truc="<?=$sejour_linked->ref_sejour?>/<?=$sejour->id?>" value="<?=$sejour->id ?>">
                                                            <?=$sejour->name ?> du <?=$date_from_string; ?> au <?=$date_to_string; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>


                                                <?php foreach($sejours as $sejour): ?>
                                                    <?php if( $sejour_linked->ref_sejour == $sejour->id ): ?>
                                                        <?php
                                                            $dates_inscriptions = inscription::getBySejourAndDossier($sejour_linked->ref_sejour, $dossier->id);
                                                            $date_from = new DateTime($sejour->date_from);
                                                            $date_to = new DateTime($sejour->date_to);
                                                            $date_from_string = strftime('%d/%m/%Y', $date_from->getTimestamp());
                                                            $date_to_string = strftime('%d/%m/%Y', $date_to->getTimestamp());

                                                            if ( $sejour->entire ) {
                                                                $nb_weeks = 0;
                                                            } else {
                                                                $nb_weeks = tool::getNbWeeks($date_from, $date_to);
                                                            }
                                                        ?>

                                                        <?php if ($nb_weeks < 1): ?>
                                                            <div class="checkbox">
                                                                <label for="">
                                                                    <input type="checkbox" disabled="disabled" name="dates[]" value="<?=$date_from_string; ?>#<?=$date_to_string; ?>#<?=$sejour_linked->ref_sejour ?>" checked="checked"> 
                                                                    L'enfant est inscrit sur le week end en intégralité.
                                                                </label>
                                                            </div>
                                                        <?php elseif($nb_weeks === 1): ?>
                                                            <div class="checkbox">
                                                                <label for="">
                                                                    <input type="checkbox" name="dates[]" value="<?=$date_from_string; ?>#<?=$date_to_string; ?>#<?=$sejour_linked->ref_sejour ?>" checked="checked" data-id="<?=$sejour->id ?>" data-start="<?=$date_from->getTimestamp(); ?>" data-end="<?=$date_to->getTimestamp(); ?>"> 
                                                                    L'nfant est inscrit sur le séjour en intégralité.
                                                                </label>
                                                            </div>


                                                        <?php else: ?>
                                                            <?php for ($i=0; $i < $nb_weeks; $i++): ?>

                                                                <?php $date_from_timestamp = $date_from->getTimestamp(); ?>
                                                                <?php $date_to_timestamp = $date_to->getTimestamp(); ?>

                                                                <?php $weekStart = 604800 * $i; ?>
                                                                <?php $weekStart = $date_from_timestamp + $weekStart; ?>

                                                                <?php $weekEnd = $weekStart + 604800 + 5000; ?>

                                                                <?php $weekStart_string = strftime('%d/%m/%Y', $weekStart); ?>

                                                                <?php $weekEnd_string = strftime('%d/%m/%Y', $weekEnd); ?>

                                                                <div class="checkbox">
                                                                    <label>
                                                                        <?php $input = '<input type="checkbox" name="dates[]" value="'.$weekStart_string.'#'.$weekEnd_string.'#'.$sejour->id.'" data-id="'.$sejour->id.'" data-start="'.$weekStart.'" data-end="'.$weekEnd.'"'; ?>
                                                                        <?php foreach($dates_inscriptions as $key => $dates_inscription): ?>
                                                                            <?php $dates_inscription_from = new DateTime($dates_inscription->date_from); ?>
                                                                            <?php $dates_inscription_to = new DateTime($dates_inscription->date_to); ?>
                                                                            <?php $dates_inscription_to_string = strftime('%d/%m/%Y', $dates_inscription_from->getTimestamp()); ?>
                                                                            <?php $dates_inscription_from_string = strftime('%d/%m/%Y', $dates_inscription_to->getTimestamp()); ?>
                                                                            <?php
                                                                            $opt = '';
                                                                            if ($weekStart_string == $dates_inscription_to_string) {
                                                                                $opt .= ' checked';
                                                                                break;
                                                                            }
                                                                            ?>
                                                                        <?php endforeach; ?>
                                                                        <?=$input.$opt.'/>'; ?>
                                                                        <strong>Semaine <?=$i + 1; ?></strong> du <?=$weekStart_string?> au <?=$weekEnd_string;?>
                                                                    </label>
                                                                </div>

                                                            <?php endfor; ?>
                                                        <?php endif ?>
                                                    <?php endif ?>
                                                <?php endforeach; ?>
                                            </fieldset>
                                        </div>
                                        <?php $l++; ?>
                                    <?php endforeach; ?>
                                    
                                </div>

                                <div class="sejours-controls">
                                    <button id="js_remove_sejour" class="btn btn-default btn-sm delete-sejour">Supprimer ce séjour</button>
                                    <button id="js_add_sejour" class="btn btn-primary btn-sm add-sejour">Ajouter un séjour</button>
                                </div>
                            </div>
                        </div>
                    <?php endif ?>

                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="form-inscription-structure-select">Centre payeur</label>
                        <div class="col-sm-6" data-toggle="tooltip" title="Sélectionnez la structure qui s'occupe de cet enfant.">
                            <div class="ui-select">
                                <?php $structures = structure::getPayerStructureList(); ?>
                                <select class="form-control" id="form-inscription-structure-select" name="form_inscription_structure">
                                    <option value="" selected="selected">Choisissez la structure</option>
                                    <?php foreach($structures as $structure): ?>
                                        <option <?php if( $structure->id == $dossier->ref_structure_payer): ?>selected="selected"<?php endif; ?> value="<?=$structure->id ?>"><?=$structure->name ?></option>
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
                            <input id="form-inscription-centre-payeur" name="form_inscription_structure_name" class="form-control input-sm" type="text" data-toggle="tooltip" title="Renseignez le nom du centre payeur." value="<?=$dossier->structure_payer ?>">
                            <input type="hidden" id="form-inscription-centre-payeur-hidden" name="form_inscription_structure_name" value="" disabled="disabled">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">Prise en charge</label>
                        <div class="col-sm-6">
                            <label class="radio-inline" for="form-inscription-supported-oui"><input type="radio" class="icheck" name="form_inscription_supported" id="form-inscription-supported-oui" value="1" <?php if($dossier->supported == 1): ?>checked="checked"<?php endif; ?>> Oui</label>
                            <label class="radio-inline" for="form-inscription-supported-non"><input type="radio" class="icheck" name="form_inscription_supported" id="form-inscription-supported-non" value="0" <?php if($dossier->supported == 0): ?>checked="checked"<?php endif; ?>> Non</label>
                            <label class="radio-inline" for="form-inscription-supported-partielle"><input type="radio" class="icheck" name="form_inscription_supported" id="form-inscription-supported-partielle" value="2" <?php if($dossier->supported == 2): ?>checked="checked"<?php endif; ?>> Partielle</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">Contrat retourné</label>
                        <div class="col-sm-6">
                            <label class="radio-inline" for="form-inscription-returned-contract-oui"><input type="radio" class="icheck" name="form_inscription_returned_contract" id="form-inscription-returned-contract-oui" value="1" <?php if($dossier->returned_contract == 1): ?>checked="checked"<?php endif; ?>> Oui</label>
                            <label class="radio-inline" for="form-inscription-returned-contract-non"><input type="radio" class="icheck" name="form_inscription_returned_contract" id="form-inscription-returned-contract-non" value="0" <?php if($dossier->returned_contract == 0): ?>checked="checked"<?php endif; ?>> Non</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="form-inscription-lieu-select">Lieu de rendez-vous</label>
                        <div class="col-sm-6" data-toggle="tooltip" title="Renseignez le lieu de rendez-vous.">
                            <div class="ui-select">
                                <select class="form-control" id="form-inscription-lieu-select" name="form_inscription_lieu"<?php if( $dossier->place == "Aulnay sous bois, au Parking d'Intermarché, avenue Antoine Bourdelle" || $dossier->place == "Gare de Villepinte, Rue Camille Pissarro 93420 Villepinte" || $dossier->place == "Bonneuil en Valois, au Gite"): ?> data-selected="<?=$dossier->place; ?>"<?php endif; ?>>
                                    <option selected="selected" value="">Choisissez le lieu de rendez-vous</option>
                                    <?php if ( $dossier->place == 'Aulnay sous bois, au Parking d\'Intermarché, avenue Antoine Bourdelle' ): ?>
                                        <option value="Aulnay sous bois, au Parking d'Intermarché, avenue Antoine Bourdelle">Aulnay sous bois, au Parking d'Intermarché, avenue Antoine Bourdelle</option>
                                    <?php endif; ?>
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
                            <input id="form_inscription_lieu_custom" name="form_inscription_lieu_custom" class="form-control" type="text" data-toggle="tooltip" <?php if( $dossier->place != "Aulnay sous bois, au Parking d'Intermarché, avenue Antoine Bourdelle" && $dossier->place != "Gare de Villepinte, Rue Camille Pissarro 93420 Villepinte" && $dossier->place != "Bonneuil en Valois, au Gite" ): ?>value="<?=$dossier->place ?>" <?php else: ?> disabled="disabled"<?php endif; ?> placeholder="Ne renseigner que si le lieu n'est pas dans la liste.">
                        </div>

                    </div>



                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="form-inscription-heure-aller">Heure de rendez-vous à l'aller</label>
                        <div class="col-md-1">
                            <?php $hour_departure = explode('h', $dossier->hour_departure); ?>
                            <input id="form-inscription-heure-aller" name="form_inscription_heure_aller" class="form-control pull-left input-hour" type="text" data-toggle="tooltip" title="Renseignez l'heure de rendez-vous pour le départ." value="<?=$hour_departure['0'] ?>">
                            <p class="input-suffix">h</p>
                        </div>
                        <div class="col-md-1">
                            <input id="form-inscription-min-aller" name="form_inscription_min_aller" class="form-control input-minute" type="text" data-toggle="tooltip" value="<?=$hour_departure['1'] ?>" title="Renseignez l'heure de rendez-vous pour le départ.">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="form-inscription-heure-retour">Heure de rendez-vous au retour</label>
                        <div class="col-md-1 col-sm-5">
                            <?php $hour_return = explode('h', $dossier->hour_return); ?>
                            <input id="form-inscription-heure-retour" name="form_inscription_heure_retour" class="form-control pull-left input-hour" type="text" data-toggle="tooltip" title="Renseignez l'heure de rendez-vous pour le retour'." value="<?=$hour_return['0'] ?>">
                            <p class="input-suffix">h</p>
                        </div>
                        <div class="col-md-1 col-sm-5">
                            <input id="form-inscription-min-retour" name="form_inscription_min_retour" class="form-control input-minute" type="text" data-toggle="tooltip" value="<?=$hour_return['1'] ?>" title="Renseignez l'heure de rendez-vous pour le retour'.">
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-4 control-label">Pique-nique</label>
                        <div class="col-sm-6">
                            <label class="radio-inline" for="form-inscription-pique-nique-oui"><input type="radio" class="icheck" name="form_inscription_pique_nique" id="form-inscription-pique-nique-oui" value="1" <?php if($dossier->pique_nique == 1): ?>checked="checked"<?php endif; ?>> Oui</label>
                            <label class="radio-inline" for="form-inscription-pique-nique-non"><input type="radio" class="icheck" name="form_inscription_pique_nique" id="form-inscription-pique-nique-non" value="0" <?php if($dossier->pique_nique == 0): ?>checked="checked"<?php endif; ?>> Non</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">Sac de couchage</label>
                        <div class="col-sm-6">
                            <label class="radio-inline" for="form-inscription-sac-oui"><input type="radio" class="icheck" name="form_inscription_sac" id="form-inscription-sac-oui" value="1" <?php if($dossier->sac == 1): ?>checked="checked"<?php endif; ?>> Oui</label>
                            <label class="radio-inline" for="form-inscription-sac-non"><input type="radio" class="icheck" name="form_inscription_sac" id="form-inscription-sac-non" value="0" <?php if($dossier->sac == 0): ?>checked="checked"<?php endif; ?>> Non</label>
                        </div>
                    </div>



                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="form-inscription-note">Notes</label>
                        <div class="col-sm-6">
                            <textarea id="form-inscription-note" name="form_inscription_note" class="form-control" rows="4" data-toggle="tooltip" title="Notes générales au sujet de l'inscription."><?=$dossier->note ?></textarea>
                        </div>
                    </div>




                    <div class="form-group">
                        <label class="col-sm-4 control-label">Inscription finalisée</label>
                        <div class="col-sm-6">
                            <label class="radio-inline" for="form-inscription-option-oui"><input type="radio" class="icheck" name="form_inscription_option" id="form-inscription-option-oui" value="1" <?php if($dossier->finished == 1): ?>checked="checked"<?php endif; ?>> Oui</label>
                            <label class="radio-inline" for="form-inscription-option-non"><input type="radio" class="icheck" name="form_inscription_option" id="form-inscription-option-non" value="0" <?php if($dossier->finished == 0): ?>checked="checked"<?php endif; ?>> Non</label>
                        </div>
                    </div>


                    <div class="form-group actions text-center">
                        <div class="col-md-8 col-md-offset-2">
                            <input type="hidden" name="submit-update" value="Enregistrer les modifications">
                            <input type="submit" class="btn btn-primary btn-rad btn-lg" value="Enregistrer les modifications">
                            <span>OU</span>
                            <a href="/dossiers/infos/id/<?=$dossier->id; ?>" class="reset">Annuler</a>
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
                    <button class="btn btn-primary btn-block btn-rad">Enregistrer les modifications</button>
                    <a href="/dossiers/infos/id/<?=$dossier->id; ?>">Annuler</a>
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
            entire: <?=$sejour->entire; ?>,
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
        // Si le dernier champ est rempli
        if ( $('.sejour-form:last-child').find('select').val() != '' ) {
            // Si il y a au moins une case à cocher
            if ( $('.sejour-form:last-child').find('[type="checkbox"]:checked').length ) {
                // console.log( $('.sejour-form:last-child').find('option:selected').attr('data-entire') == 1 )
                if ( $('.sejour-form:last-child').find('option:selected').attr('data-entire') == 1  ) {
                    $add_sejour.attr('disabled', 'disabled');
                } else {
                    $add_sejour.removeAttr('disabled');
                }
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
            var entire = dataSejours[selectedId].entire;
            var nbWeeks = countWeeks( start, end );
            if ( nbWeeks < 1 || entire ) {
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
        setControls();
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
        
    });
</script>
<?php $scripts .= ob_get_contents();
ob_end_clean(); ?>

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>