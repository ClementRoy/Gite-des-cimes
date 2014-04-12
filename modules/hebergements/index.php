<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>

<?php hebergement::cleanEmpty(); ?>


<div class="title">
    <div class="row header">
        <div class="col-md-6">
            <h1>Les hébergements</h1>
        </div>
        <div class="col-md-6 text-right">
            <a href="/hebergements/ajouter" class="btn btn-primary"><span>+</span>
                Ajouter un hébergement</a>
            </div>
        </div>
    </div>
    <div class="content content-table">

        <div class="row">
            <div class="col-md-12">


                <table class="datatable">
                    <thead>
                        <tr>
                            <th class="sortable">Nom</th>
                            <th class="sortable">Ville</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $the_json = array();

                        $hebergements = hebergement::getList();
                        $the_datas = array();
                        foreach($hebergements as $key => $hebergement) {

                            $popup = '
                            <div class="pop-dialog tr">
                                <div class="pointer">
                                    <div class="arrow"></div>
                                    <div class="arrow_border"></div>
                                </div>
                                <div class="body">
                                    <div class="menu">
                                        <a href="/hebergements/infos/id/'.$hebergement->id.'" class="item"><i class="icon-share"></i> Voir la fiche</a>
                                        <a href="/hebergements/editer/id/'.$hebergement->id.'" class="item"><i class="icon-edit"></i> Modifier</a>
                                        <a href="/hebergements/supprimer/id/'.$hebergement->id.'" class="item"><i class="icon-remove"></i> Supprimer</a>
                                    </div>
                                </div>
                            </div>    ';


                            $the_data = ['
                            <a href="/hebergements/infos/id/'.$hebergement->id.'">'.$hebergement->name.'</a>'.$popup,
                            $hebergement->address_city
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
</script>

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>