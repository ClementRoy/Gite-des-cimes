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
                    accompagnateur::remove($_GET['id']);
                    ?>
                    <div class="alert alert-danger">
                        <i class="icon-remove-sign"></i>
                        L'accompagnateur a bien été supprimé
                    </div>
                    <a href="/accompagnateurs/">Retourner à la liste des accompagnateurs</a>

                </div>                
            </div>
        <?php else: ?>
            <?php $accompagnateur = accompagnateur::get($_GET['id']); ?>
            <div class="row" class="message">
                <div class="col-md-12 message">
                 <p>Vous êtes sur le point de supprimer l'accompagnateur <strong><?=$accompagnateur->firstname; ?> <?=$accompagnateur->lastname; ?></strong>.<br />
                    Cette action est irréversible.</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <a href="/accompagnateurs/infos/id/<?=$accompagnateur->id; ?>" class="btn-flat white" data-dismiss="modal">Annuler</a>
                    <a href="/accompagnateurs/supprimer/id/<?=$accompagnateur->id; ?>/confirm/true" class="btn-flat danger"><i class="icon-remove"></i> Supprimer</a>
                </div>                
            </div>


        <?php endif; ?>


    </div>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>