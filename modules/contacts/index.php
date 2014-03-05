<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>

<div class="title">
    <div class="row header">
        <div class="col-md-6">
            <h3>Les contacts</h3>
        </div>
        <div class="col-md-6 text-right">
            <a href="/contacts/ajouter" class="btn btn-primary">
                <span>+</span>Ajouter un contact
            </a>
        </div>
    </div>
</div>
<div class="content content-table">




    <?php $contacts = contact::getList(); ?>

    <?php //$contacts = contact::getList(); 
    /*
    Array (
    'join strucutre on xxx '
    'join contact on xxx '
    )

    */
    ?>


    <div class="row">
        <div class="col-md-12">
            <table class="datatable">
                <thead>
                    <tr>
                        <th class="sortable">Nom</th>
                        <th class="sortable">Prénom</th>
                        <th class="sortable">Téléphone</th>
                        <th class="sortable">Mobile</th>
                        <th class="sortable">Email</th>
                        <th class="sortable">Structure</th>
                        <th class="sortable">Enfants à charge</th>
                    </tr>
                </thead>

                <tfoot>
                    <tr>
                        <th class="sortable">Nom</th>
                        <th class="sortable">Prénom</th>
                        <th class="sortable">Téléphone</th>
                        <th class="sortable">Mobile</th>
                        <th class="sortable">Email</th>
                        <th class="sortable">Structure</th>
                        <th class="sortable">Enfants à charge</th>
                    </tr>
                </tfoot>

                <tbody>
                    <?php foreach($contacts as $key => $contact): ?>
                        <?php 
                        if($contact->ref_structure) {
                            $structure = structure::get($contact->ref_structure);
                        }
                        ?>
                        <?php 
                        $enfants = enfant::getByContact($contact->id);
                        ?>
                        <tr>
                            <td>
                                <a href="/contacts/infos/id/<?=$contact->id; ?>"><?=$contact->lastname; ?></a>
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
                                </div>
                            </td>
                            <td>
                                <a href="/contacts/infos/id/<?=$contact->id; ?>"><?=$contact->firstname; ?></a>
                            </td>
                            <td>
                                <?=$contact->phone; ?>
                            </td>
                            <td>
                                <?=$contact->mobile_phone; ?>
                            </td>
                            <td>
                                <a href="mailto:<?=$contact->email; ?>"><?=$contact->email; ?></a>
                            </td>
                            <td>
                                <?php if(isset($structure)): ?>
                                    <a href="/structures/infos/id/<?=$structure->id; ?>"><?=$structure->name ?></a>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?=count($enfants) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>
</div>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>