<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>

<?php structure::cleanEmpty(); ?>


<div class="title">
    <div class="row header">
        <div class="col-md-6">
            <h1>Les structures</h1>
        </div>
        <div class="col-md-6 text-right">
            <a href="/structures/ajouter" class="btn btn-primary">
                <span>+</span>
                Ajouter une structure
            </a>
        </div>
    </div>
</div>
<div class="content content-table">

    <div class="row">
        <div class="col-md-12">

            <table class="datatable" data-sort="1">
                <thead>
                    <tr>
                        <th class="sortable style="width: 320px;">Nom</th>
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
                        <div class="pop-dialog tr">
                            <div class="pointer">
                                <div class="arrow"></div>
                                <div class="arrow_border"></div>
                            </div>
                            <div class="body">
                                <div class="menu">
                                    <a href="/structures/infos/id/'.$structure->id.'" class="item"><i class="icon-share"></i> Voir la fiche</a>
                                    <a href="/structures/editer/id/'.$structure->id.'" class="item"><i class="icon-edit"></i> Modifier</a>
                                    <a href="/structures/supprimer/id/'.$structure->id.'" class="item"><i class="icon-remove"></i> Supprimer</a>
                                </div>
                            </div>
                        </div>';


                        $the_data = ['
                        <a href="/structures/infos/id/'.$structure->id.'">'.$structure->name.'</a>'.$popup,
                        $structure->service,
                        '<span class="sr-only">'.tool::removeSpaces($structure->phone).'</span>'.tool::formatTel($structure->phone),
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


<script>
    var the_datas = [];
    <?php foreach ($the_json as $key => $value): ?>
    the_datas.push(<?=json_encode($the_json[$key]);?>);
    <?php endforeach; ?>
</script>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>