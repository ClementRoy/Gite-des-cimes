    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
    <?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>
    

    <?php if(isset($_POST['submit'])): ?>
        <?php  
            extract($_POST);
            $form_sejour_date_debut = tool::generateDatetime($form_sejour_date_debut);
            $form_sejour_date_fin = tool::generateDatetime($form_sejour_date_fin);
            
            $datas = array(
                            ':name' => $form_sejour_nom,
                            ':date_from' => $form_sejour_date_debut,
                            ':date_to' => $form_sejour_date_fin,
                            ':place' => $form_sejour_lieu,
                            ':capacity_max' => $form_sejour_capacite_max,
                            ':capacity_min' => $form_sejour_capacite_min,
                            ':numero' => $form_sejour_numero,
                            ':price' => $form_sejour_prix
                            );

            $result = sejour::add($datas);

        ?>
    <?php //tool::output($_POST); ?>
    <div class="content">
        <div id="pad-wrapper" class="form-page">
            <div class="row header">
                <div class="col-md-12">
                    <h3>Ajouter un séjour</h3>
                </div>
            </div>
        </div>

        <p>Le séjour <?=$form_sejour_name; ?> a bien été ajouté</p>
        <a href="/sejours/index/">Retourner à la liste des séjours</a>
    </div>
    <?php else: ?>
    <div class="content">
        <div id="pad-wrapper" class="form-page">
            <div class="row header">
                <div class="col-md-12">
                    <h3>Ajouter un séjour</h3>
                </div>
            </div>

            <form id="form-add-sejour" method="post" parsley-validate>
                   <!--  <h2>Informations sur le séjour</h2> -->
                     <div class="row form-wrapper">
                        <div class="field-box row">
                            <label class="col-md-2" for="form-sejour-nom">Nom du séjour</label>
                            <div class="col-md-4">
                                <input id="form-sejour-name" name="form_sejour_name" class="form-control" type="text" 
                                data-toggle="tooltip" title="Renseignez le nom du séjour." parsley-required="true">
                            </div>                            
                        </div>
                        <div class="field-box row">
                            <label class="col-md-2" for="form-sejour-nom">Dates</label>
                            <div class="col-md-2">
                                <input id="form-sejour-date-debut" name="form_sejour_date_debut" type="text" class="form-control input-datepicker"
                                placeholder="Date de début" data-toggle="tooltip" title="Renseignez la date à laquelle commence le séjour (jj/mm/aaaa)." 
                                parsley-regexp="([0-3][0-9]|[1-9])/([1-9]|1[0-2]|0[1-9])/([1-2][0|9][0-9]{2})">
                            </div> 
                          <div class="col-md-2">
                                <input id="form-sejour-date-fin" name="form_sejour_date_fin" type="text" class="form-control input-datepicker" 
                                placeholder="Date de fin" data-toggle="tooltip" title="Renseignez la date à laquelle se termine le séjour (jj/mm/aaaa)." 
                                parsley-regexp="([0-3][0-9]|[1-9])/([1-9]|1[0-2]|0[1-9])/([1-2][0|9][0-9]{2})" parsley-afterdate="#form-sejour-date-debut">
                            </div>                              
                        </div>                  
                        <div class="field-box row">
                            <label class="col-md-2" for="form-sejour-lieu">Lieu</label>
                            <div class="col-md-4">
                                <input id="form-sejour-lieu" name="form_sejour_lieu" class="form-control" type="text" 
                                data-toggle="tooltip" title="Renseignez où se déroule la séjour." parsley-required="true">
                            </div>                            
                        </div>

                        <div class="field-box row">
                            <label class="col-md-2" for="form-sejour-capacite-min">Capacité</label>
                            <div class="col-md-2">
                                <input id="form-sejour-capacite-min" name="form_sejour_capacite_min" class="form-control" type="text" 
                                data-toggle="tooltip" placeholder="Minimum" title="Renseignez le nombre d'enfant minimum pour ce séjour." parsley-type="digits" parsley-required="true">
                            </div>        
                            <div class="col-md-2">
                                <input id="form-sejour-capacite-max" name="form_sejour_capacite_max" class="form-control" type="text" 
                                data-toggle="tooltip" placeholder="Maximum" title="Renseignez le nombre d'enfant maximum pour ce séjour." parsley-required="true" parsley-type="digits" parsley-greaterthan="#form-sejour-capacite-min">
                            </div>                         
                        </div>

                        <div class="field-box row">
                            <label class="col-md-2" for="form-sejour-mail">Numéro (Jeunesse & Sport)</label>
                            <div class="col-md-4">
                                <input id="form-sejour-numero" name="form_sejour_numero" class="form-control" type="text" 
                                data-toggle="tooltip" title="Renseignez le numéro jeunesse & sport du séjour.">
                            </div>                            
                        </div>
                        <div class="field-box row">
                            <label class="col-md-2" for="form-sejour-mail">Prix</label>
                            <div class="col-md-2">
                                <input id="form-sejour-prix" name="form_sejour_prix" class="form-control" type="text" 
                                data-toggle="tooltip" title="Renseignez le prix unitaire du séjour du séjour." parsley-type="number" parsley-required="true">
                            </div>                            
                        </div>


                        <input type="submit" class="btn-flat primary" name="submit" value="Valider">
                    </div>
            </form>
        </div>
    </div>
    <?php endif; ?>

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>