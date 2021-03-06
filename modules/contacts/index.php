<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>

<?php contact::cleanEmpty(); ?>


<div class="page-head">
    <div class="row">
        <div class="col-md-8">
            <h1>Les contacts</h1>
        </div>
        <div class="col-md-4 text-right">
            <a href="/contacts/ajouter" class="btn btn-primary btn-rad">Ajouter un contact</a>
        </div>
    </div>
</div>


<?php if (isset($_POST['id']) && $_POST['action'] == 'supprimer' && $_POST['confirm'] == true): ?>
    <?php $contact = contact::get($_POST['id']); ?>
    <?php tpl::alert('success', 'La fiche du contact <strong>'.$contact->lastname.' '.$contact->firstname.'</strong> a bien été supprimée !') ?>
    <?php contact::remove($_POST['id']); ?>
<?php endif; ?>


<div class="block-flat tb-special">
    <div class="content">
        <div class="table-responsive">
            <table class="table table-bordered" id="datatable">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Téléphone fixe</th>
                        <th>Téléphone portable</th>
                        <th width="300" style="width:300px;">Email</th>
                        <th width="300" style="width:300px;">Structure</th>
                        <th width="300" style="width:300px;">Adresse</th>
                        <th width="180" style="width:180px;">Enfants à charge</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $the_json = array();

                        $contacts = contact::getList();
                        $the_datas = array();

                        foreach($contacts as $key => $contact) {
                            if ($contact->ref_structure) {
                                $structure = structure::get($contact->ref_structure);
                            }
                            $enfants = enfant::getByContact($contact->id);

                            $popup = '
                                <ul class="dropdown-menu">
                                    <li><a href="/contacts/infos/id/'.$contact->id.'" class="item"><i class="fa fa-share"></i> Voir la fiche</a></li>
                                    <li><a href="/contacts/editer/id/'.$contact->id.'" class="item"><i class="fa fa-edit"></i> Modifier</a></li>
                                    <li><a href="#" class="modal-remove-link" data-id="'.$contact->id.'" data-name="'.$contact->lastname.' '.$contact->firstname.'" data-toggle="modal" data-target="#modal-remove" class="item"><i class="fa fa-remove"></i> Supprimer</a></li>
                                </ul>';


                            // tool::output( $structure );
                            if(isset($structure) && !empty($structure)) {
                                $contact_structure = '<a href="/structures/infos/id/'.$structure->id.'">'.$structure->name.'</a>';
                                $structure_address =    $structure->address_number . ' ' . $structure->address_street . ' ' .
                                                        $structure->address_comp . ( ( !empty( $structure->address_comp ) ) ? ' ' : '' ) .
                                                        $structure->address_postal_code . ' ' . $structure->address_city;
                            } else {
                                $contact_structure = '';
                                $structure_address = '';
                            }

                            $the_data = ['
                                <a href="/contacts/infos/id/'.$contact->id.'">'.trim($contact->lastname).'</a>',
                                '<a href="/contacts/infos/id/'.$contact->id.'">'.$contact->firstname.'</a>',
                                // '<span class="sr-only">'.tool::removeSpaces($contact->phone).'</span>'.tool::formatTel($contact->phone),
                                // '<span class="sr-only">'.tool::removeSpaces($contact->mobile_phone).'</span>'.tool::formatTel($contact->mobile_phone),
                                tool::formatTel($contact->phone),
                                tool::formatTel($contact->mobile_phone),
                                '<a href="mailto:'.$contact->email.'">'.$contact->email.'</a>',
                                $contact_structure,
                                $structure_address,
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
                        Vous êtes sur le point de supprimer la fiche contact de <strong id="remove-name">nom</strong>.<br>
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
                    <input type="submit" class="btn btn-warning btn-flat" value="Supprimer le fiche contact">
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

dataTableForIndexPages( $('#datatable'), the_datas[0], 'Liste des contacts' );

</script>
<?php $scripts .= ob_get_contents();
ob_end_clean(); ?>

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>