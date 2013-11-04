   <!-- navbar -->
    <header class="navbar navbar-inverse" role="banner">
        <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" id="menu-toggler">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Gîte des cimes</a>
        </div>
        <ul class="nav navbar-nav pull-right hidden-xs">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle hidden-xs hidden-sm" data-toggle="dropdown">
                    Bonjour <strong><?=$user->firstname; ?> <?=$user->lastname; ?></strong>
                    <strong class="caret"></strong>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="/users/fiche/<?=$user->id; ?>">Mes infos personnelles</a></li>
                    <li><a href="/users/list/">Liste des utilisateurs</a></li>
                    <li><a href="/app/contact">Repporter un bug</a></li>
                </ul>
            </li>
            <li class="settings hidden-xs hidden-sm">
                <a href="/?logout" role="button">
                    <i class="icon-signin"></i>
                </a>
            </li>
        </ul>
    </header>
    <!-- end navbar -->