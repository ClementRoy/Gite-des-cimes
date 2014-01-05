    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
    <?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>


    <!-- main container -->
    <div class="content">
<div id="pad-wrapper">
            <div class="row header">
                <div class="col-md-3">
                    <h3>Les structures</h3>
                </div>
                <div class="col-md-9 text-right">
                    <input type="text" id="table-enfant-search" class="col-md-5 search" placeholder="Tapez le nom d'un enfant..." autofocus="autofocus">
                    <a href="/enfants/ajouter" class="btn-flat primary"><span>+</span>
                        Ajouter une structure</a>
                </div>
            </div>

            <?php $structures = structure::getList(); ?>


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

                        <?php foreach($structures as $key => $structure): ?>
                        <tr>
                            <td>
                                <a href="/structures/infos/id/<?=$structure->id; ?>"><?=$structure->name; ?></a>
                            </td>
                            <td>
                                 <a href="/structures/infos/id/<?=$structure->id; ?>"><?=$structure->paying; ?></a>
                            </td>
                            <td>
                               <a href="/structures/infos/id/<?=$structure->id; ?>"><?=$structure->email; ?></a>
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



