    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
    <?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>
    

    <?php if(isset($_POST['submit'])): ?>
        <?php  
            tool::output($_POST);
            extract($_POST);
            // $form_sejour_date_debut = tool::generateDatetime($form_sejour_date_debut);
            // $form_sejour_date_fin = tool::generateDatetime($form_sejour_date_fin);
            
            // $datas = array(
            //                 ':name' => $form_sejour_name,
            //                 ':date_from' => $form_sejour_date_debut,
            //                 ':date_to' => $form_sejour_date_fin,
            //                 ':ref_hebergement' => $form_sejour_hebergement,
            //                 ':capacity_max' => $form_sejour_capacite_max,
            //                 ':capacity_min' => $form_sejour_capacite_min,
            //                 ':numero' => $form_sejour_numero,
            //                 ':price' => $form_sejour_prix
            //                 );

            //$result = inscription::add($datas);
            $result = false;

        ?>
    <?php //tool::output($_POST); ?>
        <?php if($result): ?>
            <div class="content">
                <div id="pad-wrapper" class="action-page">
                    <div class="row header">
                        <div class="col-md-12">
                            <h3>Ajouter une inscription</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-success">
                                <i class="icon-ok-sign"></i> 
                                L'inscription de <strong><?=$form_inscription_name; ?></strong> au séjour <strong></strong> a bien été ajoutée
                            </div>
                            <a href="/inscriptions/">Retourner à la liste des inscriptions</a>
                        </div>
                    </div>
                </div>
            </div>

        <?php else: ?>

            <div class="content">
                <div id="pad-wrapper" class="action-page">
                    <div class="row header">
                        <div class="col-md-12">
                            <h3>Ajouter une inscription</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger">
                                <i class="icon-remove-sign"></i> 
                                Une erreur s'est produite durant la création de l'inscription, veuillez réessayer
                            </div>
                            <a href="/inscriptions/ajouter">Retourner au formulaire de création</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

    <?php else: ?>
    <div class="content">
        <div id="pad-wrapper" class="form-page">
            <div class="row header">
                <div class="col-md-12">
                    <h3>Créer une inscription</h3>
                </div>
            </div>

            <form id="form-add-sejour" method="post" parsley-validate>

            <div class="row form-wrapper">

                <div class="field-box row">
                    <label class="col-md-2" for="form-inscription-enfant-select">Nom de l'enfant</label>
                    <div class="col-md-4 col-sm-5" data-toggle="tooltip" title="Sélectionnez l'enfant à inscrire">
                        <div class="ui-select">
                            <?php $enfants = enfant::getList(); ?>
                            <select id="form-inscription-enfant-select" name="form_inscription_enfant">
                                <option selected="selected">Choisissez l'enfant</option>
                                <?php foreach($enfants as $enfant): ?>
                                <option <?php if( isset($_GET['enfant']) && $enfant->id == $_GET['enfant']): ?>selected="selected"<?php endif; ?> value="<?=$enfant->id ?>"><?=$enfant->firstname ?> <?=$enfant->lastname ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>

                <?php // TODO: ne prendre que les FUTURS séjours ?>
                <?php $sejours = sejour::getList(); ?>
                <div class="field-box row">
                    <label class="col-md-2" for="form-inscription-sejour-select">Séjour</label>
                    <div class="col-md-4 col-sm-5" data-toggle="tooltip" title="Sélectionnez le séjour">
                        <div class="ui-select">
                            <select id="form-inscription-sejour-select" name="form_inscription_sejour">
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
                        >
                    </div> 
                  <div class="col-md-2">
                        <input id="form-inscription-date-fin" name="form_inscription_date_fin" type="text" class="form-control input-datepicker-light" 
                        placeholder="Date de fin" data-toggle="tooltip" title="Renseignez la date à laquelle se termine le séjour (jj/mm/aaaa)." 
                        parsley-regexp="([0-3][0-9]|[1-9])/([1-9]|1[0-2]|0[1-9])/([1-2][0|9][0-9]{2})"
                        ><!-- parsley-afterdate="#form-sejour-date-debut" CR : not working properly with french dates -->
                    </div>                              
                </div>   


                <div class="field-box row">
                    <label class="col-md-2" for="form-inscription-structure-select">Centre payeur</label>
                    <div class="col-md-4 col-sm-5" data-toggle="tooltip" title="Sélectionnez la structure qui s'occupe de cet enfant.">
                        <div class="ui-select">
                            <?php $structures = structure::getList(); ?>
                            <select id="form-inscription-structure-select" name="form_inscription_structure">
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
                        <input id="form-inscription-centre-payeur" name="form_enfant_numero_securite" class="form-control input-sm" type="text" data-toggle="tooltip" title="Renseignez le nom du centre payeur.">
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
                    <label class="col-md-2" for="form-inscription-lieu">Lieu de rendez-vous</label>
                    <div class="col-md-4 col-sm-5">
                        <input id="form-inscription-lieu" name="form_inscription_lieu" class="form-control input-sm" type="text" data-toggle="tooltip" title="Renseignez le lieu de rendez-vous.">
                    </div>
                </div>

                <div class="field-box row">
                    <label class="col-md-2" for="form-inscription-heure-aller">Heure de rendez-vous</label>
                    <div class="col-md-4 col-sm-5">
                        <input id="form-inscription-heure-aller" name="form_inscription_heure_aller" class="form-control adresse-numero" type="text" data-toggle="tooltip" title="Renseignez l'heure de rendez-vous pour le départ.">
                    </div>
                </div>

                <div class="field-box row">
                    <label class="col-md-2" for="form-inscription-heure-retour">Heure de rendez-vous pour le retour</label>
                    <div class="col-md-4 col-sm-5">
                        <input id="form-inscription-heure-retour" name="form_inscription_heure_retour" class="form-control adresse-numero" type="text" data-toggle="tooltip" title="Renseignez l'heure de rendez-vous pour le retour'.">
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

            
                <div class="field-box actions">
                    <div class="col-md-6">
                        <input type="submit" class="btn-flat primary" name="submit" value="Valider l'inscription">
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
                                // On met en disabled les champs
                            }else {
                                // On met en set les values début et fin
                                $('#form-inscription-date-debut').val($option.data('date-start')).data('date-startdate',$option.data('date-start')).data('date-enddate',$option.data('date-end')).removeAttr('disabled');
                                $('#form-inscription-date-fin').val($option.data('date-end')).data('date-startdate',$option.data('date-start')).data('date-enddate',$option.data('date-end')).removeAttr('disabled');
                                // On set les data-debut et data-fin des patepickers
                                $('.input-datepicker-light').datepicker('startDate', $option.data('date-start'));
                            }
                        });

                        $('#form-inscription-structure-select').change(function(){
                            console.log($(this).val());
                            if($(this).val() == 'Choisissez la structure'){
                                $('#form-inscription-centre-payeur').removeAttr('disabled');  
                            }else {
                                $('#form-inscription-centre-payeur').attr('disabled','disabled');
                            }
                        });

                        <?php if(isset($_GET['sejour'])): ?>
                        $('#form-inscription-sejour-select').trigger('change');
                        <?php endif; ?>
                    });
                </script>

            </div>

            </form>


        </div>
    </div>
    <?php endif; ?>

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>