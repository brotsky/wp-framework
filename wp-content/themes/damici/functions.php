<?php

function splash_scripts() {
    wp_enqueue_style( 'splash', get_stylesheet_directory_uri() . '/css/splash.css' );
}


//add_action( 'wp_enqueue_scripts', 'damici_init_scripts' );

function damici_init_scripts() {
    wp_enqueue_script( 'damici', get_stylesheet_directory_uri() . '/js/script.js', array(), '1.0.0', true );
}