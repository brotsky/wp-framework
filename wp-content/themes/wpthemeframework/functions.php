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

function get_social_links() {
    $social_links = get_field("social_links","options");
        if(sizeof($social_links) > 0) {
    ?>
    <ul>
        <?php foreach($social_links as $s) { ?>
        <li>
            <a href="<?php echo $s['url']; ?>">
            <i class="fa <?php echo $s['fontawesome_class_name'] ?>"></i>
            </a>
        </li>
        <?php } ?>
    </ul>
    <?php }
}

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_theme-options',
		'title' => 'Theme Options',
		'fields' => array (
			array (
				'key' => 'field_53602ec3c0ea8',
				'label' => 'Logo',
				'name' => 'logo',
				'type' => 'image',
				'save_format' => 'url',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
			array (
				'key' => 'field_53602ed9c0ea9',
				'label' => 'Social Links',
				'name' => 'social_links',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_53602ef7c0eaa',
						'label' => 'FontAwesome Class Name',
						'name' => 'fontawesome_class_name',
						'type' => 'text',
						'instructions' => 'ie: fa-facebook',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_53602f45c0eab',
						'label' => 'URL',
						'name' => 'url',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
				),
				'row_min' => '',
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Social Link',
			),
			array (
				'key' => 'field_53602fa3c2cbc',
				'label' => 'Use WooCommerce Store',
				'name' => 'use_store',
				'type' => 'true_false',
				'message' => '',
				'default_value' => 0,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'acf-options-theme-options',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}
