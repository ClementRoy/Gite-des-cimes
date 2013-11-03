
<!DOCTYPE html>
<html class="login-bg">
<head>
    <title>Detail Admin - Sign in</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- bootstrap -->
    <link href="/assets/css/bootstrap.css" rel="stylesheet">
    <link href="/assets/css/bootstrap-overrides.css" type="text/css" rel="stylesheet">

    <!-- global styles -->
    <link rel="stylesheet" type="text/css" href="/assets/css/app.css">

    <!-- libraries -->
    <link rel="stylesheet" type="text/css" href="/assets/css/lib/font-awesome.css">
    
    <!-- open sans font -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!-- lato font -->
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>

    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body>

    <div class="login-wrapper">
        <h1 class="logo">Gîte des cimes</h1>

        <div class="box">
            <div class="content-wrap">
                <h6>Connexion</h6>
                <form action="index.php" method="post">
                    

                
                <input class="form-control" type="text" name="identifier" placeholder="Votre identifiant">
                <input class="form-control" type="password" name="password" placeholder="Votre mot de passe">
                <!--<a href="#" class="forgot">Mot de passe oublié ?</a>-->
                <!--
                <div class="remember">
                    <input id="remember-me" type="checkbox">
                    <label for="remember-me">Se souvenir de moi</label>
                </div>
                -->
                <input type="submit" class="btn-glow primary login" name="login" value="Connexion">
                </form>
            </div>
        </div>

    </div>

    <!-- scripts -->
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/theme.js"></script>

</body>
</html>