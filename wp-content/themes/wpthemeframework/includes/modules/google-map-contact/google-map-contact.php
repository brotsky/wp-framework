<?php
		
define('GOOGLE_MAP_CONTACT_DIR', get_template_directory_uri() . '/includes/modules/google-map-contact');

function google_map_contact() {
	google_map_contact_scripts();
	if ( get_field('google_embed_key') )
	{
		if ( get_field('company_name'))
		{
			if ( get_field('city') && get_field('state') )
			{//if latitude and longitude are avaiable create map
				$google_map_url = 'https://www.google.com/maps/embed/v1/place?key='.get_field('google_embed_key').'&q='.get_field('company_name').','.get_field('city').'+'.get_field('state').'&zoom=18';?>
			<?}
			else
			{//else Geocode address and save lat and longitude?>
				<? $google_map_url = 'https://www.google.com/maps/embed/v1/place?key='.get_field('google_embed_key').'&q='.get_field('company_name').'&zoom=18'; ?>
			<?}?>
			<section id="google-map-contact">
				<div class="row">
				<div class="col-md-12 wrapper">
					<iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
					  src='<?echo $google_map_url;?>'
					</iframe>
				</div>
				</div>
			</section>
			<!-- <h1>Hello Company Address</h1> -->
		<?}
		else
		{//neither address nor latitude and longitude are available so don't show map?>
			<h1>No Company Address == No Map</h1>
		<?}
	}
}
function google_map_contact_scripts() {
    wp_enqueue_style( 'google-map-contact', GOOGLE_MAP_CONTACT_DIR . '/google-map-contact.css' );
    wp_enqueue_script( 'google-map-contact', GOOGLE_MAP_CONTACT_DIR . '/google-map-contact.js', array(), '1.0.0', true );
}

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_google-map-contact',
		'title' => 'google-map-contact',
		'fields' => array (
			array (
				'key' => 'field_5380107130104',
				'label' => 'Company Name',
				'name' => 'company_name',
				'type' => 'text',
				'instructions' => 'Add the company Name for a google place search',
				'default_value' => '',
				'placeholder' => 'Company Name',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_538010a230105',
				'label' => 'City',
				'name' => 'city',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => 'City',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_538010bc30106',
				'label' => 'State',
				'name' => 'state',
				'type' => 'text',
				'instructions' => 'Company State',
				'default_value' => '',
				'placeholder' => 'State',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5380114114e95',
				'label' => 'Google Embed Key',
				'name' => 'google',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => 'Google Embed Key',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
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


function google_map_contact_shortcode( $atts, $content = null ) {
    return google_map_contact();
}
add_shortcode( 'google_map_contact', 'google_map_contact_shortcode' );
?>