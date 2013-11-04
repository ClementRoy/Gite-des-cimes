    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
    <?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>


    <!-- main container -->
    <div class="content">
		<div id="pad-wrapper" class="users-list">
            <div class="row header">
                <h3>Utilisateurs</h3>
                <div class="col-md-10 col-sm-12 col-xs-12 pull-right">
                    <a href="/users/add" class="btn-flat primary pull-right"><span>+</span>
                        Ajouter un utilisateur</a>
                </div>
            </div>
    
            <?php $users = user::get_users(); ?>

            <!-- Users table -->
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="col-md-1 sortable">
                                    Id
                                </th>
                                <th class="col-md-4 sortable">
                                    Nom
                                </th>
                                <th class="col-md-3 sortable">
                                    <span class="line"></span>Prénom
                                </th>
                                <th class="col-md-3 sortable">
                                    <span class="line"></span>Identifiant
                                </th>
                                <th class="col-md-1 sortable align-right">
                                    <span class="line"></span>Statut
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        <!-- row -->
                        <?php foreach($users as $key => $user): ?>
                        <tr <?php if($key == 0): ?>class="first"<?php endif; ?>>
                            <td>
                                <?=$user->id; ?>
                            </td>
                            <td>
                                <img src="img/contact-img.png" class="img-circle avatar hidden-phone" />
                                <a href="" class="name"><?=$user->firstname; ?></a>
                                <span class="subtext"><?=$user->rank; ?></span>
                            </td>
                            <td>
                                <?=$user->lastname; ?>
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