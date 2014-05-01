<?php

if( function_exists('acf_set_options_page_menu') ){
    acf_add_options_sub_page( __('Theme Options') );
    acf_set_options_page_title( __('Theme Options') );
}

get_template_part( 'includes/scripts' );
get_template_part( 'includes/navigation' );
get_template_part( 'includes/news' );
get_template_part( 'includes/modules/main' );

add_theme_support( 'post-thumbnails' );


if(get_field("use_store","options")) {
    add_theme_support( 'woocommerce' );
    remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20, 0);
    
    // Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php)
    add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');
     
}
 
function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	
	ob_start();
	?>
	<a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?> - <?php echo $woocommerce->cart->get_cart_total(); ?></a>
	<?php
	
	$fragments['a.cart-contents'] = ob_get_clean();
	
	return $fragments;	
}

function widgets_init() {
    register_sidebar( array(
        'name' => 'News Sidebar',
        'id' => 'home_right_1',
        'before_widget' => '<div>',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="rounded">',
        'after_title' => '</h2>',
    ) );
}
add_action( 'widgets_init', 'widgets_init' );