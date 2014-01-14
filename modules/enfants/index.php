    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
    <?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>


    <!-- main container -->
    <div class="content">
<div id="pad-wrapper">
            <div class="row header">
                <div class="col-md-4">
                    <h3>Les enfants</h3>
                </div>
                <div class="col-md-8 text-right">
                    <input type="text" id="table-enfant-search" data-search="enfant" class="col-md-5 search" placeholder="Tapez le nom d'un enfant..." autofocus="autofocus">
                    <a href="/enfants/ajouter" class="btn-flat primary"><span>+</span>
                        Ajouter un enfant</a>
                </div>
            </div>

            <?php $enfants = enfant::getList(); ?>

            <!--
            <div class="alert alert-success">
                <i class="icon-ok-sign"></i> Your order has been placed.
            </div>
            <div class="alert alert-info">
                <i class="icon-exclamation-sign"></i>
                Do you want to get these resources for as little as $0.70 each?
            </div>
            <div class="alert alert-danger">
                <i class="icon-remove-sign"></i>
                Unexpected error. Please try again later.
            </div>
            -->
                      

            <div class="row">
                <div class="col-md-12">
                    <table id="table-enfant" data-search="enfant" class="table table-hover tablesorter extendlink">
                        <thead>
                            <tr>
                                <th class="sortable">Prénom</th>
                                <th class="sortable"><span class="line"></span>Nom</th>
                                <th class="sortable"><span class="line"></span>Sexe</th>
                                <th class="sortable">Statut de la fiche</th>
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
                                <a href="/enfants/infos/id/<?=$enfant->id; ?>"><?=$enfant->firstname; ?></a>
                            </td>
                            <td>
                                 <a href="/enfants/infos/id/<?=$enfant->id; ?>"><?=$enfant->lastname; ?></a>
                            </td>
                            <td>
                                <?=($enfant->sex == 'féminin') ? '<i class="icon-female"></i> Féminin' : '<i class="icon-male"></i> Masculin'; ?>
                            </td>
                            <td>
                                <span class="label label-warning">Incomplète</span>      
                            </td>
                            <td>
                                <?php 
                                    // http://net.tutsplus.com/tutorials/php/dates-and-time-the-oop-way/?search_index=27
                                    $birthdate = new DateTime($enfant->birthdate); 
                                ?>
                                <?php if($birthdate->getTimestamp() != '-62169984561'): ?>
                                    <?=strftime('%d/%m/%Y', $birthdate->getTimestamp()); ?>
                                <?php else: ?>
                                    <?php echo EMPTYVAL; ?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($birthdate->getTimestamp() != '-62169984561'): ?>
                                    <?=tool::getAgeFromDate($enfant->birthdate); ?> ans
                                <?php else: ?>
                                    <?php echo EMPTYVAL; ?>
                                <?php endif; ?>
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



