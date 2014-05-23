<?php
		
define('GOOGLE_MAP_CONTACT_DIR', get_template_directory_uri() . '/includes/modules/google-map-contact');

function google_map_contact() {
	google_map_contact_scripts();
		if (get_field('company_address'))
		{?>
			<h1>Hello Company Address</h1>
		<?}
		else
		{?>
			<h1>No Company Address</h1>
		<?}
}
function google_map_contact_scripts() {
    wp_enqueue_style( 'instagram-gallery-grid', GOOGLE_MAP_CONTACT_DIR . '/google_map_contact.css' );
    wp_enqueue_script( 'instagam-gallery-grid', GOOGLE_MAP_CONTACT_DIR . '/google_map_contact.js', array(), '1.0.0', true );
}

if(function_exists("register_field_group"))
{
register_field_group(array (
	'id' => 'acf_google_map_contact',
	'title' => 'google_map_contact',
	'fields' => array (
		array (
			'key' => 'field_537f7b387570d',
			'label' => 'Company Address',
			'name' => 'company_address',
			'type' => 'text',
			'instructions' => 'Enter an address for Geocoding into Latitude and Longitude Coordinates which are required to create a Pushpin on a Google Map.',
			'default_value' => '',
			'placeholder' => 'Address for Geocoding',
			'prepend' => '',
			'append' => '',
			'formatting' => 'html',
			'maxlength' => '',
		),
		array (
			'key' => 'field_537f7c827570e',
			'label' => 'Latitude',
			'name' => 'latitude',
			'type' => 'text',
			'instructions' => 'Auto filled or can manually input a Latitude from Geocoded Address.',
			'default_value' => '',
			'placeholder' => 'Latitude',
			'prepend' => '',
			'append' => '',
			'formatting' => 'html',
			'maxlength' => '',
		),
		array (
			'key' => 'field_537f7ce57570f',
			'label' => 'Longitude',
			'name' => 'longitude',
			'type' => 'text',
			'instructions' => 'Auto filled or can manually input a Longitude from Geocoded Address.',
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
				'value' => 'post',
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

?>