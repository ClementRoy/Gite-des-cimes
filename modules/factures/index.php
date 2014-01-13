    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
    <?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>


    <!-- main container -->
    <div class="content">
<div id="pad-wrapper">
            <div class="row header">
                <div class="col-md-3">
                    <h3>Les factures</h3>
                </div>
                <div class="col-md-9 text-right">
                    <input type="text" id="table-enfant-search" class="col-md-5 search" placeholder="Tapez le numéro d'une facture..." autofocus="autofocus">
                    <a href="/factures/ajouter" class="btn-flat primary"><span>+</span>
                        Editer une nouvelle facture</a>
                </div>
            </div>

            <?php $factures = facture::getList(); ?>


            <div class="row">
                <div class="col-md-12">
                    <table id="table-enfant" class="table table-hover tablesorter extendlink">
                        <thead>
                            <tr>
                                <th class="sortable">Nom</th>
                                <th class="sortable"><span class="line"></span>Payeur</th>
                                <th class="sortable"><span class="line"></span>Email</th>
                            </tr>
                        </thead>
                        <tbody>

                        <!-- row -->

                        <?php foreach($factures as $key => $facture): ?>
                        <tr>
                            <td>
                                <a href="/factures/infos/id/<?=$facture->id; ?>"><?=$facture->name; ?></a>
                            </td>
                            <td>
                                 <a href="/factures/infos/id/<?=$facture->id; ?>"><?=$facture->payer; ?></a>
                            </td>
                            <td>
                               <a href="/factures/infos/id/<?=$facture->id; ?>"><?=$facture->email; ?></a>
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



