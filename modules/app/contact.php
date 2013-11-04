<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
<?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>


	<!-- main container -->
    <div class="content">


       <div id="pad-wrapper" class="new-user">
            <div class="row header">
                <div class="col-md-12">
                    <h3>Signaler un problème sur l'outil</h3>
                </div>                
            </div>

            <div class="row form-wrapper">
                <!-- left column -->
                <div class="col-md-9 with-sidebar">
                    <div class="container">
                        <form class="new_user_form" action="" method="post">
                            <div class="col-md-12 field-box">
                                <label for="page">Page concernée :</label>
                                <input id="page" name="page" class="form-control" type="text" />
                            </div>
                            <div class="col-md-12 field-box textarea">
                                <label for="description">Description :</label>
                                <textarea id="description" name="description" class="col-md-9" rows="20"></textarea>
                                <!--<span class="charactersleft">90 characters remaining. Field limited to 100 characters</span>-->
                            </div>
                            <div class="col-md-11 field-box actions">
                                <input type="submit" class="btn-glow primary" value="Envoyer">
                                <span>OU</span>
                                <input type="reset" value="Annuler" class="reset">
                            </div>
                        </form>
                    </div>
                </div>

                <!-- side right column -->
                <div class="col-md-3 form-sidebar pull-right">
                    <div class="alert alert-info hidden-tablet">
                        <i class="icon-lightbulb pull-left"></i>
                        Utiliser ce formulaire en cas de problème durant l'usage de l'outil
                    </div>                        
                    <h6>Informations</h6>
                    <p>Clément Roy</p>
                    <ul>
                        <li>Tél : 06 59 29 24 55</li>
                        <li><a href="mailto:mail@clementroy.fr">mail@clementroy.fr</a></li>
                    </ul>
                </div>
            </div>
        </div>




	</div>




<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>