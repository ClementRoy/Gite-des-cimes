<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
<?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>


<?php $result = inscription::add(array()); ?>
<?php $id = inscription::getLastID(); ?>

<div class="title">
    <div class="row header">
        <div class="col-md-12">
            <h3>Ajouter une inscription</h3>
        </div>
    </div>
</div>
<div class="content">

        <div class="row">
            <div class="col-md-12">
                <form id="form-add-sejour" method="post" action="/inscription/infos/id/<?=$id ?>" parsley-validate>

                    <input type="hidden" value="<?=$id ?>" name="id" />


                    <div class="field-box row">
                        <label class="col-md-2" for="form-inscription-enfant-select">Nom de l'enfant</label>
                        <div class="col-md-4 col-sm-5" data-toggle="tooltip" title="Sélectionnez l'enfant à inscrire">
                            <div class="ui-select">
                                <?php $enfants = enfant::getList(); ?>
                                <select class="form-control" id="form-inscription-enfant-select" name="form_inscription_enfant" parsley-required="true">
                                    <option selected="selected">Choisissez l'enfant</option>
                                    <?php foreach($enfants as $enfant): ?>
                                        <option <?php if( isset($_GET['enfant']) && $enfant->id == $_GET['enfant']): ?>selected="selected"<?php endif; ?> value="<?=$enfant->id ?>"><?=$enfant->lastname ?> <?=$enfant->firstname ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <?php // TODO: ne prendre que les FUTURS séjours ?>

                    <?php $sejours = sejour::getListFuturSejour(); ?>
                    <div class="field-box row">
                        <label class="col-md-2" for="form-inscription-sejour-select">Séjour</label>
                        <div class="col-md-4 col-sm-5" data-toggle="tooltip" title="Sélectionnez le séjour">
                            <div class="ui-select">
                                <select class="form-control" id="form-inscription-sejour-select" name="form_inscription_sejour" parsley-required="true">
                                    <option selected="selected">Choisissez le séjour</option>
                                    <?php foreach($sejours as $sejour): ?>
                                        <?php $date_from = new DateTime($sejour->date_from); ?>
                                        <?php $date_from_2 = new DateTime($sejour->date_from); ?>
                                        <?php $date_from_2 = $date_from_2->modify('+2 day'); ?>
                                        <?php if($date_from->getTimestamp() != '-62169987600'): ?>
                                            <?php $date_from = strftime('%d/%m/%Y', $date_from->getTimestamp()); ?>
                                        <?php endif; ?>
                                        <?php $date_to = new DateTime($sejour->date_to); ?>
                                        <?php if($date_to->getTimestamp() != '-62169987600'): ?>
                                            <?php $date_to = strftime('%d/%m/%Y', $date_to->getTimestamp()); ?>
                                        <?php endif; ?>
                                        <option <?php if( isset($_GET['sejour']) && $sejour->id == $_GET['sejour']): ?>selected="selected"<?php endif; ?> value="<?=$sejour->id ?>" data-date-start="<?=$date_from; ?>" data-date-end-2="<?=$date_from_2->format('d/m/Y'); ?>" data-date-end="<?=$date_to; ?>"><?=$sejour->name ?> du <?=$date_from; ?> au <?=$date_to; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="field-box row">
                        <label class="col-md-2" for="form-inscription-nom">Dates</label>
                        <div class="col-md-2">
                            <input id="form-inscription-date-debut" name="form_inscription_date_debut" type="text" class="form-control input-datepicker-light"
                            placeholder="Date de début" data-toggle="tooltip" title="Renseignez la date à laquelle commence le séjour (jj/mm/aaaa)." 
                            parsley-regexp="([0-3][0-9]|[1-9])/([1-9]|1[0-2]|0[1-9])/([1-2][0|9][0-9]{2})"
                            parsley-required="true">
                            <input type="hidden" id="form-inscription-date-debut-hidden" name="form_inscription_date_debut" value="" disabled="disabled">
                        </div> 
                        <div class="col-md-2">
                            <input id="form-inscription-date-fin" name="form_inscription_date_fin" type="text" class="form-control input-datepicker-light" 
                            placeholder="Date de fin" data-toggle="tooltip" title="Renseignez la date à laquelle se termine le séjour (jj/mm/aaaa)." 
                            parsley-regexp="([0-3][0-9]|[1-9])/([1-9]|1[0-2]|0[1-9])/([1-2][0|9][0-9]{2})"
                            parsley-required="true"><!-- parsley-afterdate="#form-sejour-date-debut" CR : not working properly with french dates -->
                            <input type="hidden" id="form-inscription-date-fin-hidden" name="form_inscription_date_fin" value="" disabled="disabled">
                        </div>                              
                    </div>   


                    <div class="field-box row">
                        <label class="col-md-2" for="form-inscription-structure-select">Centre payeur</label>
                        <div class="col-md-4 col-sm-5" data-toggle="tooltip" title="Sélectionnez la structure qui s'occupe de cet enfant.">
                            <div class="ui-select">
                                <?php $structures = structure::getList(); ?>
                                <select class="form-control" id="form-inscription-structure-select" name="form_inscription_structure">
                                    <option selected="selected">Choisissez la structure</option>
                                    <?php foreach($structures as $structure): ?>
                                        <option value="<?=$structure->id ?>"><?=$structure->name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="field-box row">
                        <label class="col-md-2" for="form-inscription-centre-payeur">Centre payeur <em>Si il n'est pas dans la liste</em></label>
                        <div class="col-md-4 col-sm-5">
                            <input id="form-inscription-centre-payeur" name="form_inscription_structure_name" class="form-control input-sm" type="text" data-toggle="tooltip" title="Renseignez le nom du centre payeur.">
                            <input type="hidden" id="form-inscription-centre-payeur-hidden" name="form_inscription_structure_name" value="" disabled="disabled">
                        </div>
                    </div>

                    <div class="field-box row">
                        <label class="col-md-2">Prise en charge de l'enfant</label>
                        <div class="col-md-4 col-sm-5" data-toggle="tooltip" title="Précisez si l'enfant est pris en charge.">
                            <label class="radio-inline col-md-7" for="form-inscription-supported-oui">
                                <div class="radio" id="uniform-form-inscription-supported-oui">
                                    <span>
                                        <input type="radio" name="form_inscription_supported" id="form-inscription-supported-oui" value="1">
                                    </span>
                                </div>
                                Oui
                            </label>
                            <label class="radio-inline col-md-4 col-sm-5" for="form-inscription-supported-non">
                                <div class="radio" id="uniform-form-inscription-supported-non">
                                    <span class="checked">
                                        <input type="radio" name="form_inscription_supported" id="form-inscription-supported-non" value="0" checked="checked">
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
                                    <option value="Aulnay sous bois, au Parking d'Intermarché">Aulnay sous bois, au Parking d'Intermarché</option>
                                    <option value="Aulnay sous Bois, au RER, Dépôt Minute, Place du Général de Gaulle">Aulnay sous Bois, au RER, Dépôt Minute, Place du Général de Gaulle</option>
                                    <option value="Bonneuil en Valois, au Gite">Bonneuil en Valois, au Gite</option>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="field-box row">
                        <label class="col-md-2" for="form-inscription-heure-aller">Heure de rendez-vous</label>
                        <div class="col-md-1 col-sm-5">
                            <input id="form-inscription-heure-aller" name="form_inscription_heure_aller" class="form-control adresse-numero pull-left" type="text" data-toggle="tooltip" title="Renseignez l'heure de rendez-vous pour le départ.">
                            <p class="input-suffix">h</p>
                        </div>
                        <div class="col-md-1 col-sm-5">
                            <input id="form-inscription-min-aller" name="form_inscription_min_aller" class="form-control adresse-numero" type="text" data-toggle="tooltip" value="00" title="Renseignez l'heure de rendez-vous pour le départ.">
                        </div>
                    </div>

                    <div class="field-box row">
                        <label class="col-md-2" for="form-inscription-heure-retour">Heure de rendez-vous pour le retour</label>
                        <div class="col-md-1 col-sm-5">
                            <input id="form-inscription-heure-retour" name="form_inscription_heure_retour" class="form-control adresse-numero pull-left" type="text" data-toggle="tooltip" title="Renseignez l'heure de rendez-vous pour le retour'.">
                            <p class="input-suffix">h</p>
                        </div>
                        <div class="col-md-1 col-sm-5">
                            <input id="form-inscription-min-retour" name="form_inscription_min_retour" class="form-control adresse-numero" type="text" data-toggle="tooltip" value="00" title="Renseignez l'heure de rendez-vous pour le retour'.">
                        </div>
                    </div>

                    <div class="field-box row">
                        <label class="col-md-2">Pique Nique</label>
                        <div class="col-md-4 col-sm-5" data-toggle="tooltip" title="Précisez si le trajet nécessite un pique nique.">
                            <label class="radio-inline col-md-7" for="form-inscription-pique-nique-oui">
                                <div class="radio" id="uniform-form-inscription-pique-nique-oui">
                                    <span>
                                        <input type="radio" name="form_inscription_pique_nique" id="form-inscription-pique-nique-oui" value="1">
                                    </span>
                                </div>
                                Oui
                            </label>
                            <label class="radio-inline col-md-4 col-sm-5" for="form-inscription-pique-nique-non">
                                <div class="radio" id="uniform-form-inscription-pique-nique-non">
                                    <span class="checked">
                                        <input type="radio" name="form_inscription_pique_nique" id="form-inscription-pique-nique-non" value="0" checked="checked">
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
                                        <input type="radio" name="form_inscription_sac" id="form-inscription-sac-oui" value="1">
                                    </span>
                                </div>
                                Oui
                            </label>
                            <label class="radio-inline col-md-4 col-sm-5" for="form-inscription-sac-non">
                                <div class="radio" id="uniform-form-inscription-sac-non">
                                    <span class="checked">
                                        <input type="radio" name="form_inscription_sac" id="form-inscription-sac-non" value="0" checked="">
                                    </span>
                                </div>
                                Non
                            </label>
                        </div>
                    </div>

                    <div class="field-box row">
                        <label class="col-md-2" for="form-inscription-note">Notes</label>
                        <div class="col-md-4 col-sm-5">
                            <textarea id="form-inscription-note" name="form_inscription_note" class="form-control" rows="4" data-toggle="tooltip" title="Notes générales au sujet de l'inscription."></textarea>
                        </div>
                    </div>

                    <div class="field-box row">
                        <label class="col-md-2">Inscription finalisée</label>
                        <div class="col-md-4 col-sm-5" data-toggle="tooltip" title="Précisez si l'inscription est finalisé.">
                            <label class="radio-inline col-md-7" for="form-inscription-option-oui">
                                <div class="radio" id="uniform-form-inscription-option-oui">
                                    <span>
                                        <input type="radio" name="form_inscription_option" id="form-inscription-option-oui" value="1">
                                    </span>
                                </div>
                                Oui
                            </label>
                            <label class="radio-inline col-md-4 col-sm-5" for="form-inscription-option-non">
                                <div class="radio" id="uniform-form-inscription-option-non">
                                    <span class="checked">
                                        <input type="radio" name="form_inscription_option" id="form-inscription-option-non" value="0" checked="checked">
                                    </span>
                                </div>
                                Non
                            </label>
                        </div>
                    </div>
                    

                    <div class="field-box actions">
                        <div class="col-md-6  col-md-offset-2">
                            <input type="submit" class="btn btn-primary" name="submit-add" value="Valider l'inscription">
                            <span>OU</span>
                            <a href="/inscriptions/" class="reset">Annuler</a>
                        </div>
                    </div>


                    <script>
                        $(document).ready(function(){

                            $('#form-inscription-sejour-select').change(function(){
// Si on est sur un week end
var $option = $(this).find('option:selected');
if($option.data('date-end') == $option.data('date-end-2')){
// on set les values de début et de fin
$('#form-inscription-date-debut').val($option.data('date-start')).attr('disabled', 'disabled');
$('#form-inscription-date-fin').val($option.data('date-end')).attr('disabled', 'disabled');

$('#form-inscription-date-debut-hidden').val($option.data('date-start')).removeAttr('disabled', 'disabled');
$('#form-inscription-date-fin-hidden').val($option.data('date-end')).removeAttr('disabled', 'disabled');
// On met en disabled les champs
}else {
// On met en set les values début et fin
$('#form-inscription-date-debut').val($option.data('date-start')).data('date-startdate',$option.data('date-start')).data('date-enddate',$option.data('date-end')).removeAttr('disabled');
$('#form-inscription-date-fin').val($option.data('date-end')).data('date-startdate',$option.data('date-start')).data('date-enddate',$option.data('date-end')).removeAttr('disabled');
// On set les data-debut et data-fin des patepickers
//console.log($option.data('date-start'));
//$('.input-datepicker-light').datepicker('startDate', $option.data('date-start'));

$('#form-inscription-date-debut-hidden').val('').attr('disabled', 'disabled');
$('#form-inscription-date-fin-hidden').val('').attr('disabled', 'disabled');

}
});

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

<?php if(isset($_GET['sejour'] )): ?>
    $('#form-inscription-sejour-select').trigger('change');
<?php endif; ?>
});
</script>


</form>


</div>
</div>

</div>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>