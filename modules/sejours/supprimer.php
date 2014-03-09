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
                    $result = sejour::remove($_GET['id']);
                    ?>
                    <p>Le séjour a bien été supprimé</p>
                    <a href="/sejours/">Retourner à la liste des séjours</a>
                </div>                
            </div>
        <?php else: ?>
            <?php $sejour = sejour::get($_GET['id']); ?>
            <div class="row" class="message">
                <div class="col-md-12 message">
                 <p>Vous êtes sur le point de supprimer le séjour <strong><?=$sejour->name; ?> (<?=$sejour->numero; ?>)</strong>.<br />
                    Cette action est irréversible.</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <a href="/sejours/infos/id/<?=$sejour->id; ?>" class="btn-flat white" data-dismiss="modal">Annuler</a>
                    <a href="/sejours/supprimer/id/<?=$sejour->id; ?>/confirm/true" class="btn-flat danger"><i class="icon-remove"></i> Supprimer</a>
                </div>                
            </div>


        <?php endif; ?>

    </div>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>