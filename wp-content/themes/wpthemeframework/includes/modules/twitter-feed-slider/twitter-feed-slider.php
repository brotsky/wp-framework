<?php

define('TWITTER_FEED_SLIDER_DIR', get_template_directory_uri() . '/includes/modules/twitter-feed-slider');

acf_add_options_sub_page( __('Twitter Feed Slider') );

//$api_key = get_field("twitter_api_key","options");
//$api_secret = get_field("twitter_api_secret","options");
//$screen_name = get_field("twitter_feed_slider_screen_name","options");
//$count = get_field("twitter_feed_count","options");


//we need the oauth token from Twitter


//$json = file_get_contents("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=$screen_name&count=$count");



function twitter_feed_slider() {
    twitter_feed_slider_scripts();
    
    ?>
    <section id="twitter-feed-slider">
            <div class="row" style="background:#303030;padding-top:50px;font-size:30px;padding-bottom:50px;color:white;">
                <div class="col-md-12 text-center" >
                <span class='fa fa-twitter fa-5x'></span>
                </div>
                <div class="col-md-12 text-center" >
                #CrunchPunch
                </div>
                <div class="container" style="font-size:20px;font-style:italic;margin-top:30px;margin-bottom:50px;">
                <div class='col-md-1'style='color:#44c4df;font-size:80px;'>&ldquo;
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

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_twitter-feed-slider',
		'title' => 'Twitter Feed Slider',
		'fields' => array (
			array (
				'key' => 'field_53715c247a771',
				'label' => 'Twitter Screen Name',
				'name' => 'twitter_feed_slider_screen_name',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_53715c407a772',
				'label' => 'Number of Tweets',
				'name' => 'twitter_feed_count',
				'type' => 'number',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'min' => 1,
				'max' => 200,
				'step' => '',
			),
			array (
				'key' => 'field_53715cb267afb',
				'label' => 'Twitter API Key',
				'name' => 'twitter_api_key',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_53715cca67afc',
				'label' => 'Twitter API Secret',
				'name' => 'twitter_api_secret',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'acf-options-twitter-feed-slider',
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
