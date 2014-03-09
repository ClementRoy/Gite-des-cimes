    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
    <?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>


    <div class="content">

        <?php $enfant = enfant::get($id); ?>

        <div id="pad-wrapper">
            <div class="row header img">
                <div class="col-md-5">
                    <img src="http://placehold.it/70x70" class="img-circle" alt="">
                    <h1><?=$enfant->firstname; ?> <?=$enfant->lastname; ?></h1>
                </div>
                <div class="col-md-5 text-right pull-right">
                    <!-- <a href="/enfants/supprimer/id/<?=$enfant->id; ?>" class="btn-flat danger"><i class="icon-remove"></i> Supprimer</a> -->
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

                    <div class="tabs ctrls">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#generales" data-toggle="tab">Générales</a></li>
                            <li><a href="#administratives" data-toggle="tab">Administratives</a></li>
                            <li><a href="#sanitaires" data-toggle="tab">Sanitaires</a></li>
                            <li><a href="#notes" data-toggle="tab">Notes</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="generales">
                                <div class="row">
                                    <div class="col-md-6">
                                        <dl>
                                            <dt>Prénom :</dt> <dd><?=$enfant->firstname; ?></dd>
                                        </dl>
                                        <dl>
                                            <dt>Nom :</dt>
                                            <dd><?=$enfant->lastname; ?></dd>
                                        </dl>
                                    </div>
                                    <div class="col-md-6">
                                        <dl>
                                            <dt>Sexe :</dt>
                                            <dd>
                                                <?=($enfant->sex == 'féminin') ? '<i class="icon-female"></i> Féminin' : '<i class="icon-male"></i> Masculin'; ?></td>
                                            </dd>
                                        </dl>
                                        <dl>
                                            <dt>Date de naissance :</dt>
                                            <dd> <?php $birthdate = new DateTime($enfant->birthdate);  ?>
                                <?php if($birthdate->getTimestamp() != '-62169987600'): ?>
                                    <?=strftime('%d %B %Y', $birthdate->getTimestamp()); ?> (<?=tool::getAgeFromDate($enfant->birthdate); ?> ans)
                                <?php else: ?>
                                /
                                <?php endif; ?></dd>

                                        </dl>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="administratives">
                                <div class="row">
                                    <div class="col-md-12">
                                        <dl>
                                            <dt>Responsable légal de l'enfant :</dt>
                                            <dd>Parents</dd>
                                        </dl>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <dl>
                                            <dt>Père :</dt>
                                            <dd>Nom du père</dd>
                                            <dd><i class="icon-phone"></i>03 44 91 20 21</dd>
                                        </dl>
                                    </div>
                                    <div class="col-md-4">
                                        <dl>
                                            <dt>Mère :</dt>
                                            <dd>Nom de la mère</dd>
                                            <dd><i class="icon-phone"></i>03 44 91 20 21</dd>
                                        </dl>
                                    </div>
                                    <div class="col-md-4">
                                        <dl>
                                            <dt>Urgence :</dt>
                                            <dd>Nom d'urgence</dd>
                                            <dd><i class="icon-phone"></i>03 44 91 20 21</dd>
                                        </dl>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <dl>
                                        <dt>Adresse :</dt>
                                        <dd>33 Allée de Bellevue<br />
                                            93390 Clichy-sous-Bois</dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="sanitaires">
                                <div class="row">
                                    <div class="col-md-6">
                                        <dl>
                                            <dt>Traitements médicaux :</dt>
                                            <dd>Non</dd>
                                        </dl>
                                    </div>
                                    <div class="col-md-6">
                                        <dl>
                                            <dt>Contre-indications / allergies :</dt>
                                            <dd>Aucune</dd>
                                        </dl>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                         <dl>
                                            <dt>Assurance (RC) :</dt>
                                            <dd>Oui</dd>
                                        </dl>
                                    </div>
                                    <div class="col-md-6">
                                        <dl>
                                            <dt>Date de fin de validité :</dt>
                                            <dd>02/01/2020</dd>
                                        </dl>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <dl>
                                            <dt>Attestation CPAM :</dt>
                                            <dd>Oui</dd>
                                        </dl>
                                    </div>
                                    <div class="col-md-6">
                                        <dl>
                                            <dt>Fiche sanitaire de liaison :</dt>
                                            <dd>Oui</dd>
                                        </dl>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <dl>
                                            <dt>Carnet de vaccination :</dt>
                                            <dd>Non</dd>
                                        </dl>
                                    </div>
                                    <div class="col-md-6">
                                        <dl>
                                            <dt>Fiche de séjour :</dt>
                                            <dd>Non</dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="notes">
                                <dl>
                                    <dt>Séjour <a href="">Nom du séjour</a> - du 21/12/2004 au 28/12/2004 :</dt>
                                    <dd>Augue enim phasellus adipiscing mid parturient? Ac montes, in enim augue ut.</dd>
                                </dl>
                            </div>
                        </div>
                    </div>

                    
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

                <div class="col-md-3 address">
                    <h6>Coordonnées</h6>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m13!1m8!1m3!1d2622.060078846162!2d2.5489488500000004!3d48.914247599999996!3m2!1i1024!2i768!4f13.1!3m2!1m1!1s0x0%3A0x97bc04535ade7b59!5e0!3m2!1sfr!2sfr!4v1386513665741" width="200" height="200" frameborder="0" style="border:0"></iframe>
                    <ul>
                        <li><strong>Adresse</strong></li>
                        <li>33 Allée de Bellevue</li>
                        <li>93390 Clichy-sous-Bois</li>
                    </ul>
                    <ul>
                        <li><strong>Père</strong></li>
                        <li>Nom du père</li>
                        <li><i class="icon-phone"></i>01 41 70 35 10</li>
                    </ul>
                    <ul>
                        <li><strong>Mère</strong></li>
                        <li>Nom de la mère</li>
                        <li><i class="icon-phone"></i>01 41 70 35 10</li>
                    </ul>
                    <ul>
                        <li><strong>Urgence</strong></li>
                        <li>Nom du contact d'urgence</li>
                        <li><i class="icon-phone"></i>01 41 70 35 10</li>
                    </ul>
                </div>
            </div>
        </div>


<?php tool::output($enfant); ?>

    </div>

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>