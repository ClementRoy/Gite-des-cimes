<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
<?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>

	<!-- main container -->
    <div class="content">

        <!-- upper main stats -->
        <div id="main-stats">
            <div class="row stats-row">
                <div class="col-md-3 col-sm-3 stat">
                    <div class="data">
                        <span class="number"><?php echo count(enfant::getList()); ?></span>
                        enfants
                    </div>
                    <span class="date">dans la base</span>
                </div>
                <div class="col-md-3 col-sm-3 stat last">
                    <div class="data">
                        <span class="number"><?php echo count(user::getList()); ?></span>
                        utilisateurs
                    </div>
                    <span class="date">connectés</span>
                </div>
            </div>
        </div>
        <!-- end upper main stats -->

        <div id="pad-wrapper">

        </div>
    </div>

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>