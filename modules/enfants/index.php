    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
    <?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>


    <!-- main container -->
    <div class="content">
<div id="pad-wrapper" class="users-list">
            <div class="row header">
                <h3>Les enfants</h3>
                <div class="col-md-10 col-sm-12 col-xs-12 pull-right">
                    <input type="text" class="col-md-5 search" placeholder="Tapez le nom d'un enfant...">
                    <a href="/enfants/ajouter" class="btn-flat primary pull-right"><span>+</span>
                        Ajouter un enfant</a>
                </div>
            </div>

            <!-- Users table -->
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="sortable">Prénom
                                &nbsp;&nbsp;&nbsp;<i class="icon-sort"></i></th>
                                <th class="sortable">Nom
                                &nbsp;&nbsp;&nbsp;<i class="icon-sort"></i></th>
                                <th class="sortable">Sexe
                                &nbsp;&nbsp;&nbsp;<i class="icon-sort"></i></th>
                                <th class="sortable">
                                    <span class="line"></span>Date de naissance
                                    &nbsp;&nbsp;&nbsp;<i class="icon-sort"></i>
                                </th>
                                <th class="sortable">
                                    <span class="line"></span>Age
                                    &nbsp;&nbsp;&nbsp;<i class="icon-sort"></i>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        <!-- row -->
                        <tr class="first">
                            <td>
                                <a href="user-profile.html">Christophe</a>
                            </td>
                            <td>
                                <a href="user-profile.html">Béghin</a>
                            </td>
                            <td>
                                <i class="icon-male"></i> Homme
                            </td>
                            <td>
                                02/01/1990
                            </td>
                            <td>
                                23 ans
                            </td>
                        </tr>
                        <!-- row -->
                        <tr>
                            <td>
                                <a href="user-profile.html">Christophe Béghin</a>
                            </td>
                            <td>
                                Mar 13, 2012
                            </td>
                            <td>
                                $ 4,500.00
                            </td>
                            <td class="align-right">
                                <a href="#">alejandra@canvas.com</a>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div>                
            </div>
            <!-- end users table -->
        </div>
    </div><!-- /.container -->

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>