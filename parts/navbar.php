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
            <li class="notification-dropdown hidden-xs hidden-sm">
                <a href="#" class="trigger">
                    <i class="icon-warning-sign"></i>
                    <span class="count">8</span>
                </a>
                <div class="pop-dialog">
                    <div class="pointer right">
                        <div class="arrow"></div>
                        <div class="arrow_border"></div>
                    </div>
                    <div class="body">
                        <a href="#" class="close-icon"><i class="icon-remove-sign"></i></a>
                        <div class="notifications">
                            <h3>You have 6 new notifications</h3>
                            <a href="#" class="item">
                                <i class="icon-signin"></i> New user registration
                                <span class="time"><i class="icon-time"></i> 13 min.</span>
                            </a>
                            <a href="#" class="item">
                                <i class="icon-signin"></i> New user registration
                                <span class="time"><i class="icon-time"></i> 18 min.</span>
                            </a>
                            <a href="#" class="item">
                                <i class="icon-envelope-alt"></i> New message from Alejandra
                                <span class="time"><i class="icon-time"></i> 28 min.</span>
                            </a>
                            <a href="#" class="item">
                                <i class="icon-signin"></i> New user registration
                                <span class="time"><i class="icon-time"></i> 49 min.</span>
                            </a>
                            <a href="#" class="item">
                                <i class="icon-download-alt"></i> New order placed
                                <span class="time"><i class="icon-time"></i> 1 day.</span>
                            </a>
                            <div class="footer">
                                <a href="#" class="logout">View all notifications</a>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle hidden-xs hidden-sm" data-toggle="dropdown">
                    Bonjour <strong><?=$user->firstname; ?> <?=$user->lastname; ?></strong>
                    <strong class="caret"></strong>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="/utilisateurs/infos/id/<?=$user->id; ?>"><i class="icon-user"></i> Mes infos personnelles</a></li>
                    <li><a href="/utilisateurs/"><i class="icon-reorder"></i> Liste des utilisateurs</a></li>
                    <li><a href="/corbeille/"><i class="icon-trash"></i> Corbeille <span class="tag">34</span></a></li>
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
                    <!--<li><a href="/infos/contact">Repporter un bug</a></li>-->
                </ul>
            </li>
            <li class="settings hidden-xs hidden-sm">
                <a href="/?deconnexion" role="button">
                    <i class="icon-off"></i>
                </a>
            </li>
        </ul>
    </header>
    <!-- end navbar -->