<?php
add_theme_support( 'post-formats', array( 'audio', 'gallery', 'link', 'quote', 'standard', 'video' ) );

function news_scripts() {
    wp_enqueue_style( 'news', get_template_directory_uri() . '/css/news.css' );
    wp_enqueue_script( 'news', get_template_directory_uri() . '/js/news.js', array(), '1.0.0', true );
}

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_video-post',
		'title' => 'Video Post',
		'fields' => array (
			array (
				'key' => 'field_535ab508a755a',
				'label' => 'Video URL',
				'name' => 'video_url',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_format',
					'operator' => '==',
					'value' => 'video',
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
