    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
    <?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>


    <div class="content">

        <?php $sejour = sejour::get($_GET['id']); ?>
        <?php //tool::output($sejour); ?>
        <?php 
          if($sejour->ref_hebergement && $sejour->ref_hebergement != 0) {
            $hebergement = hebergement::get($sejour->ref_hebergement);
          }
        ?>
        <?php $creator = user::get($sejour->creator); ?>
        <?php $editor = user::get($sejour->editor); ?>
        <?php $date_created = new DateTime($sejour->created); ?>
        <?php $date_edited = new DateTime($sejour->edited); ?>

        <div id="pad-wrapper" class="users-profil">
            <div class="row header icon">
                <div class="col-md-10">
                    <a href="#" class="trigger"><i class="big-icon icon-plane"></i></a>
                    <div class="pop-dialog">
                        <div class="pointer">
                            <div class="arrow"></div>
                            <div class="arrow_border"></div>
                        </div>
                        <div class="body">
                            <div class="menu">
                                <a href="/sejours/editer/id/<?=$sejour->id; ?>" class="item"><i class="icon-edit"></i> Modifier</a>
                                <a href="/sejours/supprimer/id/<?=$sejour->id; ?>" class="item" data-toggle="modal"><i class="icon-remove"></i> Supprimer</a>
                            </div>
                        </div>
                    </div>                    
                    <h3><?=$sejour->name; ?></h3>
                </div>
                <div class="col-md-2 pull-right">

                    <div class="btn-group">
                        <button class="btn glow"><i class="icon-download-alt"></i></button>
                        <button class="btn glow dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="/export/sejour/type/1/id/<?=$sejour->id ?>">Récapitulatif mineurs</a></li>
                            <li><a href="/export/sejour/type/2/id/<?=$sejour->id ?>">Suivi sanitaire</a></li>
                            <li><a href="/export/sejour/type/3/id/<?=$sejour->id ?>">Registre des mineurs</a></li>
                        </ul>
                    </div>         
                </div>
            </div>

            <div class="row">
                <div class="col-md-9 bio">

                    <!--
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
                        </div>
                        
                    </div>
                -->


                    <h4>Capacité du séjour</h4>
                    <?php $inscriptions = inscription::getBySejour($sejour->id); ?>
                    <div class="progress">
                      <div class="progress-bar" role="progressbar" aria-valuenow="<?=count($inscriptions) ?>" aria-valuemin="0" aria-valuemax="<?=$sejour->capacity_min ?>" style="width: <?php echo (count($inscriptions)/$sejour->capacity_max)*100; ?>%;">
                        <span><?=count($inscriptions) ?></span>
                      </div>
                      <!--
                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="1" aria-valuemin="0" aria-valuemax="7" style="width: 10%">
                        <span>1</span>
                      </div>
                  -->
                      <span><?=$sejour->capacity_max ?></span>
                    </div>


                    <?php //tool::output($inscriptions); ?>

                    
                    <div class="pull-right">
                        <a href="/inscriptions/ajouter/sejour/<?=$sejour->id; ?>" class="btn-flat primary"><span>+</span> Ajouter un enfant à ce séjour</a>
                    </div>
                    <h6>Enfants inscrits à ce séjour</h6>

                    <?php if(count($inscriptions) > 0): ?>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>
                                    id
                                </th>
                                <th class="col-md-3">
                                    Prénom
                                </th>
                                <th class="col-md-3">
                                    <span class="line"></span>
                                    Nom
                                </th>
                                <th class="col-md-2">
                                    <span class="line"></span>
                                    Dates
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($inscriptions as $inscription): ?>
                            <?php $enfant = enfant::get($inscription->ref_enfant); ?>
                            <tr>
                                <td>
                                    <?=$inscription->id ?>
                                </td>
                                <td>
                                    <a href="/enfants/infos/id/<?=$enfant->id ?>"><?=$enfant->firstname ?></a>
                                </td>
                                <td>
                                    <a href="/enfants/infos/id/<?=$enfant->id ?>"><?=$enfant->lastname ?></a>
                                </td>
                                <td>
                                    du <?=tool::getDatefromDatetime($inscription->date_from); ?> au <?=tool::getDatefromDatetime($inscription->date_to); ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php else: ?>
                        <em>Aucune inscription pour le moment</em>
                    <?php endif; ?>
                </div>

                <div class="col-md-3 address">
                    <?php if(isset($hebergement )): ?>
                    <h6>Coordonnées</h6>
                    <?php $geo = tool::getLatLng($hebergement->address_number.' '.$hebergement->address_street.' '.$hebergement->address_postal_code.' '.$hebergement->address_city); ?>
                    <img src="https://maps.googleapis.com/maps/api/staticmap?center=<?=$geo[0]; ?>,<?=$geo[1]; ?>&zoom=12&size=210x200&scale=2&markers=<?=$geo[0]; ?>,<?=$geo[1]; ?>&sensor=false" width="100%" alt="">
                    <ul>
                      <li><strong>Adresse</strong></li>
                      <li><?=$hebergement->address_number; ?> <?=$hebergement->address_street; ?></li>
                      <li><?=$hebergement->address_postal_code; ?> <?=$hebergement->address_city; ?></li>              
                    </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div>




<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>