<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
<?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>

<?php 
    
    $structures = structure::getListAll();

    function getNbInscriptionsByPeriod($from, $to ){
        global $db;
        $number = 0;
        $from = $from->format("Y-m-d H:i:s");
        $to = $to->format("Y-m-d H:i:s");


        $sql = 'SELECT COUNT(inscription.id) as nb FROM inscription
                LEFT JOIN dossier ON inscription.ref_dossier = dossier.id 
                WHERE dossier.finished = 1 
                AND dossier.archived = 0
                AND inscription.date_from >= "'.$from.'" 
                AND inscription.date_to <= "'.$to.'" 
                AND DATE_ADD(inscription.date_from, INTERVAL 2 DAY) != inscription.date_to
                ORDER BY inscription.id';

        return $db->row($sql)->nb;
    }

    function getNbInscriptionByStructureByYear($structure, $year = '2014'){
        global $db;
        $from = new DateTime($year.'-01-01');
        $from = $from->format("Y-m-d H:i:s");
        $to = new DateTime($year.'-12-31');
        $to = $to->format("Y-m-d H:i:s");

        $sql = 'SELECT inscription.id, COUNT(inscription.id) as nb FROM inscription
                LEFT JOIN dossier ON inscription.ref_dossier = dossier.id 
                LEFT JOIN enfant ON inscription.ref_enfant = enfant.id 
                LEFT JOIN structure ON enfant.organization = structure.id 
                WHERE structure.id  = "'.$structure->id.'" 
                AND dossier.finished = 1 
                AND dossier.archived = 0
                AND inscription.date_from >= "'.$from.'" 
                AND inscription.date_to <= "'.$to.'" 
                ORDER BY inscription.id';

        return $db->row($sql);

       
    }

    function getNbInscriptionByStructureByPeriod($structure, $from, $to ){
        global $db;
        $number = 0;
        $from = $from->format("Y-m-d H:i:s");
        $to = $to->format("Y-m-d H:i:s");

        $sql = 'SELECT inscription.id, COUNT(inscription.id) as nb FROM inscription
                LEFT JOIN dossier ON inscription.ref_dossier = dossier.id 
                LEFT JOIN enfant ON inscription.ref_enfant = enfant.id 
                LEFT JOIN structure ON enfant.organization = structure.id 
                WHERE structure.id  = "'.$structure->id.'" 
                AND dossier.finished = 1 
                AND dossier.archived = 0
                AND inscription.date_from >= "'.$from.'" 
                AND inscription.date_to <= "'.$to.'" 
                AND DATE_ADD(inscription.date_from, INTERVAL 2 DAY) != inscription.date_to
                ORDER BY inscription.id';
        return $db->row($sql);
    }


    $year = $_GET['annee'];
    
    $seasons = saison::getListAll();

    // $seasons = array(
    //     'Février' => array(
    //         'start' => new DateTime($year.'-02-05'),
    //         'end' => new DateTime($year.'-03-10'),
    //     ),
    //     'Printemps' => array(
    //         'start' => new DateTime($year.'-03-21'),
    //         'end' => new DateTime($year.'-05-31'),
    //     ),
    //     'Été' => array(
    //         'start' => new DateTime($year.'-06-01'),
    //         'end' => new DateTime($year.'-09-30'),
    //     ),
    //     'Toussaints' => array(
    //         'start' => new DateTime($year.'-10-01'),
    //         'end' => new DateTime($year.'-11-30'),
    //     )
    // );

?>



<div class="page-head">
    <div class="row">
        <div class="col-md-8">
            <h1>
                Statistiques
                <small>Année <?=$year; ?></small>
            </h1>
        </div>
    </div>
</div>

<div class="row">
    
    <div class="col-md-12">
        <div class="section-head">
            <div class="row">
                <div class="col-md-8">
                    <h3>Inscription par saison</h3>
                </div>
            </div>
        </div>

        
        <?php

            $inscriptionsCount = array();

            foreach ( $seasons as $season ) {
                $today = new DateTime('NOW');
                $season_start = new DateTime($year.'-' . $season->month_from . '-' . $season->day_from);
                $season_end = new DateTime($year.'-' . $season->month_to . '-' . $season->day_to);
                if ( $today->getTimestamp() > $season_start->getTimestamp() ) {
                    $inscriptionSeason = getNbInscriptionsByPeriod( $season_start, $season_end );
                    // tool::output( $inscriptionSeason );
                    $inscriptionsCount[$season->name] = $inscriptionSeason;
                } else {
                    $inscriptionsCount[$season->name] = 0;
                }
            }

            tool::output( $inscriptionsCount );

        ?>
        <div class="block-flat">
            <div class="content">
                
                <div id="statsYear" style="height: 400px; width:100%; padding: 0px; position: relative;"></div>
                
                <?php ob_start(); ?>
                    <?php if (APP_VERSION != 'dev'): ?>
                        <script type="text/javascript" src="/assets/js/stats.min.js"></script>
                    <?php else: ?>
                        <script type="text/javascript" src="/assets/libs/jquery-flot/jquery.flot.js"></script>
                        <script type="text/javascript" src="/assets/libs/jquery-flot/jquery.flot.pie.js"></script>
                        <script type="text/javascript" src="/assets/libs/jquery-flot/jquery.flot.resize.js"></script>
                        <script type="text/javascript" src="/assets/libs/jquery-flot/jquery.flot.categories.js"></script>
                    <?php endif; ?>
                    <script>

                    function showNumbersOnBars(elem, objectElem) {
                        var $elem = $(elem);
                        $elem.find('.flot-text-over').remove();
                        $elem.append('<div class="flot-text-over"></div>');
                        var flotTextOver = $elem.find('.flot-text-over'),
                            datas = objectElem.getData()[0].data,
                            datasLength = datas.length,
                            overWidth = 100 / datasLength,
                            valueMax = 0;

                        $.each(datas, function(index, val) {
                            if (val[1] > valueMax) {
                                valueMax = val[1];
                            }
                        });

                        // La valeur max arrondi
                        valueMaxRounded = Math.ceil(valueMax / 50) * 50;
                        var textOverHeight = $('.flot-text-over').height(),
                            textOverWidth = $('.flot-text-over').width();

                        for (var i = 0; i < datas.length; i++) {
                            if (datas[i][1] !== 0) {
                                var posY = textOverHeight * datas[i][1] / valueMaxRounded / 2;
                                var posX = (textOverWidth / datasLength * i) + (textOverWidth / datasLength / 2);
                                flotTextOver.append('<span style="width:' + 100 / datasLength + '%;left:' + 100 / datasLength * i + '%; bottom:' + Math.round(posY) + 'px;">' + datas[i][1] + '</span>');
                                var span = flotTextOver.find('span').last();
                                span.css('margin-bottom', '-' + span.outerHeight() / 2 + 'px');
                            }
                        }
                    }


                    var dataYear = [<?php foreach ($inscriptionsCount as $name => $nb): ?>["<?=$name; ?>", <?=$nb; ?>],<?php endforeach; ?>];

                    $(function() {
                        var statsYear = $.plot($("#statsYear"), [{
                            data: dataYear,
                            // label: "Unique Visits"
                        }
                        ], {
                            series: {
                                bars: {
                                    show: true,
                                    barWidth: 0.5,
                                    lineWidth: 0,
                                    fill: true,
                                    hoverable: true,
                                    align: "center",
                                    fillColor: {
                                        colors: [{
                                                opacity: 1
                                            }, {
                                                opacity: 1
                                            }
                                        ]
                                    } 
                                },
                                shadowSize: 2
                            },
                            legend:{
                                show: false
                            },
                            grid: {
                                labelMargin: 10,
                                axisMargin: 500,
                                hoverable: true,
                                clickable: true,
                                tickColor: "rgba(0,0,0,0.15)",
                                borderWidth: 0
                            },
                            colors: ["#FD6A5E", "#FFFFFF", "#52e136"],
                            xaxis: {
                                autoscaleMargin: .05,
                                mode: "categories",
                                tickLength: 0,
                                axisLabelUseCanvas: false,
                                axisLabelFontSizePixels: 14,
                            },
                            yaxis: {
                                ticks: 6,
                                tickDecimals: 0
                            }
                        });


                        showNumbersOnBars('#statsYear', statsYear);
                        $(window).on('resize', function () {
                            showNumbersOnBars('#statsYear', statsYear);
                        });

                        $("#statsYear").bind("plotclick", function (event, pos, item) {
                            alert("You clicked at " + pos.x + ", " + pos.y);
                            // axis coordinates for other axes, if present, are in pos.x2, pos.x3, ...
                            // if you need global screen coordinates, they are pos.pageX, pos.pageY

                            if (item) {
                                highlight(item.series, item.datapoint);
                                alert("You clicked a point!");
                            }
                        });

                        var total = 0;
                        $('#datatable-weekend').find('.progress').find('span').each(function(index, el) {
                        total = parseInt($(el).text()) + total;
                        });
                        // console.log('weekend '+total);


                        var total = 0;
                        $('#datatable-1').find('.progress').find('span').each(function(index, el) {
                        total = parseInt($(el).text()) + total;
                        });
                        // console.log('fev '+total);

                        var total = 0;
                        $('#datatable-2').find('.progress').find('span').each(function(index, el) {
                        total = parseInt($(el).text()) + total;
                        });
                        // console.log('printemps '+total);


                        var total = 0;
                        $('#datatable-3').find('.progress').find('span').each(function(index, el) {
                        total = parseInt($(el).text()) + total;
                        });
                        // console.log('ete '+total);

                        var total = 0;
                        $('#datatable-4').find('.progress').find('span').each(function(index, el) {
                        total = parseInt($(el).text()) + total;
                        });
                        // console.log('toussaints '+total);

                    });
                    </script>
                <?php $scripts .= ob_get_contents();
                ob_end_clean(); ?>



            </div>
        </div>
        
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        

        <?php 
            $inscriptionStructures = array();
            foreach($structures as $key => $structure) {
                $result = getNbInscriptionByStructureByYear($structure, $year);
                if (!empty($result->id) && $result->nb != 0) {
                    $inscriptionStructures[$structure->name] = $result->nb;
                }
            }
            asort($inscriptionStructures);
       ?>
        <div class="section-head">
            <div class="row">
                <div class="col-md-8">
                    <h3>Année <?=$year; ?></h3>
                </div>
            </div>
        </div>
        <div class="block-flat tb-special tb-stats">
            <div class="content">
                <div class="table-responsive">
                    <table class="table table-bordered" id="datatable">
                        <thead>
                            <tr>
                                <th width="350">Structure</th>
                                <th>Nombre d'inscriptions par période</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $the_json = array();

                                $the_datas = array();
                                $max = max($inscriptionStructures);

                                foreach($inscriptionStructures as $name => $nb) {

                                    $nb_text = '<span class="hide">'.sprintf("%04d", $nb).'</span>';
                                    $width = $nb * 100 / $max;
                                    $nb_text .= '<div class="progress ';
                                    if ($nb == $max) {
                                        $nb_text .= 'progress-striped active';
                                    }
                                    $nb_text .= ' progress-stats"><div class="progress-bar progress-bar-primary" style="width: '.$width.'%;"><span>'.$nb.'</span></div></div>';
                                    $the_data = ['<div class="text-right" style="font-size:11px;">'.$name.'</div>', $nb_text];
                                    array_push($the_datas, $the_data);
                                }
                                array_push($the_json, $the_datas);
                            ?>
                        </tbody>
                    </table>
                    
                    <?php ob_start(); ?>
                        <script>

                            var the_datas = [];
                            <?php foreach ($the_json as $key => $value): ?>
                            the_datas.push(<?=json_encode($the_json[$key]);?>);
                            <?php endforeach; ?>
                            $('#datatable').dataTable({
                                "bProcessing": true,
                                "bDeferRender": true,
                                "bStateSave": true,
                                "aaData":   the_datas[0],
                                "aaSorting": [[ 1, "desc" ]],
                                "bLengthChange": false,
                                "iDisplayLength": 1000,
                                // "bPaginate": false,
                                "bInfo": false
                            });

                        </script>
                    <?php $scripts .= ob_get_contents();
                    ob_end_clean(); ?>

                </div>
            </div>
        </div>
    </div>
</div>


<?php $a = 1; ?>
<?php foreach ($seasons as $season): ?>
    <?php
        $season_start = new DateTime($year.'-' . $season->month_from . '-' . $season->day_from);
        $season_end = new DateTime($year.'-' . $season->month_to . '-' . $season->day_to);

        $inscriptions = array();
        $nb_total = 0;
        foreach($structures as $structure) {
            $result = getNbInscriptionByStructureByPeriod($structure, $season_start, $season_end );
            if ( !empty($result->id) && $result->nb != 0 ) {
                $inscriptions[$structure->name] = $result->nb;
                $nb_total += $result->nb;
            }
        }
        
        if( $nb_total > 0 ) {
            $inscriptions['AUTRES - Particuliers'] = $inscriptionsCount[$season->name] - $nb_total;
        }
        arsort($inscriptions);

   ?>
   <?php if( $nb_total > 0 ):  ?>
        <div class="row">
            <div class="col-md-12">
                <div class="section-head">
                    <div class="row">
                        <div class="col-md-8">
                            <h3><?php echo $season->name; ?> <?=$year; ?></h3>
                        </div>
                    </div>
                </div>
                <div class="block-flat tb-special tb-stats">
                    <div class="content">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="datatable-<?=$a; ?>">
                                <thead>
                                    <tr>
                                        <th width="350">Structure</th>
                                        <th>Nombre d'inscriptions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $the_json = array();

                                        $the_datas = array();
                                        $max = max($inscriptions);
                                        foreach($inscriptions as $name => $nb) {

                                            $nb_text = '<span class="hide">'.sprintf("%04d", $nb).'</span>';
                                            $width = $nb * 100 / $max;
                                            $nb_text .= '<div class="progress ';
                                            if ($nb == $max) {
                                                $nb_text .= 'progress-striped active';
                                            }
                                            $nb_text .= ' progress-stats"><div class="progress-bar progress-bar-primary" style="width: '.$width.'%;"><span>'.$nb.'</span></div></div>';
                                            $the_data = ['<div class="text-right" style="font-size:11px;">'.$name.'</div>', $nb_text];
                                            array_push($the_datas, $the_data);
                                        }
                                        array_push($the_json, $the_datas);
                                    ?>
                                </tbody>
                            </table>
                            
                            <?php ob_start(); ?>
                                <script>

                                    var the_datas = [];
                                    <?php foreach ($the_json as $key => $value): ?>
                                    the_datas.push(<?=json_encode($the_json[$key]);?>);
                                    <?php endforeach; ?>
                                    $('#datatable-<?=$a; ?>').dataTable({
                                        "bProcessing": true,
                                        "bDeferRender": true,
                                        "bStateSave": true,
                                        "aaData":   the_datas[0],
                                        "aaSorting": [[ 1, "desc" ]],
                                        "bLengthChange": false,
                                        "iDisplayLength": 1000,
                                        // "bPaginate": false,
                                        "bInfo": false
                                    });

                                </script>
                            <?php $scripts .= ob_get_contents();
                            ob_end_clean(); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php $a++; ?>
<?php endforeach; ?>


<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>
