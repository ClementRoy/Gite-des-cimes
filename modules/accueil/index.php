<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>

<!-- Page title -->
<div class="page-head">
    <h2>Tableau de bord</h2>
</div>
<!-- /Page title -->

<!-- Chiffres -->
<div class="row hidden-xs">
    <div class="col-md-3 col-sm-6">
        <div class="fd-tile detail tile-purple">
            <div class="content"><h1 class="text-left odometer" id="number-enfants">0</h1><p>enfants dans la base</p></div>
            <div class="icon"><i class="fa fa-group"></i></div>
            <a class="details" href="/enfants/">Tout voir <span><i class="fa fa-arrow-circle-right pull-right"></i></span></a>
        </div>
    </div>

    <div class="col-md-3 col-sm-6">
        <div class="fd-tile detail tile-orange">
            <div class="content"><h1 class="text-left odometer" id="number-sejours">0</h1><p>séjours dans la base</p></div>
            <div class="icon"><i class="fa fa-plane"></i></div>
            <a class="details" href="/sejours/">Tout voir <span><i class="fa fa-arrow-circle-right pull-right"></i></span></a>
        </div>
    </div>

    <div class="col-md-3 col-sm-6">
        <div class="fd-tile detail tile-prusia">
            <div class="content"><h1 class="text-left odometer" id="number-structures">0</h1><p>structures dans la base</p></div>
            <div class="icon"><i class="fa fa-building"></i></div>
            <a class="details" href="/structures/">Tout voir <span><i class="fa fa-arrow-circle-right pull-right"></i></span></a>
        </div>
    </div>

    <div class="col-md-3 col-sm-6">
        <div class="fd-tile detail tile-lemon">
            <div class="content"><h1 class="text-left odometer" id="number-dossiers">0</h1><p>inscriptions dans la base</p></div>
            <div class="icon"><i class="fa fa-folder-open"></i></div>
            <a class="details" href="/dossiers/">Tout voir <span><i class="fa fa-arrow-circle-right pull-right"></i></span></a>
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
                    <table class="table table-bordered" id="datatable1">
                        <thead>
                            <tr>
                                <th width="90">Dossier</th>
                                <th>Nom de l'enfant</th>
                                <th>Séjour</th>
                                <th>À partir du</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $notSupported = dossier::getListNotSupported(); ?>
                            <?php foreach ($notSupported as $key => $notSupportedDossier): ?>
                                <?php
                                    $enfant = enfant::get($notSupportedDossier->ref_enfant);
                                    // $structure = structure::get($notSupportedDossier->ref_structure_payer);
                                    $inscription = inscription::getByDossier($notSupportedDossier->id);
                                ?>
                                <?php if ( count($inscription) > 0): ?>
                                    <?php
                                        $dossier = $notSupportedDossier->id;
                                        $date_from = new DateTime($inscription[0]->date_from);
                                        if($date_from->getTimestamp() != '-62169987600') {
                                            $week = 60 * 60 * 24 * 7;
                                            $alert = '';
                                            if (($week * 2 + time()) >= $date_from->getTimestamp()) {
                                                $alert = '<span class="label label-primary" style="padding:3px 6px 4px;float:left;display:block;margin-top:1px;margin-right:8px;">Bientôt</span> ';
                                            }
                                            if (($week + time()) >= $date_from->getTimestamp()) {
                                                $alert = '<span class="label label-danger" style="padding:3px 6px 4px;float:left;display:block;margin-top:1px;margin-right:8px;">Urgent</span> ';
                                            }
                                            $date_from = '<span class="sr-only">'.strftime("%Y/%m/%d", $date_from->getTimestamp()).'</span> '.$alert.strftime("%d %B %Y", $date_from->getTimestamp());
                                        }

                                        

                                        $date_to = new DateTime($inscription[0]->date_to);
                                        if($date_to->getTimestamp() != '-62169987600') {
                                            $date_to = strftime("%Y/%m/%d", $date_to->getTimestamp()).'</span> '.strftime("%d %B %Y", $date_to->getTimestamp());
                                        }

                                        $sejour = sejour::get($inscription[0]->ref_sejour);

                                        $popup = '
                                            <ul class="dropdown-menu">
                                                <li><a href="/sejours/infos/id/'.$sejour->id.'" class="item"><i class="fa fa-share"></i> Voir le séjour</a></li>
                                                <li><a href="/dossiers/infos/id/'.$notSupportedDossier->id.'" class="item"><i class="fa fa-share"></i> Voir le dossier</a></li>
                                                <li><a href="/dossiers/editer/id/'.$notSupportedDossier->id.'" class="item"><i class="fa fa-edit"></i> Modifier l\'inscription</a></li>
                                            </ul>';
                                    ?>
                                    <tr>
                                        <td><a href="/dossiers/infos/id/<?=$dossier; ?>">#<?=$dossier; ?></a><?=$popup; ?></td>
                                        <td><a href="/enfants/infos/id/<?=$enfant->id; ?>"><?=$enfant->firstname?> <?=$enfant->lastname?></a></td>
                                        <td><a href="/sejours/infos/<?=$sejour->id; ?>"><?=$sejour->name; ?></a></td>
                                        <td><?=$date_from; ?></td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
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
                $y = 0;

                $futurs_sejours = sejour::getListFuturSejour();

                foreach($futurs_sejours as $key => $sejour) {

                    $date_from = new DateTime($sejour->date_from);
                    $date_to = new DateTime($sejour->date_to);

                    $i++;

                    $nb_weeks = tool::getNbWeeks(new DateTime($sejour->date_from), new DateTime($sejour->date_to));

                    $min = $sejour->capacity_min;
                    $max = $sejour->capacity_max;

                    if ($nb_weeks > 1) {

                        for ($i = 0; $i < $nb_weeks; $i++) {

                            $start_base = new DateTime($sejour->date_from);
                            $end_base = new DateTime($sejour->date_from);

                            $start_base->modify("+$i weeks");
                            $end_base->modify("+$i weeks");
                            $end_base->modify("+1 weeks");

                            $date_from = strftime("%d", $start_base->getTimestamp());

                            $date_to = strftime("%d %B",  $end_base->getTimestamp());

                            $inscriptions = inscription::getBySejourBetweenDates($sejour->id, $start_base, $end_base);

                            $nb = count($inscriptions);
                            $opt = inscription::getUnconfirmedBySejourBetweenDates($sejour->id, $start_base, $end_base);
                            $opt = count($opt);

                            ?>

                            <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
                                <div class="block-flat block-piechart">
                                    <div class="content text-center">
                                        <div class="epie-chart" data-barcolor="<?=$colors[$y]?>" data-trackcolor="#F3F3F3" data-percent="<?=100 * $nb / $sejour->capacity_max; ?>">
                                            <span>
                                                <?=floor(100 * $nb / $sejour->capacity_max); ?>%
                                            </span>
                                        </div>
                                        <p>
                                            <a href="/sejours/infos/id/<?=$sejour->id; ?>#week-<?=$i+1; ?>"><?=$sejour->name ?> (<?=$i+1; ?>)</a><br>
                                            Du <?=$date_from; ?> au <?=$date_to; ?><br>
                                            <strong><?=$nb; ?>/<?=$sejour->capacity_max; ?></strong>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <?php 

                            if ($y < 5) { $y++; } else { $y = 0; }

                        }

                    } else {

                        $inscriptions = inscription::getBySejour($sejour->id);

                        $nb = count($inscriptions);
                        $opt = inscription::getUnconfirmedBySejourBetweenDates($sejour->id, $date_from, $date_to);
                        $opt = count($opt);

                        if ($date_from->getTimestamp() != '-62169987600') {
                            $date_from = strftime("%d", $date_from->getTimestamp());
                        }

                        if ($date_to->getTimestamp() != '-62169987600') {
                            $date_to = strftime("%d %B", $date_to->getTimestamp());
                        }

                        ?>

                            <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
                                <div class="block-flat block-piechart">
                                    <div class="content text-center">
                                        <div class="epie-chart" data-barcolor="<?=$colors[$y]?>" data-trackcolor="#F3F3F3" data-percent="<?=100 * $nb / $sejour->capacity_max; ?>">
                                            <span>
                                                <?=floor(100 * $nb / $sejour->capacity_max); ?>%
                                            </span>
                                        </div>
                                        <p>
                                            <a href="/sejours/infos/id/<?=$sejour->id; ?>"><?=$sejour->name ?></a><br>
                                            Du <?=$date_from; ?> au <?=$date_to; ?><br>
                                            <strong><?=$nb; ?>/<?=$sejour->capacity_max; ?></strong>
                                        </p>
                                    </div>
                                </div>
                            </div>

                        <?php
                        
                        if ($y < 5) { $y++; } else { $y = 0; }

                    }
                    
                }

            ?>
  
        </div>
    </div>
    <!-- /Séjours à venir -->
</div>





<?php ob_start(); ?>
<?php if (APP_VERSION != 'dev'): ?>
    <script type="text/javascript" src="/assets/js/dashboard.min.js"></script>
<?php else: ?>
    <script type="text/javascript" src="/assets/js/libs/jquery.easy-pie-chart.min.js"></script>
    <script type="text/javascript" src="/assets/js/libs/odometer.min.js"></script>
<?php endif; ?>
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

        $('#datatable1').DataTable({
            "bFilter": false,
            "bLengthChange": false,
            "iDisplayLength": 1000,
            "oLanguage": {
                "sInfo": "_START_ - _END_ sur _TOTAL_ ",
                "oPaginate": {
                    "sFirst": "",
                    "sPrevious": "",
                    "sNext": "",
                    "sLast": ""
                }
            },
            "aaSorting": [[ 2, "asc" ]]
        });
    });
</script>
<?php $scripts .= ob_get_contents();
ob_end_clean(); ?>

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>