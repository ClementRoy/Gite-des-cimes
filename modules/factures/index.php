<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>

<?php 

    $year = $_GET['annee'];
    /*
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

     */
    // Question comment on gère les inscriptions qui n'ont pas de centre payeur ?

    $seasons = saison::getListAll();

    // echo '<ul>';
    // foreach ($seasons as $key => $season) {
    //     echo '<li>'.$season->name.' - '.$year;
    //     echo '<ul>';
    //     $structures = structure::getPayerStructuresBySeason($season->id, $year);
    //     foreach ($structures as $structure_key => $structure) {
    //         echo '<li>';
    //         echo '<a href="/factures/infos/annee/'.$year.'/season/'.$season->id.'/structure/'.$structure->id.'">'.$structure->name.'</a>';
    //         echo '</li>';
    //     }
    //     echo '</ul>';
    //     echo '</li>';

    // }
    // $structures = getPayerStructureByWeekend($year);
    //  echo '<li>Week-ends - '.$year;
    //   echo '<ul>';
    //     foreach ($structures as $key => $structure) {
    //         echo '<li>';
    //         echo '<a href="/factures/infos/annee/'.$year.'/season/'.$name.'/structure/'.$structure->id.'">'.$structure->name.'</a>';
    //         echo '</li>';
    //     }
    //   echo '</ul>';
    //  echo '</li>';

    // echo '</ul>';

?>

<div class="page-head">
    <div class="row">
        <div class="col-md-8">
            <h1>Facturations</h1>
        </div>
        <div class="col-md-4 text-right hidden-xs hiden-sm">
            <a href="/factures/debug/annee/2016/"><i class="fa fa-cog"></i></a>
        </div>
    </div>
</div>

<div class="block-flat tb-special">
    <div class="content">
        <div class="table-responsive">
            <table class="table table-bordered" id="datatable">
                <thead>
                    <tr>
                        <th><strong>Saison - Organisme</strong></th>
                        <th style="width: 80px;"><strong>Statut</strong></th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                        $the_json = array();
                        $the_datas = array();

                        $seasons = saison::getListAll();

                        foreach ($seasons as $key => $season) {
                            $structures = structure::getPayerStructuresBySeason($season->id, $year);
                            foreach ($structures as $structure_key => $structure) {

                                $factures = facture::getByStructureAndSeason($structure->id, $season->id, $year);




                                $enfants = facture::getInscriptionsByStructureAndSeason($structure->id, $season->id, $year);
                                $alreadyFactured = facture::getAlreadyFactured($structure->id, $season->id, $year);

                                $status_str = '<span class="label label-warning">À facturer</span>';
                                $nb_factured = 0;
                                $nb_inscriptions = 0;
                                $global_status = 0;

                                foreach ($enfants as $enfant) {

                                    $inscriptions = facture::getInscriptionByChildBySeason($enfant->id, $season->id, $year );
                                    $nb_inscriptions = $nb_inscriptions + count($inscriptions) ;

                                    foreach ($inscriptions as $key => $inscription) {

                                        if (in_array($inscription->id, $alreadyFactured)) {
                                            $nb_factured++;
                                        }

                                        $factureItem = facture_item::getByInscription($inscription->id);
                                        if ( !empty($factureItem) ) {

                                            $facture_inscription = facture::get( $factureItem->ref_facture );

                                            if ($facture_inscription->status > 0 ) {
                                                if ( $facture_inscription->amount_caf > 0 ) {
                                                    if ($facture_inscription->status_caf > 0) {
                                                        $global_status = 1;
                                                    } else {
                                                        $global_status = 0;
                                                    }
                                                } else {
                                                    $global_status = 1;
                                                }
                                            } else {
                                                $global_status = 0;
                                            }
                                        }


                                    }

                                }

                                if ( $nb_factured == $nb_inscriptions && $global_status > 0 ) {
                                    $status_str = '<span class="label label-success">Payé en totalité</span>';
                                } elseif ( ($nb_factured < $nb_inscriptions && $nb_factured > 0) || ($nb_factured == $nb_inscriptions && $global_status == 0) ) {
                                    $status_str = '<span class="label label-primary">Facturé/payé partiellement</span>';
                                }



                                $factures_str = '';
                                foreach ($factures as $key => $facture) {
                                    $factures_str .= $facture->number.' ';
                                }

                                $the_data = ['
                                    <a href="/factures/infos/annee/'.$year.'/season/'.$season->id.'/structure/'.$structure->id.'">'.$season->name. ' ' .$year.' - '.$structure->name.'</a> <span class="hide">' . $factures_str . '</span>',
                                    $status_str,
                                ];
                                array_push($the_datas, $the_data);

                            }
                        }
                        array_push($the_json, $the_datas);
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>



<?php ob_start(); ?>
<script>
var the_datas = [];
the_datas.push(<?=json_encode($the_datas);?>);

$('#datatable').dataTable({
    "bProcessing": true,
    "bDeferRender": true,
    "bStateSave": true,
    "iDisplayLength": 100,
    "aaData":   the_datas[0],
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
</script>
<?php $scripts .= ob_get_contents();
ob_end_clean(); ?>

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>