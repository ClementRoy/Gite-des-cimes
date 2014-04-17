<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>


<?php accompagnateur::cleanEmpty(); ?>


<?php  $accompagnateurs = accompagnateur::getList(); ?>



<div class="title">
    <div class="row header">
        <div class="col-md-6">
            <h1>Les accompagnateurs</h1>
        </div>
        <div class="col-md-6 text-right">
            <a href="/accompagnateurs/ajouter" class="btn btn-primary">
                <span>+</span>Ajouter un accompagnateur
            </a>
        </div>
    </div>
</div>
<div class="content content-table">

            <!--
            <div class="alert alert-success">
            <i class="icon-ok-sign"></i> Your order has been placed.
            </div>
            <div class="alert alert-info">
            <i class="icon-exclamation-sign"></i>
            Do you want to get these resources for as little as $0.70 each?
            </div>
            <div class="alert alert-danger">
            <i class="icon-remove-sign"></i>
            Unexpected error. Please try again later.
            </div>
            -->

            
    <div class="row">
        <div class="col-md-12">

            <table class="datatable" data-sort="0">
                <thead>
                    <tr>
                        <th class="sortable">Prénom</th>
                        <th class="sortable">Nom</th>
                        <th class="sortable">Téléphone</th>
                        <th class="sortable">Rôle</th>
                    </tr>
                </thead>

                <tfoot>
                    <tr>
                        <th class="sortable">Prénom</th>
                        <th class="sortable">Nom</th>
                        <th class="sortable">Téléphone</th>
                        <th class="sortable">Rôle</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach($accompagnateurs as $key => $accompagnateur): ?>
                        <tr <?php if($key == 0): ?>class="first"<?php endif; ?>>
                            <td>
                                <a href="/accompagnateurs/infos/id/<?=$user->id; ?>" class="name"><?=$accompagnateur->firstname; ?></a>
                                <div class="pop-dialog tr">
                                    <div class="pointer">
                                        <div class="arrow"></div>
                                        <div class="arrow_border"></div>
                                    </div>
                                    <div class="body">
                                        <div class="menu">
                                            <a href="/accompagnateurs/infos/id/<?=$user->id; ?>" class="item"><i class="icon-share"></i> Voir la fiche</a>
                                            <a href="/accompagnateurs/editer/id/<?=$user->id; ?>" class="item"><i class="icon-edit"></i> Modifier</a>
                                            <a href="/accompagnateurs/supprimer/id/<?=$user->id; ?>" class="item"><i class="icon-remove"></i> Supprimer</a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a href="/accompagnateurs/infos/id/<?=$user->id; ?>" class="name"><?=$accompagnateur->lastname; ?></a>
                            </td>
                            <td>
                                <?=$accompagnateur->tel; ?>
                            </td>
                            <td>
                                <span class="label label-info">
                                    <?php if ($accompagnateur->rank == 1): ?>
                                        Utilisateur
                                    <?php elseif ($accompagnateur->rank == 3): ?>
                                        Gestionnaire
                                    <?php elseif ($accompagnateur->rank == 5): ?>
                                        Administrateur
                                    <?php endif; ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>
</div>

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>


