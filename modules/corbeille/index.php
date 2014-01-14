    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
    <?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>


    <!-- main container -->
    <div class="content">
<div id="pad-wrapper">
            <div class="row header">
                <div class="col-md-4">
                    <h3>Les enfants</h3>
                </div>
                <div class="col-md-8 text-right">
                    <input type="text" id="table-enfant-search" data-search="enfant" class="col-md-5 search" placeholder="Tapez le nom d'un enfant..." autofocus="autofocus">
                </div>
            </div>

            <?php $enfants = enfant::getTrashed(); ?>

            <!--
            <div class="alert alert-success">
                <i class="icon-ok-sign"></i> Your order has been placed.
            </div>
            <div class="alert alert-info">
                <i class="icon-exclamation-sign"></i>
                Do you want to get these resources for as little as $0.70 each?
            </div>
            <div class="alert alert-danger">
                <i class="icon-remove-sign"></i>
                Unexpected error. Please try again later.
            </div>
            -->
                      

            <div class="row">
                <div class="col-md-12">

                    <ul class="nav nav-tabs">
                      <li class="active"><a href="#enfants">Enfants</a></li>
                      <li class=""><a href="#structures">Structures</a></li>
                      <li class=""><a href="#contacts">Contacts</a></li>
                      <li class=""><a href="#sejours">Séjours</a></li>
                      <li class=""><a href="#utilisateurs">Utilisateurs</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="enfants">Home tab!</div>
                        <div class="tab-pane" id="structures">Profile tab!</div>
                        <div class="tab-pane" id="contacts">Messages tab!</div>
                        <div class="tab-pane" id="sejours">Messages tab!</div>
                        <div class="tab-pane" id="sejours">Messages tab!</div>
                    </div>

                    <script>
                    $(function () {
                        $('.nav-tabs a').click(function (e) {
                            e.preventDefault();
                            $(this).tab('show');
                        });
                    });
                    </script>


                </div>                
            </div>

            <!-- end users table -->
        </div>
    </div><!-- /.container -->
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>



