<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>

<?php dossier::cleanEmpty(); ?>


<?php $dossiers = dossier::getList(); ?>
<?php //tool::output($sejours); ?>
<div class="title">
    <div class="row header">
        <div class="col-md-6">
            <h1>Les dossiers d'inscription</h1>
        </div>
        <div class="col-md-6 text-right">
            <a href="/dossiers/ajouter" class="btn btn-primary">
                <span>+</span>Ajouter une inscription
            </a>
        </div>
    </div>
</div>

<div class="content content-table">
    <div class="row">
        <div class="col-md-12">

            <table class="datatable">
                <thead>
                    <tr>
                        <th class="sortable">Numéro du séjour</th>
                        <th class="sortable">Nom de l'enfant</th>
                        <th class="sortable">Satut</th>
                        <th class="sortable">Pris en charge</th>
                    </tr>
                </thead>

                <tfoot>
                    <tr>
                        <th class="sortable">Numéro du séjour</th>
                        <th class="sortable">Nom de l'enfant</th>
                        <th class="sortable">Satut</th>
                        <th class="sortable">Pris en charge</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach($dossiers as $key => $dossier): ?>
                    
                        <?php $enfant = enfant::get($dossier->ref_enfant); ?>
                        <?php $inscriptions_dossier = inscription::getByDossier($dossier->id); ?>
                        <tr>
                            <td>
                                <a href="/dossiers/infos/id/<?=$dossier->id; ?>">#<?=$dossier->id; ?></a>
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
                                <a href="/enfants/infos/id/<?=$enfant->id; ?>"><?=$enfant->lastname ?> <?=$enfant->firstname ?></a>
                                - <?php foreach($inscriptions_dossier as $inscription_dossier): ?>
                                    <?php $sejour = sejour::get($inscription_dossier->ref_sejour); ?>
                                    <?=$sejour->name; ?> du 
                                    <?php $date_from = new DateTime($inscription_dossier->date_from); ?>
                                    <?php if($date_from->getTimestamp() != '-62169987600'): ?>
                                        <?=strftime('%d %b %Y', $date_from->getTimestamp()); ?>
                                    <?php endif; ?> au 
                                    <?php $date_to = new DateTime($inscription_dossier->date_to); ?>
                                    <?php if($date_to->getTimestamp() != '-62169987600'): ?>
                                        <?=strftime('%d %b %Y', $date_to->getTimestamp()); ?>
                                    <?php endif; ?>
                            <?php endforeach; ?>
                            </td>
                            <td>
                                <?php if($dossier->finished): ?>
                                    <span class="label label-success">Confirmé</span>
                                <?php else: ?>
                                    <span class="label label-danger">Non confirmé</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($dossier->supported): ?>
                                    <span class="label label-success">Oui</span>
                                <?php else: ?>
                                    <span class="label label-danger">Non</span>
                                <?php endif; ?>
                            </td>

                        </tr>

                    
                    <?php endforeach; ?>
                    </tbody>
               
            </table>
        </div>
    </div>
</div>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>