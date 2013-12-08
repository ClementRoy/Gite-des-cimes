    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
    <?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>


    <!-- main container -->
    <div class="content">
        <div id="pad-wrapper">
            <div class="row header">
                <div class="col-md-3">
                    <h3>Les utitilisateurs</h3>
                </div>
                <div class="col-md-9 text-right">
                    <a href="/utilisateurs/ajouter" class="btn-flat primary pull-right"><span>+</span>
                        Ajouter un utilisateur</a>
                </div>
            </div>
    
            <?php $users = user::getList(); ?>

            <!-- Users table -->
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-hover extendlink tablesorter">
                        <thead>
                            <tr>
                                <th class="sortable col-md-3">Prénom</th>
                                <th class="sortable col-md-2"><span class="line"></span>Nom</th>
                                <th class="sortable">
                                    <span class="line"></span>Identifiant
                                </th>
                                <th class="sortable col-md-1">
                                    <span class="line"></span>Statut
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        <!-- row -->
                        <?php foreach($users as $key => $user): ?>
                        <tr <?php if($key == 0): ?>class="first"<?php endif; ?>>
                            <td>
                               <img src="http://placehold.it/45x45" width="45" height="45" class="img-circle avatar" />
                                <a href="/utilisateurs/infos/id/<?=$user->id; ?>" class="name"><?=$user->firstname; ?></a>
                            </td>
                            <td>
                                <a href="/utilisateurs/infos/id/<?=$user->id; ?>" class="name"><?=$user->lastname; ?></a>
                            </td>
                            <td>
                               <?=$user->identifier; ?>
                            </td>
                            <td class="align-right">
                                <a href="#"><?=$user->rank; ?></a>
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