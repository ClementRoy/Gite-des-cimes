<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>


<?php sejour::cleanEmpty(); ?>


    
    <?php //tool::output($sejours); ?>


    <div class="title">
        <div class="row header">
            <div class="col-md-4">
               <h1>Les séjours</h1>
               <ul class="nav nav-tabs">
                  <li class="active"><a href="#present">A venir</a></li>
                  <li class=""><a href="#past">Achevés</a></li>
              </ul>

          </div>
          <div class="col-md-8 text-right">
          <a href="/sejours/ajouter" class="btn btn-primary"><span>+</span>
                Ajouter un séjour</a>
            </div>
        </div>
    </div>

    <div class="content content-table">
     <div class="row">
        <div class="col-md-12">

            <div class="tab-content">
                <div class="tab-pane active" id="present">
                    <?php $sejours = sejour::getListFuturSejour(); ?>
                    <table class="datatable" data-sort="1">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Date de début</th>
                                <th>Date de fin</th>
                                <th>Lieu</th>
                                <th>Nb enfants</th>
                                <th>Capacité min</th>
                                <th>Capacité max</th>
                                <th>Tarif (€)</th>
                            </tr>
                        </thead>

                        <tfoot>
                            <tr>
                                <th>Nom</th>
                                <th>Date de début</th>
                                <th>Date de fin</th>
                                <th>Lieu</th>
                                <th>Nb enfants</th>
                                <th>Capacité min</th>
                                <th>Capacité max</th>
                                <th>Tarif (€)</th>
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
                                            <p class="sr-only"> <?=strftime('%Y%m%d', $date_from->getTimestamp()); ?></p>
                                            <?=strftime('%d %B %Y', $date_from->getTimestamp()); ?>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-right">
                                        <?php $date_to = new DateTime($sejour->date_to); ?>
                                        <?php if($date_to->getTimestamp() != '-62169987600'): ?>
                                            <p class="sr-only"> <?=strftime('%Y%m%d', $date_from->getTimestamp()); ?></p>
                                            <?=strftime('%d %B %Y', $date_to->getTimestamp()); ?>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if(isset($hebergement)): ?>
                                            <a href="/hebergements/infos/id/<?=$hebergement->id; ?>"><span class="label label-default"><?=$hebergement->name ?></span></a>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-right">
                                        <?=count($inscriptions) ?>
                                    </td>
                                    <td class="text-right">
                                        <span class="label label-default"><?=$sejour->capacity_min; ?></span>
                                    </td>
                                    <td class="text-right">  
                                        <span class="label label-default"><?=$sejour->capacity_max; ?></span>
                                    </td>
                                    <td class="text-right">
                                        <span class="label label-info"><?=$sejour->price; ?>€</span>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>

                        </div>

                    <div class="tab-pane" id="past">
                    <?php $sejours = sejour::getListPastSejour(); ?>
                    <table class="datatable" data-sort="1">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Date de début</th>
                                <th>Date de fin</th>
                                <th>Lieu</th>
                                <th>Nb enfants</th>
                                <th>Capacité min</th>
                                <th>Capacité max</th>
                                <th>Tarif (€)</th>
                            </tr>
                        </thead>

                        <tfoot>
                            <tr>
                                <th>Nom</th>
                                <th>Date de début</th>
                                <th>Date de fin</th>
                                <th>Lieu</th>
                                <th>Nb enfants</th>
                                <th>Capacité min</th>
                                <th>Capacité max</th>
                                <th>Tarif (€)</th>
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
                                            <?=strftime('%d %B %Y', $date_from->getTimestamp()); ?>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-right">
                                        <?php $date_to = new DateTime($sejour->date_to); ?>
                                        <?php if($date_to->getTimestamp() != '-62169987600'): ?>
                                            <?=strftime('%d %B %Y', $date_to->getTimestamp()); ?>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if(isset($hebergement)): ?>
                                            <a href="/hebergements/infos/id/<?=$hebergement->id; ?>"><span class="label label-default"><?=$hebergement->name ?></span></a>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-right">
                                        <?=count($inscriptions) ?>
                                    </td>
                                    <td class="text-right">
                                        <span class="label label-default"><?=$sejour->capacity_min; ?></span>
                                    </td>
                                    <td class="text-right">  
                                        <span class="label label-default"><?=$sejour->capacity_max; ?></span>
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
                </div>                
                </div>

<!-- end users table -->
</div>
</div><!-- /.container -->

<script>
    $(function () {
        $('.nav-tabs a').click(function (e) {
            e.preventDefault();
            $(this).tab('show');
        });
    });
</script>

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>