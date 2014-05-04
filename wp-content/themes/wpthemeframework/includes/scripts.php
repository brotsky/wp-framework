<?php

function init_scripts() {
	wp_enqueue_style( 'normalize', get_template_directory_uri() . '/css/normalize.css' );
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css' );
	//wp_enqueue_style( 'bootstrap', '//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css' );
	//wp_enqueue_style( 'bootstrap-responsive', get_template_directory_uri() . '/css/bootstrap-responsive.min.css' );
	wp_enqueue_style( 'jquery-ui', '//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css' );
	
	wp_enqueue_style( 'lato-font', '//fonts.googleapis.com/css?family=Lato:100italic,100,300italic,300,400italic,400,700italic,700,900italic,900' );
	//wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css' );
	wp_enqueue_style( 'font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css' );
	
	wp_enqueue_style( 'aquagrade', get_stylesheet_uri() );
	
	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/vendor/modernizr-2.6.2.min.js', array(), '2.6.2', true );
	wp_enqueue_script( 'jquery', '//code.jquery.com/jquery-1.10.2.min.js', '1.10.2', true );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '2.3.2', true );
	wp_enqueue_script( 'jquery-ui', '//code.jquery.com/ui/1.10.3/jquery-ui.js', '1.10.2', true );
	
	if(get_field("use_store","options")) {
    	wp_deregister_script( 'jquery-cookie' ); 
    	wp_enqueue_script( 'jquery-cookie', get_template_directory_uri() . '/js/cookie/1.3.1.js', '1.3.1', true );
    	wp_enqueue_script( 'store', get_template_directory_uri() . '/js/store.js', array(), '1.0.0', true );
	}	
}

add_action( 'wp_enqueue_scripts', 'init_scripts' );