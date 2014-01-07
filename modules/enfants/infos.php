<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
<?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>



    <div class="content">
        
        <?php $enfant = enfant::get($_GET['id']); ?>

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
                <a class="btn-flat icon pull-right delete-user" data-toggle="modal" data-target="#remove-modal">
                    <i class="icon-trash"></i>
                </a>

                <a href="/enfants/editer/id/<?=$enfant->id; ?>" class="btn-flat icon large pull-right edit">
                    <i class="icon-edit"></i> Modifier cette fiche
                </a>
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
                    <div class="col-md-12 bio">
                       <h4>Ses informations</h4>
                       <div class="row">
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
                                        <p><?=$enfant->domiciliation; ?></p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="panel panel-default">
                                <div class="panel-heading">Responsable légal de l'enfant</div>

                                <ul class="list-group">
                                    <?php if($enfant->registration_by = 'particulier'): ?>
                                        <?php if($enfant->guardian = 'tuteur'): ?>
                                            <li class="list-group-item">
                                                <p><strong>Tuteur :</strong></p>
                                                <p><?=$enfant->guardian_name;?> <?php if (!empty($enfant->guardian_phone)): ?><span class="pull-right"><i class="icon-phone"></i><?=$enfant->guardian_phone;?></span><?php endif ?></p>
                                            </li>
                                        <?php else: ?>
                                            <?php if (!empty($enfant->father_name)): ?>
                                                <li class="list-group-item">
                                                    <p><strong>Père :</strong></p>
                                                    <p><?=$enfant->father_name;?> <?php if (!empty($enfant->father_phone)): ?><span class="pull-right"><i class="icon-phone"></i><?=$enfant->father_phone;?></span><?php endif ?></p>
                                                </li>
                                            <?php endif ?>
                                            
                                            <?php if (!empty($enfant->mother_name)): ?>
                                                <li class="list-group-item">
                                                    <p><strong>Mère :</strong></p>
                                                    <p><?=$enfant->mother_name;?> <?php if (!empty($enfant->mother_phone)): ?><span class="pull-right"><i class="icon-phone"></i><?=$enfant->mother_phone;?></span><?php endif ?></p>
                                                </li>
                                            <?php endif; ?>
                                        <?php endif ?>
                                        <li class="list-group-item">
                                            <p><strong>Adresse  :</strong></p>
                                            <p><?=$enfant->guardian_address_number;?> <?=$enfant->guardian_address_street;?>,<br /> <?=$enfant->guardian_address_postal_code;?> <?=$enfant->guardian_address_city;?></p>
                                        </li>
                                    <?php elseif($enfant->registration_by = 'structure'): ?>
                                        <li class="list-group-item">
                                            <p><strong>Structure :</strong></p>
                                            <p><?=$enfant->organization;?></p>
                                        </li>
                                        <li class="list-group-item">
                                            <p><strong>Contact :</strong></p>
                                            <p><?=$enfant->contact;?></p>
                                        </li>
                                    <?php endif; ?>

                                    
                                </ul>
                            </div>

                            <?php if ($enfant->domiciliation = 'famille'): ?>
                                <div class="panel panel-default noheader">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <p><strong>Famille d'accueil :</strong></p>
                                            <p><?=$enfant->host_family_name;?> <?php if (!empty($enfant->host_family_phone)): ?><span class="pull-right"><i class="icon-phone"></i><?=$enfant->host_family_phone;?></span><?php endif ?></p>
                                        </li>
                                        <li class="list-group-item">
                                            <p><strong>Famille d'accueil :</strong></p>
                                            <p><?=$enfant->host_family_address_number;?> <?=$enfant->host_family_address_street;?>,<br /> <?=$enfant->host_family_address_postal_code;?> <?=$enfant->host_family_address_city;?></p>
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
                                            <p><small>Validité : <?=$enfant->self_assurance_expiration_date;?></small></p>
                                        <?php endif ?>
                                    </li>
                                    <li class="list-group-item">
                                        <p><strong>Attestation CPAM :</strong><span class="pull-right"><?=($enfant->cpam_attestation > 0)?'<i class="icon-ok-sign"></i>':'<i class="icon-remove-sign"></i>'; ?></span></p>
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






                    <dl>
                        <dt>Séjour <a href="">Nom du séjour</a> - du 21/12/2004 au 28/12/2004 :</dt>
                        <dd>Augue enim phasellus adipiscing mid parturient? Ac montes, in enim augue ut.</dd>
                    </dl>


                    <h4>Ses séjours</h4>
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
        </div>


        <?php tool::output($enfant); ?>

    </div>

    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>
