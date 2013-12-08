    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
    <?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>


    <!-- main container -->
    <div class="content">
<div id="pad-wrapper">
            <div class="row header">
                <h3>Les enfants</h3>
                <div class="col-md-10 col-sm-12 col-xs-12 pull-right">
                    <input type="text" id="table-enfant-search" class="col-md-5 search" placeholder="Tapez le nom d'un enfant...">
                    <a href="/enfants/ajouter" class="btn-flat primary pull-right"><span>+</span>
                        Ajouter un enfant</a>
                </div>
            </div>

            <?php $enfants = enfant::getList(); ?>


            <div class="row">
                <div class="col-md-12">
                    <table id="table-enfant" class="table table-hover extendlink">
                        <thead>
                            <tr>
                                <th class="sortable">Prénom</th>
                                <th class="sortable"><span class="line"></span>Nom</th>
                                <th class="sortable"><span class="line"></span>Sexe</th>
                                <th class="sortable">
                                    <span class="line"></span>Date de naissance
                                </th>
                                <th class="sortable">
                                    <span class="line"></span>Age
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        <!-- row -->

                         <?php foreach($enfants as $key => $enfant): ?>
                        <tr class="first">
                            <td>
                                <img src="http://placehold.it/45x45" class="img-circle avatar hidden-phone" />
                                <a href="/enfants/infos/id/<?=$enfant->id; ?>"><?=$enfant->firstname; ?></a>
                            </td>
                            <td>
                                 <a href="/enfants/infos/id/<?=$enfant->id; ?>"><?=$enfant->lastname; ?></a>
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
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>                
            </div>

            <!-- end users table -->
        </div>
    </div><!-- /.container -->
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>