<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
<?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>

<?php if (isset($_POST['submit-note'])): ?>
    <?php
        extract($_POST);

        if (!empty($note_id)) {
            // update
            $datas = array(
                ':ref_sejour' => $note_ref_sejour,
                ':ref_enfant' => $note_ref_enfant,
                ':message' => tool::cleanInput($note_message)
            );

            $result = note::update($datas, $note_id);

        } else {
            // add
            $datas = array(
                ':ref_sejour' => $note_ref_sejour,
                ':ref_enfant' => $note_ref_enfant,
                ':message' => tool::cleanInput($note_message)
            );

            $result = note::add($datas);

        }
    ?>
    <?php if ($result): ?>

        <?php tpl::alert('success', 'Le commentaire a bien été enregistré.'); ?>

    <?php else: ?>

        <?php tpl::alert('danger', 'Une erreur s\'est produite durant l\'enregistrement du commentaire =('); ?>

    <?php endif; ?>

<?php endif; ?>

<?php if (isset($_POST['submit-add'])): ?>
   
    <?php
        extract($_POST);
        $form_sejour_date_debut = tool::generateDatetime($form_sejour_date_debut);
        $form_sejour_date_fin = tool::generateDatetime($form_sejour_date_fin);

        $hours_departure = serialize(array( 'hours' => $form_sejour_heure_aller, 'min' => $form_sejour_min_aller));
        $hours_return = serialize(array( 'hours' => $form_sejour_heure_retour, 'min' => $form_sejour_min_retour));

        $hours_intermediate_departure = serialize(array( 'hours' => $form_sejour_heure_aller_intermediaire, 'min' => $form_sejour_min_aller_intermediaire));
        $hours_intermediate_return = serialize(array( 'hours' => $form_sejour_heure_retour_intermediaire, 'min' => $form_sejour_min_retour_intermediaire));

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
            ':hours_intermediate_departure' => $hours_intermediate_departure,
            ':hours_intermediate_return' => $hours_intermediate_return,
        );

        $result = sejour::update($datas, $_GET['id']);

        if (isset($form_sejour_accompagnateur)) {
            $datas_accompagnateur = array(
                ':ref_sejour' => $_GET['id'],
                ':ref_accompagnateur' => $form_sejour_accompagnateur
            );

            $result = accompagnateur::addToSejour($datas_accompagnateur);
        }
    ?>

    <?php if ($result): ?>

        <?php tpl::alert('success', 'Le séjour <strong>'.$form_sejour_name.' </strong> a bien été créé. <a href="/sejours/">Retourner à la liste des séjours</a>'); ?>

    <?php else: ?>

        <?php tpl::alert('danger', ' Une erreur s\'est produite durant la création du séjour, veuillez réessayer. <a href="/sejours/ajouter/">Retourner au formulaire d\'ajout</a>'); ?>

    <?php endif; ?>

<?php endif; ?>


<?php if (isset($_POST['submit-update'])): ?>
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

    <?php if ($result): ?>

        <?php tpl::alert('success', ' Le séjour <strong>'.$form_sejour_name.'</strong> a bien été modifié. <a href="/sejours/">Retourner à la liste des séjours</a>'); ?>

    <?php else: ?>

        <?php tpl::alert('danger', ' Une erreur s\'est produite durant la modification du séjour, veuillez réessayer. <a href="/sejours/editer/'.$_GET['id'].'">Retourner au formulaire de modification</a>'); ?>

    <?php endif; ?>

<?php endif; ?>


<?php
    $sejour = sejour::get($_GET['id']);

    if ($sejour->ref_hebergement && $sejour->ref_hebergement != 0) {
        $hebergement = hebergement::get($sejour->ref_hebergement);
    }

    $creator = user::get($sejour->creator);
    $editor = user::get($sejour->editor);
    $date_created = new DateTime($sejour->created);
    $date_edited = new DateTime($sejour->edited);

    $date_from = new DateTime($sejour->date_from);
    $date_to = new DateTime($sejour->date_to);

    $nb_weeks = tool::getNbWeeks($date_from, $date_to);
    if ($nb_weeks == 0) {
        $nb_weeks = 1;
    }
?>




<div class="page-head">
    <div class="row">
        <div class="col-md-8">
             <a href="#" class="trigger dropdown-toggle" data-toggle="dropdown">
                    <i class="fa big-icon fa-plane"></i>
            </a>
            <ul class="dropdown-menu animated fadeInDown">
                <li><a href="/sejours/editer/id/<?=$sejour->id; ?>" class="item"><i class="fa fa-edit"></i> Modifier</a></li>
                <li><a href="#" data-toggle="modal" data-target="#modal-remove" class="item"><i class="fa fa-remove"></i> Supprimer</a></li>
            </ul>

            <h1>
                <?=$sejour->name; ?></strong><br />
                <small><i class="fa fa-calendar"></i> Du <?=strftime('%d %B %Y', $date_from->getTimestamp()) ?> au <?=strftime('%d %B %Y', $date_to->getTimestamp()) ?></small>
            </h1>
        </div>
        <div class="col-md-4 text-right">
            <!-- <a href="#" data-toggle="modal" data-target="#modal-remove" class="item">Supprimer cette fiche</a> -->
            <a href="/sejours/editer/id/<?=$sejour->id; ?>" class="btn btn-primary btn-rad">Modifier ce séjour</a>
        </div>
    </div>
</div>





<div class="row">
    <div class="col-sm-9">

        <div class="tab-container">

            <?php if ($nb_weeks > 1): ?>
                <ul class="nav nav-tabs">

                    <?php for ($i=1; $i <= $nb_weeks; $i++) : ?>
                        <?php 
                            $date_from_query = new DateTime($sejour->date_from);
                            $date_to_query = new DateTime($sejour->date_from);
                        ?>
                        <li<?php if ($i == 1): ?> class="active"<?php endif; ?>>
                            <a data-toggle="tab" href="#week-<?=$i ?>">
                                <?php if ($date_from->diff($date_to)->format('%d') == 2): ?>
                                    <strong>Week-end</strong>
                                <?php else: ?>
                                    <strong>Semaine <?=$i ?></strong><br />
                                    Du <?=strftime('%d %B', $date_from->getTimestamp() + (($i-1) * 604800)); ?>
                                <?php endif; ?>
                            </a>
                        </li>
                    <?php endfor; ?>

                </ul>
            <?php endif; ?>
            <div class="tab-content">

                <?php for ($o=1; $o <= $nb_weeks; $o++) : ?>
                    <?php 
                        $date_from_query = new DateTime($sejour->date_from);
                        $date_to_query = new DateTime($sejour->date_from);
                        if ($date_from->diff($date_to)->format('%d') != 2) {
                            $diff_date_from = $o-1;
                            $date_from_query->modify("+$diff_date_from weeks");
                            $date_to_query->modify("+$o weeks");
                        }
                        $inscriptions = inscription::getBySejourBetweenDates($sejour->id, $date_from_query, $date_to_query);
                    ?>

                    <div class="tab-pane cont<?php if ($o == 1): ?> active<?php endif; ?>" id="week-<?=$o ?>">


                        <?php 
                            $min = $sejour->capacity_min;
                            $max = $sejour->capacity_max;
                            $nb = count($inscriptions);
                            $opt = inscription::getUnconfirmedBySejourBetweenDates($sejour->id, $date_from_query, $date_to_query);
                            $opt = count($opt);

                            $total = $nb;
                            $nb = $total - $opt;
                        ?>

                        <?php if ($total < 1): ?>

                            <div class="header">
                                <div class="row">
                                    <div class="col-md-6">
                                        <em>Aucun enfant n'est inscrit à ce séjour</em>
                                    </div>
                                </div>
                            </div>

                        <?php else: ?>

                            <div class="header clearfix">
                                <div class="pull-left">
                                    <?php /*
                                        <button class="btn btn-info btn-sm btn-rad" data-toggle="modal" data-target="#modal-recapitulatif-dossiers-incomplets-<?=$o?>">
                                            Récap. dossier incomplet (sur la saison)
                                        </button>
                                    */ ?>
                                    <?php
                                        $sejour_season = saison::getBySejour($sejour->id);
                                        $year = strftime('%Y', $date_from_query->getTimestamp() );
                                    ?>
                                    <a href="/export/saison/type/1/id/<?php echo $sejour_season->id ?>/year/<?php echo $year; ?>" class="btn btn-info btn-sm btn-rad">
                                        Télécharger récap. dossiers saison
                                    </a>
                                </div>
                                <div class="pull-right">
                                    <button class="btn btn-primary btn-sm btn-rad" data-toggle="modal" data-target="#modal-recapitulatif-notes-enfants-<?=$o?>">
                                        Récap. des notes d'enfant
                                    </button>
                                    <button class="btn btn-primary btn-sm btn-rad" data-toggle="modal" data-target="#modal-recapitulatif-mineurs-<?=$o?>">
                                        Récapitulatif mineurs
                                    </button>
                                    <button class="btn btn-primary btn-sm btn-rad" data-toggle="modal" data-target="#modal-suivi-sanitaire-<?=$o?>">
                                        Suivi sanitaire
                                    </button>
                                    <button class="btn btn-primary btn-sm btn-rad" data-toggle="modal" data-target="#modal-registre-des-mineurs-<?=$o?>">
                                        Registre des mineurs
                                    </button>
                                </div>
                            </div>
                            <hr>
                            <div class="content">
                                <p class="lead">
                                    <strong><?=$total; ?> enfant<?php if($total > 1): ?>s<?php endif ?><?php if($opt > 0): ?> (dont <?=$opt; ?> option(s))<?php endif; ?></strong> sont inscrits<?php if ($date_from->diff($date_to)->format('%d') != 2): ?> pour la semaine <?=$o; ?><?php endif; ?>.
                                    <?php if ($total < $max): ?>
                                        <?php $remain = $max - $total; ?>
                                        Il reste <?=$remain; ?> place<?php if($remain > 1): ?>s<?php endif ?>.
                                    <?php elseif ($total == $max): ?>
                                        Le séjour est complet.
                                    <?php else: ?>
                                        <?php $overflow = $total - $max; ?>
                                        Il y a <?=$overflow; ?> inscription<?php if($overflow > 1): ?>s<?php endif ?> au dessus du maximum.
                                    <?php endif; ?>    
                                </p>
                                
                                <?php
                                    if ($total > $max) {
                                        $base = $total;
                                    } else {
                                        $base = $max;
                                    }

                                    $pc_nb = $nb * 100 / $base;
                                    $pc_opt = $opt * 100 / $base;
                                    $pos_min = $min * 100 / $base;
                                    $pos_max = $max * 100 / $base;

                                    if ($pc_nb < $pos_min) {
                                        $color = 'warning';
                                    } elseif ($pc_nb >= $pos_min && $pc_nb <= $pos_max) {
                                        $color = 'success';
                                    } elseif ($pc_nb > $pos_max) {
                                        $color = 'danger';
                                    }
                                ?>


                                <div class="progress progress-striped active">
                                    <div class="labels">
                                        <?php if ($min > 0): ?><span class="zero" style="left:0;">0</span><?php endif ?>
                                        <span class="min" style="left:<?=$pos_min;?>%;"><small>min</small><br><?=$min;?></span>
                                        <span class="max" style="left:<?=$pos_max;?>%;"><small>max</small><br><?=$max;?></span>
                                    </div>
                                    <div class="progress-bar progress-bar-<?=$color; ?>" role="progressbar" aria-valuenow="<?=$pc_nb;?>" aria-valuemin="0" aria-valuemax="<?=$min;?>" style="width: <?=$pc_nb;?>%;">
                                        <span><?=$nb;?></span></div>
                                    <?php if ($opt > 0): ?>
                                        <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="<?=$opt;?>" style="width: <?=$pc_opt;?>%;">
                                            <span><?=$opt;?></span>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                
                                <?php /*
                                <div class="progress minmax">
                                    <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="<?=$pos_min;?>" aria-valuemin="0" style="width: <?=$pos_min;?>%;"></div>
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?=$pos_max-$pos_min;?>" aria-valuemin="0" style="width: <?=$pos_max-$pos_min;?>%;"></div>
                                    <?php if ($total > $max): ?>
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="<?=100-$pos_max;?>" aria-valuemin="0" style="width: <?=100-$pos_max;?>%;"></div>
                                    <?php endif ?>
                                </div>
                                */ ?>
                            </div>

                       


                            <div class="tb-inside tb-special">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="datatable-<?=$o; ?>">
                                        <thead>
                                            <tr>
                                                <th>Dossier</th>
                                                <th>Prénom</th>
                                                <th>Nom</th>
                                                <th>Dates</th>
                                                <th>Statut</th>
                                                <th>Prise en charge</th>
                                                <th>Commentaires</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($inscriptions as $key => $inscription): ?>
                                                <?php if ($inscription->ref_enfant_id != ''): ?>
                                                    <?php 
                                                        $enfant = enfant::get($inscription->ref_enfant_id);
                                                        $dossier = dossier::get($inscription->ref_dossier);
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <a href="/dossiers/infos/id/<?php echo $dossier->id; ?>"><strong>#<?php echo $dossier->id ?></strong></a>
                                                            <ul class="dropdown-menu">
                                                                <li><a href="/dossiers/infos/id/<?=$dossier->id; ?>" class="item"><i class="fa fa-folder-open"></i> Voir le dossier d'inscription</a></li>
                                                                <li><a href="/enfants/infos/id/<?=$enfant->id; ?>" class="item"><i class="fa fa-user"></i> Voir la fiche de l'enfant</a></li>
                                                                <!-- <li><a href="/dossiers/editer/id/<?=$dossier->id; ?>" class="item"><i class="fa fa-edit"></i> Désincrire cet enfant</a></li> -->
                                                            </ul>
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
                                                            <?=strftime('%d ', $date_from->getTimestamp()); ?>  au <?=strftime('%d %B %Y', $date_to->getTimestamp()); ?> 
                                                        </td>
                                                        <td>
                                                            <?php if ($inscription->finished): ?>
                                                                <span class="label label-success">Confirmé</span>
                                                            <?php else: ?>
                                                                <span class="label label-warning">Non confirmé</span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <?php if ($inscription->supported): ?>
                                                                <span class="label label-success">Oui</span>
                                                            <?php else: ?>
                                                                <span class="label label-warning">Non</span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <?php $note = note::get($enfant->id, $sejour->id) ?>
                                                            <a href="#" class="btn btn-default btn-xs" data-toggle="popover" data-note="<?php if (!empty($note)): ?><?=$note->message ?><?php endif; ?>" data-note-id="<?php if (!empty($note)): ?><?=$note->id ?><?php endif; ?>" data-ref-sejour="<?=$sejour->id ?>" data-ref-enfant="<?=$enfant->id ?>">
                                                                <i class="fa fa-comments"></i> <?=(!empty($note))? 'Modifier la note' : 'Ajouter une note'; ?>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <?php ob_start(); ?>
                            <script>
                                var table<?=$o; ?> = $('#datatable-<?=$o; ?>').dataTable({
                                    'bFilter': true,
                                    // 'bLengthChange': false,
                                    'iDisplayLength': 20,
                                    'oLanguage': {
                                        'sInfo': '_START_ - _END_ sur _TOTAL_ ',
                                        'oPaginate': {
                                            'sFirst': '',
                                            'sPrevious': '',
                                            'sNext': '',
                                            'sLast': ''
                                        }
                                    }
                                });

                                 table<?=$o; ?>.$('[data-toggle=popover]').popover({
                                    trigger:"click",
                                    html: true,
                                    placement: 'top',
                                    container: 'body',
                                    content: '<div class="popover-form clearfix"><form action="" method="post"><div class="form-group"><textarea class="form-control" name="note_message" cols="50" rows="5" placeholder="Entrez un commentaire"></textarea></div> <div class="pull-right"><a href="#" class="btn btn-default btn-sm btn-close">Annuler</a><button type="submit" name="submit-note" class="btn btn-primary btn-sm sumbit-comment">Enregistrer</button></div></form></div>'
                                })
                                 .on('click', function (e) {
                                    e.preventDefault();
                                    $('[data-toggle=popover]').not(this).popover('hide');
                                })
                                 .on('show.bs.popover', function () {
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

                            </script>
                            <?php $scripts .= ob_get_contents();
                            ob_end_clean(); ?>


                            <?php
                                $datas = array();
                                foreach ($inscriptions as $key => $inscription) {
                                    
                                    $enfant = enfant::get($inscription->ref_enfant_id);
                                    $birthdate = new DateTime($enfant->birthdate);
                                    if ($enfant->birthdate != '0000-00-00 00:00:00') {
                                        $birthdate_string = strftime('%d/%m/%Y', $birthdate->getTimestamp());
                                    } else {
                                        $birthdate_string = ' ';
                                    }
                                    $address_host = '';
                                    if (tool::check($enfant->father_address_number)) {
                                        $address = $enfant->father_address_number.' '.$enfant->father_address_street.'<br />'.$enfant->father_address_postal_code.' '.$enfant->father_address_city;
                                    } elseif (tool::check($enfant->mother_address_postal_code)) {
                                        $address = $enfant->mother_address_number.' '.$enfant->mother_address_street.'<br />'.$enfant->mother_address_postal_code.' '.$enfant->mother_address_city;
                                    } elseif (tool::check($enfant->guardian_address_street)) {
                                        $address = $enfant->guardian_address_number.' '.$enfant->guardian_address_street.'<br />'.$enfant->guardian_address_postal_code.' '.$enfant->guardian_address_city;
                                    } else {
                                        $address = '';
                                    }
                                    $tel_father = '';
                                    if (tool::check($enfant->father_phone_home)) {
                                        $tel_father .= 'Fixe : '.tool::formatTel($enfant->father_phone_home)."\n";
                                    }
                                    if (tool::check($enfant->father_phone_mobile)) {
                                        $tel_father .= 'Mobile : '.tool::formatTel($enfant->father_phone_mobile)."\n";
                                    }
                                    if (tool::check($enfant->father_phone_pro)) {
                                        $tel_father .= 'Pro : '.tool::formatTel($enfant->father_phone_pro)."\n";
                                    }

                                    $tel_mother = '';
                                    if (tool::check($enfant->mother_phone_home)) {
                                        $tel_mother .= 'Fixe : '.tool::formatTel($enfant->mother_phone_home)."\n";
                                    }
                                    if (tool::check($enfant->mother_phone_mobile)) {
                                        $tel_mother .= 'Mobile : '.tool::formatTel($enfant->mother_phone_mobile)."\n";
                                    }
                                    if (tool::check($enfant->mother_phone_pro)) {
                                        $tel_mother .= 'Pro : '.tool::formatTel($enfant->mother_phone_pro)."\n";
                                    }

                                    $tel_host_family = '';
                                    if (tool::check($enfant->host_family_phone_home)) {
                                        $tel_host_family .= 'Fixe : '.tool::formatTel($enfant->host_family_phone_home)."\n";
                                    }
                                    if (tool::check($enfant->host_family_phone_mobile)) {
                                        $tel_host_family .= 'Mobile : '.tool::formatTel($enfant->host_family_phone_mobile)."\n";
                                    }
                                    if (tool::check($enfant->host_family_phone_pro)) {
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
                                }
                            ?>
                            
                            <?php /*
                            <!-- modal-recapitulatif-dossiers-incomplets -->
                            <?php $sejours_saison = sejour::getBySaison($sejour_season->id, $year); ?>
                            <div class="modal fade colored-header" id="modal-recapitulatif-dossiers-incomplets-<?=$o; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-recapitulatif-dossiers-incomplets-<?=$o; ?>" aria-hidden="true">
                                <div class="modal-dialog full-width">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="modal-label-recapitulatif-dossiers-incomplets-<?=$o; ?>">
                                                Récapitulatif des dossiers pour la saison <span><?php echo $sejour_season->name; ?></span>
                                            </h4>
                                        </div>
                                        <div class="modal-body">
                                            <table class="no-border">
                                                <thead class="no-border">
                                                    <tr>
                                                        <th>Prénom</th>
                                                        <th>Nom</th>
                                                        <th>Séjour</th>
                                                        <th>N° de sécurité sociale</th>
                                                        <th>Assurance (RC) (validité)</th>
                                                        <th>Attestation CPAM</th>
                                                        <th>Fiche sanitaire de liaison</th>
                                                        <th>Carnet de vaccination</th>
                                                        <th>Fiche de séjour</th>
                                                        <th>Structure</th>
                                                        <th>Contact</th>
                                                        <th>Tél</th>

                                                    </tr>
                                                </thead>
                                                <tbody class="no-border-x no-border-y">

                                                    <?php foreach($sejours_saison as $sejour_saison): ?>
                                                        <?php
                                                            $inscriptions = inscription::getBySejour($sejour_saison->id);
                                                            $enfants_id = array();
                                                        ?>
                                                        <?php foreach ($inscriptions as $inscription): ?>
                                                            <?php
                                                                $enfant = enfant::get($inscription->ref_enfant);
                                                                $sejour = sejour::get($inscription->ref_sejour);
                                                            ?>
                                                            <?php if ( !in_array($enfant->id, $enfants_id) ): ?>
                                                                <?php $enfants_id[] = $enfant->id; ?>
                                                                <tr>
                                                                    <td style="font-weight:bold;width:200px;" width="200px;">
                                                                        <?php echo $enfant->firstname; ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $enfant->lastname; ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php
                                                                            $date_from = new DateTime($sejour->date_from);
                                                                            $date_to = new DateTime($sejour->date_to);
                                                                            echo $sejour->name;
                                                                        ?>
                                                                        (<?php echo strftime('%d %B', $date_from->getTimestamp()); ?>  au <?=strftime('%d %B %Y', $date_to->getTimestamp()); ?>)
                                                                    </td>

                                                                    <?php if ($enfant->number_ss): ?>
                                                                        <td><?php echo $enfant->number_ss; ?></td>
                                                                    <?php else: ?>
                                                                        <td><i class="fa fa-times-circle"></i></td>
                                                                    <?php endif ?>

                                                                    <?php if ($enfant->self_assurance): ?>
                                                                        <td><i class="fa fa-check-circle"></i> <?php if (!empty( $enfant->self_assurance_expiration_date ) ): ?>(<?php echo $enfant->self_assurance_expiration_date; ?>)<?php endif ?></td>
                                                                    <?php else: ?>
                                                                        <td><i class="fa fa-times-circle"></i></td>
                                                                    <?php endif; ?>

                                                                    <?php if ($enfant->cpam_attestation): ?>
                                                                        <td><i class="fa fa-check-circle"></i> <?php if (!empty($enfant->cpam_attestation_expiration_date)): ?>(<?php echo $enfant->self_assurance_expiration_date; ?>)<?php endif ?></td>
                                                                    <?php else: ?>
                                                                        <td><i class="fa fa-times-circle"></i></td>
                                                                    <?php endif; ?>

                                                                    <?php if ($enfant->health_record): ?>
                                                                        <td><i class="fa fa-check-circle"></i></td>
                                                                    <?php else: ?>
                                                                        <td><i class="fa fa-times-circle"></i></td>
                                                                    <?php endif; ?>

                                                                    <?php if ($enfant->vaccination): ?>
                                                                        <td><i class="fa fa-check-circle"></i></td>
                                                                    <?php else: ?>
                                                                        <td><i class="fa fa-times-circle"></i></td>
                                                                    <?php endif; ?>

                                                                    <?php if ($enfant->stay_record): ?>
                                                                        <td><i class="fa fa-check-circle"></i></td>
                                                                    <?php else: ?>
                                                                        <td><i class="fa fa-times-circle"></i></td>
                                                                    <?php endif; ?>
                                                                    
                                                                    <td>
                                                                        <?php
                                                                            $structure = structure::get($enfant->organization);
                                                                            if (!empty($structure)) {
                                                                                echo $structure->name;
                                                                            }
                                                                        ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php
                                                                            $contact = contact::get($enfant->contact);
                                                                            if (!empty($contact)) {
                                                                                echo $contact->civility . ' ' . $contact->firstname . ' ' . $contact->lastname;
                                                                            }
                                                                        ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php
                                                                            if (!empty($contact)) {
                                                                                echo $contact->phone;
                                                                            }
                                                                        ?>
                                                                    </td>
                                                                </tr>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    <?php endforeach; ?>

                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                                            <a href="/export/saison/type/1/id/<?php echo $sejour_season->id ?>/year/<?php echo $year; ?>" class="btn btn-primary">
                                                <i class="fa fa-download"></i> Télécharger le document
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.modal-recapitulatif-dossiers-incomplets -->
                            */ ?>


                            <!-- modal-recapitulatif-mineurs -->
                            <div class="modal fade colored-header" id="modal-recapitulatif-notes-enfants-<?=$o; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-recapitulatif-notes-enfants-<?=$o; ?>" aria-hidden="true">
                                <div class="modal-dialog full-width">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="modal-label-recapitulatif-notes-enfants-<?=$o; ?>">
                                                Récapitulatif des notes générales de chaque enfant
                                                - <span><?=$sejour->name;?> du <?=strftime('%d %B %Y', $date_from_query->getTimestamp()); ?> au <?=strftime('%d %B %Y', $date_to_query->getTimestamp()); ?></span>
                                            </h4>
                                        </div>
                                        <div class="modal-body">
                                            <table class="no-border">
                                                <thead class="no-border">
                                                    <tr>
                                                        <th>Prénom & nom</th>
                                                        <th>Notes</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="no-border-x no-border-y">

                                                    <?php foreach($inscriptions as $key => $inscription): ?>
                                                        <?php if ($inscription->ref_enfant_id != ''): ?>
                                                            <?php $enfant = enfant::get($inscription->ref_enfant_id); ?>
                                                            <?php if ( isset($enfant->note) && trim($enfant->note) != ''): ?>
                                                                <tr>
                                                                    <td style="font-weight:bold;width:200px;" width="200px;"><?=$enfant->firstname; ?> <?=$enfant->lastname; ?></td>
                                                                    <td><?=$enfant->note; ?></td>
                                                                </tr>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>

                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                                            <a href="/export/sejour/type/4/id/<?=$sejour->id ?>/datefrom/<?=$date_from_query->getTimestamp() ?>/dateto/<?=$date_to_query->getTimestamp()?>" class="btn btn-primary">
                                                <i class="fa fa-download"></i> Télécharger le document
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.modal-recapitulatif-mineurs -->

                            <!-- modal-recapitulatif-mineurs -->
                            <div class="modal fade colored-header" id="modal-recapitulatif-mineurs-<?=$o; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-recapitulatif-mineurs-<?=$o; ?>" aria-hidden="true">
                                <div class="modal-dialog full-width">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="modal-label-recapitulatif-mineurs-<?=$o; ?>">
                                                Récapitulatif mineurs par âge
                                                <span><?=$sejour->name;?> du <?=strftime('%d %B %Y', $date_from_query->getTimestamp()); ?> au <?=strftime('%d %B %Y', $date_to_query->getTimestamp()); ?></span>
                                            </h4>
                                        </div>
                                        <div class="modal-body">
                                            <table class="no-border">
                                                <thead class="no-border">
                                                    <tr>
                                                        <th>Nom</th>
                                                        <th>Prénom</th>
                                                        <th>Date de naissance</th>
                                                        <th>Age</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="no-border-x no-border-y">
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
                                                <i class="fa fa-download"></i> Télécharger le document
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.modal-recapitulatif-mineurs -->
                            
                            <!-- modal-suivi-sanitaire -->
                            <div class="modal fade colored-header" id="modal-suivi-sanitaire-<?=$o; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-suivi-sanitaire-<?=$o; ?>" aria-hidden="true">
                                <div class="modal-dialog full-width">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="modal-label-suivi-sanitaire-<?=$o; ?>">
                                                Suivi sanitaire
                                                <span><?=$sejour->name;?> du <?=strftime('%d %B %Y', $date_from_query->getTimestamp()); ?> au <?=strftime('%d %B %Y', $date_to_query->getTimestamp()); ?></span>
                                            </h4>
                                        </div>
                                        <div class="modal-body">
                                            <table class="no-border">
                                                <thead class="no-border">
                                                    <tr>
                                                        <th>Nom</th>
                                                        <th>Prénom</th>
                                                        <th>Date de naissance</th>
                                                        <th width="150">N° sécurité sociale</th>
                                                        <th>Carnet de vaccination</th>
                                                        <th>Traitement médical</th>
                                                        <th>Contre indications</th>
                                                        <th>Fiche sanitaire</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="no-border-x no-border-y">
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
                                                <i class="fa fa-download"></i> Télécharger le document
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.modal-suivi-sanitaire -->

                            <!-- modal-registre-des-mineurs -->
                            <div class="modal fade colored-header" id="modal-registre-des-mineurs-<?=$o; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-registre-des-mineurs-<?=$o; ?>" aria-hidden="true">
                                <div class="modal-dialog full-width">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="modal-label-registre-des-mineurs-<?=$o; ?>">
                                                <strong>Registre des mineurs</strong> - 
                                                <span><?=$sejour->name;?> du <?=strftime('%d %B %Y', $date_from_query->getTimestamp()); ?> au <?=strftime('%d %B %Y', $date_to_query->getTimestamp()); ?></span>
                                            </h4>
                                        </div>
                                        <div class="modal-body">
                                            <table class="no-border" style="font-size:12px;">
                                                <thead class="no-border">
                                                    <tr>
                                                        <th>Nom</th>
                                                        <th>Prénom</th>
                                                        <th>Date de naissance</th>
                                                        <th>Adresse de l'enfant</th>
                                                        <th>Famille d'accueil</th>
                                                        <th>Structure</th>
                                                        <th>Nom du contact</th>
                                                        <th width="105">Tél structure</th>
                                                        <th>Père</th>
                                                        <th width="160">Tél père</th>
                                                        <th>Mère</th>
                                                        <th width="160">Tél mère</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="no-border-x no-border-y">
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
                                                <i class="fa fa-download"></i> Télécharger le document
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.modal-registre-des-mineurs -->


                        <?php endif; ?>


                    </div>





                <?php endfor; ?>

            </div>
        </div>
    </div>




    <div class="col-sm-3">
        <?php if (isset($hebergement )): ?>
            <?php $geo = tool::getLatLng($hebergement->address_number.' '.$hebergement->address_street.' '.$hebergement->address_postal_code.' '.$hebergement->address_city); ?>
            <div class="block-flat bars-widget">
                <div class="gmap-sm">
                    <a href="https://www.google.fr/maps/place/<?=$hebergement->address_number; ?>+<?=$hebergement->address_street; ?>,+<?=$hebergement->address_postal_code; ?>+<?=$hebergement->address_city; ?>/">
                        <img src="https://maps.googleapis.com/maps/api/staticmap?center=<?=$geo[0]; ?>,<?=$geo[1]; ?>&zoom=10&size=210x200&scale=2&markers=<?=$geo[0]; ?>,<?=$geo[1]; ?>&sensor=false" width="100%" alt="">
                    </a>
                </div>

                <address>
                    <strong><?=$hebergement->name; ?></strong>
                    <?php if ( !empty($hebergement->address_number) OR !empty($hebergement->address_street) ): ?>
                        <br><?=$hebergement->address_number; ?> <?=$hebergement->address_street; ?>
                        <br><?=$hebergement->address_postal_code; ?> <?=$hebergement->address_city; ?>
                    <?php endif; ?>
                </address>
            </div>

            <?php $ref_accompagnateur = accompagnateur::getBySejour($sejour->id); ?>
            <?php if (!empty($ref_accompagnateur)): ?>
                <div class="block-flat bars-widget">
                    <h4>Directeur du séjour</h4>
                    <?php $accompagnateur = accompagnateur::get($ref_accompagnateur->ref_accompagnateur); ?>

                    <address>
                        <strong><?=$accompagnateur->firstname ?> <?=$accompagnateur->lastname; ?></strong>
                        <?php if (!empty($accompagnateur->tel)): ?>
                            <br><?=tool::formatTel($accompagnateur->tel) ?>
                        <?php endif; ?>

                        <?php if (!empty($accompagnateur->email)): ?>
                            <br><a href="mailto:<?=$accompagnateur->email ?>"><?=$accompagnateur->email ?></a>
                        <?php endif; ?>
                    </address>
                </div>
            <?php endif; ?>

            <div class="block-flat bars-widget">
                <h4>Rendez-vous</h4>
                <?php
                    $hours_departure =  unserialize($sejour->hours_departure);
                    $hours_return =  unserialize($sejour->hours_return);

                    $hours_intermediate_departure =  unserialize($sejour->hours_intermediate_departure);
                    $hours_intermediate_return =  unserialize($sejour->hours_intermediate_return);

                    $hour_departure = $hours_departure['hours'];
                    $min_departure = $hours_departure['min'];
                    $hour_return = $hours_return['hours'];
                    $min_return = $hours_return['min'];

                    $hour_intermediate_departure = $hours_intermediate_departure['hours'];
                    $min_intermediate_departure = $hours_intermediate_departure['min'];
                    $hour_intermediate_return = $hours_intermediate_return['hours'];
                    $min_intermediate_return = $hours_intermediate_return['min'];
                ?>

                <?php if ( !empty( $hour_departure[0] ) && !empty( $hour_departure[0] ) && !empty( $hour_return[0] ) && !empty( $min_return[0] ) ): ?>
                    <address>
                        <strong>Aulnay sous bois, au Parking d'Intermarché</strong><br>
                        Départ : <?=(tool::check($hour_departure[0]))? $hour_departure[0].'h'.$min_departure[0] : EMPTYVAL; ?><br>
                        Retour : <?=(tool::check($hour_return[0]))? $hour_return[0].'h'.$min_return[0] : EMPTYVAL; ?>
                    </address>
                <?php endif; ?>

                <address>
                    <strong>Gare de Villepinte, Rue Camille Pissarro 93420 Villepinte</strong><br>
                    Départ : <?=(tool::check($hour_departure[1]))? $hour_departure[1].'h'.$min_departure[1] : EMPTYVAL; ?><br>
                    <?php if ( tool::check( $hour_intermediate_return[1] ) ): ?>Retour (intermédiaire) : <?php echo $hour_intermediate_return[1]; ?>h<?php echo $min_intermediate_departure[1]; ?><br><?php endif; ?>
                    <?php if ( tool::check( $hour_intermediate_departure[1] ) ): ?>Départ (intermédiaire) : <?php echo $hour_intermediate_departure[1]; ?>h<?php echo $min_intermediate_return[1]; ?><br><?php endif; ?>
                    Retour : <?=(tool::check($hour_return[1]))? $hour_return[1].'h'.$min_return[1] : EMPTYVAL; ?>
                </address>

                <address>
                    <strong>Bonneuil en Valois, au Gite</strong><br>
                    Départ : <?=(tool::check($hour_departure[2]))? $hour_departure[2].'h'.$min_departure[2] : EMPTYVAL; ?><br>
                    <?php if ( tool::check( $hour_intermediate_return[2] ) ): ?>Retour (intermédiaire) : <?php echo $hour_intermediate_return[2]; ?>h<?php echo $min_intermediate_departure[2]; ?><br><?php endif; ?>
                    <?php if ( tool::check( $hour_intermediate_departure[2] ) ): ?>Départ (intermédiaire) : <?php echo $hour_intermediate_departure[2]; ?>h<?php echo $min_intermediate_return[2]; ?><br><?php endif; ?>
                    Retour : <?=(tool::check($hour_return[2]))? $hour_return[2].'h'.$min_return[2] : EMPTYVAL; ?>
                </address>
            </div>
        <?php endif; ?>
    </div>
</div>




<div class="modal fade colored-header" id="modal-remove" tabindex="-1" role="dialog" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <div class="i-circle warning"><i class="fa fa-warning"></i></div>
                    <h4>Attention !</h4>
                    <p>
                        Vous êtes sur le point de supprimer le séjour  <strong><?=$sejour->name?></strong>.<br>
                        Êtes-vous sur de vouloir effectuer cette opération ?
                    </p>
                </div>
            </div>
            <div class="modal-footer">
                <form id="form-remove-children" action="/sejours/" method="post">
                    <a href="#" class="btn btn-default btn-flat" data-dismiss="modal">Annuler</a>
                    <input id="remove-id" type="hidden" name="id" value="<?=$sejour->id;?>">
                    <input type="hidden" name="action" value="supprimer">
                    <input type="hidden" name="confirm" value="true">
                    <input type="submit" class="btn btn-warning btn-flat" value="Supprimer la fiche">
                </form>
            </div>
        </div>
    </div>
</div>




<?php ob_start(); ?>
<script>
    $(function () {


        $('body').on('click', '.btn-close', function (e) {
            e.preventDefault();
            $('[data-toggle=popover]').popover('hide');
        });

    });
</script>
<?php $scripts .= ob_get_contents();
ob_end_clean(); ?>

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>