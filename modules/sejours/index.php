<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>


<?php sejour::cleanEmpty(); ?>


<div class="title">
    <div class="row header">
        <div class="col-md-4">
         <h1>Les séjours</h1>
     </div>
     <div class="col-md-8 text-right">
      <a href="/sejours/ajouter" class="btn btn-primary"><span>+</span>
        Ajouter un séjour</a>
    </div>
</div>
</div>

<div class="content">
    <div class="row">
        <div class="col-md-12">


            <div id='calendar'>

            </div>




        </div>
    </div>                
</div>

<?php $sejours = sejour::getList(); ?>
<?php $nb_sejours = count($sejours); ?>
<?php $i = 0; ?>

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
                    description : '<p><span class="plabel"><i class="icon-calendar icon"></i> :</span> <span class="pcontent"><?=$date_from2?> au <?=$date_to2?></span></p><p><span class="plabel"><i class="icon-map-marker icon"></i> :</span> <span class="pcontent"><?=addslashes($hebergement)?></span></p><p><span class="plabel"><i class="icon-group icon"></i> :</span> <span class="pcontent"><?=count($inscriptions)?> <?=(count($inscriptions) > 1)?"enfants":"enfant";?> inscrits (sur <?=$max?>) <?=($opt > 0)?"<br /> dont ".$opt." option(s)":"";?> </span></p><p><span class="plabel"><i class="icon-tag icon"></i> :</span> <span class="pcontent"><?=$sejour->price?> €/<small><?=$stay_kind?></small></span></p>'

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
            description : '<p><span class="plabel"><i class="icon-calendar icon"></i> :</span> <span class="pcontent"><?=$date_from2?> au <?=$date_to2?></span></p><p><span class="plabel"><i class="icon-map-marker icon"></i> :</span> <span class="pcontent"><?=addslashes($hebergement)?></span></p><p><span class="plabel"><i class="icon-group icon"></i> :</span> <span class="pcontent"><?=count($inscriptions)?> <?=(count($inscriptions) > 1)?"enfants":"enfant";?> inscrits (sur <?=$max?>) <?=($opt > 0)?"<br /> dont ".$opt." option(s)":"";?> </span></p><p><span class="plabel"><i class="icon-tag icon"></i> :</span> <span class="pcontent"><?=$sejour->price?> €/<small><?=$stay_kind?></small></span></p>'

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
        container: '.wrapper',
        html: 'true',
        content: event.description
    });
}

});
});
</script>
<hr>

<ul class="nav nav-tabs">
  <li class="active"><a href="#present">A venir</a></li>
  <li class=""><a href="#past">Achevés</a></li>
</ul>
<div class="content content-table">
   <div class="row">
    <div class="col-md-12">

        <div class="tab-content">
            <div class="tab-pane active" id="present">

                <table class="datatable" data-sort="1">
                    <thead>
                        <tr>
                            <th>Nom</th>
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
                            <div class="pop-dialog tr">
                                <div class="pointer">
                                    <div class="arrow"></div>
                                    <div class="arrow_border"></div>
                                </div>
                                <div class="body">
                                    <div class="menu">
                                        <a href="/sejours/infos/id/<?=$sejour->id; ?>" class="item"><i class="icon-share"></i> Voir la fiche</a>
                                        <a href="/sejours/editer/id/<?=$sejour->id; ?>" class="item"><i class="icon-edit"></i> Modifier</a>
                                        <a href="/sejours/supprimer/id/<?=$sejour->id; ?>" class="item"><i class="icon-remove"></i> Supprimer</a>
                                    </div>
                                </div>
                            </div>';

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

            </div>

            <div class="tab-pane" id="past">

                <table class="datatable" data-sort="0">
                    <thead>
                        <tr>
                            <th>Nom</th>
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

                        $sejours = sejour::getListPastSejour();
                        unset($the_datas);
                        $the_datas = array();

                        foreach($sejours as $key => $sejour) {
                            $inscriptions = inscription::getBySejour($sejour->id);

                            $popup = '
                            <div class="pop-dialog tr">
                                <div class="pointer">
                                    <div class="arrow"></div>
                                    <div class="arrow_border"></div>
                                </div>
                                <div class="body">
                                    <div class="menu">
                                        <a href="/sejours/infos/id/<?=$sejour->id; ?>" class="item"><i class="icon-share"></i> Voir la fiche</a>
                                        <a href="/sejours/editer/id/<?=$sejour->id; ?>" class="item"><i class="icon-edit"></i> Modifier</a>
                                        <a href="/sejours/supprimer/id/<?=$sejour->id; ?>" class="item"><i class="icon-remove"></i> Supprimer</a>
                                    </div>
                                </div>
                            </div> ';

                            $date_from = new DateTime($sejour->date_from);
                            if($date_from->getTimestamp() != '-62169987600') {
                                $date_from = '<span class="sr-only">'.strftime('%Y%m%d', $date_from->getTimestamp()).'</span> '.strftime('%d %B %Y', $date_from->getTimestamp());
                            }

                            $date_to = new DateTime($sejour->date_to);
                            if($date_to->getTimestamp() != '-62169987600') {
                                $date_to = '<span class="sr-only">'.strftime('%Y%m%d', $date_to->getTimestamp()).'</span> '.strftime('%d %B %Y', $date_to->getTimestamp());
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
            </div>

        </div>
    </div>                
</div>

<script>
    var the_datas = [];
    <?php foreach ($the_json as $key => $value): ?>
    the_datas.push(<?=json_encode($the_json[$key]);?>);
<?php endforeach; ?>

$(function () {
    $('.nav-tabs a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    });
});
</script>

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>