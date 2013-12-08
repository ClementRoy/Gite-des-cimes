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
                        <a href="/enfants/remove/id/<?=$enfant->id; ?>" class="btn-flat danger"><i class="icon-remove"></i> Supprimer</a>
                        <a href="/enfants/editer/id/<?=$enfant->id; ?>" class="btn-flat default"><i class="icon-edit"></i> Modifier</a>
                </div>
            </div>

        <?php tool::output($enfant); ?>
              
        </div>
        
    </div>

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>