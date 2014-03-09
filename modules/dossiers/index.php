<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>

<?php dossier::cleanEmpty(); ?>


<?php $dossiers = dossier::getList(); ?>
<?php //tool::output($sejours); ?>

<div class="title">
    <div class="row header">
        <div class="col-md-6">
            <h3>Les dossiers d'inscription</h3>
        </div>
        <div class="col-md-6 text-right">
            <a href="/inscriptions/ajouter" class="btn btn-primary">
                <span>+</span>Ajouter une inscription
            </a>
        </div>
    </div>
</div>

<?php 

/*

// MIGRATION TOOL

foreach($dossiers as $key => $dossier){

    //tool::output($dossier);

    // update each inscriptionList

    // create each inscription
    // $datas = array(
    //     ':ref_enfant' => $dossier->ref_enfant,
    //     ':ref_sejour' => $dossier->ref_sejour,
    //     ':ref_dossier' => $dossier->id,
    //     ':date_from' => $dossier->date_from,
    //     ':date_to' => $dossier->date_to
    // );

    // $result = inscription::add($datas);


}



$inscriptions = inscription::getList();

foreach ($inscriptions as $key => $inscription) {
    $date_from = new DateTime($inscription->date_from);
    $date_to = new DateTime($inscription->date_to);

    $nb_weeks = tool::getNbWeeks($date_from, $date_to);
    echo $nb_weeks;
    if($nb_weeks > 1) {
        for ($i=0; $i < $nb_weeks; $i++) { 
            tool::output($inscription);
            if($i == 0){
                $date_to_inject = new DateTime($inscription->date_from);
                $date_to_inject->modify('+1 weeks');

                $datas = array(
                    ':ref_enfant' => $inscription->ref_enfant,
                    ':ref_sejour' => $inscription->ref_sejour,
                    ':ref_dossier' => $inscription->ref_dossier,
                    ':date_from' => $inscription->date_from,
                    ':date_to' => $date_to_inject->format('Y-m-d H:i:s')
                );
                tool::output($datas);
                $result = inscription::update($datas, $inscription->id );
            }else {
                $date_from_inject = new DateTime($inscription->date_from);
                $diff = '+'.$i.' weeks';
                $date_from_inject->modify($diff);

                $date_to_inject = new DateTime($inscription->date_from);
                $diff2 = '+'.++$i.' weeks';
                $date_to_inject->modify($diff2);

                $datas = array(
                    ':ref_enfant' => $inscription->ref_enfant,
                    ':ref_sejour' => $inscription->ref_sejour,
                    ':ref_dossier' => $inscription->ref_dossier,
                    ':date_from' => $date_from_inject->format('Y-m-d H:i:s'),
                    ':date_to' => $date_to_inject->format('Y-m-d H:i:s')
                );
                tool::output($datas);
                $result = inscription::add($datas);
            }            
        }
    }

}
*/
?>
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