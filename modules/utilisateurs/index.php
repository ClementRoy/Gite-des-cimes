<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
<?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>

    <?php  $users = user::getList(); ?>

    <!-- main container -->
    <div class="content">
        <div id="pad-wrapper">


            <div class="row header">
                <div class="col-md-3">
                    <h3>Les utilisateurs</h3>
                </div>
                <div class="col-md-9 text-right">
                    <a href="/utilisateurs/ajouter" class="btn-flat primary pull-right"><span>+</span>
                        Ajouter un utilisateur</a>
                </div>
            </div>        

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

            <!-- Users table -->
            <div class="row">
                <div class="col-md-12">

                    <table class="datatable">
                        <thead>
                            <tr>
                                <th class="sortable">Prénom</th>
                                <th class="sortable">Nom</th>
                                <th class="sortable">Identifiant</th>
                                <th class="sortable">Rôle</th>
                            </tr>
                        </thead>
                        
                        <tfoot>
                            <tr>
                                <th class="sortable">Prénom</th>
                                <th class="sortable">Nom</th>
                                <th class="sortable">Identifiant</th>
                                <th class="sortable">Rôle</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php foreach($users as $key => $user): ?>
                            <tr <?php if($key == 0): ?>class="first"<?php endif; ?>>
                                <td>
                                   <!--<img src="http://placehold.it/45x45" width="45" height="45" class="img-circle avatar" />-->
                                    <a href="/utilisateurs/infos/id/<?=$user->id; ?>" class="name"><?=$user->firstname; ?></a>
                                    <div class="pop-dialog tr">
                                        <div class="pointer">
                                            <div class="arrow"></div>
                                            <div class="arrow_border"></div>
                                        </div>
                                        <div class="body">
                                            <div class="menu">
                                                <a href="/utilisateurs/infos/id/<?=$user->id; ?>" class="item"><i class="icon-share"></i> Voir la fiche</a>
                                                <a href="/utilisateurs/editer/id/<?=$user->id; ?>" class="item"><i class="icon-edit"></i> Modifier</a>
                                                <a href="/utilisateurs/supprimer/id/<?=$user->id; ?>" class="item"><i class="icon-remove"></i> Supprimer</a>
                                            </div>
                                        </div>
                                    </div>                                     
                                </td>
                                <td>
                                    <a href="/utilisateurs/infos/id/<?=$user->id; ?>" class="name"><?=$user->lastname; ?></a>
                                </td>
                                <td>
                                   <?=$user->identifier; ?>
                                </td>
                                <td>
                                    <span class="label label-info">
                                    <?php if ($user->rank == 1): ?>
                                        Utilisateur
                                    <?php elseif ($user->rank == 3): ?>
                                        Gestionnaire
                                    <?php elseif ($user->rank == 5): ?>
                                        Administrateur
                                    <?php endif; ?>
                                    </span>
                                    <!--<ul class="actions">
                                        <li><i class="table-edit"></i></li>
                                        <li><i class="table-settings"></i></li>
                                        <li class="last"><i class="table-delete"></i></li>
                                    </ul> -->                          
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>                
            </div>
            <!-- end users table -->


 
        </div>
    </div><!-- /.container -->

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>