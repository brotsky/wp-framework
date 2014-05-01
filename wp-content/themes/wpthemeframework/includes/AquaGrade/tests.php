<?php
function graph_scripts() {
    wp_enqueue_style( 'jqplot', get_template_directory_uri() . '/js/vendor/jqplot/jquery.jqplot.min.css' );

    wp_enqueue_script( 'jqplot', get_template_directory_uri() . '/js/vendor/jqplot/jquery.jqplot.min.js','1.0.0', true );
	wp_enqueue_script( 'jqplot-json', get_template_directory_uri() . '/js/vendor/jqplot/plugins/jqplot.json2.min.js','1.0.0', true );
	wp_enqueue_script( 'jqplot-render', get_template_directory_uri() . '/js/vendor/jqplot/plugins/jqplot.dateAxisRenderer.min.js','1.0.0', true );
}

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_test',
		'title' => 'Test',
		'fields' => array (
			array (
				'key' => 'field_5328f5653edda',
				'label' => 'DateCreated',
				'name' => 'DateCreated',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5328f5903eddb',
				'label' => 'FsqId',
				'name' => 'FsqId',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5328f5953eddc',
				'label' => 'TestID',
				'name' => 'TestID',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5328f59c3eddd',
				'label' => 'UserID',
				'name' => 'UserID',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5328f5a53edde',
				'label' => 'TdsNumber',
				'name' => 'TdsNumber',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5328f5ad3eddf',
				'label' => 'Lat',
				'name' => 'Lat',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5328f5b93ede0',
				'label' => 'Longi',
				'name' => 'Longi',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5328f5c23ede1',
				'label' => 'PlacePhoto',
				'name' => 'PlacePhoto',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5328f5cd3ede2',
				'label' => 'Comment',
				'name' => 'Comment',
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
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'test',
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
