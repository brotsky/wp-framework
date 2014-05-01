<?php

define('TWITTER_FEED_SLIDER_DIR', get_template_directory_uri() . '/includes/modules/twitter-feed-slider');

acf_add_options_sub_page( __('Twitter Feed Slider') );

function twitter_feed_slider() {
    twitter_feed_slider_scripts();
    
    ?>
    
    <section id="twitter-feed-slider">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                </div>
            </div>
        </div>
    </section>
    <?php
}

function twitter_feed_slider_scripts() {
    wp_enqueue_style( 'twitter-feed-slider', TWITTER_FEED_SLIDER_DIR . '/twitter-feed-slider.css' );
    wp_enqueue_script( 'twitter-feed-slider', TWITTER_FEED_SLIDER_DIR . '/twitter-feed-slider.js', array(), '1.0.0', true );
}

//copy the PHP export from ACF here