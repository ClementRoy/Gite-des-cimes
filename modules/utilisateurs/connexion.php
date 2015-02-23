<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/assets/img/favicon.png">
    <title>Gîte des Cîmes - Outil de gestion</title>
    <meta name="robots" CONTENT="noindex, nofollow">
    
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,700italic,400,600,700,300">

    <?php if (APP_VERSION != 'dev'): ?>
    <link rel="stylesheet" href="/assets/dist/css/gitedescimes.min.css" />
    <?php else: ?>

    <link rel="stylesheet" href="/assets/libs/jquery.easy-pie-chart/jquery.easy-pie-chart.css">
    <link rel="stylesheet" href="/assets/libs/odometer/themes/odometer-theme-default.css">
    <link rel="stylesheet" href="/assets/css/datatables-bootstrap-adapter.css">

    <link rel="stylesheet" href="/assets/libs/jquery.gritter/css/jquery.gritter.css">
    <link rel="stylesheet" href="/assets/libs/jquery-icheck/skins/flat/purple.css">
    <link rel="stylesheet" href="/assets/libs/fullcalendar/fullcalendar.css">


    <link rel="stylesheet" href="/assets/css/flatdream.css">
    <link rel="stylesheet" href="/assets/css/flatdream-overide.css">

    <?php endif; ?>

   <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

    <?php
        $bgs = array('/assets/img/bg1.jpg', '/assets/img/bg2.jpg', '/assets/img/bg3.jpg');
        shuffle($bgs);
    ?>

    <div id="cl-wrapper" class="login-container" style="background-image:url(<?=$bgs[0]; ?>);">

        <div class="middle-login animated fadeInUp">
            <div class="block-flat">
                <div class="header">                            
                    <h1 class="text-center">Gite des cîmes</h1>
                </div>
                <div class="body">
                     <form action="<?php if(isset($_SERVER['REDIRECT_URL'])) $_SERVER['REDIRECT_URL']; else echo '/'; ?>" method="post" style="margin-bottom: 0px !important;" class="form-horizontal">
                        <div class="content">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input type="text" class="form-control" name="identifier" placeholder="Votre identifiant">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                        <input type="password" class="form-control" name="password" placeholder="Votre mot de passe">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="foot">
                            <button class="btn btn-primary btn-block btn-lg btn-rad" name="login" type="submit">Connexion</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> 
        
    </div>
</body>
</html>