    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
    <?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>


    <div class="title">
        <div class="row header">
            <div class="col-md-12">
                <h1>Suppression</h1>
            </div>
        </div>
    </div>

    <div class="content">
        <?php if(isset($_GET['confirm'])): ?>
            <div class="row">
                <div class="col-md-12">
                    <?php 
                    enfant::remove($_GET['id']);
                    ?>
                    <div class="alert alert-danger">
                        <i class="icon-remove-sign"></i>
                        La fiche a bien été supprimée
                    </div>
                    <a href="/enfants/index">Retourner à la liste des enfants</a>
                </div>                
            </div>
        <?php else: ?>

            <?php $enfant = enfant::get($_GET['id']); ?>
            <div class="row">
                <div class="col-md-12 message">
                   <p>Vous êtes sur le point de supprimer la fiche de <strong><?=$enfant->firstname; ?> <?=$enfant->lastname; ?></strong>.<br />
                    Cette action est irréversible.</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <a href="/enfants/infos/id/<?=$enfant->id; ?>" class="btn-flat white" data-dismiss="modal">Annuler</a>
                    <a href="/enfants/supprimer/id/<?=$enfant->id; ?>/confirm/true" class="btn-flat danger"><i class="icon-remove"></i> Supprimer</a>
                </div>                
            </div>

        <?php endif; ?>
    </div>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>