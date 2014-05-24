<?php
		
define('GOOGLE_MAP_CONTACT_DIR', get_template_directory_uri() . '/includes/modules/google-map-contact');

function google_map_contact() {
	google_map_contact_scripts();
		if (get_field('company_address'))
		{
			if ( !get_field('latitude') && !get_field('longitude') )
			{//if latitude and longitude are avaiable create map?>
				<section id="google-map-contact">
				<div class="row">
				<div class="col-md-12 wrapper">
					<iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
					  src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDUb-AV0h3Lss_Y27ZvVHCGZSlV3nkUfqI&q=Damici,Calistoga+CA&zoom=18">
					</iframe>
				</div>
				</div>
				</section>
			<?}
			else
			{//else Geocode address and save lat and longitude?>
				<h1>No Lat and Long Encode it</h1>
			<?}?>
			<!-- <h1>Hello Company Address</h1> -->
		<?}
		else
		{//neither address nor latitude and longitude are available so don't show map?>
			<h1>No Company Address == No Map</h1>
		<?}
}
function google_map_contact_scripts() {
    wp_enqueue_style( 'google-map-contact', GOOGLE_MAP_CONTACT_DIR . '/google-map-contact.css' );
    wp_enqueue_script( 'google-map-contact', GOOGLE_MAP_CONTACT_DIR . '/google-map-contact.js', array(), '1.0.0', true );
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

function google_map_contact_shortcode( $atts, $content = null ) {
    return google_map_contact();
}
add_shortcode( 'google_map_contact', 'google_map_contact_shortcode' );
?>