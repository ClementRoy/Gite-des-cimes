    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>



    <div class="title">
        <div class="row header">
            <div class="col-md-6">
                <h3>Les hébergements</h3>
            </div>
            <div class="col-md-6 text-right">
                <a href="/hebergements/ajouter" class="btn btn-primary"><span>+</span>
                    Ajouter un hébergement</a>
                </div>
            </div>
        </div>
        <div class="content content-table">

            <?php $hebergements = hebergement::getList(); ?>

            <div class="row">
                <div class="col-md-12">

                    <?php if($hebergements && count($hebergements)>0 ): ?>
                        <table class="datatable">
                            <thead>
                                <tr>
                                    <th class="sortable">Nom</th>
                                    <th class="sortable">Ville</th>
                                </tr>
                            </thead>

                            <tfoot>
                                <tr>
                                    <th class="sortable">Nom</th>
                                    <th class="sortable">Ville</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php foreach($hebergements as $key => $hebergement): ?>
                                    <tr>
                                        <td>
                                            <a href="/hebergements/infos/id/<?=$hebergement->id; ?>"><?=$hebergement->name; ?></a>
                                            <div class="pop-dialog tr">
                                                <div class="pointer">
                                                    <div class="arrow"></div>
                                                    <div class="arrow_border"></div>
                                                </div>
                                                <div class="body">
                                                    <div class="menu">
                                                        <a href="/hebergements/infos/id/<?=$hebergement->id; ?>" class="item"><i class="icon-share"></i> Voir la fiche</a>
                                                        <a href="/hebergements/editer/id/<?=$hebergement->id; ?>" class="item"><i class="icon-edit"></i> Modifier</a>
                                                        <a href="/hebergements/supprimer/id/<?=$hebergement->id; ?>" class="item"><i class="icon-remove"></i> Supprimer</a>
                                                    </div>
                                                </div>
                                            </div>                                      
                                        </td>
                                        <td>
                                            <?=$hebergement->address_city; ?>
                                        </td>                                        
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p>Aucune données disponibles</p>
                    <?php endif; ?>

                </div>                
            </div>
        </div>
        <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>