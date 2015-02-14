    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
    <?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>


    <div class="page-head">
        <div class="row">
            <div class="col-sm-12">
                <h1>Suppression de fiche</h1>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-7">
            <div class="block-flat">
                <div class="content">
                    <?php if(isset($_GET['confirm'])): ?>
                    <?php $enfant = enfant::get($_GET['id']); ?>
                    <div class="alert alert-success alert-white rounded">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <div class="icon"><i class="fa fa-check"></i></div>
                        <strong>C'est fait !</strong> La fiche de <strong><?=$enfant->firstname ?> <?=$enfant->lastname ?></strong> a bien été supprimée !
                    </div>
                    <?php enfant::remove($_GET['id']); ?>

                    <?php else: ?>

                    <?php $enfant = enfant::get($_GET['id']); ?>
                            <div class="row">
                                <div class="col-md-8">
                                    <p>
                                        Vous êtes sur le point de supprimer la fiche de <strong><?=$enfant->firstname; ?> <?=$enfant->lastname; ?></strong>.<br />
                                        Cette action est irréversible.
                                    </p>

                                <div class="form-group actions text-center">
                                    <a href="/enfants/supprimer/id/<?=$enfant->id; ?>/confirm/true" class="btn btn-primary btn-rad btn-lg">Supprimer la fiche</a>
                                    <span>OU</span>
                                    <a href="/enfants/infos/id/<?=$enfant->id; ?>" class="reset">Annuler</a>
                                </div>
                            </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>