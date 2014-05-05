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
                <div class="row">
                    <div class="col-md-9 col-sm-9 hidden-xs">
                        <?php get_social_links(); ?>
                    </div>
                    <?php if(get_field("use_store","options")) { ?>
                    <div id="shopping-cart" class="col-md-3 col-sm-3 col-xs-12 text-right">
                        <i class="fa fa-shopping-cart"></i>
                        <a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"><?php echo $woocommerce->cart->cart_contents_count ?> item<?php if($woocommerce->cart->cart_contents_count != 1) echo "s"; ?> - <?php echo $woocommerce->cart->get_cart_total(); ?></a>
                        
                    </div>
                    <?php $current_cart = $woocommerce->cart->cart_contents;
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="menu-container">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-6 hidden-xs">
                    <a href="<?php echo site_url(); ?>">
                        <img id="logo" src="<?php the_field("logo","options"); ?>" />
                    </a>
                    </div>
                    <div class="hidden-lg hidden-md hidden-sm col-xs-6">
                        <a href="<?php echo site_url(); ?>">
                            <img style="height:80%;width:80%;min-width:175px;min-height:33px;max-width:233px;max-height:44px;" id="logo-mobile" src="<?php the_field("logo","options"); ?>" />
                        </a>
                    </div>
                    <!-- menu in large and medium view - hidden in small and extra small view -->
                    <div class="col-md-9 text-right hidden-sm hidden-xs">
                        <?wp_nav_menu( array( 'theme_location' => 'header-menu', 'container_class' => '' ) );?>
                    </div>

                    <!-- menu in small and extra small view - hidden in large and view view -->
                    <div class="col-sm-6 col-xs-6 hidden-lg hidden-md">
                        <div class="btn-group pull-right">
                            <button type="button" style="height:auto;width:auto;"class="btn btn-lg dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-cog fa-2x"></i>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                            <?
                            $menu_name = 'header-menu'; // Get the nav menu based on $menu_name (same as 'theme_location' or 'menu' arg to wp_nav_menu)
    
                            if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
                                $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
    
                                $menu_items = wp_get_nav_menu_items($menu->term_id);
                                foreach ( (array) $menu_items as $key => $menu_item ) {?>
                                    <li style="width:100% !important;"><a href="<?=$menu_item->url?>"><?=$menu_item->title?></a></li>
                                <?}
                            }?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <?php if(!is_page_template('home-template.php')) { ?>
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-6 ">
                    <?php 
                    if(get_post_type() == "bottle") { echo "<h1>Bottle</h1>"; }
                    else if(is_shop()) {echo "<h1>Store</h1>"; }
                    else if(is_product()) {echo "<h2>Product</h2>"; }
                    else if(get_post_type() == "place") {echo "<h2>Place</h2>"; }
                    else { echo "<h1>"; the_title(); echo "</h1>"; } ?>
                </div>

                <div class="col-md-6  hidden-sm hidden-xs">
                    <?php
                    $queried_post_type = get_query_var('post_type');
                    if ( 'bottle' !=  $queried_post_type &&  'place' !=  $queried_post_type) {
                        if(function_exists('yoast_breadcrumb')) yoast_breadcrumb('<p id="breadcrumbs">','</p>');
                    } else if('bottle' ==  $queried_post_type ) { ?>
                        <p id="breadcrumbs"><span xmlns:v="http://rdf.data-vocabulary.org/#">
                            <span typeof="v:Breadcrumb"><a href="<?php echo site_url() ?>" rel="v:url" property="v:title">Home</a></span> » <span typeof="v:Breadcrumb"><a href="<?php echo get_permalink(1939) ?>" rel="v:url" property="v:title"><?php echo get_the_title(1939) ?></a></span> » <span typeof="v:Breadcrumb"><span class="breadcrumb_last" property="v:title"><?php the_title(); ?></span></span></span>
                        </p>
                    <?php } else if('place' ==  $queried_post_type) { ?>
                        <p id="breadcrumbs"><span xmlns:v="http://rdf.data-vocabulary.org/#">
                            <span typeof="v:Breadcrumb"><a href="<?php echo site_url() ?>" rel="v:url" property="v:title">Home</a></span> » <span typeof="v:Breadcrumb"><a href="<?php echo get_permalink(20664) ?>" rel="v:url" property="v:title"><?php echo get_the_title(20664) ?></a></span> » <span typeof="v:Breadcrumb"><span class="breadcrumb_last" property="v:title"><?php the_title(); ?></span></span></span>
                        </p>
                    <?php }
                        
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="page-content">
    <?php } ?>

