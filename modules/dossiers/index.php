<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>

<?php dossier::cleanEmpty(); ?>

<div class="page-head">
    <div class="row">
        <div class="col-md-8">
            <h1>Les dossiers d'inscription</h1>
        </div>
        <div class="col-md-4 text-right">
            <a href="/dossiers/ajouter" class="btn btn-primary btn-rad">Ajouter une inscription</a>
        </div>
    </div>
</div>

<?php if (isset($_POST['id']) && $_POST['action'] == 'supprimer' && $_POST['confirm'] == true): ?>
    <?php $dossier = dossier::get($_POST['id']); ?>
    <?php tool::alert('success', 'Le dossier d\'inscription <strong>n°'.$dossier->id.'</strong> a bien été supprimée !') ?>
    <?php dossier::remove($_POST['id']); ?>
<?php endif; ?>




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
                        <tr>
                            <th class="sortable" style="width: 65px;">N°</th>
                            <th class="sortable" style="width: 270px;">Nom de l'enfant</th>
                            <th class="sortable">Séjour(s)</th>
                            <th class="sortable" width="155" style="width:155px;">Statut</th>
                            <th class="sortable" width="155" style="width:155px;">Prise en charge</th>
                            <th class="sortable" width="180" style="width:180px;">Modifié le</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $the_json = array();

                            $dossiers = dossier::getListPresent(); 

                            // On tri les inscriptions de la plus récement modifiées à la plus ancienne
                            $dossiers = tool::array_sort($dossiers, 'edited', SORT_DESC);
                            //tool::output($dossiers);
                            $the_datas = array();

                            foreach($dossiers as $key => $dossier) {
                                $enfant = enfant::get($dossier->dossier_ref_enfant);
                                $inscriptions_dossier = inscription::getByDossier($dossier->dossier_id);

                                $popup = '
                                <ul class="dropdown-menu">
                                    <li><a href="/dossiers/infos/id/'.$dossier->dossier_id.'" class="item"><i class="fa fa-share"></i> Voir la fiche</a></li>
                                    <li><a href="/dossiers/editer/id/'.$dossier->dossier_id.'" class="item"><i class="fa fa-edit"></i> Modifier</a></li>
                                    <li><a href="#" class="modal-remove-link" data-id="'.$dossier->dossier_id.'" data-name="'.$enfant->firstname.' '.$enfant->lastname.'" data-toggle="modal" data-target="#modal-remove" class="item"><i class="fa fa-remove"></i> Supprimer</a></li>
                                </ul>';

                                $last_inscription = end($inscriptions_dossier);
                                if ($last_inscription != '') {
                                    $sejours = '<span class="hide">'.$last_inscription->date_to.'</span>';
                                } else {
                                    $sejours = '';
                                }

                                $i = 0;
                                $l = count($inscriptions_dossier);

                                $sejours .= '<ul class="list-unstyled">';
                                foreach($inscriptions_dossier as $inscription_dossier) {

                                    $sejour = sejour::get($inscription_dossier->ref_sejour);
                                    $sejours .= '<li><a href="/sejours/infos/id/'.$sejour->id.'"><strong>'.$sejour->name.'</strong></a>';
                                    $sejours .= ' du ';

                                    $date_from = new DateTime($inscription_dossier->date_from);

                                    if ($date_from->getTimestamp() != '-62169987600') {
                                        $sejours .= strftime('%d', $date_from->getTimestamp());
                                    }
                                    $sejours .= ' au ';
                                    $date_to = new DateTime($inscription_dossier->date_to);
                                    if ($date_to->getTimestamp() != '-62169987600') {

                                        $sejours .= strftime('%d %B %Y', $date_to->getTimestamp());
                                        $sejours .= '</li>';
                                    }
                                    $i++;

                                    if ($i < $l) {
                                        // $sejours .= ' <br> ';
                                        // $sejours .= ' &nbsp;&#10141;&nbsp; ';
                                    }
                                }
                                $sejours .= '</ul>';

                                $finished = '';
                                if ($dossier->finished) {
                                    $finished = '<span class="label label-success">Confirmé</span>';
                                } else {

                                    $finished = '<span class="label label-warning">Non confirmé</span>';
                                }


                                $supported = '';
                                if ($dossier->supported) {
                                    $supported = '<span class="label label-success">Oui</span>';
                                } else {
                                    $supported = '<span class="label label-warning">Non</span>';
                                }

                                $edited = '<span class="hide">'.$dossier->edited.'</span>';
                                $edited_date = new DateTime($dossier->edited);
                                if ($edited_date->getTimestamp() != '-62169987600') {
                                    $edited .= strftime('%d/%m/%Y à %Hh%M', $edited_date->getTimestamp());
                                } else {
                                    $edited .= '';
                                }

                                $the_data = [
                                    '<a href="/dossiers/infos/id/'.$dossier->dossier_id.'">#'.$dossier->dossier_id.'</a>',
                                    '<a href="/enfants/infos/id/'.$enfant->id.'">'.$enfant->lastname.' '.$enfant->firstname.'</a>'.$popup,
                                    $sejours,
                                    $finished,
                                    $supported,
                                    $edited
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
                            <th class="sortable" style="width: 65px;">N°</th>
                            <th class="sortable" style="width: 270px;">Nom de l'enfant</th>
                            <th class="sortable">Séjour(s)</th>
                            <th class="sortable" width="170" style="width:170px;">Statut</th>
                            <th class="sortable" width="170" style="width:170px;">Pris en charge</th>
                            <th class="sortable" width="200" style="width:200px;">Modifié le</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                            $the_json_past = array();
                            $dossiers_past = dossier::getListPast(); 
                            $the_datas = array();
                            foreach($dossiers_past as $key => $dossier) {
                                $enfant = enfant::get($dossier->dossier_ref_enfant);
                                $inscriptions_dossier = inscription::getByDossier($dossier->dossier_id);

                                $popup = '
                                <ul class="dropdown-menu">
                                    <li><a href="/dossiers/infos/id/'.$dossier->dossier_id.'" class="item"><i class="fa fa-share"></i> Voir la fiche</a></li>
                                    <li><a href="/dossiers/editer/id/'.$dossier->dossier_id.'" class="item"><i class="fa fa-edit"></i> Modifier</a></li>
                                    <li><a href="#" class="modal-remove-link" data-id="'.$dossier->dossier_id.'" data-name="'.$dossier->dossier_id.'" data-toggle="modal" data-target="#modal-remove" class="item"><i class="fa fa-remove"></i> Supprimer</a></li>
                                </ul>';
                                
                                $last_inscription = end($inscriptions_dossier);
                                if ($last_inscription != '') {
                                    $sejours = '<span class="hide">'.$last_inscription->date_to.'</span>';
                                } else {
                                    $sejours = '';
                                }

                                $i = 0;
                                $l = count($inscriptions_dossier);


                                $sejours .= '<ul class="list-unstyled">';
                                foreach($inscriptions_dossier as $inscription_dossier) {

                                    $sejour = sejour::get($inscription_dossier->ref_sejour);
                                    $sejours .= '<li><a href="/sejours/infos/id/'.$sejour->id.'"><strong>'.$sejour->name.'</strong></a>';
                                    $sejours .= ' du ';

                                    $date_from = new DateTime($inscription_dossier->date_from);

                                    if ($date_from->getTimestamp() != '-62169987600') {
                                        $sejours .= strftime('%d', $date_from->getTimestamp());
                                    }
                                    $sejours .= ' au ';
                                    $date_to = new DateTime($inscription_dossier->date_to);
                                    if ($date_to->getTimestamp() != '-62169987600') {

                                        $sejours .= strftime('%d %B %Y', $date_to->getTimestamp());
                                    }
                                    $i++;

                                    if ($i < $l) {
                                        // $sejours .= ' <br> ';
                                        // $sejours .= ' &nbsp;&#10141;&nbsp; ';
                                    }
                                    $sejours .= '</li>';
                                }
                                $sejours .= '</ul>';


                                $finished = '';
                                if ($dossier->finished) {
                                    $finished = '<span class="label label-success">Confirmé</span>';
                                } else {

                                    $finished = '<span class="label label-warning">Non confirmé</span>';
                                }


                                $supported = '';
                                if ($dossier->supported) {
                                    $supported = '<span class="label label-success">Oui</span>';
                                } else {
                                    $supported = '<span class="label label-warning">Non</span>';
                                }


                                $edited = '<span class="hide">'.$dossier->edited.'</span>';
                                $edited_date = new DateTime($dossier->edited);
                                if ($edited_date->getTimestamp() != '-62169987600') {
                                    $edited .= strftime('%d/%m/%Y à %Hh%M', $edited_date->getTimestamp());
                                } else {
                                    $edited .= '';
                                }

                                $the_data = [
                                    '<a href="/dossiers/infos/id/'.$dossier->dossier_id.'">#'.$dossier->dossier_id.'</a>',
                                    '<a href="/enfants/infos/id/'.$enfant->id.'">'.$enfant->lastname.' '.$enfant->firstname.'</a>'.$popup,
                                    $sejours,
                                    $finished,
                                    $supported,
                                    $edited
                                ];
                                array_push($the_datas, $the_data);
                            }
                            array_push($the_json_past, $the_datas);
                        ?>
                    </tbody>

                </table>
                <?php ob_start(); ?>
                <script>
                var the_past_datas = [];
                <?php foreach ($the_json_past as $key => $value): ?>
                    the_past_datas.push(<?=json_encode($the_json_past[$key]);?>);
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
                        Vous êtes sur le point de supprimer le dossier d'inscription <strong>n°<span id="remove-id-2"></span></strong><br> concernant <strong id="remove-name"></strong>.<br>
                        Êtes-vous sur de vouloir effectuer cette opération ?
                    </p>
                </div>
            </div>
            <div class="modal-footer">
                <form id="form-remove-dossier" action="/dossiers" method="post">
                    <a href="#" class="btn btn-default btn-flat" data-dismiss="modal">Annuler</a>
                    <input id="remove-id" type="hidden" name="id" value="0">
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
    $('.dropdown-menu').on('click', '.modal-remove-link', function(event) {
        event.preventDefault();
        /* Act on the event */
        var $modal = $('#modal-remove'),
            that = $(this),
            _id = that.data('id'),
            _name = that.data('name');

        $modal.find('#remove-id').attr('value', _id);
        $modal.find('#remove-id-2').html(_id);
        $modal.find('#remove-name').html(_name);
    });
});
</script>
<?php $scripts .= ob_get_contents();
ob_end_clean(); ?>

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>