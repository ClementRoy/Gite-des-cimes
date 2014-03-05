<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>


<?php $inscriptions = inscription::getList(); ?>
<?php //tool::output($sejours); ?>

<div class="title">
    <div class="row header">
        <div class="col-md-6">
            <h3>Les inscriptions</h3>
        </div>
        <div class="col-md-6 text-right">
            <a href="/inscriptions/ajouter" class="btn btn-primary">
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
                        <th class="sortable">Nom du séjour</th>
                        <th class="sortable">Nom de l'enfant</th>
                        <th class="sortable">Dates</th>
                    </tr>
                </thead>

                <tfoot>
                    <tr>
                        <th class="sortable">Numéro</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach($inscriptions as $key => $inscription): ?>
                        <?php $enfant = enfant::get($inscription->ref_enfant); ?>
                        <?php $sejour = sejour::get($inscription->ref_sejour); ?>
                        <tr>
                            <td>
                                <a href="/sejours/infos/id/<?=$sejour->id; ?>"><?=$sejour->name; ?></a>
                                <div class="pop-dialog tr">
                                    <div class="pointer">
                                        <div class="arrow"></div>
                                        <div class="arrow_border"></div>
                                    </div>
                                    <div class="body">
                                        <div class="menu">
                                            <a href="/inscriptions/infos/id/<?=$inscription->id; ?>" class="item"><i class="icon-share"></i> Voir la fiche</a>
                                            <a href="/inscriptions/editer/id/<?=$inscription->id; ?>" class="item"><i class="icon-edit"></i> Modifier</a>
                                            <a href="/inscriptions/supprimer/id/<?=$inscription->id; ?>" class="item"><i class="icon-remove"></i> Supprimer</a>
                                        </div>
                                    </div>
                                </div> 
                            </td>
                            <td>
                                <a href="/enfants/infos/id/<?=$enfant->id; ?>"><?=$enfant->lastname ?> <?=$enfant->firstname ?></a>
                            </td>
                            <td>
                                du <?=tool::getDatefromDatetime($inscription->date_from); ?> au <?=tool::getDatefromDatetime($inscription->date_to); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>