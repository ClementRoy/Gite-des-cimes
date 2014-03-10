<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
<?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>

<?php if(isset($_POST['submit-add'])): ?>
    <?php  
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
    $form_inscription_date_debut = tool::generateDatetime($form_inscription_date_debut);
    $form_inscription_date_fin = tool::generateDatetime($form_inscription_date_fin);

    $datas = array(
        ':ref_sejour' => $form_inscription_sejour,
        ':finished' => $form_inscription_option,
        ':ref_enfant' => $form_inscription_enfant,
        ':date_from' => $form_inscription_date_debut,
        ':date_to' => $form_inscription_date_fin,
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

    ?>
    <?php //tool::output($_POST); ?>
    <?php if($result): ?>

        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success">
                    <i class="icon-ok-sign"></i> 
                    Le dossier d'inscription de <strong><?=$form_inscription_enfant; ?></strong> au séjour <strong></strong> a bien été modifiée
                </div>
                <a href="/folders/">Retourner à la liste des dossiers d'inscription</a>
            </div>
        </div>

    <?php else: ?>


        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger">
                    <i class="icon-remove-sign"></i> 
                    Une erreur s'est produite durant la modification de l'inscription, veuillez réessayer
                </div>
                <a href="/folders/edit/id/<?=$inscription->id ?>">Retourner au formulaire de modification</a>
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
            <div class="row">
            <?php if ($dossier->finished): ?>
            <a href="/pdf/generate/id/<?=$dossier->id?>/type/contrat/" class="btn btn-primary">Contrat</a>
                <a href="/pdf/generate/id/<?=$dossier->id?>/type/convocation/" class="btn btn-primary">Convocation</a>
                <a href="/pdf/generate/id/<?=$dossier->id?>/type/dossier/" class="btn btn-primary">Dossier d'inscription</a>
            <?php else: ?>
                Ce dossier d'inscription n'est pas finalisé.
            <?php endif ?>
            </div>
        </div>
    </div>
</div>



<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>