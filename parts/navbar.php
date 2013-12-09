   <!-- navbar -->
    <header class="navbar navbar-inverse" role="banner">
        <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" id="menu-toggler">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/"><?=app::$name; ?></a>
        </div>
        <ul class="nav navbar-nav pull-right hidden-xs">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle hidden-xs hidden-sm" data-toggle="dropdown">
                    Bonjour <strong><?=$user->firstname; ?> <?=$user->lastname; ?></strong>
                    <strong class="caret"></strong>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="/utilisateurs/infos/id/<?=$user->id; ?>">Mes infos personnelles</a></li>
                    <li><a href="/utilisateurs/">Liste des utilisateurs</a></li>
                </ul>
            </li>
            <li class="dropdown hidden-xs hidden-sm">
                <a href="#" class="dropdown-toggle hidden-xs hidden-sm" data-toggle="dropdown">
                    <i class="icon-cog"></i>
                    <strong class="caret"></strong>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="/infos/infos/">Infos</a></li>
                    <li><a href="/infos/debug/">Debug</a></li>
                    <li><a href="/infos/contact">Repporter un bug</a></li>
                </ul>
            </li>
            <li class="settings hidden-xs hidden-sm">
                <a href="/?deconnexion" role="button">
                    <i class="icon-signin"></i>
                </a>
            </li>
        </ul>
    </header>
    <!-- end navbar -->