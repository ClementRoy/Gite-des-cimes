    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
    <?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>


    <!-- main container -->
    <div class="content">
<div id="pad-wrapper">
            <div class="row header">
                <div class="col-md-2">
                    <h3>Les enfants</h3>
                </div>
                <div class="col-md-10 text-right">
                    <input type="text" id="table-enfant-search" data-search="enfant" class="col-md-5 search" placeholder="Tapez le nom d'un enfant..." autofocus="autofocus">
                    <a href="/enfants/ajouter" class="btn-flat primary"><span>+</span>
                        Ajouter un enfant</a>
                </div>
            </div>

            <?php $enfants = enfant::getList(); ?>


            <div class="row">
                <div class="col-md-12">
                    <table id="table-enfant" data-search="enfant" class="table table-hover tablesorter extendlink">
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
                                <img src="http://placehold.it/45x45" width="45" height="45" class="img-circle avatar" />
                                <a href="/enfants/infos/id/<?=$enfant->id; ?>"><?=$enfant->firstname; ?></a>
                            </td>
                            <td>
                                 <a href="/enfants/infos/id/<?=$enfant->id; ?>"><?=$enfant->lastname; ?></a>
                            </td>
                            <td>
                                <?=($enfant->sex == 'féminin') ? '<i class="icon-female"></i> Féminin' : '<i class="icon-male"></i> Masculin'; ?>                            </td>
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



