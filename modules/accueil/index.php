<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
<?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>

	<!-- main container -->
    <div class="content">

        <!-- upper main stats -->
        <div id="main-stats">
            <div class="row stats-row">
                <div class="col-md-3 col-sm-3 stat">
                    <div class="data">
                        <span class="number"><a href="/enfants/"><?php echo count(enfant::getList()); ?></a></span>
                        enfants
                    </div>
                    <span class="date">dans la base</span>
                </div>
                <div class="col-md-3 col-sm-3 stat">
                    <div class="data">
                        <span class="number"><a href="/utilisateurs/"><?php echo count(user::getList()); ?></a></span>
                        utilisateurs
                    </div>
                    <span class="date">autorisés</span>
                </div>
                <div class="col-md-3 col-sm-3 stat">
                    <div class="data">
                        <span class="number"><a href="/enfants/">0</a></span>
                        séjours
                    </div>
                    <span class="date">en cours</span>
                </div>
                <div class="col-md-3 col-sm-3 stat last">
                    <div class="data">
                        <span class="number"><a href="/enfants/">0</a></span>
                        Fiches
                    </div>
                    <span class="date">incomplètes</span>
                </div>
            </div>
        </div>
        <!-- end upper main stats -->

        <div id="pad-wrapper">
            
            <div class="grid-wrapper">
                <div class="row">
                    <div class="col-md-6">
                        <h4>Enfants récemment ajoutés</h4>
                      <?php $enfants = enfant::getList('5','0'); ?>
                      <table id="table-enfant" class="table table-hover extendlink">
                            <thead>
                                <tr>
                                    <th class="sortable">Prénom</th>
                                    <th class="sortable"><span class="line"></span>Nom</th>
                                    <th class="sortable"><span class="line"></span>Sexe</th>
                                </tr>
                            </thead>
                            <tbody>
                            <!-- row -->
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
                            <!-- row -->
                           

                            </tbody>
                        </table>                        
                    </div>
                    <div class="col-md-6">
                        <h4>Séjours en cours</h4>
                      <?php $sejours = sejour::getList('5','0'); ?>
                      <table id="table-enfant" class="table table-hover extendlink">
                            <thead>
                                <tr>
                                    <th class="sortable">Numéro</th>
                                    <th class="sortable"><span class="line"></span>Nom</th>
                                    <th class="sortable"><span class="line"></span>Date de début</th>
                                </tr>
                            </thead>
                            <tbody>
                            <!-- row -->
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
                            <!-- row -->
                           

                            </tbody>
                        </table> 
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <h4>Rappels</h4>
                    </div>                  
                </div>
            </div>
        </div>
    </div>

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>