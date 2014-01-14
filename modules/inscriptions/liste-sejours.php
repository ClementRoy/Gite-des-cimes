    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
    <?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>


    <?php $sejours = sejour::getList(); ?>
    <?php //tool::output($sejours); ?>

    <!-- main container -->
    <div class="content">
<div id="pad-wrapper">
            <div class="row header">
                <h3>Les séjours</h3>
                <div class="col-md-10 col-sm-12 col-xs-12 pull-right">
                    <input type="text" id="table-sejour-search" data-search="sejour" class="col-md-5 search" placeholder="Tapez le nom d'un séjour...">
                    <a href="/sejours/ajouter" class="btn-flat primary pull-right"><span>+</span>
                        Ajouter un séjour</a>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <table id="table-sejour"  data-search="sejour" class="table tablesorter table-hover extendlink">
                        <thead>
                            <tr>
                            	<th class="sortable">Numéro</th>
                                <th class="sortable">Nom</th>
                                <th class="sortable"><span class="line"></span>Date de début</th>
                                <th class="sortable"><span class="line"></span>Date de fin</th>
                                <th class="sortable"><span class="line"></span>Lieu</th>
                                <th class="sortable"><span class="line"></span>Capacité min</th>
                                <th class="sortable"><span class="line"></span>Capacité max</th>
                            </tr>
                        </thead>
                        <tbody>
                        <!-- row -->

                        <?php foreach($sejours as $key => $sejour): ?>
                        <tr class="first">
                            <td>
                            	<a href="/sejours/infos/id/<?=$sejour->id; ?>"><?=$sejour->numero; ?></a>
                            </td>
                            <td>
                            	<a href="/sejours/infos/id/<?=$sejour->id; ?>"><?=$sejour->name; ?></a>
                            </td>
                            <td>
                            	<?=$sejour->date_from; ?>
                            </td>
                            <td>
                                <?=$sejour->date_to; ?>
                            </td>
                            <td>
                               <?=$sejour->place; ?>
                            </td>
                            <td>
                                <?=$sejour->capacity_min; ?>
                            </td>
                            <td>
                                <?=$sejour->capacity_max; ?>
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



