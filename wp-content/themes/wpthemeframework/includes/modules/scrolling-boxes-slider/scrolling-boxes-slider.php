<?php

define('SCROLLING_BOXES_SLIDER_DIR', get_template_directory_uri() . '/includes/modules/scrolling-boxes-slider');

//add_image_size( 'scrolling-boxes-slider', ___, ___, true );

function gallery_grid() {
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