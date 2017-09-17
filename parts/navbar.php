<?php

$navbar = menu::getNavbar();


/*
    'convocations' => array(
        'name' => 'Convocations',
        'icon' => 'file-text-alt'),
    'factures' => array(
        'name' => 'Factures',
        'icon' => 'edit')

    'export' => array(
        'name' => 'Export',
        'icon' => 'cog'
    ),
    
*/

// Build active element from REQUEST URI
    $path_array = explode('/', $_SERVER['REQUEST_URI']);

// Set default path
    if($path_array['1'] == ''){
        $path_array['1']  = 'accueil';
    }

    ?>


    <div class="cl-sidebar">
        <div class="cl-toggle"><i class="fa fa-bars"></i></div>
        <div class="cl-navblock">
            <div class="menu-space">
                <div class="content">
                    <!--LOGO-->
                    <div class="sidebar-logo">
                        <div class="logo">
                            <a href="/"><img src="/assets/img/icon-home.png" class="logo-img" width="40" height="40" alt=""><span class="visible-hover">Gite des cîmes</span></a>
                        </div>
                    </div>

                    <ul class="cl-vnavigation">
                        <?php foreach( $navbar as $key => $menu ): ?>
                            <?php if ( isset( $menu['submenu'] ) && count( $menu['submenu'] ) > 0 ): ?>
                                <?php if ( $user->rank >= $menu['min_rank'] && $menu['display'] ): ?>
                                    <li class="parent<?php if ( in_array( $key, $path_array ) ): ?><?php endif; ?>">
                                        <a href="#">
                                            <i class="fa fa-<?php echo $menu['icon']; ?>"></i>
                                            <span class="visible-hover"><?php echo $menu['name']; ?></span>
                                        </a>
                                        <ul class="sub-menu<?php if ( in_array( $key, $path_array ) ): ?> active<?php endif; ?>">
                                            <?php foreach( $menu['submenu'] as $subKey => $submenu ): ?>
                                                <?php if ( $user->rank >= $submenu['min_rank'] && $submenu['display'] ): ?>
                                                    <li>
                                                        <a href="/<?php echo $key; ?>/<?php echo $subKey; ?>/" class="<?php if ( in_array( $subKey, $path_array ) && in_array( $key, $path_array ) ): ?>active<?php endif; ?>">
                                                            <?php echo $submenu['name']; ?>    
                                                        </a>
                                                    </li>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </ul>
                                    </li>
                                <?php endif; ?>
                            <?php else: ?>
                                <?php if ( $user->rank >= $menu['min_rank'] ): ?>
                                    <li <?php if ( in_array( $key, $path_array ) ): ?> class="active"<?php endif; ?>>
                                        <a href="/<?php echo $key; ?>/">
                                            <i class="fa fa-<?php echo $menu['icon']; ?>"></i>
                                            <span class="visible-hover"><?php echo $menu['name']; ?></span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>

                </div>
            </div>
        </div>
    </div>