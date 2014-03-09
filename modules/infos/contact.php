<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
<?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>


    <?php 

    if( isset($message) && !empty($message) ){

        $mail = new PHPMailer();

        $mail->From = $_SESSION['Auth']['email'];
        $mail->FromName = $_SESSION['Auth']['firstname']." ".$_SESSION['Auth']['lastname'];
        $mail->Subject = $page;
        $mail->Body = $message;
        $mail->AddAddress(ADMIN, 'clem');
        if (!$mail->send()) {
            $error[] = "le message n'est pas parti";
        }
    ?>
    <!-- main container -->
    <div class="content">
       <div id="pad-wrapper" class="new-user">
            <div class="row header">
                <div class="col-md-12">
                    <h1>Message envoyé</h1>
                </div>                
            </div>

            <p>Votre message a bien été envoyé, il sera pris en compte dans les plus bref délais</p>
    </div>
    <?php
    }
    else {
    ?>
	<!-- main container -->
    <div class="content">


       <div id="pad-wrapper" class="new-user">
            <div class="row header">
                <div class="col-md-12">
                    <h1>Signaler un problème sur l'outil</h1>
                </div>                
            </div>

            <div class="row form-wrapper">
                <!-- left column -->
                <div class="col-md-9 with-sidebar">
                    <div class="container">
                        <form class="new_user_form" action="/infos/contact" method="post">
                            <div class="col-md-12 field-box">
                                <label for="page">Page concernée :</label>
                                <input id="page" name="page" class="form-control" type="text" />
                            </div>
                            <div class="col-md-12 field-box textarea">
                                <label for="message">Description :</label>
                                <textarea id="message" name="message" class="col-md-9" rows="20"></textarea>
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
        <?php } ?>




	</div>




<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>