    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
    <?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>


    <div class="content">

        <?php $sejour = sejour::get($_GET['id']); ?>
        <?php //tool::output($sejour); ?>
        <?php $creator = user::get($sejour->creator); ?>
        <?php $editor = user::get($sejour->editor); ?>
        <?php $date_created = new DateTime($sejour->created); ?>
        <?php $date_edited = new DateTime($sejour->edited); ?>

        <div id="pad-wrapper">
            <div class="row header">
                <div class="col-md-5">
                    <h3><?=$sejour->name; ?></h3>
                </div>
                <div class="col-md-5 text-right pull-right">
                    <button class="btn-flat danger" data-toggle="modal" data-target="#remove-modal">
                        <i class="icon-remove"></i> Supprimer
                    </button>
                    <a href="/sejours/editer/id/<?=$sejour->id; ?>" class="btn-flat default"><i class="icon-edit"></i> Modifier</a>
                    <button class="metadata btn btn-default" data-container="body" data-toggle="popover" data-placement="bottom" data-html="true" data-content="<strong>Créé par :</strong><br/> <?=$creator->firstname; ?>, le <?=strftime('%d %B %Y', $date_created->getTimestamp()); ?> <br /><strong>Edité par :</strong><br/> <?=$editor->firstname ?> ,le <?=strftime('%d %B %Y', $date_edited->getTimestamp()); ?> " data-original-title="Informations" title="">
                      <i class="icon-info-sign"></i>
                    </button>                
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
                            <p>Vous êtes sur le point de supprimer la fiche de <strong><?=$sejour->name; ?></strong>.<br />
                                Cette action est irréversible.</p>
                        </div>
                        <div class="modal-footer">
                            <a class="btn-flat white" data-dismiss="modal">Annuler</a>
                            <a href="/sejours/supprimer/id/<?=$sejour->id; ?>/confirm/true" class="btn-flat danger"><i class="icon-remove"></i> Supprimer</a>
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




            <div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-labelledby="add-modal-label" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h6 class="modal-title" id="add-modal-label">Ajouter un enfant au séjour</h6>
                        </div>
                        <div class="modal-body">

                            <form action="" method="get">
  
                             <div class="field-box row">
                            <div class="ui-select">
                                <?php $enfants = enfant::getList(); ?>
                                <select id="form-enfant-select" name="form_enfant_structure">
                                    <option value="" selected="selected">Sélectionnez un enfant</option>
                                    <?php foreach($enfants as $enfant): ?>
                                    <option value="<?=$enfant->id ?>"><?=$enfant->firstname ?> <?=$enfant->lastname ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div> 
                            </div>                             


        <div class="field-box row">
            <label class="col-md-2" for="form-enfant-prenom">Date début</label>
            <div class="col-md-4 col-sm-5">
                <input id="form-enfant-prenom" name="form_enfant_prenom" class="form-control input-sm" type="text" data-toggle="tooltip" title="Renseignez le prénom de l'enfant." parsley-required="true">
            </div>
        </div>


        <div class="field-box row">
            <label class="col-md-2" for="form-enfant-prenom">Date fin</label>
            <div class="col-md-4 col-sm-5">
                <input id="form-enfant-prenom" name="form_enfant_prenom" class="form-control input-sm" type="text" data-toggle="tooltip" title="Renseignez le prénom de l'enfant." parsley-required="true">
            </div>
        </div>


        <p>// Autres infos ????</p>

        
                            </form>


                        </div>
                        <div class="modal-footer">
                            <a class="btn-flat white" data-dismiss="modal">Annuler</a>
                            <a href="/sejours/supprimer/id/<?=$sejour->id; ?>/confirm/true" class="btn-flat danger"><i class="icon-remove"></i> Supprimer</a>
                        </div>
                    </div>
                </div>
            </div>



<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>