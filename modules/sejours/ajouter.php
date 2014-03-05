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
            ':name' => $form_sejour_name,
            ':date_from' => $form_sejour_date_debut,
            ':date_to' => $form_sejour_date_fin,
            ':ref_hebergement' => $form_sejour_hebergement,
            ':capacity_max' => $form_sejour_capacite_max,
            ':capacity_min' => $form_sejour_capacite_min,
            ':numero' => $form_sejour_numero,
            ':price' => $form_sejour_prix
            );

        $result = sejour::add($datas);

        ?>

        <?php //tool::output($_POST); ?>

        <?php if($result): ?>

            <div class="title">
                <div class="row header">
                    <div class="col-md-12">
                        <h3>Ajouter un séjour</h3>
                    </div>
                </div>
            </div>
            <div class="content action-page">
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-success">
                            <i class="icon-ok-sign"></i> 
                            Le séjour <strong><?=$form_sejour_name; ?></strong> a bien été ajouté
                        </div>
                        <a href="/sejours/">Retourner à la liste des séjours</a>

                    </div>
                </div>
            </div>

        <?php else: ?>

            <div class="title">
                <div class="row header">
                    <div class="col-md-12">
                        <h3>Ajouter un séjour</h3>
                    </div>
                </div>
            </div>
            <div class="content action-page">
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-danger">
                            <i class="icon-remove-sign"></i> 
                            Une erreur s'est produite durant l'ajout du séjour, veuillez réessayer
                        </div>
                        <a href="/sejours/ajouter">Retourner au formulaire d'ajout</a>
                    </div>
                </div>
            </div>

        <?php endif; ?>

    <?php else: ?>



        <div class="title">
            <div class="row header">
                <div class="col-md-12">
                    <h3>Ajouter un séjour</h3>
                </div>
            </div>
        </div>
        <div class="content action-page">
            <form id="form-add-sejour" method="post" parsley-validate>
             <!--  <h2>Informations sur le séjour</h2> -->
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
                    parsley-regexp="([0-3][0-9]|[1-9])/([1-9]|1[0-2]|0[1-9])/([1-2][0|9][0-9]{2})" ><!-- parsley-afterdate="#form-sejour-date-debut" CR : not working properly with french dates -->
                </div>
            </div>

            <div class="field-box row">
                <label class="col-md-2" for="form-enfant-structure-select">Hébergement</label>
                <div class="col-md-4 col-sm-5" data-toggle="tooltip" title="Sélectionnez l'hébergement qui accueillera le séjour.">
                    <div class="ui-select">
                        <?php $hebergements = hebergement::getList(); ?>
                        <select id="form-sejour-hebergement-select" name="form_sejour_hebergement">
                            <option selected="selected">Choisissez l'hébergement</option>
                            <?php foreach($hebergements as $hebergement): ?>
                                <option value="<?=$hebergement->id ?>"><?=$hebergement->name ?></option>
                            <?php endforeach; ?>
                            <!--<option value="0">Nouvel hébergement</option>-->
                        </select>
                    </div>
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
                <label class="col-md-2" for="form-sejour-mail">Prix unitaire</label>
                <div class="col-md-2">
                    <input id="form-sejour-prix" name="form_sejour_prix" class="form-control" type="text" 
                    data-toggle="tooltip" title="Renseignez le prix unitaire du séjour du séjour." parsley-type="number" parsley-required="true">
                    <span class="libelle-suffix">€</span>
                </div>                            
            </div>


            <div class="field-box actions">
                <div class="col-md-6">
                    <input type="submit" class="btn-flat primary" name="submit" value="Ajouter le séjour">
                    <span>OU</span>
                    <a href="/sejours/" class="reset">Annuler</a>
                </div>
            </div>

        </form>
    </div>

<?php endif; ?>

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>