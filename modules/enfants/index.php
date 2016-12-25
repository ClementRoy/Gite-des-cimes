<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
<?php enfant::cleanEmpty(); ?>


<div class="page-head">
    <div class="row">
        <div class="col-md-8">
            <h1>Les enfants</h1>
        </div>
        <div class="col-md-4 text-right">
            <a href="/enfants/ajouter" class="btn btn-primary btn-rad">Ajouter un enfant</a>
        </div>
    </div>
</div>

<?php if (isset($_POST['id']) && $_POST['action'] == 'supprimer' && $_POST['confirm'] == true): ?>
    <?php $enfant = enfant::get($_POST['id']); ?>

    <?php tpl::alert('success', 'La fiche de <strong>'.$enfant->firstname.' '.$enfant->lastname.'</strong> a bien été supprimée !'); ?>

    <?php enfant::remove($_POST['id']); ?>
<?php endif; ?>

<div class="block-flat tb-special">
    <div class="content">
        <div class="table-responsive">
            <table class="table table-bordered" id="datatable">
                <thead>
                    <tr>
                        <th style="width: 200px;"><strong>Nom</strong></th>
                        <th><strong>Prénom</strong></th>
                        <th><strong>Sexe</strong></th>
                        <th><strong>Date de naissance</strong></th>
                        <th><strong>Age</strong></th>
                        <th style="width: 80px;"><strong>Statut</strong></th>
                        <th style="width: 160px;"><strong>Droit à l'image</strong></th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
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
                        Vous êtes sur le point de supprimer la fiche de <strong id="remove-name">Nom prénom</strong>.<br>
                        Êtes-vous sur de vouloir effectuer cette opération ?
                    </p>
                </div>
            </div>
            <div class="modal-footer">
                <form id="form-remove-children" action="" method="post">
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



<?php 
$the_json = array();
$enfants = enfant::getDisplayedList(); 
$the_datas = array();
foreach($enfants as $key => $enfant) {

    $popup = '
        <ul class="dropdown-menu">
            <li><a href="/enfants/infos/id/'.$enfant->id.'" class="item"><i class="fa fa-share"></i> Voir la fiche</a></li>
            <li><a href="/enfants/editer/id/'.$enfant->id.'" class="item"><i class="fa fa-edit"></i> Modifier</a></li>
            <li><a href="#" class="modal-remove-link" data-id="'.$enfant->id.'" data-name="'.$enfant->firstname.' '.$enfant->lastname.'" data-toggle="modal" data-target="#modal-remove" class="item"><i class="fa fa-remove"></i> Supprimer</a></li>
        </ul>';

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
        $sex = '<i class="fa fa-female"></i> Féminin';
    } else {
        $sex = '<i class="fa fa-male"></i> Masculin';
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


<?php ob_start(); ?>
<script>
var the_datas = [];
<?php foreach ($the_json as $key => $value): ?>
the_datas.push(<?=json_encode($the_json[$key]);?>);
<?php endforeach; ?>

$('#datatable')
    .on( 'draw.dt', function () {
        if ($(window).width() < 768) {
            $(this).find('tr').each(function(index, el) {
                $(el).find('td, th').filter(':eq(2), :eq(3), :eq(4), :eq(5), :eq(6)').hide();
            });
        }
    } ).dataTable({
    "bProcessing": true,
    "bDeferRender": true,
    "bStateSave": true,
    "aaData":   the_datas[0],
    // "responsive": true,
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