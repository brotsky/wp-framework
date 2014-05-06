<?php

get_template_part( 'includes/menu-shortcodes' );

function splash_scripts() {
    wp_enqueue_style( 'splash', get_stylesheet_directory_uri() . '/css/splash.css' );
}


//add_action( 'wp_enqueue_scripts', 'damici_init_scripts' );

function damici_init_scripts() {
    wp_enqueue_script( 'damici', get_stylesheet_directory_uri() . '/js/script.js', array(), '1.0.0', true );
}

function damici_register_nav_bars() {
    register_nav_menu('header-menu-2',__( 'Header Navigation 2' ));
}
add_action( 'init', 'damici_register_nav_bars' );

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_damici-header-options',
		'title' => 'd\'Amici Header Options',
		'fields' => array (
			array (
				'key' => 'field_53692f4d2279a',
				'label' => 'Header Selection',
				'name' => 'header_selection',
				'type' => 'select',
				'instructions' => 'Logo 1 or Logo 2?<br />
	Navigation 1 or Navigation 2?',
				'choices' => array (
					1 => 1,
					2 => 2,
				),
				'default_value' => 1,
				'allow_null' => 0,
				'multiple' => 0,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
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
	register_field_group(array (
		'id' => 'acf_damici-theme-options',
		'title' => 'd\'Amici Theme Options',
		'fields' => array (
			array (
				'key' => 'field_53692e0566584',
				'label' => 'Logo2',
				'name' => 'logo2',
				'type' => 'image',
				'save_format' => 'object',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
			array (
				'key' => 'field_53692e1966585',
				'label' => 'Dine Home Page',
				'name' => 'dine_home_page',
				'type' => 'page_link',
				'post_type' => array (
					0 => 'page',
				),
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_53692e3766586',
				'label' => 'Stay Home Page',
				'name' => 'stay_home_page',
				'type' => 'page_link',
				'post_type' => array (
					0 => 'page',
				),
				'allow_null' => 0,
				'multiple' => 0,
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
