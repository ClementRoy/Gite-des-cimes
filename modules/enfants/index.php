<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>


<?php enfant::cleanEmpty(); ?>


<div class="title">
    <div class="row header">
        <div class="col-md-4">
            <h1>Les enfants</h1>
        </div>
        <div class="col-md-8 text-right">
            <a href="/enfants/ajouter" class="btn btn-primary"><span>+</span>
                Ajouter un enfant</a>
            </div>
        </div>
    </div>
    <div class="content content-table">
        <div class="row">
            <div class="col-md-12">
             <table class="datatable" data-sort="1" data-searchable="false" data-paginate="false">
                <thead>
                    <tr>
                        <th tabindex="0" rowspan="1" colspan="1">Nom</th>
                        <th tabindex="0" rowspan="1" colspan="1">Prénom</th>
                        <th tabindex="0" rowspan="1" colspan="1">Sexe</th>
                        <th tabindex="0" rowspan="1" colspan="1">Date de naissance</th>
                        <th tabindex="0" rowspan="1" colspan="1">Age</th>
                        <th tabindex="0" rowspan="1" colspan="1">Statut de la fiche</th>
                        <th tabindex="0" rowspan="1" colspan="1">Droit à l'image</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>                
    </div>
</div>

<?php 
$the_json = array();

$enfants = enfant::getDisplayedList(); 
$the_datas = array();
foreach($enfants as $key => $enfant) {

    $popup = '
    <div class="pop-dialog tr">
        <div class="pointer">
            <div class="arrow"></div>
            <div class="arrow_border"></div>
        </div>
        <div class="body">
            <div class="menu">
                <a href="/enfants/infos/id/'.$enfant->id.'" class="item"><i class="icon-share"></i> Voir la fiche</a>
                <a href="/enfants/editer/id/'.$enfant->id.'" class="item"><i class="icon-edit"></i> Modifier</a>
                <a href="/enfants/supprimer/id/'.$enfant->id.'" class="item"><i class="icon-remove"></i> Supprimer</a>
            </div>
        </div>
    </div>';

    if( $enfant->number_ss != 0 && $enfant->self_assurance > 0 && $enfant->cpam_attestation > 0 && !empty($enfant->self_assurance_expiration_date) && $enfant->health_record > 0 && $enfant->vaccination > 0 ) {
        $complete = '<span class="label label-success">Complète</span>';
    } else {
        $complete = '<span class="label label-warning">Incomplète</span>';
    }

    $birthdate = new DateTime($enfant->birthdate); 

    if($birthdate->getTimestamp() != '-62169984561') {
        $birth = strftime('%d %B %Y', $birthdate->getTimestamp());
    } else {
        $birth = EMPTYVAL;
    }

    if($birthdate->getTimestamp() != '-62169984561') {
        $age = tool::getAgeFromDate($enfant->birthdate);
        $age .= ' ans';
    } else {
        $age = EMPTYVAL;
    }
    $sex = '';
    if($enfant->sex == 'féminin') {
        $sex = '<i class="icon-female"></i> Féminin';
    } else {
        $sex = '<i class="icon-male"></i> Masculin';
    }

    $image_rights = '';
    if($enfant->image_rights == 1) {
        $image_rights = '<span class="label label-success">Oui</span>';
    } elseif($enfant->image_rights == 2) {
        $image_rights = '<span class="label label-warning">Non</span>';
    } else {
        $image_rights = EMPTYVAL;
    }


    $the_data = ['
    <a href="/enfants/infos/id/'.$enfant->id.'">'.$enfant->lastname.'</a>'.$popup,
    '<a href="/enfants/infos/id/'.$enfant->id.'">'.$enfant->firstname.'</a>',
    $sex,
    $birth,
    $age,
    $complete,
    $image_rights
    ];
    array_push($the_datas, $the_data);
}
array_push($the_json, $the_datas);
?>

<script>
    var the_datas = [];
    <?php foreach ($the_json as $key => $value): ?>
    the_datas.push(<?=json_encode($the_json[$key]);?>);
    <?php endforeach; ?>
</script>

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>