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
                    <h3><?=$enfant->firstname; ?> <?=$enfant->lastname; ?></h3>
                    </div>
                    <div class="col-md-5 text-right pull-right">
                        <a href="/enfants/supprimer/id/<?=$enfant->id; ?>" class="btn-flat danger"><i class="icon-remove"></i> Supprimer</a>
                        <a href="/enfants/editer/id/<?=$enfant->id; ?>" class="btn-flat default"><i class="icon-edit"></i> Modifier</a>
                    </div>
                </div>
            

                <div class="row">
                    <div class="col-md-9 bio">
                    
                    <div class="tabs ctrls">
                        <ul class="nav nav-tabs">
                          <li class="active"><a href="#home" data-toggle="tab">Générales</a></li>
                          <li><a href="#profile" data-toggle="tab">Administratives</a></li>
                          <li><a href="#messages" data-toggle="tab">Sanitaires</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="home">
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
                                            <dd><i class="icon-male"></i>Homme</dd>
                                        </dl>
                                        <dl>
                                            <dt>Date de naissance :</dt>
                                            <dd>02/01/1990 (23 ans)</dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="profile">
                                <div class="row">
                                    <div class="col-md-12">
                                        <dl>
                                            <dt>Responsable légal de l'enfant :</dt>
                                            <dd>Parents</dd>
                                        </dl>
                                    </div>
                                    <div class="col-md-6">
                                        <dl>
                                            <dt>Père :</dt>
                                            <dd>Nom du père</dd>
                                            <dd><i class="icon-phone"></i>03 44 91 20 21</dd>
                                        </dl>
                                    </div>
                                           <div class="col-md-6">
                                        <dl>
                                            <dt>Mère :</dt>
                                            <dd>Nom de la mère</dd>
                                            <dd><i class="icon-phone"></i>03 44 91 20 21</dd>
                                        </dl>
                                    </div>
                                    <div class="col-md-6">
                                        <dl>
                                            <dt>Urgence :</dt>
                                            <dd>Nom d'urgence</dd>
                                            <dd><i class="icon-phone"></i>03 44 91 20 21</dd>
                                        </dl>
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

                                <div class="row">
                                    <div class="col-md-6">
                                        <dl>
                                            <dt>Responsable légal de l'enfant :</dt>
                                            <dd><a href="">Parents</a></dd>
                                        </dl>
                                    </div>
                                    <div class="col-md-6">
                                        <dl>
                                            <dt>Sexe :</dt>
                                            <dd><i class="icon-male"></i> Homme</dd>
                                        </dl>
                                        <dl>
                                            <dt>Date de naissance :</dt>
                                            <dd>02/01/1990 (23 ans)</dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="messages">
                                <div class="row">
                                    <div class="col-md-6">
                                        <dl>
                                            <dt>Traitement(s) médical(s) :</dt>
                                            <dd>Non</dd>
                                        </dl>
                                        <dl>
                                            <dt>Contre-indications / allergies :</dt>
                                            <dd><a href="">Aucune</a></dd>
                                        </dl>
                                        <dl>
                                            <dt>Attestation CPAM :</dt>
                                            <dd><a href="">Oui</a></dd>
                                        </dl>
                                        <dl>
                                            <dt>Attestation CPAM :</dt>
                                            <dd><a href="">Oui</a></dd>
                                        </dl>
                                        <dl>
                                            <dt>Fiche sanitaire de liaison :</dt>
                                            <dd><a href="">Oui</a></dd>
                                        </dl>
                                    </div>
                                    <div class="col-md-6">
                                        <dl>
                                            <dt>Assurance (RC) :</dt>
                                            <dd>Oui</dd>
                                        </dl>
                                        <dl>
                                            <dt>Date de fin de validité :</dt>
                                            <dd>02/01/2020</dd>
                                        </dl>
                                        <dl>
                                            <dt>Carnet de vaccination :</dt>
                                            <dd>Non</dd>
                                        </dl>
                                        <dl>
                                            <dt>Fiche de séjour :</dt>
                                            <dd>Non</dd>
                                        </dl>
                                    </div>
                                </div>
                                </div>
                        </div>
                    </div>


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


        <?php tool::output($enfant); ?>
              
        </div>
        
    </div>

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>