<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
<?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>

<?php if(isset($_POST['submit-note'])): ?>
    <?php  
    
    extract($_POST);

    if(!empty($note_id)){
        // update
        $datas = array(
            ':ref_sejour' => $note_ref_sejour,
            ':ref_enfant' => $note_ref_enfant,
            ':message' => tool::cleanInput($note_message)
            );

        $result = note::update($datas, $note_id);

    }else {
        // add
        $datas = array(
            ':ref_sejour' => $note_ref_sejour,
            ':ref_enfant' => $note_ref_enfant,
            ':message' => tool::cleanInput($note_message)
            );

        $result = note::add($datas);

    }

    ?>
    <?php if($result): ?>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success">
                    <i class="icon-ok-sign"></i> 
                    Le commentaire a bien été enregistré
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger">
                    <i class="icon-remove-sign"></i> 
                    Une erreur s'est produite durant l'enregistrement du commentaire =(
                </div>
            </div>
        </div>
    <?php endif; ?>


<?php endif; ?>
<?php if(isset($_POST['submit-add'])): ?>
   
    <?php  
    extract($_POST);
    $form_sejour_date_debut = tool::generateDatetime($form_sejour_date_debut);
    $form_sejour_date_fin = tool::generateDatetime($form_sejour_date_fin);

    $hours_departure = serialize(array( 'hours' => $form_sejour_heure_aller, 'min' => $form_sejour_min_aller));
    $hours_return = serialize(array( 'hours' => $form_sejour_heure_retour, 'min' => $form_sejour_min_retour));

    $datas = array(
        ':name' => $form_sejour_name,
        ':date_from' => $form_sejour_date_debut,
        ':date_to' => $form_sejour_date_fin,
        ':ref_hebergement' => $form_sejour_hebergement,
        ':capacity_max' => $form_sejour_capacite_max,
        ':capacity_min' => $form_sejour_capacite_min,
        ':numero' => $form_sejour_numero,
        ':price' => $form_sejour_prix,
        ':hours_departure' => $hours_departure,
        ':hours_return' => $hours_return,
    );

    $result = sejour::update($datas, $_GET['id']);

    if(isset($form_sejour_accompagnateur)){
    $datas_accompagnateur = array(
        ':ref_sejour' => $_GET['id'],
        ':ref_accompagnateur' => $form_sejour_accompagnateur
        );

    $result = accompagnateur::addToSejour($datas_accompagnateur);
    }

    ?>

    <?php //tool::output($_POST); ?>

    <?php if($result): ?>

        <div class="title">
            <div class="row header">
                <div class="col-md-12">
                    <h1>Ajouter un séjour</h1>
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
                </div>
            </div>
        </div>

    <?php else: ?>

        <div class="title">
            <div class="row header">
                <div class="col-md-12">
                    <h1>Ajouter un séjour</h1>
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
                </div>
            </div>
        </div>

    <?php endif; ?>

<?php endif; ?>


<?php if(isset($_POST['submit-update'])): ?>
    <?php  

    extract($_POST);
    $form_sejour_date_debut = tool::generateDatetime($form_sejour_date_debut);
    $form_sejour_date_fin = tool::generateDatetime($form_sejour_date_fin);

    $hours_departure = serialize(array( 'hours' => $form_sejour_heure_aller, 'min' => $form_sejour_min_aller));
    $hours_return = serialize(array( 'hours' => $form_sejour_heure_retour, 'min' => $form_sejour_min_retour));
    
    $datas = array(
        ':name' => $form_sejour_name,
        ':date_from' => $form_sejour_date_debut,
        ':date_to' => $form_sejour_date_fin,
        ':ref_hebergement' => $form_sejour_hebergement,
        ':capacity_max' => $form_sejour_capacite_max,
        ':capacity_min' => $form_sejour_capacite_min,
        ':numero' => $form_sejour_numero,
        ':price' => $form_sejour_prix,
        ':hours_departure' => $hours_departure,
        ':hours_return' => $hours_return,
        );

    $result = sejour::update($datas, $_GET['id']);

    $accompagnateur = accompagnateur::deleteBySejour($_GET['id']);

    $datas_accompagnateur = array(
        ':ref_sejour' => $_GET['id'],
        ':ref_accompagnateur' => $form_sejour_accompagnateur
        );

    $result = accompagnateur::addToSejour($datas_accompagnateur);



    ?>
    <?php if($result): ?>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-info">
                    <i class="icon-exclamation-sign"></i>
                    Le séjour <strong><?=$form_sejour_name; ?></strong> a bien été modifié.
                </div>
                <a href="/sejours/">Retourner à la liste des séjours</a>

            </div>
        </div>
    <?php else: ?>

    <?php endif; ?>
<?php endif; ?>


<?php $sejour = sejour::get($_GET['id']); ?>

<?php 
if($sejour->ref_hebergement && $sejour->ref_hebergement != 0) {
    $hebergement = hebergement::get($sejour->ref_hebergement);
}
?>
<?php $creator = user::get($sejour->creator); ?>
<?php $editor = user::get($sejour->editor); ?>
<?php $date_created = new DateTime($sejour->created); ?>
<?php $date_edited = new DateTime($sejour->edited); ?>

<?php $date_from = new DateTime($sejour->date_from); ?>
<?php $date_to = new DateTime($sejour->date_to); ?>

<?php $nb_weeks = tool::getNbWeeks($date_from, $date_to); ?>
<?php if($nb_weeks == 0){
    $nb_weeks = 1;
} 
?>

<div class="title">
    <div class="row header">
        <div class="col-md-9">

            <h1>
                <a href="#" class="trigger"><i class="big-icon icon-plane"></i></a> <?=$sejour->name; ?>
                <small><i class="icon icon-calendar"></i> Du <?=strftime('%d %B %Y', $date_from->getTimestamp()) ?> au <?=strftime('%d %B %Y', $date_to->getTimestamp()) ?></small>
            </h1>

            <div class="pop-dialog">
                <div class="pointer">
                    <div class="arrow"></div>
                    <div class="arrow_border"></div>
                </div>
                <div class="body">
                    <div class="menu">
                        <a href="/sejours/editer/id/<?=$sejour->id; ?>" class="item"><i class="icon-edit"></i> Modifier</a>
                        <a href="/sejours/supprimer/id/<?=$sejour->id; ?>" class="item" data-toggle="modal"><i class="icon-remove"></i> Supprimer</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 text-right">
            <a href="/dossiers/ajouter/sejour/<?=$sejour->id; ?>" class="btn btn-primary"><span>+</span> Ajouter un enfant à ce séjour</a>
        </div>
    </div>
</div>
<?php if ($nb_weeks > 1): ?>
    <div class="row content-nav-tabs">
        <div class="col-md-12">
            <ul class="nav nav-tabs">
                <?php for ($i=1; $i <= $nb_weeks; $i++) : ?>
                   <?php 
                   $date_from_query = new DateTime($sejour->date_from);
                   $date_to_query = new DateTime($sejour->date_from);
                   ?>
                   <li <?php if($i == 1): ?>class="active"<?php endif; ?>>
                    <a href="#week-<?=$i ?>">
                        <?php if($date_from->diff($date_to)->format('%d') == 2): ?>
                            <strong>Week-end</strong>
                        <?php else: ?>
                            <strong>Semaine <?=$i ?></strong><br />
                            Du <?=strftime('%d %B', $date_from->getTimestamp()+(($i-1)*604800)); ?>
                        <?php endif; ?>

                    </a>
                </li>
                <?php endfor; ?>
            </ul>
        </div>
    </div>
<?php endif ?>

<div class="row">
    <div class="col-md-9">


        <div class="content<?=($sejour->archived)?' archived':' ';?>">
            <div class="tab-content">
                <?php for ($i=1; $i <= $nb_weeks; $i++) : ?>
                    <?php 
                    $date_from_query = new DateTime($sejour->date_from);
                    $date_to_query = new DateTime($sejour->date_from);
                    if($date_from->diff($date_to)->format('%d') != 2){
                        $diff_date_from = $i-1;
                        $date_from_query->modify("+$diff_date_from weeks");
                        $date_to_query->modify("+$i weeks");
                    }
                    ?>

                    <?php $inscriptions = inscription::getBySejourBetweenDates($sejour->id, $date_from_query, $date_to_query); ?>

                    <div class="tab-pane <?php if($i == 1): ?>active<?php endif; ?>" id="week-<?=$i ?>">
                        <div class="row">
                            <div class="col-md-6">
                                <?php 
                                $min = $sejour->capacity_min;
                                $max = $sejour->capacity_max;
                                $nb = count($inscriptions);
                                $opt = inscription::getUnconfirmedBySejourBetweenDates($sejour->id, $date_from_query, $date_to_query);
                                $opt = count($opt);

                                $total = $nb;
                                $nb = $total - $opt;
                                ?>
                                <h6><strong><?=count($inscriptions) ?></strong> Enfants inscrits à ce séjour <?php if($date_from->diff($date_to)->format('%d') != 2): ?> pour la semaine <?=$i ?> <?php endif; ?>
                                    (min : <?=$sejour->capacity_min ?> -  max : <?=$sejour->capacity_max ?>)
                                </h6>
                            </div>
                            <div class="col-md-6 text-right">
                                
                                <?
                                $datas = array();
                                foreach ($inscriptions as $key => $inscription) {
                                    
                                    //tool::output($inscription);
                                    //if($inscription->ref_enfant != ''){
                                    $enfant = enfant::get($inscription->ref_enfant_id);
                                    $birthdate = new DateTime($enfant->birthdate);
                                    if( $enfant->birthdate != '0000-00-00 00:00:00') {
                                        $birthdate_string = strftime('%d/%m/%Y', $birthdate->getTimestamp());
                                    }
                                    else {
                                        $birthdate_string = ' ';
                                    }
                                    $address_host = '';
                                    if(tool::check($enfant->father_address_number)){
                                        $address = $enfant->father_address_number.' '.$enfant->father_address_street.'<br />'.$enfant->father_address_postal_code.' '.$enfant->father_address_city;
                                    }elseif(tool::check($enfant->mother_address_postal_code)){
                                        $address = $enfant->mother_address_number.' '.$enfant->mother_address_street.'<br />'.$enfant->mother_address_postal_code.' '.$enfant->mother_address_city;
                                    }elseif(tool::check($enfant->guardian_address_street)){
                                        $address = $enfant->guardian_address_number.' '.$enfant->guardian_address_street.'<br />'.$enfant->guardian_address_postal_code.' '.$enfant->guardian_address_city;
                                    }else{
                                        $address = '';
                                    }
                                    $tel_father = '';
                                    if(tool::check($enfant->father_phone_home)){
                                        $tel_father .= 'Fixe : '.tool::formatTel($enfant->father_phone_home)."\n";
                                    }
                                    if(tool::check($enfant->father_phone_mobile)){
                                        $tel_father .= 'Mobile : '.tool::formatTel($enfant->father_phone_mobile)."\n";
                                    }
                                    if(tool::check($enfant->father_phone_pro)){
                                        $tel_father .= 'Pro : '.tool::formatTel($enfant->father_phone_pro)."\n";
                                    }

                                    $tel_mother = '';
                                    if(tool::check($enfant->mother_phone_home)){
                                        $tel_mother .= 'Fixe : '.tool::formatTel($enfant->mother_phone_home)."\n";
                                    }
                                    if(tool::check($enfant->mother_phone_mobile)){
                                        $tel_mother .= 'Mobile : '.tool::formatTel($enfant->mother_phone_mobile)."\n";
                                    }
                                    if(tool::check($enfant->mother_phone_pro)){
                                        $tel_mother .= 'Pro : '.tool::formatTel($enfant->mother_phone_pro)."\n";
                                    }

                                    $tel_host_family = '';
                                    if(tool::check($enfant->host_family_phone_home)){
                                        $tel_host_family .= 'Fixe : '.tool::formatTel($enfant->host_family_phone_home)."\n";
                                    }
                                    if(tool::check($enfant->host_family_phone_mobile)){
                                        $tel_host_family .= 'Mobile : '.tool::formatTel($enfant->host_family_phone_mobile)."\n";
                                    }
                                    if(tool::check($enfant->host_family_phone_pro)){
                                        $tel_host_family .= 'Pro : '.tool::formatTel($enfant->host_family_phone_pro)."\n";
                                    }
                                    $organization = structure::get($enfant->organization);
                                    $contact = contact::get($enfant->contact);


                                    $datas[] = array(
                                        'Nom' => $enfant->lastname,
                                        'Prénom' => $enfant->firstname,
                                        'Date de naissance' => $birthdate_string,
                                        'Age' => tool::getAgeDetailFromDate($enfant->birthdate),
                                        'N° sécurité sociale' => $enfant->number_ss,
                                        'Carnet de vaccination' => ($enfant->vaccination > 0)?'oui':'non',
                                        'Traitement médical' => ($enfant->medicals_treatments > 0)?'oui':'non',
                                        'Contre indications' => $enfant->allergies,
                                        'Fiche sanitaire' => ($enfant->health_record > 0)?'oui':'non',
                                        'Adresse' => $address,
                                        'Famille d\'accueil' => $enfant->host_family_name.'<br>'.$tel_host_family,
                                        'Structure' => (tool::check($organization))?$organization->name:'',
                                        'Contact' => (tool::check($contact))?$contact->civility.' '.$contact->lastname.' '.$contact->firstname:'',
                                        'Tél contact' => (tool::check($organization))?tool::formatTel($organization->phone):'',
                                        'Père' => $enfant->father_name,
                                        'Tél père' => $tel_father,
                                        'Mère' => $enfant->mother_name,
                                        'Tél mère' => $tel_mother
                                        );

                                    //}
}

?>
<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-recapitulatif-mineurs-<?=$i?>">
    Récapitulatif mineurs
</button>
<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-suivi-sanitaire-<?=$i?>">
    Suivi sanitaire
</button>
<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-registre-des-mineurs-<?=$i?>">
    Registre des mineurs
</button>
</div>
</div>
<div class="row">


    <div class="modal fade modal-table" id="modal-recapitulatif-mineurs-<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="modal-recapitulatif-mineurs-<?=$i?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="modal-label-recapitulatif-mineurs-<?=$i?>">
                        Récapitulatif mineurs par âge
                        <span><?=$sejour->name;?> du <?=strftime('%d %B %Y', $date_from_query->getTimestamp()); ?> au <?=strftime('%d %B %Y', $date_to_query->getTimestamp()); ?></span>
                    </h4>
                </div>
                <div class="modal-body"><table class="table table table-striped table-bordered" style="width:100%;">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Date de naissance</th>
                            <th>Age</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($datas as $key => $data): ?>
                            <tr>
                                <td style="font-weight:bold;"><?=$data['Nom'] ?></td>
                                <td><?=$data['Prénom'] ?></td>
                                <td><?=$data['Date de naissance'] ?></td>
                                <td><?=$data['Age'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                <a href="/export/sejour/type/1/id/<?=$sejour->id ?>/datefrom/<?=$date_from_query->getTimestamp() ?>/dateto/<?=$date_to_query->getTimestamp()?>" class="btn btn-primary">
                    <i class="icon icon-download-alt"></i> Télécharger le document
                </a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-table" id="modal-suivi-sanitaire-<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="modal-suivi-sanitaire-<?=$i?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="modal-label-suivi-sanitaire-<?=$i?>">
                    Suivi sanitaire
                    <span><?=$sejour->name;?> du <?=strftime('%d %B %Y', $date_from_query->getTimestamp()); ?> au <?=strftime('%d %B %Y', $date_to_query->getTimestamp()); ?></span>
                </h4>
            </div>
            <div class="modal-body"><table class="table table table-striped table-bordered" style="width:100%;">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Date de naissance</th>
                        <th>N° sécurité sociale</th>
                        <th>Carnet de vaccination</th>
                        <th>Traitement médical</th>
                        <th>Contre indications</th>
                        <th>Fiche sanitaire</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($datas as $key => $data): ?>
                        <tr>
                            <td style="font-weight:bold;"><?=$data['Nom'] ?></td>
                            <td><?=$data['Prénom'] ?></td>
                            <td><?=$data['Date de naissance'] ?></td>
                            <td><?=$data['N° sécurité sociale'] ?></td>
                            <td><?=$data['Carnet de vaccination'] ?></td>
                            <td><?=$data['Traitement médical'] ?></td>
                            <td><?=$data['Contre indications'] ?></td>
                            <td><?=$data['Fiche sanitaire'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            <a href="/export/sejour/type/2/id/<?=$sejour->id ?>/datefrom/<?=$date_from_query->getTimestamp() ?>/dateto/<?=$date_to_query->getTimestamp()?>" class="btn btn-primary">
                <i class="icon icon-download-alt"></i> Télécharger le document
            </a>
        </div>
    </div>
</div>
</div>




<div class="modal fade modal-table" id="modal-registre-des-mineurs-<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="modal-registre-des-mineurs-<?=$i?>" aria-hidden="true">
    <div class="modal-dialog" style="width: 92%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="modal-label-registre-des-mineurs-<?=$i?>">
                    Registre des mineurs
                    <span><?=$sejour->name;?> du <?=strftime('%d %B %Y', $date_from_query->getTimestamp()); ?> au <?=strftime('%d %B %Y', $date_to_query->getTimestamp()); ?></span>
                </h4>
            </div>
            <div class="modal-body"><table class="table table table-striped table-bordered" style="width:100%;">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th >Date de naissance</th>
                        <th>Adresse de l'enfant</th>
                        <th>Famille d'accueil</th>
                        <th>Structure</th>
                        <th>Nom du contact</th>
                        <th>Tél structure</th>
                        <th>Père</th>
                        <th>Tél père</th>
                        <th>Mère</th>
                        <th>Tél mère</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($datas as $key => $data): ?>
                        <tr>
                            <td style="font-weight:bold;"><?=$data['Nom'] ?></td>
                            <td><?=$data['Prénom'] ?></td>
                            <td><?=$data['Date de naissance'] ?></td>
                            <td><?=$data['Adresse'] ?></td>
                            <td><?=$data['Famille d\'accueil'] ?></td>
                            <td><?=$data['Structure'] ?></td>
                            <td><?=$data['Contact'] ?></td>
                            <td><?=$data['Tél contact'] ?></td>
                            <td><?=$data['Père'] ?></td>
                            <td><?=$data['Tél père'] ?></td>
                            <td><?=$data['Mère'] ?></td>
                            <td><?=$data['Tél mère'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            <a href="/export/sejour/type/3/id/<?=$sejour->id ?>/datefrom/<?=$date_from_query->getTimestamp() ?>/dateto/<?=$date_to_query->getTimestamp()?>" class="btn btn-primary">
                <i class="icon icon-download-alt"></i> Télécharger le document
            </a>
        </div>
    </div>
</div>
</div>


<div class="col-md-12">
    <?php
    if ($total > $max) {
        $base = $total;
    } else {
        $base = $max;
    }

    $pc_nb = $nb*100/$base;
    $pc_opt = $opt*100/$base;
    $pos_min = $min*100/$base;
    $pos_max = $max*100/$base;
    ?>

    <div class="progress-label">
        <span class="zero" style="left:0;">0</span>
        <span class="min" style="left:<?=$pos_min;?>%;"><small>min</small><br><?=$min;?></span>
        <span class="max" style="left:<?=$pos_max;?>%;"><small>max</small><br><?=$max;?></span>
        <?php if ($total > $max): ?>
            <span class="total" style="right:0;"><small>total</small><br><?=$total;?></span>
        <?php endif ?>
    </div>

    <div class="progress stats">
        <div class="progress-bar progress-bar-primary" role="progressbar"
        aria-valuenow="<?=$pc_nb;?>"
        aria-valuemin="0" aria-valuemax="<?=$min;?>"
        style="width: <?=$pc_nb;?>%;">
        <span><?=$nb;?></span>
    </div>
    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="<?=$opt;?>" style="width: <?=$pc_opt;?>%;">
        <span><?=$opt;?></span>
    </div>
</div>

<div class="progress minmax">
    <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="<?=$pos_min;?>" aria-valuemin="0" style="width: <?=$pos_min;?>%;"></div>
    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?=$pos_max-$pos_min;?>" aria-valuemin="0" style="width: <?=$pos_max-$pos_min;?>%;"></div>
    <?php if ($total > $max): ?>
        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="<?=100-$pos_max;?>" aria-valuemin="0" style="width: <?=100-$pos_max;?>%;"></div>
    <?php endif ?>
</div>
</div>
</div>



<div class="row">
    <?php if(count($inscriptions) > 0): ?>
        <div class="content-table">

            <table class="datatable">
                <thead>
                    <tr>
                        <th>
                            Dossier
                        </th>
                        <th>
                            Prénom
                        </th>
                        <th >
                            <span class="line"></span>
                            Nom
                        </th>
                        <th >
                            <span class="line"></span>
                            Dates
                        </th>
                        <th>
                            Statut
                        </th>
                        <th >
                            Prise en charge
                        </th>
                        <th>
                            Commentaires
                        </th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach($inscriptions as $key => $inscription): ?>
                        <?php if($inscription->ref_enfant_id != ''): ?>
                        <?php $enfant = enfant::get($inscription->ref_enfant_id); ?>
                        <?php $dossier = dossier::get($inscription->ref_dossier); ?>
                        <tr>
                            <td>
                                <a href="/dossiers/infos/id/<?=$dossier->id; ?>"><strong>#<?=$dossier->id ?></strong></a>
                                <div class="pop-dialog tr">
                                    <div class="pointer">
                                        <div class="arrow"></div>
                                        <div class="arrow_border"></div>
                                    </div>
                                    <div class="body">
                                        <div class="menu">
                                            <a href="/dossiers/infos/id/<?=$dossier->id; ?>" class="item"><i class="icon-share"></i> Voir la fiche</a>
                                            <a href="/dossiers/editer/id/<?=$dossier->id; ?>" class="item"><i class="icon-edit"></i> Modifier</a>
                                            <a href="/dossiers/supprimer/id/<?=$dossier->id; ?>" class="item"><i class="icon-remove"></i> Supprimer</a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a href="/enfants/infos/id/<?=$enfant->id ?>"><?=$enfant->firstname ?></a>
                            </td>
                            <td>
                                <a href="/enfants/infos/id/<?=$enfant->id ?>"><?=$enfant->lastname ?></a>
                            </td>
                            <td>
                                <?php $date_from = new DateTime($inscription->date_from); ?>
                                <?php $date_to = new DateTime($inscription->date_to); ?>
                                du <?=strftime('%d %B %Y', $date_from->getTimestamp()); ?>  au <?=strftime('%d %B %Y', $date_to->getTimestamp()); ?> 
                            </td>
                            <td>
                                <?php if($inscription->finished): ?>
                                    <span class="label label-success">Confirmé</span>
                                <?php else: ?>
                                    <span class="label label-danger">Non confirmé</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($inscription->supported): ?>
                                    <span class="label label-success">Oui</span>
                                <?php else: ?>
                                    <span class="label label-danger">Non</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php $note = note::get($enfant->id, $sejour->id) ?>
                                <button type="button" class="comment-popover btn btn-default" data-toggle="popover" data-note="<?php if(!empty($note)): ?><?=$note->message ?><?php endif; ?>" data-note-id="<?php if(!empty($note)): ?><?=$note->id ?><?php endif; ?>" data-ref-sejour="<?=$sejour->id ?>" data-ref-enfant="<?=$enfant->id ?>">
                                    <i class="icon icon-comments"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    <?php else: ?>
        <td colspan="7">
            <em>Aucune inscription pour le moment</em>
            <td>
            <?php endif; ?>
        </div>
    </div>
<?php endfor; ?>
</div>
</div>
</div>

<div class="col-md-3 address">
    <?php if(isset($hebergement )): ?>
        <?php $geo = tool::getLatLng($hebergement->address_number.' '.$hebergement->address_street.' '.$hebergement->address_postal_code.' '.$hebergement->address_city); ?>
        <div class="contact">
            <h6><?=$hebergement->name; ?></h6>
            <p>
                <img src="https://maps.googleapis.com/maps/api/staticmap?center=<?=$geo[0]; ?>,<?=$geo[1]; ?>&zoom=12&size=210x200&scale=2&markers=<?=$geo[0]; ?>,<?=$geo[1]; ?>&sensor=false" width="100%" alt="">
            </p>
            <?php if( !empty($hebergement->address_number) OR !empty($hebergement->address_street) ): ?>
                <p>
                    <?=$hebergement->address_number; ?> <?=$hebergement->address_street; ?><br>
                    <?=$hebergement->address_postal_code; ?> <?=$hebergement->address_city; ?>
                </p>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php $ref_accompagnateur = accompagnateur::getBySejour($sejour->id); ?>
    <?php if(!empty($ref_accompagnateur)): ?>
        <h6>Directeur du séjour</h6>
        <?php $accompagnateur = accompagnateur::get($ref_accompagnateur->ref_accompagnateur); ?>
        <ul>
            <li><strong><?=$accompagnateur->firstname ?> <?=$accompagnateur->lastname; ?></strong></li>
            <?php if(!empty($accompagnateur->tel)): ?><li><strong>Téléphone : </strong><?=tool::formatTel($accompagnateur->tel) ?></li><?php endif; ?>
            <?php if(!empty($accompagnateur->email)): ?><li><strong>Email : </strong><a href="mailto:<?=$accompagnateur->email ?>"><?=$accompagnateur->email ?></a></li><?php endif; ?>
        </ul>
    <?php endif; ?>

    <?php $hours_departure =  unserialize($sejour->hours_departure); ?>
    <?php $hours_return =  unserialize($sejour->hours_return); ?>
   
    
    <?php $hour_departure = $hours_departure['hours']; ?>
    <?php $min_departure = $hours_departure['min']; ?>
    <?php $hour_return = $hours_return['hours']; ?>
    <?php $min_return = $hours_return['min']; ?>


    <p>Aulnay sous bois, au Parking d'Intermarché, avenue Antoine Bourdelle</p>
        <ul>
            <li>départ : <?=$hour_departure[0] ?>h<?=$min_departure[0] ?></li>
            <li>retour : <?=$hour_return[0] ?>h<?=$min_return[0] ?></li>
        </ul>

    <p>Aulnay sous Bois, au RER, Dépôt Minute, Place du Général de Gaulle</p>
        <ul>
            <li>départ : <?=$hour_departure[1] ?>h<?=$min_departure[1] ?></li>
            <li>retour : <?=$hour_return[1] ?>h<?=$min_return[1] ?></li>
        </ul>

    <p>Bonneuil en Valois, au Gite</p>
        <ul>
            <li>départ : <?=$hour_departure[2] ?>h<?=$min_departure[2] ?></li>
            <li>retour : <?=$hour_return[2] ?>h<?=$min_return[2] ?></li>
        </ul>

</div>

</div>




<script>
    $(function () {
        $('.nav-tabs a').click(function (e) {
            e.preventDefault();
            $(this).tab('show');
        });

        $('[data-toggle=popover]').popover({
            trigger:"click",
            html: true,
            placement: 'bottom',
            container: 'body',
            content: '<div class="popover-form clearfix"><form action="" method="post"><div class="form-group"><textarea class="form-control" name="note_message" cols="50" rows="5" placeholder="Entrez un commentaire"></textarea></div> <div class="pull-right"><a href="#" class="btn btn-default btn-sm btn-close">Annuler</a><button type="submit" name="submit-note" class="btn btn-primary btn-sm sumbit-comment">Enregistrer</button></div></form></div>'
        });

        $('[data-toggle=popover]').on('show.bs.popover', function () {
            var note = $(this).data('note');
            var note_id = $(this).data('note-id');
            var ref_sejour = $(this).data('ref-sejour');
            var ref_enfant = $(this).data('ref-enfant');
            setTimeout(function() {
                $('body').find('.popover:last-child').find('form').prepend('<input type="hidden" name="note_ref_sejour" value="'+ref_sejour+'">');
                $('body').find('.popover:last-child').find('form').prepend('<input type="hidden" name="note_ref_enfant" value="'+ref_enfant+'">');
                $('body').find('.popover:last-child').find('form').prepend('<input type="hidden" name="note_id" value="'+note_id+'">');
                $('body').find('.popover:last-child').find('textarea').text(note);
            }, 1);
        });

        $('[data-toggle=popover]').on('click', function (e) {
            $('[data-toggle=popover]').not(this).popover('hide');
        });

        $('body').on('click', '.btn-close', function (e) {
            e.preventDefault();
            $('[data-toggle=popover]').popover('hide');
        });

    });
</script>

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>