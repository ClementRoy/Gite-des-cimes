<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>

<?php structure::cleanEmpty(); ?>


<div class="page-head">
    <div class="row">
        <div class="col-md-8">
            <h1>Les structures</h1>
        </div>
        <div class="col-md-4 text-right">
            <a href="/structures/ajouter" class="btn btn-primary btn-rad">Ajouter une structure</a>
        </div>
    </div>
</div>

<?php if (isset($_POST['id']) && $_POST['action'] == 'supprimer' && $_POST['confirm'] == true): ?>
    <?php $structure = structure::get($_POST['id']); ?>
    <?php tpl::alert('success', 'La structure <strong>'.$structure->name.'</strong> a bien été supprimée !') ?>
    <?php structure::remove($_POST['id']); ?>
<?php endif; ?>

<div class="block-flat tb-special">
    <div class="content">
        <div class="table-responsive">
            <table class="table table-bordered" id="datatable">
                <thead>
                    <tr>
                        <th class="sortable" style="width: 320px;">Nom</th>
                        <th class="sortable">Service</th>
                        <th class="sortable">Téléphone</th>
                        <th class="sortable">Email</th>
                        <th class="sortable">Ville</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $the_json = array();

                        $structures = structure::getList();
                        $the_datas = array();

                        foreach($structures as $key => $structure) {

                            $popup = '
                                <ul class="dropdown-menu">
                                    <li><a href="/structures/infos/id/'.$structure->id.'" class="item"><i class="fa fa-share"></i> Voir la fiche</a></li>
                                    <li><a href="/structures/editer/id/'.$structure->id.'" class="item"><i class="fa fa-edit"></i> Modifier</a></li>
                                    <li><a href="#" class="modal-remove-link" data-id="'.$structure->id.'" data-name="'.$structure->name.'" data-toggle="modal" data-target="#modal-remove" class="item"><i class="fa fa-remove"></i> Supprimer</a></li>
                                </ul>';


                            $the_data = ['
                            <a href="/structures/infos/id/'.$structure->id.'">'.$structure->name.'</a>',
                            $structure->service,
                            tool::formatTel($structure->phone),
                            '<a href="mailto:'.$structure->email.'">'.$structure->email.'</a>',
                            $structure->address_city
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
                        Vous êtes sur le point de supprimer la structure de <strong id="remove-name">nom</strong>.<br>
                        Êtes-vous sur de vouloir effectuer cette opération ?
                    </p>
                </div>
            </div>
            <div class="modal-footer">
                <form id="form-remove-structure" action="" method="post">
                    <a href="#" class="btn btn-default btn-flat" data-dismiss="modal">Annuler</a>
                    <input id="remove-id" type="hidden" name="id" value="21">
                    <input type="hidden" name="action" value="supprimer">
                    <input type="hidden" name="confirm" value="true">
                    <input type="submit" class="btn btn-warning btn-flat" value="Supprimer la structure">
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
    dataTableForIndexPages( $('#datatable'), the_datas[0], 'Liste des structures' );
</script>
<?php $scripts .= ob_get_contents();
ob_end_clean(); ?>

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>