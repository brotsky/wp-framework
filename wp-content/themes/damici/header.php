<?php global $woocommerce; ?>

<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width">
        <title><?php wp_title( '|', true, 'right' ); ?></title>
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
        <!--[if lt IE 9]>
        <script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
        <![endif]-->
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <header>
        <div class="top-header">
            <div class="container">
                <div class="myRow row hidden-sm hidden-xs ">
                    <div class='col-lg-3 col-md-3 logo-links' style="vertical-align:middle;">
                        <ul>
                            <li class='pull-right' style="margin-right:66px;">
                                <a href="#">Dine</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <a href="<?php echo site_url(); ?>">
                            <img id="logo" src="<?php the_field("logo","options"); ?>" />
                        </a>
                    </div>
                    <div class='col-lg-3 col-md-3 logo-links' style="vertical-align:middle;">
                        <ul>
                            <li class="pull-left" >
                                <a href="#">Stay</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class='row hidden-lg hidden-md'>
                    <div class="col-sm-12 col-xs-12"  style="margin-bottom:10px;">
                        <a href="<?php echo site_url(); ?>">
                            <img id="logo" src="<?php the_field("logo","options"); ?>" />
                        </a>
                    </div>
                    <div class='col-sm-6 col-xs-6 logo-links'>
                        <ul>
                            <li class="pull-left">
                                <a href="#">Dine</a>
                            </li>
                        </ul>
                    </div>
                    <div class='col-sm-6 col-xs-6 logo-links'>
                        <ul>
                            <li class="pull-right" style="margin-right:76px;">
                                <a href="#">Stay</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <?php 
        
        if(!is_page_template('splash-template.php')) { ?>
        <div class="menu-container">
            <div class="container">
                <div class="row hidden-sm hidden-xs">
                    <!-- menu in large and medium view - hidden in small and extra small view -->
                    <div class="col-md-12">
                        <?wp_nav_menu( array( 'theme_location' => 'header-menu', 'container_class' => '' ) );?>
                    </div>
                </div>
                <div class='row hidden-lg hidden-md'>
                                        <!-- menu in small and extra small view - hidden in large and view view -->
                    <div class="col-sm-12 col-xs-12 hidden-lg hidden-md text-center">
                        <div class="btn-group">
                            <button type="button" class="btn btn-lg dropdown-toggle myNavButton" data-toggle="dropdown">
                                <a href="#" class='rolling-pin'></a><!-- <i class="fa fa-cog fa-2x"></i> -->
                            </button>
                            <ul class="dropdown-menu" role="menu">
                            <?
                            $menu_name = 'header-menu'; // Get the nav menu based on $menu_name (same as 'theme_location' or 'menu' arg to wp_nav_menu)
    
                            if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
                                $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
    
                                $menu_items = wp_get_nav_menu_items($menu->term_id);
                                foreach ( (array) $menu_items as $key => $menu_item ) {?>
                                    <li style="width:100% !important;"><a class='text-center' href="<?=$menu_item->url?>"><?=$menu_item->title?></a></li>
                                <?}
                            }?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </header>
