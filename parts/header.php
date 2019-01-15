<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/assets/img/favicon.png">
    <title>Gîte des Cîmes - Outil de gestion</title>
    <meta name="robots" CONTENT="noindex, nofollow">
    
    <!-- <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,700italic,400,600,700,300"> -->

    <?php if (APP_VERSION != 'dev'): ?>

        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

        <link rel="stylesheet" href="/assets/css/gitedescimes.min.css" />
    
    <?php else: ?>

        <link rel="stylesheet" href="/assets/libs/bootstrap/dist/css/bootstrap.css">
        <link rel="stylesheet" href="/assets/libs/font-awesome/css/font-awesome.css">

        <link rel="stylesheet" href="/assets/libs/jquery.easy-pie-chart/jquery.easy-pie-chart.css">
        <link rel="stylesheet" href="/assets/libs/odometer/themes/odometer-theme-default.css">
        <!-- <link rel="stylesheet" href="//cdn.datatables.net/responsive/2.1.0/css/responsive.dataTables.min.css"> -->
            <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css"/> -->
        <link rel="stylesheet" href="/assets/css/datatables-bootstrap-adapter.css">
            <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.1.0/css/responsive.bootstrap.min.css"/> -->

        <link rel="stylesheet" href="/assets/libs/jquery.gritter/css/jquery.gritter.css">
        <link rel="stylesheet" href="/assets/libs/jquery-icheck/skins/flat/purple.css">
        <link rel="stylesheet" href="/assets/libs/fullcalendar/fullcalendar.css">

        <link rel="stylesheet" href="/assets/css/flatdream.css">
        
        <link rel="stylesheet" href="/assets/css/app.css">
        <link rel="stylesheet" href="/assets/css/responsive.css">

    <?php endif; ?>

   <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
   <div id="cl-wrapper">
        

        <?php if ( !user::canCurrentSeePage() ): ?>
            <?php die('Vous n\'avez pas les droits pour afficher cette page.'); ?>
        <?php endif; ?>
            
