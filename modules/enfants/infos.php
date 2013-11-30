    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
    <?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>


    <div class="content">

        <?php $enfant = enfant::get($id); ?>
        <div id="pad-wrapper" class="users-list">
            <div class="row header">
                <h3><?=$enfant->firstname; ?> <?=$enfant->lastname; ?></h3>
            </div>

        <?php tool::output($enfant); ?>
              
        </div>
        
    </div>

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>