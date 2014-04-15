<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>


<?php sejour::cleanEmpty(); ?>



<?php //tool::output($sejours); ?>


<div class="title">
    <div class="row header">
        <div class="col-md-4">
           <h1>Les séjours</h1>
           <ul class="nav nav-tabs">
              <li class="active"><a href="#present">A venir</a></li>
              <li class=""><a href="#past">Achevés</a></li>
          </ul>

      </div>
      <div class="col-md-8 text-right">
          <a href="/sejours/ajouter" class="btn btn-primary"><span>+</span>
            Ajouter un séjour</a>
        </div>
    </div>
</div>

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