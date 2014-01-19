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
                    <a href="/structures/ajouter" class="btn-flat primary"><span>+</span>
                        Ajouter une structure</a>
                    </div>
                </div>

                <?php $structures = structure::getList(); ?>

                <div class="row">
                    <div class="col-md-12">

                    <table class="datatable">
                        <thead>
                            <tr>
                                <th class="sortable">Nom</th>
                                <th class="sortable">Téléphone</th>
                                <th class="sortable">Email</th>
                                <th class="sortable">Ville</th>
                            </tr>
                        </thead>
                        
                        <tfoot>
                            <tr>
                                <th class="sortable">Nom</th>
                                <th class="sortable">Téléphone</th>
                                <th class="sortable">Email</th>
                                <th class="sortable">Ville</th>
                            </tr>
                        </tfoot>
                        <tbody>
                        <?php foreach($structures as $key => $structure): ?>
                            <tr>
                                <td>
                                    <a href="/structures/infos/id/<?=$structure->id; ?>"><?=$structure->name; ?></a>
                                </td>
                                <td>
                                    <?=$structure->phone; ?>
                                </td>
                                <td>
                                    <a href="mailto:<?=$structure->email; ?>"><?=$structure->email; ?></a>
                                </td>
                                <td>
                                    <?=$structure->address_city; ?>
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



