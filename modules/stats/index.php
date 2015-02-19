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
    $from_2014 = new DateTime('2014-01-01');
    $from_2014 = $from_2014->format("Y-m-d H:i:s");
    $to_2014 = new DateTime('2104-12-31');
    $to_2014 = $to_2014->format("Y-m-d H:i:s");



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

    // Ne pas faire un étoile ici ....
    $sql = 'SELECT COUNT(*) as nb FROM inscription
            LEFT JOIN dossier ON inscription.ref_dossier = dossier.id 
            LEFT JOIN enfant ON inscription.ref_enfant = enfant.id 
            LEFT JOIN structure ON enfant.organization = structure.id 
            WHERE structure.id  = "'.$structure->id.'" AND dossier.finished = 1 AND inscription.date_from >= "'.$from_2014.'" AND inscription.date_to <= "'.$to_2014.'" ORDER BY inscription.id';

    $result = $db->row($sql);

    $sql2 = 'SELECT DISTINCT enfant.id , COUNT(enfant.id) as nb FROM inscription
            LEFT JOIN dossier ON inscription.ref_dossier = dossier.id 
            LEFT JOIN enfant ON inscription.ref_enfant = enfant.id 
            LEFT JOIN structure ON enfant.organization = structure.id 
            WHERE structure.id  = "'.$structure->id.'" AND dossier.finished = 1 AND inscription.date_from >= "'.$from_2014.'" AND inscription.date_to <= "'.$to_2014.'" ORDER BY inscription.id';

    $result2 = $db->row($sql2);


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
