<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>


<?php sejour::cleanEmpty(); ?>

<div class="page-head">
    <div class="row">
        <div class="col-md-8">
            <h1>Les séjours</h1>
        </div>
        <div class="col-md-4 text-right">
            <a href="/sejours/ajouter" class="btn btn-primary btn-rad">Ajouter un séjour</a>
        </div>
    </div>
</div>

<?php if (isset($_POST['id']) && $_POST['action'] == 'supprimer' && $_POST['confirm'] == true): ?>
    <?php $sejour = sejour::get($_POST['id']); ?>
    <div class="alert alert-success rounded">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <i class="fa fa-check sign"></i><strong>C'est fait !</strong> Le séjour <strong><?=$sejour->name ?></strong> a bien été supprimée !
    </div>

    <?php sejour::remove($_POST['id']); ?>
<?php endif; ?>

<div class="block-flat tb-calendar">
    <div class="content">
        <div id='calendar'>

        </div>
    </div>                
</div>

<?php $sejours = sejour::getList(); ?>
<?php $nb_sejours = count($sejours); ?>
<?php $i = 0; ?>



<?php ob_start(); ?>
<script>
    $(function($) {
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'year,month'
            },
            defaultView : 'year',
            buttonText : {
                today:    'Aujourd\'hui',
                month:    'mois',
                week:     'semaine',
                day:      'jour',
                year:      'année'
            },
            firstDay: 1,
            dayNamesShort: ['dim.', 'lun.', 'mar.', 'mer.', 'jeu.', 'ven.', 'sam.'],
            monthNames: ['Janvier','Février','Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
            eventSources: [{
                events: [
                <?php foreach($sejours as $key => $sejour): ?>
                <?php

                $date_from = new DateTime($sejour->date_from);
                $date_to = new DateTime($sejour->date_to);

                if ($sejour->ref_hebergement) {
                    $hebergement = hebergement::get($sejour->ref_hebergement);
                    $hebergement = $hebergement->name;
                } else {
                    $hebergement = EMPTYVAL;
                }

                $i++;

                $nb_weeks = tool::getNbWeeks(new DateTime($sejour->date_from), new DateTime($sejour->date_to));

                $type = '';
                if ($nb_weeks < 1) {
                    $stay_kind = 'week-end';
                } else {
                    $stay_kind = 'semaine';
                }

                $min = $sejour->capacity_min;
                $max = $sejour->capacity_max;

                ?>

                <?php if ($nb_weeks > 1): ?>
                <?php for ($i=0; $i < $nb_weeks; $i++): ?>
                <?php

                $start_base = new DateTime($sejour->date_from);
                $end_base = new DateTime($sejour->date_from);

                $start_base->modify("+$i weeks");
                $end_base->modify("+$i weeks");
                $end_base->modify("+1 weeks");

                $date_from1 = strftime("%Y-%m-%d", $start_base->getTimestamp());
                $date_from2 = strftime("%d %B %Y", $start_base->getTimestamp());

                $date_to1 = strftime("%Y-%m-%d",  $end_base->getTimestamp());
                $date_to2 = strftime("%d %B %Y",  $end_base->getTimestamp());

                $inscriptions = inscription::getBySejourBetweenDates($sejour->id, $start_base, $end_base);

                $nb = count($inscriptions);
                $opt = inscription::getUnconfirmedBySejourBetweenDates($sejour->id, $start_base, $end_base);
                $opt = count($opt);

                ?>

                {
                    title       : '<?=addslashes($sejour->name)?> (<?=$i+1?>) - <?=$nb?>/<?=$max?> <?=($opt)?'('.$opt.' opt)':''?>',
                    url         : '/sejours/infos/id/<?=$sejour->id?>#week-<?=$i+1;?>',
                    start       : '<?=$date_from1?>',
                    end         : '<?=$date_to1?>',
                    description : '<p><span class="plabel"><i class="fa fa-calendar icon"></i> :</span> <span class="pcontent"><?=$date_from2?> au <?=$date_to2?></span></p><p><span class="plabel"><i class="fa fa-map-marker icon"></i> :</span> <span class="pcontent"><?=addslashes($hebergement)?></span></p><p><span class="plabel"><i class="fa fa-group icon"></i> :</span> <span class="pcontent"><?=count($inscriptions)?> <?=(count($inscriptions) > 1)?"enfants":"enfant";?> inscrits (sur <?=$max?>) <?=($opt > 0)?"<br /> dont ".$opt." option(s)":"";?> </span></p><p><span class="plabel"><i class="fa fa-tag icon"></i> :</span> <span class="pcontent"><?=$sejour->price?> €/<small><?=$stay_kind?></small></span></p>'

                }<?=($i < $nb_sejours) ? ',' : '' ; ?>


                <?php endfor; ?>
                <?php else: ?>
                <?php 
                $inscriptions = inscription::getBySejour($sejour->id);

                $nb = count($inscriptions);
                $opt = inscription::getUnconfirmedBySejourBetweenDates($sejour->id, $date_from, $date_to);
                $opt = count($opt);

                if ($date_from->getTimestamp() != '-62169987600') {
                    $date_from1 = strftime("%Y-%m-%d", $date_from->getTimestamp());
                    $date_from2 = strftime("%d %B %Y", $date_from->getTimestamp());
                }

                if ($date_to->getTimestamp() != '-62169987600') {
                    $date_to1 = strftime("%Y-%m-%d", $date_to->getTimestamp());
                    $date_to2 = strftime("%d %B %Y", $date_to->getTimestamp());
                }
                ?>

                {
                    title       : '<?=addslashes($sejour->name)?>',
                    url         : '/sejours/infos/id/<?=$sejour->id?>',
                    start       : '<?=$date_from1?>',
                    end         : '<?=$date_to1?>',
                    description : '<p><span class="plabel"><i class="fa fa-calendar icon"></i> :</span> <span class="pcontent"><?=$date_from2?> au <?=$date_to2?></span></p><p><span class="plabel"><i class="fa fa-map-marker icon"></i> :</span> <span class="pcontent"><?=addslashes($hebergement)?></span></p><p><span class="plabel"><i class="fa fa-group icon"></i> :</span> <span class="pcontent"><?=count($inscriptions)?> <?=(count($inscriptions) > 1)?"enfants":"enfant";?> inscrits (sur <?=$max?>) <?=($opt > 0)?"<br /> dont ".$opt." option(s)":"";?> </span></p><p><span class="plabel"><i class="fa fa-tag icon"></i> :</span> <span class="pcontent"><?=$sejour->price?> €/<small><?=$stay_kind?></small></span></p>'

                }<?=($i < $nb_sejours) ? ',' : '' ; ?>

                <?php endif; ?>

                <?php endforeach; ?>

            ]
        }],
        eventRender: function (event, element) {
            element.popover({
                title: event.title,
                placement: 'top',
                trigger: 'hover',
                container: '.tb-calendar',
                html: 'true',
                content: event.description
            });
        }

    });
});
</script>
<?php $scripts .= ob_get_contents();
ob_end_clean(); ?>

<hr>





<div class="tab-container">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#present">A venir</a></li>
        <li class=""><a href="#past">Achevés</a></li>
    </ul>
    <div class="tab-content tb-special">
        <div id="present" class="tab-pane cont active">
            <div class="table-responsive">
                <table id="datatable-present" class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 200px;">Nom</th>
                            <th>Date de début</th>
                            <th>Date de fin</th>
                            <th>Lieu</th>
                            <th>Nb enfants</th>
                            <th>Capacité min</th>
                            <th>Capacité max</th>
                            <th>Tarif (€)</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $the_json = array();

                        $sejours = sejour::getListFuturSejour();
                        $the_datas = array();

                        foreach($sejours as $key => $sejour) {
                            $inscriptions = inscription::getBySejour($sejour->id);

                            $popup = '
                            <ul class="dropdown-menu">
                                <li><a href="/sejours/infos/id/'.$sejour->id.'" class="item"><i class="fa fa-share"></i> Voir la fiche</a></li>
                                <li><a href="/sejours/editer/id/'.$sejour->id.'" class="item"><i class="fa fa-edit"></i> Modifier</a></li>
                                <li><a href="#" class="modal-remove-link" data-id="'.$sejour->id.'" data-name="'.$sejour->name.'" data-toggle="modal" data-target="#modal-remove" class="item"><i class="fa fa-remove"></i> Supprimer</a></li>
                            </ul>';

                            $date_from = new DateTime($sejour->date_from);
                            if($date_from->getTimestamp() != '-62169987600') {
                                $date_from = '<span class="sr-only">'.strftime("%Y%m%d", $date_from->getTimestamp()).'</span> '.strftime("%d %B %Y", $date_from->getTimestamp());
                            }

                            $date_to = new DateTime($sejour->date_to);
                            if($date_to->getTimestamp() != '-62169987600') {
                                $date_to = '<span class="sr-only">'.strftime("%Y%m%d", $date_to->getTimestamp()).'</span> '.strftime("%d %B %Y", $date_to->getTimestamp());
                            }

                            if($sejour->ref_hebergement) {
                                $hebergement = hebergement::get($sejour->ref_hebergement);
                                $hebergement = '<a href="/hebergements/infos/id/'.$hebergement->id.'"><span class="label label-default">'.$hebergement->name.'</span></a>';
                            }else {
                                $hebergement = EMPTYVAL;
                            }

                            $the_data = [
                            '<a href="/sejours/infos/id/'.$sejour->id.'">'.$sejour->name.'</a>'.$popup,
                            $date_from,
                            $date_to,
                            $hebergement,
                            count($inscriptions),
                            '<span class="label label-default">'.$sejour->capacity_min.'</span>',
                            '<span class="label label-default">'.$sejour->capacity_max.'</span>',
                            '<span class="label label-info">'.$sejour->price.'€</span>'
                            ];

                            array_push($the_datas, $the_data);
                        }
                        array_push($the_json, $the_datas);
                        ?>

                    </tbody>
                </table>
                <?php ob_start(); ?>
                <script>
                var the_future_datas = [];
                <?php foreach ($the_json as $key => $value): ?>
                the_future_datas.push(<?=json_encode($the_json[$key]);?>);
                <?php endforeach; ?>

                $('#datatable-present').dataTable({
                    "bProcessing": true,
                    "bDeferRender": true,
                    "bStateSave": true,
                    "aaData":   the_future_datas[0]
                });
                </script>
                </script>
                <?php $scripts .= ob_get_contents();
                ob_end_clean(); ?>
            </div>
        </div>
        <div id="past" class="tab-pane">
            <div class="table-responsive">
                <table class="table table-bordered" id="datatable-past">
                    <thead>
                        <tr>
                            <th style="width: 200px;">Nom</th>
                            <th>Date de début</th>
                            <th>Date de fin</th>
                            <th>Lieu</th>
                            <th>Nb enfants</th>
                            <th>Capacité min</th>
                            <th>Capacité max</th>
                            <th>Tarif (€)</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        unset($the_datas);
                        unset($the_json);


                        $the_datas = array();
                        $the_json = array();
                        
                        $past_sejours = sejour::getListPastSejour();

                        foreach($past_sejours as $key => $past_sejour) {
                            $inscriptions = inscription::getBySejour($past_sejour->id);

                            $popup = '
                            <ul class="dropdown-menu">
                                <li><a href="/sejours/infos/id/'.$past_sejour->id.'" class="item"><i class="fa fa-share"></i> Voir la fiche</a></li>
                                <li><a href="/sejours/editer/id/'.$past_sejour->id.'" class="item"><i class="fa fa-edit"></i> Modifier</a></li>
                                <li><a href="#" class="modal-remove-link" data-id="'.$past_sejour->id.'" data-name="'.$past_sejour->name.'" data-toggle="modal" data-target="#modal-remove" class="item"><i class="fa fa-remove"></i> Supprimer</a></li>
                            </ul>';
                            
                            $date_from = new DateTime($past_sejour->date_from);
                            if($date_from->getTimestamp() != '-62169987600') {
                                $date_from = '<span class="sr-only">'.strftime('%Y%m%d', $date_from->getTimestamp()).'</span> '.strftime('%d %B %Y', $date_from->getTimestamp());
                            }

                            $date_to = new DateTime($past_sejour->date_to);
                            if($date_to->getTimestamp() != '-62169987600') {
                                $date_to = '<span class="sr-only">'.strftime('%Y%m%d', $date_to->getTimestamp()).'</span> '.strftime('%d %B %Y', $date_to->getTimestamp());
                            }

                            if($past_sejour->ref_hebergement) {
                                $hebergement = hebergement::get($past_sejour->ref_hebergement);
                                $hebergement = '<a href="/hebergements/infos/id/'.$hebergement->id.'"><span class="label label-default">'.$hebergement->name.'</span></a>';
                            }else {
                                $hebergement = EMPTYVAL;
                            }

                            $the_data = [
                            '<a href="/sejours/infos/id/'.$past_sejour->id.'">'.$past_sejour->name.'</a>'.$popup,
                            $date_from,
                            $date_to,
                            $hebergement,
                            count($inscriptions),
                            '<span class="label label-default">'.$past_sejour->capacity_min.'</span>',
                            '<span class="label label-default">'.$past_sejour->capacity_max.'</span>',
                            '<span class="label label-info">'.$past_sejour->price.'€</span>'
                            ];

                            array_push($the_datas, $the_data);
                        }
                        array_push($the_json, $the_datas);
                        ?>

                    </tbody>
                </table>
                <?php ob_start(); ?>
                <script>
                var the_past_datas = [];
                <?php foreach ($the_json as $key => $value): ?>
                the_past_datas.push(<?=json_encode($the_json[$key]);?>);
                <?php endforeach; ?>

                $('#datatable-past').dataTable({
                    "bProcessing": true,
                    "bDeferRender": true,
                    "bStateSave": true,
                    "aaData":   the_past_datas[0]
                });
                </script>
                <?php $scripts .= ob_get_contents();
                ob_end_clean(); ?>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal-remove" tabindex="-1" role="dialog" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <div class="i-circle warning"><i class="fa fa-warning"></i></div>
                    <h4>Attention !</h4>
                    <p>
                        Vous êtes sur le point de supprimer le séjour <strong id="remove-name">Nom prénom</strong>.<br>
                        Êtes-vous sur de vouloir effectuer cette opération ?
                    </p>
                </div>
            </div>
            <div class="modal-footer">
                <form id="form-remove-children" action="/sejours" method="post">
                    <a href="#" class="btn btn-default btn-flat" data-dismiss="modal">Annuler</a>
                    <input id="remove-id" type="hidden" name="id" value="21">
                    <input type="hidden" name="action" value="supprimer">
                    <input type="hidden" name="confirm" value="true">
                    <input type="submit" class="btn btn-warning btn-flat" value="Supprimer la fiche">
                </form>
            </div>
        </div>
    </div>
</div>




<?php ob_start(); ?>
<script>
$(function () {
    $('.nav-tabs a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    });
    $('.dropdown-menu').on('click', '.modal-remove-link', function(event) {
        event.preventDefault();
        /* Act on the event */
        var $modal = $('#modal-remove'),
            that = $(this),
            _id = that.data('id'),
            _name = that.data('name');

        $modal.find('#remove-id').attr('value', _id);
        $modal.find('#remove-name').html(_name);
    });
});
</script>
<?php $scripts .= ob_get_contents();
ob_end_clean(); ?>

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>