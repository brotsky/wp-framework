<?php

function create_post_types() {
	register_post_type( 'bottle',
		array(
			'labels' => array(
				'name' => __( 'Bottles' ),
				'singular_name' => __( 'Bottle' )
			),
			'public' => true,
			'has_archive' => false,
			'rewrite' => array('slug' => 'bottle'),
			'supports' => array('title', 'editor', 'thumbnail'),
		)
	);
	
	register_post_type( 'test',
		array(
			'labels' => array(
				'name' => __( 'Tests' ),
				'singular_name' => __( 'Test' )
			),
			'public' => true,
			'has_archive' => false,
			'rewrite' => array('slug' => 'test'),
			'supports' => array('title', 'editor', 'thumbnail'),
		)
	);
	
	register_post_type( 'place',
		array(
			'labels' => array(
				'name' => __( 'Places' ),
				'singular_name' => __( 'Place' )
			),
			'public' => true,
			'has_archive' => false,
			'rewrite' => array('slug' => 'place'),
			'supports' => array('title', 'editor', 'thumbnail'),
		)
	);
}

function create_bottle_taxonomies() {
    $labels = array(
    	'name'              => _x( 'Types', 'taxonomy general name' ),
    	'singular_name'     => _x( 'Type', 'taxonomy singular name' ),
    	'search_items'      => __( 'Search Types' ),
    	'all_items'         => __( 'All Types' ),
    	'parent_item'       => __( 'Parent Type' ),
    	'parent_item_colon' => __( 'Parent Type:' ),
    	'edit_item'         => __( 'Edit Type' ),
    	'update_item'       => __( 'Update Type' ),
    	'add_new_item'      => __( 'Add New Type' ),
    	'new_item_name'     => __( 'New Type Name' ),
    	'menu_name'         => __( 'Type' ),
    );
    
    $args = array(
    	'hierarchical'      => true,
    	'labels'            => $labels,
    	'show_ui'           => true,
    	'show_admin_column' => true,
    	'query_var'         => true,
    	'rewrite'           => array( 'slug' => 'type' ),
    );
    
    register_taxonomy( 'type', 'bottle', $args );
}

function create_place_taxonomies() {
    $labels = array(
    	'name'              => _x( 'Addresses', 'taxonomy general name' ),
    	'singular_name'     => _x( 'Address', 'taxonomy singular name' ),
    	'search_items'      => __( 'Search Addresses' ),
    	'all_items'         => __( 'All Addresses' ),
    	'parent_item'       => __( 'Parent Address' ),
    	'parent_item_colon' => __( 'Parent Address:' ),
    	'edit_item'         => __( 'Edit Address' ),
    	'update_item'       => __( 'Update Address' ),
    	'add_new_item'      => __( 'Add New Address' ),
    	'new_item_name'     => __( 'New Address Name' ),
    	'menu_name'         => __( 'Address' ),
    );
    
    $args = array(
    	'hierarchical'      => true,
    	'labels'            => $labels,
    	'show_ui'           => true,
    	'show_admin_column' => true,
    	'query_var'         => true,
    	'rewrite'           => array( 'slug' => 'address' ),
    );
    
    register_taxonomy( 'address', 'place', $args );

    $labels = array(
    	'name'              => _x( 'Streets', 'taxonomy general name' ),
    	'singular_name'     => _x( 'Street', 'taxonomy singular name' ),
    	'search_items'      => __( 'Search Streets' ),
    	'all_items'         => __( 'All Streets' ),
    	'parent_item'       => __( 'Parent Street' ),
    	'parent_item_colon' => __( 'Parent Street:' ),
    	'edit_item'         => __( 'Edit Street' ),
    	'update_item'       => __( 'Update Street' ),
    	'add_new_item'      => __( 'Add New Street' ),
    	'new_item_name'     => __( 'New Street Name' ),
    	'menu_name'         => __( 'Street' ),
    );
    
    $args = array(
    	'hierarchical'      => true,
    	'labels'            => $labels,
    	'show_ui'           => true,
    	'show_admin_column' => true,
    	'query_var'         => true,
    	'rewrite'           => array( 'slug' => 'street' ),
    );
    
    register_taxonomy( 'street', 'place', $args );
    
    $labels = array(
    	'name'              => _x( 'States', 'taxonomy general name' ),
    	'singular_name'     => _x( 'State', 'taxonomy singular name' ),
    	'search_items'      => __( 'Search States' ),
    	'all_items'         => __( 'All States' ),
    	'parent_item'       => __( 'Parent State' ),
    	'parent_item_colon' => __( 'Parent State:' ),
    	'edit_item'         => __( 'Edit State' ),
    	'update_item'       => __( 'Update State' ),
    	'add_new_item'      => __( 'Add New State' ),
    	'new_item_name'     => __( 'New State Name' ),
    	'menu_name'         => __( 'State' ),
    );
    
    $args = array(
    	'hierarchical'      => true,
    	'labels'            => $labels,
    	'show_ui'           => true,
    	'show_admin_column' => true,
    	'query_var'         => true,
    	'rewrite'           => array( 'slug' => 'state' ),
    );
    
    register_taxonomy( 'state', 'place', $args );

    $labels = array(
    	'name'              => _x( 'Cities', 'taxonomy general name' ),
    	'singular_name'     => _x( 'City', 'taxonomy singular name' ),
    	'search_items'      => __( 'Search Cities' ),
    	'all_items'         => __( 'All Cities' ),
    	'parent_item'       => __( 'Parent City' ),
    	'parent_item_colon' => __( 'Parent City:' ),
    	'edit_item'         => __( 'Edit City' ),
    	'update_item'       => __( 'Update City' ),
    	'add_new_item'      => __( 'Add New City' ),
    	'new_item_name'     => __( 'New City Name' ),
    	'menu_name'         => __( 'City' ),
    );
    
    $args = array(
    	'hierarchical'      => true,
    	'labels'            => $labels,
    	'show_ui'           => true,
    	'show_admin_column' => true,
    	'query_var'         => true,
    	'rewrite'           => array( 'slug' => 'city' ),
    );
    
    register_taxonomy( 'city', 'place', $args );
    
    $labels = array(
    	'name'              => _x( 'Countries', 'taxonomy general name' ),
    	'singular_name'     => _x( 'Country', 'taxonomy singular name' ),
    	'search_items'      => __( 'Search Countries' ),
    	'all_items'         => __( 'All Countries' ),
    	'parent_item'       => __( 'Parent Country' ),
    	'parent_item_colon' => __( 'Parent Country:' ),
    	'edit_item'         => __( 'Edit Country' ),
    	'update_item'       => __( 'Update Country' ),
    	'add_new_item'      => __( 'Add New Country' ),
    	'new_item_name'     => __( 'New Country Name' ),
    	'menu_name'         => __( 'Country' ),
    );
    
    $args = array(
    	'hierarchical'      => true,
    	'labels'            => $labels,
    	'show_ui'           => true,
    	'show_admin_column' => true,
    	'query_var'         => true,
    	'rewrite'           => array( 'slug' => 'country' ),
    );
    
    register_taxonomy( 'country', 'place', $args );
    
    $labels = array(
    	'name'              => _x( 'FourSquare IDs', 'taxonomy general name' ),
    	'singular_name'     => _x( 'FourSquare ID', 'taxonomy singular name' ),
    	'search_items'      => __( 'Search FourSquare IDs' ),
    	'all_items'         => __( 'All FourSquare IDs' ),
    	'parent_item'       => __( 'Parent FourSquare ID' ),
    	'parent_item_colon' => __( 'Parent FourSquare ID:' ),
    	'edit_item'         => __( 'Edit FourSquare ID' ),
    	'update_item'       => __( 'Update FourSquare ID' ),
    	'add_new_item'      => __( 'Add New FourSquare ID' ),
    	'new_item_name'     => __( 'New FourSquare ID Name' ),
    	'menu_name'         => __( 'FourSquare ID' ),
    );
    
    $args = array(
    	'hierarchical'      => true,
    	'labels'            => $labels,
    	'show_ui'           => true,
    	'show_admin_column' => true,
    	'query_var'         => true,
    	'rewrite'           => array( 'slug' => 'foursquare_id' ),
    );
    
    register_taxonomy( 'foursquare_id', 'place', $args );
    
    
    $labels = array(
    	'name'              => _x( 'Place Categories', 'taxonomy general name' ),
    	'singular_name'     => _x( 'Place Category', 'taxonomy singular name' ),
    	'search_items'      => __( 'Search Place Categories' ),
    	'all_items'         => __( 'All Place Categories' ),
    	'parent_item'       => __( 'Parent Place Category' ),
    	'parent_item_colon' => __( 'Parent Place Category:' ),
    	'edit_item'         => __( 'Edit Place Category' ),
    	'update_item'       => __( 'Update Place Category' ),
    	'add_new_item'      => __( 'Add New Place Category' ),
    	'new_item_name'     => __( 'New Place Category Name' ),
    	'menu_name'         => __( 'Place Category' ),
    );
    
    $args = array(
    	'hierarchical'      => true,
    	'labels'            => $labels,
    	'show_ui'           => true,
    	'show_admin_column' => true,
    	'query_var'         => true,
    	'rewrite'           => array( 'slug' => 'place-category' ),
    );
    
    register_taxonomy( 'place_category', 'place', $args );
}


add_action( 'init', 'create_post_types' );
add_action( 'init', 'create_bottle_taxonomies', 0 );
add_action( 'init', 'create_place_taxonomies', 0 );