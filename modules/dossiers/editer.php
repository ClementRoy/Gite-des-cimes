<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
<?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>


<?php $dossier = dossier::get($_GET['id']); ?>

    <?php if(isset($_POST['submit-update'])): ?>
        <?php  
//tool::output($_POST);
        extract($_POST);

        $datas = array(
            ':finished' => $form_inscription_option,
            ':ref_enfant' => $form_inscription_enfant,
            ':ref_structure_payer' => $form_inscription_structure,
            ':structure_payer' => $form_inscription_structure_name,
            ':supported' => $form_inscription_supported,
            ':note' => $form_inscription_note,
            ':place' => $form_inscription_lieu,
            ':hour_departure' => $form_inscription_heure_aller.'h'.$form_inscription_min_aller,
            ':hour_return' => $form_inscription_heure_retour.'h'.$form_inscription_min_retour,
            ':pique_nique' => $form_inscription_pique_nique,
            ':sac' => $form_inscription_sac
        );

        $result = dossier::update($datas, $_GET['id']);

        $inscription = inscription::deleteByDossier($dossier->id);

        foreach($form_inscription_sejour as $key => $inscription_entry){

            $dates = explode('#', $dates[$key]);
            $form_inscription_date_debut = tool::generateDatetime($dates[0]);
            $form_inscription_date_fin = tool::generateDatetime($dates[1]);
            $datas = array(
                ':ref_enfant' => $form_inscription_enfant,
                ':ref_sejour' => $form_inscription_sejour[$key],
                ':ref_dossier' => $id,
                ':date_from' => $form_inscription_date_debut,
                ':date_to' => $form_inscription_date_fin
            );
            $result = inscription::add($datas);
        }

        ?>
        <?php //tool::output($_POST); ?>
        <?php if($result): ?>

            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success">
                        <i class="icon-ok-sign"></i> 
                        Le dossier d'inscription de <strong><?=$form_inscription_enfant; ?></strong> au séjour <strong></strong> a bien été modifiée
                    </div>
                    <a href="/dossiers/">Retourner à la liste des dossiers d'inscription</a>
                </div>
            </div>

        <?php else: ?>


            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger">
                        <i class="icon-remove-sign"></i> 
                        Une erreur s'est produite durant la modification de l'inscription, veuillez réessayer
                    </div>
                    <a href="/dossiers/edit/id/<?=$dossier->id ?>">Retourner au formulaire de modification</a>
                </div>
            </div>
        <?php endif; ?>

    <?php endif; ?>

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
                <form id="form-add-sejour" action="/dossiers/editer/id/<?=$dossier->id ?>" method="post" parsley-validate>


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


                    <?php //Handle Sejour here ?> 
                    <?php $sejours = sejour::getList(); ?>
                    <?php $inscriptions = inscription::getByDossier($dossier->id); ?>
                    <?php tool::output($inscriptions); ?>

                    <?php foreach($inscriptions as $inscription): ?>
                    

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

                                        <option <?php if( $inscription->ref_sejour == $sejour->id ): ?>selected="selected"<?php endif; ?> 
                                                value="<?=$sejour->id ?>"
                                                data-nbweek="<?=$nb_weeks ?>"
                                                data-datesfrom="<?=sejour::getAllBeginsWeek($sejour->id) ?>"
                                                data-datesto="<?=sejour::getAllEndsWeek($sejour->id) ?>">
                                                <?=$sejour->name ?> du <?=$date_from_string; ?> au <?=$date_to_string; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="field-box row date-range">
                        <label class="col-md-2" for="form-inscription-dates">Dates</label>
                        <div class="col-md-10 col-sm-5" data-toggle="tooltip" title="Sélectionnez les dates d'inscription">
                            <?php if($nb_weeks > 0): ?>

                            <?php else: ?>
                            <div class="btn-group-vertical" data-toggle="buttons">
                                <label class="btn btn-primary">
                                    <input type="checkbox" name="dates[]" value=""> Semaine 1
                                </label>
                            </div>
                            <?php endif; ?>
                        </div>
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
                                    <option <?php if( $dossier->lieu == "Aulnay sous bois, au Parking d'Intermarché"): ?>selected="selected"<?php endif; ?> value="Aulnay sous bois, au Parking d'Intermarché">Aulnay sous bois, au Parking d'Intermarché</option>
                                    <option <?php if( $dossier->lieu == "Aulnay sous Bois, au RER, Dépôt Minute, Place du Général de Gaulle"): ?>selected="selected"<?php endif; ?> value="Aulnay sous Bois, au RER, Dépôt Minute, Place du Général de Gaulle">Aulnay sous Bois, au RER, Dépôt Minute, Place du Général de Gaulle</option>
                                    <option <?php if( $dossier->lieu == "Bonneuil en Valois, au Gite"): ?>selected="selected"<?php endif; ?> value="Bonneuil en Valois, au Gite">Bonneuil en Valois, au Gite</option>
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
                    $(document).ready(function(){


                        var i = 1;
                        $('.duplicate').click(function(e){
                            e.preventDefault();
                            $('.sejour-select').first().clone().insertBefore($(this));
                            $('.date-range').first().clone().insertBefore($(this));
                            i++;

                        });


                    });
                    </script>

</form>


</div>
</div>

</div>

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>