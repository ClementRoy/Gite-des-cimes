<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>


<?php accompagnateur::cleanEmpty(); ?>





<div class="page-head">
    <div class="row">
        <div class="col-md-8">
            <h1>Les accompagnateurs</h1>
        </div>
        <div class="col-md-4 text-right">
            <a href="/accompagnateurs/ajouter" class="btn btn-primary btn-rad">Ajouter un accompagnateur</a>
        </div>
    </div>
</div>


<?php if (isset($_POST['id']) && $_POST['action'] == 'supprimer' && $_POST['confirm'] == true): ?>
    <?php $accompagnateur = accompagnateur::get($_POST['id']); ?>
    <div class="alert alert-success rounded">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <i class="fa fa-check sign"></i><strong>C'est fait !</strong> La fiche de l'accompagnateur <strong><?=$accompagnateur->firstname ?> <?=$accompagnateur->lastname ?></strong> a bien été supprimée !
    </div>

    <?php accompagnateur::remove($_POST['id']); ?>
<?php endif; ?>


<div class="block-flat tb-special">
    <div class="content">
        <div class="table-responsive">
            <table class="table table-bordered" id="datatable">
                <thead>
                    <tr>
                        <th width="150" style="width:150px;">Prénom</th>
                        <th>Nom</th>
                        <th>Téléphone</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>


                    <?php
                        $the_json = array();

                        $accompagnateurs = accompagnateur::getList();
                        $the_datas = array();

                        foreach($accompagnateurs as $key => $accompagnateur) {


                            $popup = '
                                <ul class="dropdown-menu">
                                    <li><a href="/accompagnateurs/infos/id/'.$accompagnateur->id.'" class="item"><i class="fa fa-share"></i> Voir la fiche</a></li>
                                    <li><a href="/accompagnateurs/editer/id/'.$accompagnateur->id.'" class="item"><i class="fa fa-edit"></i> Modifier</a></li>
                                    <li><a href="#" class="modal-remove-link" data-id="'.$accompagnateur->id.'" data-name="'.$accompagnateur->firstname.' '.$accompagnateur->lastname.'" data-toggle="modal" data-target="#modal-remove" class="item"><i class="fa fa-remove"></i> Supprimer</a></li>
                                </ul>';

                                if(!empty($accompagnateur->email)) { 
                                    $email = '<a href="mailto:'.$accompagnateur->email.'">'.$accompagnateur->email.'</a>';
                                } else {
                                    $email = EMPTYVAL;
                                }

                            $the_data = ['
                                <a href="/accompagnateurs/infos/id/'.$accompagnateur->id.'">'.$accompagnateur->firstname.'</a>'.$popup,
                                '<a href="/accompagnateurs/infos/id/'.$accompagnateur->id.'">'.$accompagnateur->lastname.'</a>',
                                '<span class="sr-only">'.tool::removeSpaces($accompagnateur->tel).'</span>'.tool::formatTel($accompagnateur->tel),
                                $email
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
                        Vous êtes sur le point de supprimer la fiche de l'accompagnateur <strong id="remove-name">nom</strong>.<br>
                        Êtes-vous sur de vouloir effectuer cette opération ?
                    </p>
                </div>
            </div>
            <div class="modal-footer">
                <form id="form-remove-accompagnateur" action="" method="post">
                    <a href="#" class="btn btn-default btn-flat" data-dismiss="modal">Annuler</a>
                    <input id="remove-id" type="hidden" name="id" value="21">
                    <input type="hidden" name="action" value="supprimer">
                    <input type="hidden" name="confirm" value="true">
                    <input type="submit" class="btn btn-warning btn-flat" value="Supprimer la fiche de l'accompagnateur">
                </form>
            </div>
        </div>
    </div>
</div>


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
    "aaData":   the_datas[0]
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