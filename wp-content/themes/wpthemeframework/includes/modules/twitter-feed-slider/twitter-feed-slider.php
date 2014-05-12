<?php

define('TWITTER_FEED_SLIDER_DIR', get_template_directory_uri() . '/includes/modules/twitter-feed-slider');

acf_add_options_sub_page( __('Twitter Feed Slider') );

function twitter_feed_slider() {
    twitter_feed_slider_scripts();
    
    ?>
    <section id="twitter-feed-slider">
            <div class="row feed_wrapper">
                <div class="col-md-12 text-center" >
                <span class='fa fa-twitter fa-5x tweet_icon'></span>
                </div>
                <div class="col-md-12 text-center" >
                #CrunchPunch
                </div>
                <div class="container feed_inner" >
                <div class='col-md-1 feed_quote'>&ldquo;
                </div>
                <div class='col-md-8'>
                Blah Blah Blah BlahBlah Blah Blah BlahBlah Blah Blah BlahBlah Blah Blah BlahBlah Blah Blah BlahBlah Blah Blah BlahBlah Blah Blah BlahBlah Blah Blah BlahBlah Blah Blah BlahBlah Blah Blah BlahBlah Blah Blah BlahBlah Blah Blah BlahBlah Blah Blah BlahBlah Blah Blah BlahBlah Blah Blah BlahBlah Blah Blah BlahBlah Blah Blah BlahBlah Blah Blah BlahBlah Blah Blah BlahBlah Blah Blah BlahBlah Blah Blah Blah
                </div>
                <div class='col-md-3'>
                <div class="tweet_bubble">
                hello world
                </div>
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