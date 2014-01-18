<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
<?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>



<div class="content">

    <?php $enfant = enfant::get($_GET['id']); ?>
    <?php $creator = user::get($enfant->creator); ?>
    <?php $editor = user::get($enfant->editor); ?>
    <?php $date_created = new DateTime($enfant->created); ?>
    <?php $date_edited = new DateTime($enfant->edited); ?>
    <?php //tool::output($enfant); ?>

    <div id="pad-wrapper" class="user-profile">


        <div class="row header">
            <div class="col-md-8">
                <img src="http://placehold.it/74x74" class="img-circle avatar" alt="">

                <h3 class="name">
                    <?=($enfant->sex == 'féminin') ? '<i class="icon-female"></i>' : '<i class="icon-male"></i>'; ?>
                    <?=$enfant->firstname; ?> <?=$enfant->lastname; ?></h3>
                    <span class="area">
                        <?php $birthdate = new DateTime($enfant->birthdate); ?>
                        <?php if($birthdate->getTimestamp() != '-62169987600'): ?>
                            <?=strftime('%d %B %Y', $birthdate->getTimestamp()); ?> 
                            (<?=tool::getAgeFromDate($enfant->birthdate); ?> ans)
                        <?php endif; ?>
                    </span>
                </div>


                <div class="col-md-4 text-right pull-right">
                    <button class="btn-flat danger" data-toggle="modal" data-target="#remove-modal">
                        <i class="icon-remove"></i> Supprimer
                    </button>
                    <a href="/enfants/editer/id/<?=$enfant->id; ?>" class="btn-flat default"><i class="icon-edit"></i> Modifier</a>
                    <button class="metadata btn-flat white" data-container="body" data-toggle="popover" data-placement="bottom" data-html="true" data-content="<p><strong>Créé par :</strong><br/> <?=$creator->firstname; ?>,<br />le <?=strftime('%d %B %Y', $date_created->getTimestamp()); ?></p><p><strong>Edité par :</strong><br/> <?=$editor->firstname ?> ,<br />le <?=strftime('%d %B %Y', $date_edited->getTimestamp()); ?></p>" data-original-title="Informations" title="">
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
                            <p>Vous êtes sur le point de supprimer la fiche de <strong><?=$enfant->firstname; ?> <?=$enfant->lastname; ?></strong>.<br />
                                Cette action est irréversible.
                            </p>
                        </div>
                        <div class="modal-footer">
                            <a class="btn-flat white" data-dismiss="modal">Annuler</a>
                            <a href="/enfants/supprimer/id/<?=$enfant->id; ?>/confirm/true" class="btn-flat danger"><i class="icon-remove"></i> Supprimer</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 fiche">
                   <div class="row">
                   <div class="col-md-12 section"><h4>Ses informations</h4></div>
                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">A propos de l'enfant</div>
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <p><strong>Date de naissance :</strong></p>
                                    <?php $birthdate = new DateTime($enfant->birthdate); ?>
                                    <p><?=($birthdate->getTimestamp() != '-62169987600')? strftime('%d %B %Y', $birthdate->getTimestamp()) : '<em>Non renseignée</em>';?></p>
                                </li>
                                <li class="list-group-item">
                                    <p><strong>Age :</strong></p>
                                    <p><?=($birthdate->getTimestamp() != '-62169987600')? tool::getAgeFromDate($enfant->birthdate).' ans' : '<em>Non renseigné</em>';?></p>
                                </li>
                                <li class="list-group-item">
                                    <p><strong>Sexe :</strong></p>
                                    <p><?=($enfant->sex == 'féminin') ? '<i class="icon-female"></i> Féminin' : '<i class="icon-male"></i> Masculin'; ?></p>

                                </li>
                                <li class="list-group-item">
                                    <p><strong>Domiciliation :</strong></p>
                                    <?php if ($enfant->domiciliation === 'responsable'): ?>
                                        <p>Famille d'accueil</p>
                                    <?php elseif($enfant->domiciliation === 'famille'): ?>
                                        <p>Famille d'accueil</p>
                                    <?php else: ?>
                                        <p><?=EMPTYVAL; ?></p>
                                    <?php endif ?>
                                </li>
                            </ul>
                        </div>
                        <?php if (!empty($enfant->note)): ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">Notes</div>
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <p><?=$enfant->note;?></p>
                                    </li>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">Inscription de l'enfant</div>
                            <ul class="list-group">
                                <?php if($enfant->registration_by === 'structure'): ?>
                                    <li class="list-group-item">
                                        <p><strong>Structure :</strong></p>
                                        <?php if ($enfant->organization != 0): ?>
                                            <?php $structure = structure::get($enfant->organization); ?>
                                            <p><a href="/structures/infos/id/<?=$structure->id ?>"><?=$structure->name;?></a></p>
                                        <?php else: ?>
                                            <p><?=EMPTYVAL; ?></p>
                                        <?php endif ?>
                                    </li>
                                    <li class="list-group-item">
                                        <p><strong>Contact :</strong></p>
                                        <?php if ($enfant->contact != 0): ?>
                                            <?php $contact = contact::get($enfant->contact); ?>
                                            <p><a href="/contacts/infos/id/<?=$contact->id ?>"><?=$contact->civility.' '.$contact->firstname.' '.$contact->lastname;?></a></p>
                                        <?php else: ?>
                                            <p><?=EMPTYVAL; ?></p>
                                        <?php endif ?>
                                    </li>
                                <?php else: ?>
                                    <li class="list-group-item">
                                        <p><?=ucfirst($enfant->registration_by); ?></p>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">Responsable légal de l'enfant</div>
                            <ul class="list-group">
                                <?php if($enfant->guardian == 'structure'): ?>
                                    <li class="list-group-item">
                                        <p><strong>Structure :</strong></p>
                                        <?php if ($enfant->organization != 0): ?>
                                            <p><a href=""><?=$enfant->organization;?></a></p>
                                        <?php else: ?>
                                            <p><?=EMPTYVAL; ?></p>
                                        <?php endif ?>
                                    </li>
                                <?php elseif($enfant->guardian == 'tuteur'): ?>
                                    <li class="list-group-item">
                                        <p><strong>Tuteur :</strong></p>
                                        <p><?=(!empty($enfant->guardian_name))? $enfant->guardian_name : EMPTYVAL; ?> <span class="pull-right"><i class="icon-phone"></i><?=(!empty($enfant->guardian_phone))? $enfant->guardian_phone : EMPTYVAL; ?></span></p>
                                    </li>
                                <?php elseif($enfant->guardian == 'parents'): ?>
                                    <li class="list-group-item">
                                        <p><strong>Père :</strong></p>
                                        <p><?=(!empty($enfant->father_name))? $enfant->father_name : EMPTYVAL; ?> <span class="pull-right"><i class="icon-phone"></i><?=(!empty($enfant->father_phone))? $enfant->father_phone : EMPTYVAL; ?></span></p>
                                    </li>
                                    <li class="list-group-item">
                                        <p><strong>Mère :</strong></p>
                                        <p><?=(!empty($enfant->mother_name))? $enfant->mother_name : EMPTYVAL; ?> <span class="pull-right"><i class="icon-phone"></i><?=(!empty($enfant->mother_phone))? $enfant->mother_phone : EMPTYVAL; ?></span></p>
                                    </li>
                                <?php elseif($enfant->guardian == 'pere'): ?>
                                    <li class="list-group-item">
                                        <p><strong>Père :</strong></p>
                                        <p><?=(!empty($enfant->father_name))? $enfant->father_name : EMPTYVAL; ?> <span class="pull-right"><i class="icon-phone"></i><?=(!empty($enfant->father_phone))? $enfant->father_phone : EMPTYVAL; ?></span></p>
                                    </li>
                                <?php elseif($enfant->guardian == 'mere'): ?>
                                    <li class="list-group-item">
                                        <p><strong>Adresse  :</strong></p>
                                        <p><?=(!empty($enfant->guardian_address_number) && !empty($enfant->guardian_address_street) && !empty($enfant->guardian_address_postal_code) && !empty($enfant->guardian_address_city))? $enfant->guardian_address_number.' '.$enfant->guardian_address_street.', <br />'.$enfant->guardian_address_postal_code.' '.$enfant->guardian_address_city : EMPTYVAL; ?></p>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>

                        <?php if ($enfant->domiciliation == 'famille'): ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">Famille d'accueil</div>
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <p><strong>Nom de la famille d'accueil :</strong></p>
                                        <?=(!empty($enfant->host_family_name))? $enfant->host_family_name : EMPTYVAL; ?>
                                        <span class="pull-right"><i class="icon-phone"></i><?=(!empty($enfant->host_family_phone))? $enfant->host_family_phone : EMPTYVAL; ?></span></p>
                                    </li>
                                    <li class="list-group-item">
                                        <p><strong>Adresse de la famille d'accueil :</strong></p>
                                        <p><?=(!empty($enfant->host_family_address_number) && !empty($enfant->host_family_address_street) && !empty($enfant->host_family_address_postal_code) && !empty($enfant->host_family_address_city))? $enfant->host_family_address_number.' '.$enfant->host_family_address_street.', <br />'.$enfant->host_family_address_postal_code.' '.$enfant->host_family_address_city : EMPTYVAL; ?></p>
                                    </li>
                                </ul>
                            </div>
                        <?php endif ?>

                        <?php if (!empty($enfant->emergency_name)): ?>
                            <div class="panel panel-default noheader">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <p><strong>Urgence :</strong></p>
                                        <p><?=$enfant->emergency_name;?> <?php if (!empty($enfant->host_family_phone)): ?><span class="pull-right"><i class="icon-phone"></i><?=$enfant->emergency_phone;?></span><?php endif ?></p>
                                    </li>
                                </ul>
                            </div>
                        <?php endif ?>
                    </div>


                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">Dossier</div>
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <p><strong>Droit à l'image :</strong> <span class="pull-right"><?=($enfant->image_rights > 0)?'Oui':'Non'; ?></span></p>
                                </li>
                                <li class="list-group-item">
                                    <p><strong>Traitements médicaux :</strong> <span class="pull-right"><?=($enfant->medicals_treatments > 0)?'Oui':'Non'; ?></span></p>
                                </li>
                                <?php if (!empty($enfant->allergies)): ?>
                                    <li class="list-group-item">
                                        <p><strong>Contre-indications / allergies :</strong></p>
                                        <p><?=$enfant->allergies;?></p>
                                    </li>   
                                <?php endif ?>
                                <li class="list-group-item">
                                    <p><strong>N° de sécurité sociale :</strong><span class="pull-right"><?=($enfant->number_ss != 0)?'<i class="icon-ok-sign"></i>':'<i class="icon-remove-sign"></i>'; ?></span></p>
                                    <?php if ($enfant->number_ss != 0): ?>
                                        <p><?=$enfant->number_ss;?></p>
                                    <?php endif ?>
                                </li>
                                <li class="list-group-item">
                                    <p><strong>Assurance (RC) :</strong><span class="pull-right"><?=($enfant->self_assurance > 0)?'<i class="icon-ok-sign"></i>':'<i class="icon-remove-sign"></i>'; ?></span></p>
                                    <?php if ($enfant->self_assurance > 0): ?>
                                        <p><small>Validité : <?=(!empty($enfant->self_assurance_expiration_date))? $enfant->self_assurance_expiration_date : EMPTYVAL; ?></small></p>
                                    <?php endif ?>
                                </li>
                                <li class="list-group-item">
                                    <p><strong>Attestation CPAM :</strong><span class="pull-right"><?=($enfant->cpam_attestation > 0)?'<i class="icon-ok-sign"></i>':'<i class="icon-remove-sign"></i>'; ?></span></p>
                                    <?php if ($enfant->cpam_attestation > 0): ?>
                                        <p><small>Validité : <?=(!empty($enfant->cpam_attestation_expiration_date))? $enfant->cpam_attestation_expiration_date : EMPTYVAL; ?></small></p>
                                    <?php endif ?>
                                </li>
                                <li class="list-group-item">
                                    <p><strong>Fiche sanitaire de liaison :</strong><span class="pull-right"><?=($enfant->health_record > 0)?'<i class="icon-ok-sign"></i>':'<i class="icon-remove-sign"></i>'; ?></span></p>
                                </li>
                                <li class="list-group-item">
                                    <p><strong>Carnet de vaccination :</strong><span class="pull-right"><?=($enfant->vaccination > 0)?'<i class="icon-ok-sign"></i>':'<i class="icon-remove-sign"></i>'; ?></span></p>

                                </li>
                                <li class="list-group-item">
                                    <p><strong>Fiche de séjour :</strong><span class="pull-right"><?=($enfant->stay_record > 0)?'<i class="icon-ok-sign"></i>':'<i class="icon-remove-sign"></i>'; ?></span></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            <div class="row">
                        
                <div class="col-md-12">
                       <div class="col-md-6">
                            <h4>Ses séjours</h4>
                        </div>
                        <div class="col-md-6 text-right">
                             <button class="btn-flat success" data-toggle="modal" data-target="#add-modal">
                                <i class="icon-plus"></i> Inscrire l'enfant à un séjour
                            </button>
                        </div>
                        </div>
                        <table class="table table-hover extendlink">
                            <thead>
                                <tr>
                                    <th class="col-md-1">
                                        N° 
                                    </th>
                                    <th class="col-md-3">
                                        <span class="line"></span>
                                        Dates
                                    </th>
                                    <th class="col-md-5">
                                        <span class="line"></span>
                                        Nom du séjour
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <a href="#">459</a>
                                    </td>
                                    <td>
                                        12 au 17 décembre 2014
                                    </td>
                                    <td>
                                        <a href="#">Du Vert et du Bleu</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="#">471</a>
                                    </td>
                                    <td>
                                        21 au 28 juillet 2013
                                    </td>
                                    <td>
                                        <a href="#">Brises et Houles</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
             </div>


    <?php //tool::output($enfant); ?>

</div>



            <div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-labelledby="add-modal-label" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h6 class="modal-title" id="add-modal-label">Inscrire l'enfant à un séjour</h6>
                        </div>
                        <div class="modal-body">

                            <form action="" method="get">
  
                             <div class="field-box row">
                            <div class="ui-select">
                                <?php $sejours = sejour::getList(); ?>
                                <select id="form-enfant-select" name="form_enfant_structure">
                                    <option value="" selected="selected">Sélectionnez un séjour</option>
                                    <?php foreach($sejours as $sejour): ?>
                                    <option value="<?=$sejour->id ?>"><?=$sejour->name ?></option>
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
