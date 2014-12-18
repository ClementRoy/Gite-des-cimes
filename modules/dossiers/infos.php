<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
<?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>

<?php if(isset($_POST['submit-add'])): ?>
    <?php  
    extract($_POST);
    //tool::output($_POST);

    $datas = array(
        ':finished' => $form_inscription_option,
        ':ref_enfant' => $form_inscription_enfant,
        ':ref_structure_payer' => $form_inscription_structure,
        ':structure_payer' => $form_inscription_structure_name,
        ':supported' => $form_inscription_supported,
        ':note' => $form_inscription_note,
        ':place' => (!empty($form_inscription_lieu_custom))?$form_inscription_lieu_custom:$form_inscription_lieu,
        ':hour_departure' => $form_inscription_heure_aller.'h'.$form_inscription_min_aller,
        ':hour_return' => $form_inscription_heure_retour.'h'.$form_inscription_min_retour,
        ':pique_nique' => $form_inscription_pique_nique,
        ':sac' => $form_inscription_sac
        );
    //tool::output($datas);
    $result = dossier::update($datas, $_GET['id']);

    foreach($dates as $key => $inscription_entry){

        $inscription_entry = explode('#', $inscription_entry);
        $form_inscription_date_debut = tool::generateDatetime($inscription_entry[0]);
        $form_inscription_date_fin = tool::generateDatetime($inscription_entry[1]);
        $datas = array(
            ':ref_enfant' => $form_inscription_enfant,
            ':ref_sejour' => $inscription_entry['2'],
            ':ref_dossier' => $_GET['id'],
            ':date_from' => $form_inscription_date_debut,
            ':date_to' => $form_inscription_date_fin
            );
        //tool::output($datas);
        $result = inscription::add($datas);
    }

    ?>
    <?php //tool::output($_POST); ?>
    <?php if($result): ?>

        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success">
                    <i class="icon-ok-sign"></i> 
                    L'inscription de <strong><?=$form_inscription_enfant; ?></strong> au séjour <strong></strong> a bien été ajoutée
                </div>
            </div>
        </div>

    <?php else: ?>


        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger">
                    <i class="icon-remove-sign"></i> 
                    Une erreur s'est produite durant la création de l'inscription, veuillez réessayer
                </div>
            </div>
        </div>
    <?php endif; ?>

<?php endif; ?>



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
        //tool::output($datas);
    $result = dossier::update($datas, $_GET['id']);

    $inscription = inscription::deleteByDossier($_GET['id']);

        //tool::output($form_inscription_sejour);
    foreach($dates as $key => $inscription_entry){

        $inscription_entry = explode('#', $inscription_entry);
        $form_inscription_date_debut = tool::generateDatetime($inscription_entry[0]);
        $form_inscription_date_fin = tool::generateDatetime($inscription_entry[1]);
        $datas = array(
            ':ref_enfant' => $form_inscription_enfant,
            ':ref_sejour' => $inscription_entry['2'],
            ':ref_dossier' => $_GET['id'],
            ':date_from' => $form_inscription_date_debut,
            ':date_to' => $form_inscription_date_fin
            );
            //tool::output($datas);
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
                <a href="/dossiers/editer/id/<?=$inscription->id ?>">Retourner au formulaire de modification</a>
            </div>
        </div>
    <?php endif; ?>

<?php endif; ?>


<?php $dossier = dossier::get($_GET['id']); ?>
<?php $creator = user::get($dossier->creator); ?>
<?php $editor = user::get($dossier->editor); ?>
<?php $date_created = new DateTime($dossier->created); ?>
<?php $date_edited = new DateTime($dossier->edited); ?>




<div class="title">
    <div class="row header">
        <div class="col-md-9">

            <h1>
                <a href="#" class="blue trigger">
                    <i class="big-icon icon-folder-open"></i>
                </a>
                Inscription <strong>n°<?=$dossier->id; ?></strong>
            </h1>

            <div class="pop-dialog">
                <div class="pointer">
                    <div class="arrow"></div>
                    <div class="arrow_border"></div>
                </div>
                <div class="body">
                    <div class="menu">
                        <a href="/dossiers/editer/id/<?=$dossier->id; ?>" class="item"><i class="icon-edit"></i> Modifier</a>
                        <a href="/dossiers/supprimer/id/<?=$dossier->id; ?>" class="item" data-toggle="modal"><i class="icon-remove"></i> Supprimer</a>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-3 text-right">
            <div class="col-md-4 text-right pull-right">
                <i class="icon-cog"></i>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-9">
        <div class="content">
            <?php  if(!$dossier->finished): ?>
                <div class="alert alert-warning">
                    <i class="icon-warning-sign"></i> 
                    L'inscription n'est pas encore été finalisée
                </div>
            <?php endif; ?>

            <?php 
            if(!$dossier->supported): ?>
            <div class="alert alert-warning">
                <i class="icon-warning-sign"></i> 
                L'inscription n'est pas encore été prise en charge
            </div>
        <?php endif; ?>

        <?php $inscriptions = inscription::getByDossier($dossier->id); ?>
        <h3>Documents</h3>
        <div class="row">
            <div class="col-md-12">
              <?php if ($dossier->finished): ?>
                <a href="/pdf/generate/id/<?=$dossier->id?>/type/contrat/" target="_blank" class="btn btn-primary">Contrat</a>
                <a href="/pdf/generate/id/<?=$dossier->id?>/type/convocation/" target="_blank" class="btn btn-primary">Convocation</a>
                <a href="/pdf/generate/id/<?=$dossier->id?>/type/dossier/" target="_blank" class="btn btn-primary">Dossier d'inscription</a>
            <?php else: ?>
                <p><em>Ce dossier d'inscription n'est pas finalisé.</em></p>
            <?php endif ?>
        </div>
    </div>
    <hr>
    <h3>Séjour(s)</h3>
    <div class="row">

        <?php foreach($inscriptions as $inscription): ?>
            <?php $sejour = sejour::get($inscription->ref_sejour); ?>
            <?php $date_from = new DateTime($inscription->date_from); ?>
            <?php $date_to = new DateTime($inscription->date_to); ?>
            <div class="col-md-6">
                <p><strong><?=$sejour->name ?></strong> du <?=strftime("%d %B %Y", $date_from->getTimestamp()) ?> au <?=strftime("%d %B %Y", $date_to->getTimestamp()) ?></p>
            </div>
        <?php endforeach; ?>
    </div>
    <hr>
    <h3>Rendez-vous</h3>
    <div class="row">
        <div class="col-md-6">
            <p>
                <strong>Lieu de rendez-vous :</strong><br>
                <?=$dossier->place; ?>
            </p>
        </div>
        <div class="col-md-6">
            <p>
                <strong>Heure de départ :</strong>
                <?=$dossier->hour_departure; ?>
            </p>
            <p>
                <strong>Heure de retour:</strong>
                <?=$dossier->hour_return; ?>
            </p>
        </div>
    </div>
    <hr>
    <h3>Informations complémentaires</h3>
    <div class="row">
        <div class="col-md-6">
            <p>
                <strong>Centre payeur :</strong>
                <?php $structure_payer = structure::get($dossier->ref_structure_payer); ?>
                <?=(!empty($structure_payer)) ? '<a href="/structures/infos/id/'.$structure_payer->id.'">'.$structure_payer->name.'</a>':EMPTYVAL; ?>
            </p>
            <p>
                <strong>Prise en charge de l'enfant :</strong> 
                <?php $structure_payer = structure::get($dossier->ref_structure_payer); ?>
                <?=($dossier->supported) ? '<i class="icon-ok-sign"></i>':'<i class="icon-remove-sign"></i>'; ?>
            </p>
        </div>
        <div class="col-md-6">
            <p>
                <strong>Pique Nique :</strong>
                <?=($dossier->pique_nique) ? '<i class="icon-ok-sign"></i>':'<i class="icon-remove-sign"></i>'; ?>
            </p>
            <p>
                <strong>Sac de couchage :</strong>
                <?=($dossier->sac) ? '<i class="icon-ok-sign"></i>':'<i class="icon-remove-sign"></i>'; ?>
            </p>
        </div>
    </div>
    <hr>
    <h3>Notes</h3>
    <div class="row">
        <div class="col-md-12">
            <?php $note = trim($dossier->note) ?>
            <?php if ($dossier->note): ?>
                <p><?=$dossier->note; ?></p>
            <?php else: ?>
                <p><em>Aucune note pour le moment</em></p>
            <?php endif; ?>

        </div>
    </div>
</div>
</div>

<?php 
/*

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

*/

        ?>
    </div>


</div>



<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>