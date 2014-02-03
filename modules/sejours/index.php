    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>


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
                                <th class="sortable">Remplissage</th>
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
                                <th class="sortable">Remplissage</th>
                                <th class="sortable">Capacité min</th>
                                <th class="sortable">Capacité max</th>
                                <th class="sortable">Prix (€)</th>
                            </tr>
                        </tfoot>
                        <tbody>
                        <?php foreach($sejours as $key => $sejour): ?>
                        <?php $inscriptions = inscription::getBySejour($sejour->id); ?>
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
                                <div class="pop-dialog tr">
                                    <div class="pointer">
                                        <div class="arrow"></div>
                                        <div class="arrow_border"></div>
                                    </div>
                                    <div class="body">
                                        <div class="menu">
                                            <a href="/sejours/infos/id/<?=$sejour->id; ?>" class="item"><i class="icon-share"></i> Voir la fiche</a>
                                            <a href="/sejours/editer/id/<?=$sejour->id; ?>" class="item"><i class="icon-edit"></i> Modifier</a>
                                            <a href="/sejours/supprimer/id/<?=$sejour->id; ?>" class="item"><i class="icon-remove"></i> Supprimer</a>
                                        </div>
                                    </div>
                                </div> 
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
                                    <a href="/hebergements/infos/id/<?=$hebergement->id; ?>"><span class="label label-default"><?=$hebergement->name ?></span></a>
                                <?php endif; ?>
                            </td>
                            <td class="text-right">
                                <?=count($inscriptions)/$sejour->capacity_min*100 ?>% / <?=count($inscriptions)/$sejour->capacity_max*100 ?>%
                                <!--<span class="label label-default">Default</span>
<span class="label label-primary">Primary</span>
<span class="label label-success">Success</span>
<span class="label label-info">Info</span>
<span class="label label-warning">Warning</span>
<span class="label label-danger">Danger</span>-->
                            </td>
                            <td class="text-right">
                               <span class="label label-success"><?=$sejour->capacity_min; ?></span>
                            </td>
                            <td class="text-right">  
                                <?=$sejour->capacity_max; ?>
                            </td>
                             <td class="text-right">
                                <span class="label label-info"><?=$sejour->price; ?>€</span>
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



