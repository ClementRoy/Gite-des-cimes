<!DOCTYPE html>
<html class="login-bg">
<head>
    <title>Detail Admin - Sign in</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- bootstrap -->
    <link href="/assets/css/bootstrap.css" rel="stylesheet">
    <!-- <link href="/assets/css/bootstrap-overrides.css" type="text/css" rel="stylesheet"> -->

    <!-- global styles -->
    <link rel="stylesheet" type="text/css" href="/assets/css/animate.css">

    <!-- libraries -->
    <link rel="stylesheet" type="text/css" href="/assets/css/lib/font-awesome.css">
    
    <!-- open sans font -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!-- lato font -->
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>

    <link href="/assets/dist/css/s.css" rel="stylesheet" />
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
      <![endif]-->
  </head>
  <body>

    <div class="login-wrapper">
        <div id="carousel-example-generic" class="carousel slide carousel-fade" data-ride="carousel" data-interval="4000" data-pause="none">
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            </ol>

            <div class="carousel-inner">
                <div class="item active">
                    <img src="/assets/img/bgs/bg1.jpg" alt="...">
                </div>
                <div class="item">
                    <img src="/assets/img/bgs/bg2.jpg" alt="...">
                </div>
                <div class="item">
                    <img src="/assets/img/bgs/bg3.jpg" alt="...">
                </div>
            </div>

        </div>



        <div class="login-content animated fadeInUp">
            <h1 class="logo">Gîte des cimes</h1>

            <div class="box">
                <div class="content-wrap">
                    
                    <form action="<?php if(isset($_SERVER['REDIRECT_URL'])) $_SERVER['REDIRECT_URL']; else echo '/'; ?>" method="post">



                        <div class="input-group">
                          <span class="input-group-addon"><i class="icon icon-user"></i></span>
                          <input class="form-control" type="text" name="identifier" placeholder="Votre identifiant">
                      </div>
                      <div class="input-group">
                          <span class="input-group-addon"><i class="icon icon-key"></i></span>
                          <input class="form-control" type="password" name="password" placeholder="Votre mot de passe">
                      </div>

                      <!--<a href="#" class="forgot">Mot de passe oublié ?</a>-->

                        <!--<div class="remember">
                            <input id="remember-me" type="checkbox" name="remember">
                            <label for="remember-me">Se souvenir de moi</label>
                        </div>-->
                        
                        <input type="submit" class="btn btn-primary login" name="login" value="Se connecter">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>




<div id="cl-wrapper" class="login-container">

    <div class="middle-login">
        <div class="block-flat">
            <div class="header">                            
                <h3 class="text-center"><img class="logo-img" src="images/logo.png" alt="logo"/></h3>
            </div>
            <div>
                <form style="margin-bottom: 0px !important;" class="form-horizontal" action="index.html">
                    <div class="content">
                        <h4 class="title">Login Access</h4>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input type="text" placeholder="Username" id="username" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                        <input type="password" placeholder="Password" id="password" class="form-control">
                                    </div>
                                </div>
                            </div>
                            
                    </div>
                    <div class="foot">
                        <button class="btn btn-default" data-dismiss="modal" type="button">Register</button>
                        <button class="btn btn-primary" data-dismiss="modal" type="submit">Log me in</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="text-center out-links"><a href="#">&copy; 2014 Your Company</a></div>
    </div> 
    
</div>



<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<script src="/assets/js/theme.js"></script>

</body>
</html>