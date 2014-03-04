    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
    <?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>


    <div class="content">

        <?php $inscription = inscription::get($_GET['id']); ?>
        <?php //tool::output($sejour); ?>
        <?php $creator = user::get($inscription->creator); ?>
        <?php $editor = user::get($inscription->editor); ?>
        <?php $date_created = new DateTime($inscription->created); ?>
        <?php $date_edited = new DateTime($inscription->edited); ?>

        <div id="pad-wrapper" class="users-profil">
            <div class="row header icon">
                <div class="col-md-7">
                    <a href="#" class="trigger"><i class="big-icon icon-plane"></i></a>
                    <div class="pop-dialog">
                        <div class="pointer">
                            <div class="arrow"></div>
                            <div class="arrow_border"></div>
                        </div>
                        <div class="body">
                            <div class="menu">
                                <a href="/inscriptions/editer/id/<?=$inscription->id; ?>" class="item"><i class="icon-edit"></i> Modifier</a>
                                <a href="/inscriptions/supprimer/id/<?=$inscription->id; ?>" class="item" data-toggle="modal"><i class="icon-remove"></i> Supprimer</a>
                            </div>
                        </div>
                    </div>                    
                    <h3><?=$inscription->id; ?></h3>
                </div>
                <div class="col-md-5 text-right pull-right">
         
                </div>
            </div>

            <div class="row">
                <div class="col-md-9 bio">

                <ul>
                    <li> éditer le contrat, </li>
                    <li>le dossier d'inscription </li>
                    <li>et la convocation.</li>
                </ul>
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


                
  
                </div>

                <div class="col-md-3 address">

                </div>
            </div>
        </div>

    </div>




<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>