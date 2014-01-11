    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
    <?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>


    <div class="content">

        <?php $sejour = sejour::get($_GET['id']); ?>
        <?php tool::output($sejour); ?>


        <div id="pad-wrapper">
            <div class="row header">
                <div class="col-md-5">
                    <h3><?=$sejour->name; ?></h3>
                </div>
                <div class="col-md-5 text-right pull-right">
                    <button class="btn-flat danger" data-toggle="modal" data-target="#remove-modal">
                        <i class="icon-remove"></i> Supprimer
                    </button>
                    <a href="/enfants/editer/id/<?=$enfant->id; ?>" class="btn-flat default"><i class="icon-edit"></i> Modifier</a>
                </div>
            </div>

            <div class="modal fade" id="remove-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h6 class="modal-title" id="myModalLabel">Supprimer cette fiche</h6>
                        </div>
                        <div class="modal-body">
                            <p>Vous êtes sur le point de supprimer la fiche de <strong><?=$enfant->firstname; ?> <?=$enfant->lastname; ?></strong>.<br />
                                Cette action est irréversible.</p>
                        </div>
                        <div class="modal-footer">
                            <a class="btn-flat white" data-dismiss="modal">Annuler</a>
                            <a href="/enfants/supprimer/id/<?=$enfant->id; ?>/confirm/true" class="btn-flat danger"><i class="icon-remove"></i> Supprimer</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-9 bio">




                    <h4>Capacité du séjour</h4>

                    <div class="progress">
                      <div class="progress-bar" role="progressbar" aria-valuenow="3" aria-valuemin="0" aria-valuemax="10" style="width: 30%;">
                        <span>3</span>
                      </div>
                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="1" aria-valuemin="0" aria-valuemax="7" style="width: 10%">
                        <span>1</span>
                      </div>
                      <span>10</span>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Enfants participants à ce séjour</h4>
                        </div>
                        <div class="col-md-6 text-right">
                             <button class="btn-flat success" data-toggle="modal" data-target="#add-modal">
                                <i class="icon-plus"></i> Ajouter un enfant
                            </button>
                        </div>
                        
                    </div>
                    <table class="table table-hover extendlink">
                        <thead>
                            <tr>
                                <th class="col-md-3">
                                    Prénom
                                </th>
                                <th class="col-md-3">
                                    <span class="line"></span>
                                    Nom
                                </th>
                                <th class="col-md-2">
                                    <span class="line"></span>
                                    Age
                                </th>

                                <th class="col-md-4">
                                    <span class="line"></span>
                                    Dossier complet
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <a href="#">Christophe</a>
                                </td>
                                <td>
                                    <a href="#">Béghin</a>
                                </td>
                                <td>
                                    23 ans
                                </td>
                                <td>
                                    Oui
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="col-md-3 address">
                    <h6><?=$sejour->place; ?></h6>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d44678.62570246739!2d5.90635345!3d45.5822195!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x478ba85708695f63%3A0xd5c21acfa63d899c!2schambery!5e0!3m2!1sfr!2sfr!4v1387062351950" width="210" height="200" frameborder="0" style="border:0"></iframe>
                </div>
            </div>
        </div>

    </div>

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>