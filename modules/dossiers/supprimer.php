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
                    $result = dossier::remove($_GET['id']);
                    ?>
                    <p>Le dossier d'inscription a bien été supprimé</p>
                    <a href="/dossiers/">Retourner à la liste des dossiers d'inscriptions</a>
                </div>                
            </div>
        <?php else: ?>
            <?php $dossier = dossier::get($_GET['id']); ?>
            <div class="row" class="message">
                <div class="col-md-12 message">
                 <p>Vous êtes sur le point de supprimer le dossier d'inscription <strong><?=$dossier->id; ?> </strong>.<br /></p>
             </div>
         </div>

         <div class="row">
            <div class="col-md-12">
                <a href="/dossiers/infos/id/<?=$dossier->id; ?>" class="btn-flat white" data-dismiss="modal">Annuler</a>
                <a href="/dossiers/supprimer/id/<?=$dossier->id; ?>/confirm/true" class="btn-flat danger"><i class="icon-remove"></i> Supprimer</a>
            </div>                
        </div>


    <?php endif; ?>
</div>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>