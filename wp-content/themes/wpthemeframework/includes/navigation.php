<?php

function register_nav_bars() {
    register_nav_menu('header-menu',__( 'Header Navigation' ));
    register_nav_menu('footer-menu',__( 'Footer Navigation' ));
}
add_action( 'init', 'register_nav_bars' );

function add_first_and_last($output) {
    $output = preg_replace('/class="menu-item/', 'class="first-menu-item menu-item', $output, 1);
    $output = substr_replace($output, 'class="last-menu-item menu-item', strripos($output, 'class="menu-item'), strlen('class="menu-item'));
    return $output;
}
add_filter('wp_nav_menu', 'add_first_and_last');