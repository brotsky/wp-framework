<?php


define('RESTAURANT_MENU_DIR', get_template_directory_uri() . '/includes/modules/restaurant-menu');

function restaurant_menu_scripts() {
    wp_enqueue_style( 'restaurant-menu', RESTAURANT_MENU_DIR . '/restaurant-menu.css' );    
 //   wp_enqueue_script( 'restaurant-menu', RESTAURANT_MENU_DIR . '/restaurant-menu.js', array(), '1.0.0', true );
}

add_action( 'init', 'create_restaurant_menu_post_type' );
function create_restaurant_menu_post_type() {
	register_post_type( 'restaurant_menu',
		array(
			'labels' => array(
				'name' => __( 'Restaurant Menus' ),
				'singular_name' => __( 'Restaurant Menu' )
			),
		'public' => true,
		'has_archive' => false,
		)
	);
}

function restaurant_menu_shortcode( $atts ) {
    extract( shortcode_atts( array(
		'id' => -1
	), $atts ) );
	
	restaurant_menu_scripts();
	
	ob_start();
	if($id != -1) {
	    $menu_items = get_field("menu_items",$id);
	    $class = get_field("class",$id);
	    
	    if(sizeof($menu_items) > 0) {
	?>
	<div id="restaurant-menu-<?php echo $id; ?>" class="restaurant-menu<?php if($class != "") { echo " " . $class; } ?>">
	    <h3><?=get_the_title($id); ?></h3>
	    <ul>
	    <?php foreach($menu_items as $key => $item) {
    	    $style = $item['class'];
    	    if($style == "")
    	        $style = "default";
            $title = $item['title'];
            $subtitle = $item['subtitle'];
            $price = $item['price'];
	    ?>
            <li id="restaurant-menu-item-<?=$key ?>" class="restaurant-menu-item style-<?=$style ?>">
                <div>
                    <span class="title"><?=$title ?></span>
                    <span class="price"><?=$price ?></span>
                </div>
                <div>
                    <span class="subtile"><?=$subtitle ?></span>
                </div>
            </li>
        <?php } ?>
	    </ul>
	</div>
    <?php
        } else { ?>
            <div class="danger">There are no menu items.</div>
        <?php }
    
    
    } else { ?>
        <div class="danger">No ID in shortcode</div>
    <?php }
    return ob_get_clean();
}

add_shortcode( 'restaurant_menu', 'restaurant_menu_shortcode' );

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_restaurant-menus',
		'title' => 'Restaurant Menus',
		'fields' => array (
			array (
				'key' => 'field_536abf044c8b7',
				'label' => 'Directions',
				'name' => '',
				'type' => 'message',
				'message' => 'Your shortcode for this menu will be: <br />
	<textarea id="restaurant-menus-shortcode"></textarea>
	
	<script type="text/javascript">$ = jQuery;$("#restaurant-menus-shortcode").text("[restaurant_menu id=\'" + getParameter("post") + "\']");function getParameter(paramName) {var searchString = window.location.search.substring(1),i, val,params = searchString.split("&");for (i=0;i<params.length;i++) {val = params[i].split("=");if (val[0] == paramName) {return unescape(val[1]);}}return null;}</script>',
			),
			array (
				'key' => 'field_536abe5181166',
				'label' => 'Style Class (optional)',
				'name' => 'class',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_536abe7a81167',
				'label' => 'Menu Items',
				'name' => 'menu_items',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_536abe8581168',
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
					array (
						'key' => 'field_536abe8c81169',
						'label' => 'Subtitle',
						'name' => 'subtitle',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_536abe938116a',
						'label' => 'Price',
						'name' => 'price',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_536abea48116b',
						'label' => 'Style Class (optional)',
						'name' => 'class',
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
				'button_label' => 'Add Item',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'restaurant_menu',
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

