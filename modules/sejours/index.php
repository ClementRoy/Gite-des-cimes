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
                    <a href="/sejours/ajouter" class="btn-flat primary pull-right"><span>+</span>
                        Ajouter un séjour</a>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">

                    <table class="datatable">
                        <thead>
                            <tr>
                                <th class="sortable">Nom</th>
                                <th class="sortable">Date de début</th>
                                <th class="sortable">Date de fin</th>
                                <th class="sortable">Lieu</th>
                                <th class="sortable">Capacité min</th>
                                <th class="sortable">Capacité max</th>
                                <th class="sortable">Prix (€)</th>
                            </tr>
                        </thead>
                        
                        <tfoot>
                            <tr>
                                <th class="sortable">Nom</th>
                                <th class="sortable">Date de début</th>
                                <th class="sortable">Date de fin</th>
                                <th class="sortable">Lieu</th>
                                <th class="sortable">Capacité min</th>
                                <th class="sortable">Capacité max</th>
                                <th class="sortable">Prix (€)</th>
                            </tr>
                        </tfoot>
                        <tbody>
                        <?php foreach($sejours as $key => $sejour): ?>
                        <?php 
                          if($sejour->ref_hebergement) {
                            $hebergement = hebergement::get($sejour->ref_hebergement);
                          }else {
                            $hebergement = null;
                          }
                        ?>
                        <tr>
                            <td>
                                <a href="/sejours/infos/id/<?=$sejour->id; ?>"><?=$sejour->name; ?></a>
                            </td>
                            <td class="text-right">
                            <?php $date_from = new DateTime($sejour->date_from); ?>
                            <?php if($date_from->getTimestamp() != '-62169987600'): ?>
                                <?=strftime('%d/%m/%Y', $date_from->getTimestamp()); ?>
                            <?php endif; ?>
                            </td>
                            <td class="text-right">
                            <?php $date_to = new DateTime($sejour->date_to); ?>
                            <?php if($date_to->getTimestamp() != '-62169987600'): ?>
                                <?=strftime('%d/%m/%Y', $date_to->getTimestamp()); ?>
                            <?php endif; ?>
                            </td>
                            <td>
                                <?php if(isset($hebergement)): ?>
                                    <a href="/hebergements/infos/id/<?=$hebergement->id; ?>"><?=$hebergement->name ?></a>
                                <?php endif; ?>
                            </td>
                            <td class="text-right">
                                <?=$sejour->capacity_min; ?>
                            </td>
                            <td class="text-right">  
                                <?=$sejour->capacity_max; ?>
                            </td>
                             <td class="text-right">
                                <?=$sejour->price; ?>
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



