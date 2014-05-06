<?php

function restaurant_menu_scripts() {
    wp_enqueue_style( 'restaurant-menu', get_stylesheet_directory_uri() . '/css/restaurant-menu.css' );
}

function restaurant_menu_item_shortcode( $atts ) {
    extract( shortcode_atts( array(
		'style' => 'default',
		'title' => '',
		'description' => ''
	), $atts ) );
    return "<div class='restaurant-menu-item style-$stlye'>
                <div class='title'>$title</div>
                <div class='description'>$description</div>
                <div class='price'>$price</div>
            </div>";
}

add_shortcode( 'restaurant_menu_item', 'restaurant_menu_item_shortcode' );

