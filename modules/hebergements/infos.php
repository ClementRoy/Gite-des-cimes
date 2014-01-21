    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
    <?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>

    
    <?php // TODO : ne pas oublier de lister les contacts associés  ?>
    <?php $hebergement = hebergement::get($_GET['id']); ?>
    <?php $creator = user::get($hebergement->creator); ?>
    <?php $editor = user::get($hebergement->editor); ?>
    <?php $date_created = new DateTime($hebergement->created); ?>
    <?php $date_edited = new DateTime($hebergement->edited); ?>

    <!-- main container -->
    <div class="content">
      <div id="pad-wrapper" class="users-profil">
        <div class="row header icon">
          <div class="col-md-7">
            <a href="#" class="trigger"><i class="big-icon icon-building"></i></a>
                <div class="pop-dialog">
                    <div class="pointer">
                        <div class="arrow"></div>
                        <div class="arrow_border"></div>
                    </div>
                    <div class="body">
                        <!--<a href="#" class="close-icon"><i class="icon-remove-sign"></i></a>-->
                        <div class="menu">
                            <a href="/hebergements/editer/id/<?=$hebergement->id; ?>" class="item"><i class="icon-edit"></i> Modifier</a>
                            <a href="/hebergements/supprimer/id/<?=$hebergement->id; ?>" class="item" data-toggle="modal"><i class="icon-remove"></i> Supprimer</a>
                            <!--<a href="#" class="item" data-container="body" data-toggle="popover" data-placement="bottom" data-html="true" data-content="<strong>Créé par :</strong><br/> <a href='/utilisateurs/infos/<?=$creator->id; ?>'><?=$creator->firstname; ?></a>, le <?=strftime('%d %B %Y', $date_created->getTimestamp()); ?> <br /><strong>Edité par :</strong><br/> <?=$editor->firstname ?> ,le <?=strftime('%d %B %Y', $date_edited->getTimestamp()); ?> " data-original-title="Informations" title=""><i class="icon-info-sign"></i> Informations</a>-->
                            <!--<div class="footer">
                                <a href="#" class="logout">Supprimer</a>
                            </div>-->
                        </div>
                    </div>
                </div>
            <h3><?=$hebergement->name; ?></h3>
          </div>
          <div class="col-md-5 text-right pull-right">
            <!--<button class="btn-flat danger" data-toggle="modal" data-target="#remove-modal">
              <i class="icon-remove"></i> Supprimer
            </button>
            <a href="/hebergements/editer/id/<?=$hebergement->id; ?>" class="btn-flat default"><i class="icon-edit"></i> Modifier</a>
            <button class="metadata btn-flat white" data-container="body" data-toggle="popover" data-placement="bottom" data-html="true" data-content="<p><strong>Créé par :</strong><br/> <?=$creator->firstname; ?>, <br>le <?=strftime('%d %B %Y', $date_created->getTimestamp()); ?> </p><p><strong>Edité par :</strong><br/> <?=$editor->firstname ?>, <br>le <?=strftime('%d %B %Y', $date_edited->getTimestamp()); ?></p>" data-original-title="Informations" title="">
              <i class="icon-info-sign"></i>
            </button>-->  
          </div>
        </div>

          <div class="col-md-9 bio">

            <div class="row">
              <?php tool::output($hebergement); ?>

            </div>

          </div>

          <div class="col-md-3 address">
            <h6>Coordonnées</h6>
            <?php $geo = tool::getLatLng($hebergement->address_number.' '.$hebergement->address_street.' '.$hebergement->address_postal_code.' '.$hebergement->address_city); ?>
            <img src="https://maps.googleapis.com/maps/api/staticmap?center=<?=$geo[0]; ?>,<?=$geo[1]; ?>&zoom=12&size=210x200&scale=2&markers=<?=$geo[0]; ?>,<?=$geo[1]; ?>&sensor=false" width="100%" alt="">
            <ul>
              <li><strong>Adresse</strong></li>
              <li><?=$hebergement->address_number; ?> <?=$hebergement->address_street; ?></li>
              <li><?=$hebergement->address_postal_code; ?> <?=$hebergement->address_city; ?></li>              
            </ul>

          </div>
        </div>
        <?php //tool::output($hebergement); ?>
        <?php //tool::output($contacts); ?>
      </div>

    </div>
  </div><!-- /.container -->

  <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>