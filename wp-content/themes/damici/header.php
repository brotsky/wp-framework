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
                    <div class="col-md-6 col-md-offset-3">
                        <a href="<?php echo site_url(); ?>">
                            <img id="logo" src="<?php the_field("logo","options"); ?>" />
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="menu-container">
            <div class="container">
                <div class="row">
                    <!-- menu in large and medium view - hidden in small and extra small view -->
                    <div class="col-md-12">
                        <?wp_nav_menu( array( 'theme_location' => 'header-menu', 'container_class' => '' ) );?>
                    </div>
                </div>
            </div>
        </div>
    </header>
