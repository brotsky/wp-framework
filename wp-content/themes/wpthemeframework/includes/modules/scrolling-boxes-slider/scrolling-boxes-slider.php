<?php

define('SCROLLING_BOXES_SLIDER_DIR', get_template_directory_uri() . '/includes/modules/scrolling-boxes-slider');

//add_image_size( 'scrolling-boxes-slider', ___, ___, true );

function scrolling_boxes_slider() {
    scrolling_boxes_slider_scripts();
    
    ?>
    
    <section id="scrolling-boxes-slider">

    </section>
    <?php
}

function scrolling_boxes_slider_scripts() {
    wp_enqueue_style( 'scrolling-boxes-slider', SCROLLING_BOXES_SLIDER_DIR . '/scrolling-boxes-slider.css' );
    wp_enqueue_script( 'scrolling-boxes-slider', SCROLLING_BOXES_SLIDER_DIR . '/scrolling-boxes-slider.js', array(), '1.0.0', true );
}

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_scrolling-boxes-slider',
		'title' => 'Scrolling Boxes Slider',
		'fields' => array (
			array (
				'key' => 'field_536425dba9a65',
				'label' => 'Scrolling Boxes Images',
				'name' => 'scrolling_boxes_images',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_536425eda9a66',
						'label' => 'Image',
						'name' => 'image',
						'type' => 'image',
						'column_width' => '',
						'save_format' => 'object',
						'preview_size' => 'thumbnail',
						'library' => 'all',
					),
					array (
						'key' => 'field_536425faa9a67',
						'label' => 'Title',
						'name' => 'title',
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
				'button_label' => 'Add Image',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'home-template.php',
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
