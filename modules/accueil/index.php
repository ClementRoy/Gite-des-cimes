<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>

<!-- Page title -->
<div class="page-head">
    <h2>Tableau de bord</h2>
</div>
<!-- /Page title -->

<!-- Chiffres -->
<div class="row">
    <div class="col-md-3 col-sm-6">
        <div class="fd-tile detail tile-purple">
            <div class="content"><h1 class="text-left odometer" id="number-enfants">0</h1><p>enfants dans la base</p></div>
            <div class="icon"><i class="fa fa-group"></i></div>
            <a class="details" href="#">Tout voir <span><i class="fa fa-arrow-circle-right pull-right"></i></span></a>
        </div>
    </div>

    <div class="col-md-3 col-sm-6">
        <div class="fd-tile detail tile-orange">
            <div class="content"><h1 class="text-left odometer" id="number-sejours">0</h1><p>séjours dans la base</p></div>
            <div class="icon"><i class="fa fa-plane"></i></div>
            <a class="details" href="#">Tout voir <span><i class="fa fa-arrow-circle-right pull-right"></i></span></a>
        </div>
    </div>

    <div class="col-md-3 col-sm-6">
        <div class="fd-tile detail tile-prusia">
            <div class="content"><h1 class="text-left odometer" id="number-structures">0</h1><p>structures dans la base</p></div>
            <div class="icon"><i class="fa fa-building"></i></div>
            <a class="details" href="#">Tout voir <span><i class="fa fa-arrow-circle-right pull-right"></i></span></a>
        </div>
    </div>

    <div class="col-md-3 col-sm-6">
        <div class="fd-tile detail tile-lemon">
            <div class="content"><h1 class="text-left odometer" id="number-dossiers">0</h1><p>inscriptions dans la base</p></div>
            <div class="icon"><i class="fa fa-folder-open"></i></div>
            <a class="details" href="#">Tout voir <span><i class="fa fa-arrow-circle-right pull-right"></i></span></a>
        </div>
    </div>
</div>
<!-- /Chiffres -->


<div class="row">
    
    <!-- Prise en charges -->
    <div class="col-md-12">
        <div class="section-head">
            <div class="row">
                <div class="col-md-8">
                    <h3>Prise en charge non reçues</h3>
                    </div>
            </div>
        </div>
        <div class="block-flat tb-special tb-no-options">
            <div class="content">
                <div class="table-responsive">
                    <table class="table table-bordered" id="datatable">
                        <thead>
                            <tr>
                                <!--<th class="sortable" style="width: 60px;">#</th>-->
                                <th class="sortable">Nom de l'enfant</th>
                                <th class="sortable">Séjour</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $notSupported = dossier::getListNotSupported(); ?>
                            <?php foreach ($notSupported as $key => $notSupportedDossier): ?>
                                <?php
                                    $enfant = enfant::get($notSupportedDossier->ref_enfant);
                                    $structure = structure::get($notSupportedDossier->ref_structure_payer);
                                    $inscription = inscription::getByDossier($notSupportedDossier->id);
                                    // tool::output($notSupportedDossier);
                                    // tool::output($inscription);
                                    $sejour = sejour::get($inscription[0]->ref_sejour);
                                ?>
                                <tr>
                                    <!--<td><a href="/dossiers/infos/id/<?=$notSupportedDossier->id?>">#<?=$notSupportedDossier->id?></a></td>-->
                                    <td><?=$enfant->firstname?> <?=$enfant->lastname?></td>
                                    <td><a href="/sejours/infos/<?=$sejour->id; ?>"><?=$sejour->name; ?></a></td>
                                    <!-- <td>Non</td> -->
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /Prise en charges -->




    <!-- Séjours à venir -->
    <div class="col-md-12">
        <div class="section-head">
            <div class="row">
                <div class="col-md-8">
                    <h3>Les prochains séjours</h3>
                    </div>
            </div>
        </div>
        <div class="row">
            <?php
                $colors =  array('#4D90FD', '#FD6A5E', '#B450B2', '#fec93d', '#dd4444', '#dd4d79');
                shuffle($colors);
                $i = 0;
            ?>
            <?php $futurs_sejours = sejour::getListFuturSejour(); ?>
            <?php foreach($futurs_sejours as $sejour): ?>

                <?php $inscriptions = inscription::getBySejour($sejour->id); ?>
                <?php if(count($inscriptions) > 0): ?>
                    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
                        <div class="block-flat">
                            <div class="content text-center">
                                <div class="epie-chart" data-barcolor="<?=$colors[$i]?>" data-trackcolor="#F3F3F3" data-percent="<?=100*count($inscriptions)/$sejour->capacity_max ?>">
                                    <span>
                                        <?=floor(100*count($inscriptions)/$sejour->capacity_max) ?>%
                                    </span>
                                </div>
                                <p>
                                    <a href="/sejours/infos/id/<?=$sejour->id ?>"><?=$sejour->name ?></a><br>
                                    <?php 
                                        $date_from = new DateTime($sejour->date_from);
                                        echo ' Du '.strftime('%d', $date_from->getTimestamp());

                                        $date_to = new DateTime($sejour->date_to);
                                        echo ' au '.strftime('%d %B', $date_to->getTimestamp());
                                    ?>
                                    <?='<br><strong>'.count($inscriptions).' / '.$sejour->capacity_max.'</strong>' ?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if ($i < 6) { $i++; } else { $i = 0; } ?>
            <?php endforeach; ?>   
  
        </div>
    </div>
    <!-- /Séjours à venir -->
</div>

<?php /*
    <div class="col-md-5">
        <p class="bloc-title">Prochains séjours</p>
        <div class="content">


            <div class="jumbotron">
                <h1>En cours de construction !</h1>
            </div>
        </div>

    </div>
    <div class="col-md-5">

        <div class="row">

            <h6>Inscriptions non finalisées</h6>

            <h6>Séjours à venir</h6>

            <h6>Fiches à compléter</h6>

            <h6>Taux de remplissage</h6>

        </div>
    </div>
*/ ?>




<?php ob_start(); ?>
<script type="text/javascript" src="/assets/libs/jquery.easypiechart/jquery.easy-pie-chart.js"></script>
<script type="text/javascript" src="/assets/libs/odometer/odometer.min.js"></script>
<script>
    $(function() {
        $('.epie-chart').easyPieChart({
            easing: 'easeOutBounce',
            size: 140,
            animate: 1500,
            lineWidth: 7
        });

        setTimeout(function() {
            $('#number-enfants').text('<?php echo count(enfant::getList()); ?>');
            // $('#number-contacts').text('<?php echo count(contact::getList()); ?>');
        }, 10);
        setTimeout(function() {
            $('#number-sejours').text('<?php echo count(sejour::getList()); ?>');
        }, 300);
        setTimeout(function() {
            $('#number-structures').text('<?php echo count(structure::getList()); ?>');
        }, 600);
        setTimeout(function() {
            $('#number-dossiers').text('<?php echo count(dossier::getList()); ?>');
        }, 900);

        $('#datatable').DataTable({
            "bFilter": false,
            "bLengthChange": false,
            "oLanguage": {
                "sInfo": "_START_ - _END_ sur _TOTAL_ ",
                "oPaginate": {
                    "sFirst": "",
                    "sPrevious": "",
                    "sNext": "",
                    "sLast": ""
                }
            }
        });
    });
</script>
<?php $scripts .= ob_get_contents();
ob_end_clean(); ?>

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>