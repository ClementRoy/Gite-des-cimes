<div class="container-fluid" id="pcont">

	<div id="head-nav" class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-collapse">


				<ul class="nav navbar-nav navbar-right user-nav">
					<li class="dropdown profile_menu">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<!-- <img alt="Avatar" width="30" height="30" src="images/avatar6-2.jpg"> -->
							<span>Bonjour <strong><?=$user->firstname; ?> <?=$user->lastname; ?></strong></span> <b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li><a href="/utilisateurs/infos/id/<?=$user->id; ?>"><i class="fa fa-user"></i>&nbsp; Mes infos personnelles</a></li>
							<?php if ( $user->rank > 2 ): ?>
								<li><a href="/utilisateurs/"><i class="fa fa-reorder"></i>&nbsp; Liste des utilisateurs</a></li>
								<li><a href="/corbeille/"><i class="fa fa-trash"></i>&nbsp; Corbeille</a></li>
							<?php endif; ?>
							<li class="divider"></li>
							<li><a href="/?deconnexion" role="button"><i class="fa fa-power-off"></i>&nbsp; Se déconnecter</a></li>
						</ul>
					</li>
					<?php if ( $user->rank > 3 ): ?>
					<li class="dropdown profile_menu">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog"></i><b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="/infos/infos/">Infos</a></li>
							<li><a href="/infos/debug/">Debug</a></li>
						</ul>
					</li>
					<?php endif; ?>
					<li class="dropdown profile_menu">
						<a href="/?deconnexion"><i class="fa fa-power-off"></i></a>
					</li>
					<!-- <li class="button"><a href="/?deconnexion" role="button"><i class="fa fa-power-off"></i><span class="sr-only">Se déconnecter</span></a></li> -->
				</ul>

			</div><!--/.nav-collapse animate-collapse -->
		</div>
	</div>



	<div class="cl-mcont">