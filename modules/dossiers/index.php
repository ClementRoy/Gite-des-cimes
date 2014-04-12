<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>

<?php dossier::cleanEmpty(); ?>

<div class="title">
    <div class="row header">
        <div class="col-md-6">
            <h1>Les dossiers d'inscription</h1>
        </div>
        <div class="col-md-6 text-right">
            <a href="/dossiers/ajouter" class="btn btn-primary">
                <span>+</span>Ajouter une inscription
            </a>
        </div>
    </div>
</div>

<div class="content content-table">
    <div class="row">
        <div class="col-md-12">

            <table class="datatable">
                <thead>
                    <tr>
                        <th class="sortable" style="width: 65px;">N°</th>
                        <th class="sortable" style="width: 270px;">Nom de l'enfant</th>
                        <th class="sortable">Séjour</th>
                        <th class="sortable" style="width: 10%;">Satut</th>
                        <th class="sortable" style="width: 12%;">Pris en charge</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $the_json = array();

                    $dossiers = dossier::getList(); 
                    $the_datas = array();
                    foreach($dossiers as $key => $dossier) {
                        $enfant = enfant::get($dossier->ref_enfant);
                        $inscriptions_dossier = inscription::getByDossier($dossier->id);

                        $popup = '
                        <div class="pop-dialog tr">
                            <div class="pointer">
                                <div class="arrow"></div>
                                <div class="arrow_border"></div>
                            </div>
                            <div class="body">
                                <div class="menu">
                                    <a href="/dossiers/infos/id/'.$dossier->id.'" class="item"><i class="icon-share"></i> Voir le dossier</a>
                                    <a href="/dossiers/editer/id/'.$dossier->id.'" class="item"><i class="icon-edit"></i> Modifier</a>
                                    <a href="/dossiers/supprimer/id/'.$dossier->id.'" class="item"><i class="icon-remove"></i> Supprimer</a>
                                </div>
                            </div>
                        </div>';

                        $sejours = '';
                        $i = 0;
                        $l = count($inscriptions_dossier);

                        foreach($inscriptions_dossier as $inscription_dossier) {

                            $sejour = sejour::get($inscription_dossier->ref_sejour);
                            $sejours .= '<strong>'.$sejour->name.'</strong>';
                            $sejours .= ' du ';

                            $date_from = new DateTime($inscription_dossier->date_from);

                            if($date_from->getTimestamp() != '-62169987600') {
                                $sejours .= strftime('%d %b %Y', $date_from->getTimestamp());
                            }
                            $sejours .= ' au ';
                            $date_to = new DateTime($inscription_dossier->date_to);
                            if($date_to->getTimestamp() != '-62169987600') {

                                $sejours .= strftime('%d %b %Y', $date_to->getTimestamp());
                            }
                                $i++;
                            
                            if ($i < $l) {
                                $sejours .= ' &nbsp;&#10141;&nbsp; ';
                            }


                        }

                        $finished = '';
                        if($dossier->finished){
                            $finished = '<span class="label label-success">Confirmé</span>';
                        } else {

                            $finished = '<span class="label label-danger">Non confirmé</span>';
                        }


                        $supported = '';
                        if($dossier->supported) {
                            $supported = '<span class="label label-success">Oui</span>';
                        } else {
                            $supported = '<span class="label label-danger">Non</span>';
                        }



                        $the_data = [
                        '<a href="/dossiers/infos/id/'.$dossier->id.'">#'.$dossier->id.'</a>',
                        '<a href="/enfants/infos/id/'.$enfant->id.'">'.$enfant->lastname.' '.$enfant->firstname.'</a>',
                        $sejours,
                        $finished,
                        $supported
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

<script>
    var the_datas = [];
    <?php foreach ($the_json as $key => $value): ?>
    the_datas.push(<?=json_encode($the_json[$key]);?>);
    <?php endforeach; ?>
</script>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>