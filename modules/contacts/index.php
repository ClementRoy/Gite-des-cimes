<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>

<?php contact::cleanEmpty(); ?>

<div class="title">
    <div class="row header">
        <div class="col-md-6">
            <h1>Les contacts</h1>
        </div>
        <div class="col-md-6 text-right">
            <a href="/contacts/ajouter" class="btn btn-primary">
                <span>+</span>Ajouter un contact
            </a>
        </div>
    </div>
</div>
<div class="content content-table">





    <?php
    /*
    Array (
    'join strucutre on xxx '
    'join contact on xxx '
    )

    */
    ?>


    <div class="row">
        <div class="col-md-12">
            <table class="datatable" data-sort="1">
                <thead>
                    <tr>
                        <th class="sortable">Nom</th>
                        <th class="sortable">Prénom</th>
                        <th class="sortable">Téléphone fixe</th>
                        <th class="sortable">Téléphone portable</th>
                        <th class="sortable">Email</th>
                        <th class="sortable">Structure</th>
                        <th class="sortable">Enfants à charge</th>
                    </tr>
                </thead>

                <tbody>


                 <?php
                 $the_json = array();

                 $contacts = contact::getList();
                 $the_datas = array();

                 foreach($contacts as $key => $contact) {
                    if($contact->ref_structure) {
                        $structure = structure::get($contact->ref_structure);
                    }
                    $enfants = enfant::getByContact($contact->id);

                    $popup = '
                    <div class="pop-dialog tr">
                        <div class="pointer">
                            <div class="arrow"></div>
                            <div class="arrow_border"></div>
                        </div>
                        <div class="body">
                            <div class="menu">
                                <a href="/contacts/infos/id/<?=$contact->id; ?>" class="item"><i class="icon-share"></i> Voir la fiche</a>
                                <a href="/contacts/editer/id/<?=$contact->id; ?>" class="item"><i class="icon-edit"></i> Modifier</a>
                                <a href="/contacts/supprimer/id/<?=$contact->id; ?>" class="item"><i class="icon-remove"></i> Supprimer</a>
                            </div>
                        </div>
                    </div>';


                    $contact_structure ='';
                    if(isset($structure)) {
                        $contact_structure = '<a href="/structures/infos/id/'.$structure->id.'">'.$structure->name.'</a>';
                    }


                    $the_data = ['
                    <a href="/contacts/infos/id/'.$contact->id.'">'.$contact->lastname.'</a>'.$popup,
                    '<a href="/contacts/infos/id/'.$contact->id.'">'.$contact->firstname.'</a>',
                    tool::formatTel($contact->phone),
                    tool::formatTel($contact->mobile_phone),
                    '<a href="mailto:'.$contact->email.'">'.$contact->email.'</a>',
                    $contact_structure,
                    count($enfants)
                    ];
                    array_push($the_datas, $the_data);
                }
                array_push($the_json, $the_datas);
                ?>


            </tbody>
        </table>

    </div>
</div>
<script>
    var the_datas = [];
    <?php foreach ($the_json as $key => $value): ?>
    the_datas.push(<?=json_encode($the_json[$key]);?>);
    <?php endforeach; ?>
</script>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>