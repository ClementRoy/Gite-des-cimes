<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>



    <?php $enfant = enfant::get($_GET['id']); ?>
    <?php $creator = user::get($enfant->creator); ?>
    <?php $editor = user::get($enfant->editor); ?>
    <?php $date_created = new DateTime($enfant->created); ?>
    <?php $date_edited = new DateTime($enfant->edited); ?>


    <div class="content">

        <?php if(isset($_POST['activate'])): ?>
                <div class="alert alert-success">
                    <i class="icon-ok-sign"></i>
                    Cette fiche a bien été réactivée !
                </div>
                <?php enfant::unarchive($_GET['id']); ?>
        <?php endif; ?>

        <?php if($enfant->archived) :?>
        <div class="alert alert-info">
            <i class="icon-exclamation-sign"></i> Cette fiche est archivée voulez-vous la réactiver ?
            <form action="" method="post" class="pull-right">
                <button class="btn btn-primary" name="activate">Réactiver</button>
            </form>
        </div>
        <?php endif; ?>

        <div id="pad-wrapper" class="users-profil<?=($enfant->archived)?' archived':' ';?>" >

            <?php //tool::output($enfant); ?>

            <div class="row header icon">
                <div class="col-md-7">
                    <a href="#" class="trigger"><i class="big-icon icon-user"></i></a>

                    <div class="pop-dialog">
                        <div class="pointer">
                            <div class="arrow"></div>
                            <div class="arrow_border"></div>
                        </div>
                        <div class="body">
                            <div class="menu">
                                <a href="/enfants/editer/id/<?=$enfant->id; ?>" class="item"><i class="icon-edit"></i> Modifier</a>
                                <a href="/enfants/supprimer/id/<?=$enfant->id; ?>" class="item" data-toggle="modal"><i class="icon-remove"></i> Supprimer</a>
                            </div>
                        </div>
                    </div>

                    <h3><!-- class="name" -->
                    
                    <?=$enfant->firstname; ?> <?=$enfant->lastname; ?>
                    <small class="area">
                        <?=($enfant->sex == 'féminin') ? '<i class="icon-female"></i>' : '<i class="icon-male"></i>'; ?>
                        <?php $birthdate = new DateTime($enfant->birthdate); ?>
                        <?php if($birthdate->getTimestamp() != '-62169987600'): ?>
                            <?=strftime('%d %B %Y', $birthdate->getTimestamp()); ?> 
                            (<?=tool::getAgeFromDate($enfant->birthdate); ?> ans)
                        <?php endif; ?>
                    </small>
                    </h3>
                </div>


                <div class="col-md-4 text-right pull-right">
                    <i class="icon-cog"></i>
                </div>

            </div>

            <div class="row profile">

                <div class="col-md-9 bio">
                    <h6>Ses informations</h6>
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
                                    <?php if ($enfant->domiciliation === 'responsable'): ?>
                                        <p>Responsable légal</p>
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
                                <?php else: ?>
                                    <li class="list-group-item">Aucun responsable légal de défini pour le moment</li>
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


                    <div class="pull-right">
                        <a href="/inscriptions/ajouter/enfant/<?=$enfant->id; ?>" class="btn-flat primary"><span>+</span> Inscrire à un séjour</a>
                    </div>
                        <?php $inscriptions = inscription::getByEnfant($enfant->id); ?>
                        <?php //tool::output($inscriptions); ?>
                    <h6>Séjours à venir de l'enfant</h6>
                      <table class="table table-hover extendlink">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>
                                        Nom du séjour
                                    </th>
                                    <th>
                                        <span class="line"></span>
                                        Dates
                                    </th>
                                    <th>
                                        <span class="line"></span>
                                        Note
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($inscriptions as $key => $inscription): ?>
                                <?php $sejour = sejour::get($inscription->ref_sejour); ?>
                                <tr>
                                    <td>
                                        <a href="/inscriptions/infos/id/<?=$inscription->id; ?>">#<?=$key+1 ?></a>
                                        <div class="pop-dialog tr">
                                            <div class="pointer">
                                                <div class="arrow"></div>
                                                <div class="arrow_border"></div>
                                            </div>
                                            <div class="body">
                                                <div class="menu">
                                                    <a href="/inscriptions/infos/id/<?=$inscription->id; ?>" class="item"><i class="icon-share"></i> Voir la fiche</a>
                                                    <a href="/inscriptions/editer/id/<?=$inscription->id; ?>" class="item"><i class="icon-edit"></i> Modifier</a>
                                                    <a href="/inscriptions/supprimer/id/<?=$inscription->id; ?>" class="item"><i class="icon-remove"></i> Supprimer</a>
                                                </div>
                                            </div>
                                        </div> 
                                    </td>
                                    <td>
                                        <a href="/sejours/infos/id/<?=$sejour->id ?>"><?=$sejour->name ?></a>
                                    </td>
                                    <td>
                                        <?php $date_from = new DateTime($inscription->date_from); ?>
                                        <?php $date_to = new DateTime($inscription->date_to); ?>
                                        du <?=strftime('%d %B %Y', $date_from->getTimestamp()); ?>  au <?=strftime('%d %B %Y', $date_to->getTimestamp()); ?> 
                                    </td>
                                    <td>
                                        <?=$inscription->note ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                </div>

                <div class="col-md-3 address">
<?php  
/*
[guardian] => 
    [father_name] => 
    [father_phone_home] => 06 13 88 8
    [father_phone_mobile] => 
    [father_phone_pro] => 
    [father_address_number] => 
    [father_address_street] => 
    [father_address_postal_code] => 
    [father_address_city] => 
    [mother_name] => Mme MALAMBA Attie
    [mother_phone_home] => 
    [mother_phone_mobile] => 
    [mother_phone_pro] => 
    [mother_address_number] => 
    [mother_address_street] => 
    [mother_address_postal_code] => 
    [mother_address_city] => 
    [guardian_name] => 
    [guardian_phone_home] => 
    [guardian_phone_mobile] => 
    [guardian_phone_pro] => 
    [emergency_name] => 
    [emergency_phone] => 
    [guardian_address_number] => 
    [guardian_address_street] => 
    [guardian_address_postal_code] => 0
    [guardian_address_city] => 
    [domiciliation] => responsable
    [host_family_name] => 
    [host_family_phone_home] => 
    [host_family_phone_mobile] => 
    [host_family_phone_pro] => 
    [host_family_address_number] => 
    [host_family_address_street] => 
    [host_family_address_postal_code] => 0
    [host_family_address_city] => 
*/

?>
<div>
<?php if(!empty($enfant->father_phone_pro) || !empty($enfant->father_phone_mobile) || !empty($enfant->father_phone_home)): ?>
<h6>Père</h6>
<p><?=(!empty($enfant->father_name))? $enfant->father_name : EMPTYVAL; ?> 
    <span class="pull-right"><?=(!empty($enfant->father_phone_home))? '<i class="icon-phone"></i> Fixe : '.$enfant->father_phone_home : ''; ?></span>
    <span class="pull-right"><?=(!empty($enfant->father_phone_mobile))? '<i class="icon-phone"></i> Portable : '.$enfant->father_phone_mobile : ''; ?></span>
    <span class="pull-right"><?=(!empty($enfant->father_phone_pro))? '<i class="icon-phone"></i> Pro : '.$enfant->father_phone_pro : ''; ?></span>
<?php endif; ?>

</p>
<!--
    [father_address_number] => 
    [father_address_street] => 
    [father_address_postal_code] => 
    [father_address_city] => 
-->
</div>
<div>
<?php if(!empty($enfant->mother_phone_pro) || !empty($enfant->mother_phone_mobile) || !empty($enfant->mother_phone_home)): ?>
<h6>Mère</h6>
<p><?=(!empty($enfant->mother_name))? $enfant->mother_name : EMPTYVAL; ?>
    <span class="pull-right"><?=(!empty($enfant->mother_phone_home))? '<i class="icon-phone"></i> Fixe : '.$enfant->mother_phone_home : ''; ?></span>
    <span class="pull-right"><?=(!empty($enfant->mother_phone_mobile))? '<i class="icon-phone"></i> Portable : '.$enfant->mother_phone_mobile : ''; ?></span>
    <span class="pull-right"><?=(!empty($enfant->mother_phone_pro))? '<i class="icon-phone"></i> Pro : '.$enfant->mother_phone_pro : ''; ?></span>
<?php endif; ?>
</p>
<!--
    [mother_address_number] => 
    [mother_address_street] => 
    [mother_address_postal_code] => 
    [mother_address_city] => 
-->
</div>
<div>
<?php if(!empty($enfant->guardian_phone_pro) && !empty($enfant->guardian_phone_mobile) && !empty($enfant->guardian_phone_home)): ?>
<h6>Responsable légale</h6>
<p><?=(!empty($enfant->guardian_name))? $enfant->guardian_name : EMPTYVAL; ?> 
    <span class="pull-right"><?=(!empty($enfant->guardian_phone_home))? '<i class="icon-phone"></i> Fixe : '.$enfant->guardian_phone_home : ''; ?></span>
    <span class="pull-right"><?=(!empty($enfant->guardian_phone_mobile))? '<i class="icon-phone"></i> Portable : '.$enfant->guardian_phone_mobile : ''; ?></span>
    <span class="pull-right"><?=(!empty($enfant->guardian_phone_pro))? '<i class="icon-phone"></i> Pro : '.$enfant->guardian_phone_pro : ''; ?></span>
<?php endif; ?>

</p>
<!--
    [guardian_address_number] => 
    [guardian_address_street] => 
    [guardian_address_postal_code] => 0
    [guardian_address_city] => 
-->
</div>
<div>
<?php if(!empty($enfant->emergency_phone)): ?>
<h6>Contact d'urgence</h6>
<p><?=(!empty($enfant->emergency_name))? $enfant->emergency_name : EMPTYVAL; ?></p> 
<p><span class="pull-right"><i class="icon-phone"></i> <?=$enfant->emergency_phone;?></span></p>
<?php endif; ?>
</div>
<div>
<?php if(!empty($enfant->host_family_phone_pro) || !empty($enfant->host_family_phone_mobile) || !empty($enfant->host_family_phone_home)): ?>
<h6>Famille d'accueil</h6>
<p><?=(!empty($enfant->host_family_name))? $enfant->host_family_name : EMPTYVAL; ?> 
    <span class="pull-right"><?=(!empty($enfant->host_family_phone_home))? '<i class="icon-phone"></i> Fixe : '.$enfant->host_family_phone_home : ''; ?></span>
    <span class="pull-right"><?=(!empty($enfant->host_family_phone_mobile))? '<i class="icon-phone"></i> Portable : '.$enfant->host_family_phone_mobile : ''; ?></span>
    <span class="pull-right"><?=(!empty($enfant->host_family_phone_pro))? '<i class="icon-phone"></i> Pro : '.$enfant->host_family_phone_pro : ''; ?></span>
<?php endif; ?>
</p>
<!--
    [host_family_address_number] => 
    [host_family_address_street] => 
    [host_family_address_postal_code] => 0
    [host_family_address_city] => 
-->
</div>

                </div>

            </div>



            <?php if($enfant->archived) :?>
            <div class="alert alert-danger">
                <i class="icon-remove-sign"></i> Cette fiche est archivée voulez-vous la supprimer ?
                <form action="" method="post" class="pull-right">
                    <button class="btn btn-danger" name="activate">Supprimer</button>
                </form>
            </div>
            <?php endif; ?>




        </div>

    </div>




<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>
