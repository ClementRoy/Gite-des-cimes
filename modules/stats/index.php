<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
<?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>



<div class="title">
    <div class="row header">
        <div class="col-md-12">
            <h1>Satistiques</h1>
            <ul class="nav nav-tabs">
                <li class="active"><a href="#2014">2014</a></li>

            </ul>
        </div>
    </div>
</div>

<?php $structures = structure::getList(); ?>
<?php 

    global $db;


    // Février,printemps, été, toussaints et week end cumulés

    // Février
    $from_fev = new DateTime('2014-02-01');
    $to_fev = new DateTime('2014-03-01');

    // Printemps
    $from_printemps = new DateTime('2014-03-21');
    $to_printemps = new DateTime('2014-05-31');

    // Ete
    $from_ete = new DateTime('2014-06-01');
    $to_ete = new DateTime('2014-09-30');

    // Toussaints
    $from_toussaint = new DateTime('2014-10-01');
    $to_toussaint = new DateTime('2014-11-30');



    function getNbInscriptionsByPeriod($from, $to ){
        global $db;
        $number = 0;
        $from = $from->format("Y-m-d H:i:s");
        $to = $to->format("Y-m-d H:i:s");


        $sql = 'SELECT DISTINCT COUNT(inscription.id) as nb  FROM inscription
                LEFT JOIN dossier ON inscription.ref_dossier = dossier.id 
                WHERE dossier.finished = 1 
                AND inscription.date_from >= "'.$from.'" 
                AND inscription.date_to <= "'.$to.'" 
                AND DATE_ADD(inscription.date_from, INTERVAL 2 DAY) != inscription.date_to
                ORDER BY inscription.id';

        return $db->row($sql)->nb;
    }

    function getNbInscriptionsWeekEndByYear($year = '2014'){
        global $db;
        $from = new DateTime($year.'-01-01');
        $from = $from->format("Y-m-d H:i:s");
        $to = new DateTime($year.'-12-31');
        $to = $to->format("Y-m-d H:i:s");
        $sql = 'SELECT DISTINCT COUNT(inscription.id) as nb  FROM inscription
                LEFT JOIN dossier ON inscription.ref_dossier = dossier.id 
                WHERE dossier.finished = 1 
                AND inscription.date_from >= "'.$from.'"
                AND inscription.date_to <= "'.$to.'"
                AND DATE_ADD(inscription.date_from, INTERVAL 2 DAY) = inscription.date_to
                ORDER BY inscription.id';
        return $db->row($sql)->nb;
    }

    echo 'février';
    tool::output(getNbInscriptionsByPeriod($from_fev, $to_fev));

    echo 'printemps';
    tool::output(getNbInscriptionsByPeriod($from_printemps, $to_printemps));

    echo 'été';
    tool::output(getNbInscriptionsByPeriod($from_ete, $to_ete));

    echo 'toussaint';
    tool::output(getNbInscriptionsByPeriod($from_toussaint, $to_toussaint));

    echo 'weekend';
    tool::output(getNbInscriptionsWeekEndByYear());


    function getNbInscriptionByStructureByYear($structure, $year = '2014'){
        global $db;
        $from = new DateTime($year.'-01-01');
        $from = $from->format("Y-m-d H:i:s");
        $to = new DateTime($year.'-12-31');
        $to = $to->format("Y-m-d H:i:s");

        $sql = 'SELECT DISTINCT enfant.id, COUNT(enfant.id) as nb FROM inscription
                LEFT JOIN dossier ON inscription.ref_dossier = dossier.id 
                LEFT JOIN enfant ON inscription.ref_enfant = enfant.id 
                LEFT JOIN structure ON enfant.organization = structure.id 
                WHERE structure.id  = "'.$structure->id.'" 
                AND dossier.finished = 1 
                AND inscription.date_from >= "'.$from.'" 
                AND inscription.date_to <= "'.$to.'" 
                ORDER BY inscription.id';

        return $db->row($sql);

    }
?>

<div class="content content-table">
    <div class="row">
        <div class="col-md-12">
            <div class="tab-content">
                <div class="tab-pane active" id="2014">
            <?php if(count($structures)): ?>
                <table class="datatable" data-sort="1" data-length="25">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <!--<th class="sortable">Nombre d'enfant inscrit cette année</th>-->
                            <th>Nombre d'inscriptions</th>
                        </thead>
                        <tbody>

                            <?php foreach($structures as $key => $structure): ?>

                            <?php 

                                $result2 = getNbInscriptionByStructureByYear($structure);

                            ?>
                            <?php if($result2->nb > 0): ?>
                            <tr>
                                <td>
                                    <a href="/structures/infos/id/<?=$structure->id; ?>"><?=$structure->name; ?></a>
                                </td>
                                <!--<td>
                                    <?=$result2->nb ?>
                                </td>-->
                                <td>
                                    <?=$result->nb ?>                                      
                                </td>                                    
                            </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p><em>Cette corbeille est vide</em></p>
            <?php endif; ?> 

                </div>
            </div>

        </div>
    </div>
</div>

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>
