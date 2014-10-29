<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
<?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>

<div class="title">
    <div class="row header">
        <div class="col-md-12">
            <h1>Tableau de bord</h1>
        </div>
    </div>
</div>
<div class="main-stats hidden-xs">
    <div class="row stats-row">
        <div class="col-md-12">
            <div class="stat">
                <div class="data">
                    <p class="datalabel">
                        <i class="icon icon-group"></i>
                        <span class="title">enfants</span>
                        <span class="subtitle">dans la base</span>
                    </p>
                    <p class="datanumber">
                        <a id="number-enfants" class="odometer" href="/enfants/">0</a>
                    </p>
                </div>
            </div>
            <div class="stat">
                <div class="data">
                    <p class="datalabel">
                        <i class="icon icon-comments"></i>
                        <span class="title">contacts</span>
                        <span class="subtitle">dans la base</span>
                    </p>
                    <p class="datanumber">
                        <a id="number-contacts" class="odometer" href="/contacts/">0</a>
                    </p>
                </div>
            </div>
            <div class="stat">
                <div class="data">
                    <p class="datalabel">
                        <i class="icon icon-building"></i>
                        <span class="title">structures</span>
                        <span class="subtitle">dans la base</span>
                    </p>
                    <p class="datanumber">
                        <a id="number-structures" class="odometer" href="/structures/">0</a>
                    </p>
                </div>
            </div>
            <div class="stat">
                <div class="data">
                    <p class="datalabel">
                        <i class="icon icon-plane" style="padding: 6px 5px 4px;"></i>
                        <span class="title">séjours</span>
                        <span class="subtitle">dans la base</span>
                    </p>
                    <p class="datanumber">
                        <a id="number-sejours" class="odometer" href="/sejours/">0</a>
                    </p>
                </div>
            </div>
            <div class="stat">
                <div class="data">
                    <p class="datalabel">
                        <i class="icon icon-folder-open" style="padding: 6px 4px 4px 6px;"></i>
                        <span class="title">inscriptions</span>
                        <span class="subtitle">dans la base</span>
                    </p>
                    <p class="datanumber">
                        <a id="number-dossiers" class="odometer" href="/dossiers/">0</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">

    <div class="col-md-12">
        <h2 class="bloc-title" style="margin-bottom:60px">Prise en charge non reçues</h2>
        <div class="content content-table">

            <table class="datatable" data-sort="1" data-length="10">
                <thead>
                    <tr>
                        <th class="sortable" style="width: 80px;">#</th>
                        <th class="sortable" style="width: 270px;">Nom de l'enfant</th>
                        <th class="sortable" style="width: 270px;">Structure</th>
                        <th class="sortable" style="width: 12%;">Pris en charge</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $notSupported = dossier::getListNotSupported(); ?>
                    <?php foreach ($notSupported as $key => $value): ?>
                       <?php $enfant = enfant::get($value->ref_enfant); ?>
                       <?php $structure = structure::get($value->ref_structure_payer); ?>
                        <tr>
                            <td><a href="/dossiers/infos/id/<?=$value->id?>">#<?=$value->id?></a></td>
                            <td><?=$enfant->firstname?> <?=$enfant->lastname?></td>
                            <td><?=(isset($structure->name))?$structure->name:'';?></td>
                            <td>Non</td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>

            

            <?php //tool::output($notSupported); ?>
        </div>

    </div>

<!--     <div class="col-md-6">
        <p class="bloc-title">Prochains séjours</p>
        <div class="content">


            <div class="jumbotron">
                <h1>En cours de construction !</h1>
            </div>
        </div>

    </div>
    <div class="col-md-6">

        <div class="row">

            <h6>Inscriptions non finalisées</h6>

            <h6>Séjours à venir</h6>

            <h6>Fiches à compléter</h6>

            <h6>Taux de remplissage</h6>

        </div>
    </div> -->
<!--
                <div class="row">
                    <div class="col-md-6">
                        <h4>Enfants récemment ajoutés</h4>
                      <?php $enfants = enfant::getList('5','0'); ?>
                      <table id="table-enfant" class="table tablesorter table-hover extendlink">
                            <thead>
                                <tr>
                                    <th class="sortable">Prénom</th>
                                    <th class="sortable"><span class="line"></span>Nom</th>
                                    <th class="sortable"><span class="line"></span>Sexe</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($enfants as $key => $enfant): ?>
                            <tr <?php if($key == 0): ?>class="first"<?php endif; ?>>
                                <td>
                                    <a href="/enfants/infos/id/<?=$enfant->id; ?>"><?=$enfant->firstname; ?></a>
                                </td>
                                <td>
                                    <a href="/enfants/infos/id/<?=$enfant->id; ?>"><?=$enfant->lastname; ?></a>
                                </td>
                                <td>
                                    <i class="icon-male"></i> Homme
                                </td>
                            </tr>
                            <?php endforeach; ?>                           
                            </tbody>
                        </table>                        
                    </div>
                    <div class="col-md-6">
                        <h4>Séjours en cours</h4>
                      <?php $sejours = sejour::getList('5','0'); ?>
                      <table id="table-enfant" class="table tablesorter table-hover extendlink">
                            <thead>
                                <tr>
                                    <th class="sortable">Numéro</th>
                                    <th class="sortable"><span class="line"></span>Nom</th>
                                    <th class="sortable"><span class="line"></span>Date de début</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($sejours as $key => $sejour): ?>
                            <tr <?php if($key == 0): ?>class="first"<?php endif; ?>>
                                <td>
                                    <a href="/sejours/infos/id/<?=$sejour->id; ?>"><?=$sejour->numero; ?></a>
                                </td>
                                <td>
                                    <a href="/sejours/infos/id/<?=$sejour->id; ?>"><?=$sejour->name; ?></a>
                                </td>
                                <td>
                                    <?=$sejour->date_from ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        
                            </tbody>
                        </table> 
                    </div>
                </div>
            

                <div class="row">
                    <div class="col-md-6">
                        <h4>Rappels</h4>
                    </div>                  
                </div>
            -->
        </div>
        <script>
            $(function() {
                setTimeout(function() {
                    $('#number-enfants').text('<?php echo count(enfant::getList()); ?>');
                    $('#number-contacts').text('<?php echo count(contact::getList()); ?>');
                    $('#number-structures').text('<?php echo count(structure::getList()); ?>');
                    $('#number-sejours').text('<?php echo count(sejour::getList()); ?>');
                    $('#number-dossiers').text('<?php echo count(dossier::getList()); ?>');
                }, 10);

            });
        </script>
        
        <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>