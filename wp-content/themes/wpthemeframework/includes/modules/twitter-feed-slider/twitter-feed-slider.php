<?php

define('TWITTER_FEED_SLIDER_DIR', get_template_directory_uri() . '/includes/modules/twitter-feed-slider');

acf_add_options_sub_page( __('Twitter Feed Slider') );

define('TWITTER_CONSUMER_KEY', get_field("twitter_api_key","options"));
define('TWITTER_CONSUMER_SECRET', get_field("twitter_api_secret","options"));
define('TWITTER_OAUTH_CALLBACK', TWITTER_FEED_SLIDER_DIR . '/twitteroauth/callback.php');

function buildBaseString($baseURI, $method, $params) {
    $r = array();
    ksort($params);
    foreach($params as $key=>$value){
        $r[] = "$key=" . rawurlencode($value);
    }
    return $method."&" . rawurlencode($baseURI) . '&' . rawurlencode(implode('&', $r));
}

function buildAuthorizationHeader($oauth) {
    $r = 'Authorization: OAuth ';
    $values = array();
    foreach($oauth as $key=>$value)
        $values[] = "$key=\"" . rawurlencode($value) . "\"";
    $r .= implode(', ', $values);
    return $r;
}

function return_tweet(){
    $oauth_access_token         = "1892688138-yeZZTVLE50Xn6JLQzmQ97nIq8J8tVqMlwWnWygt";
    $oauth_access_token_secret  = "QDKRL5qC3w4Omda96PHOmfRCyAM1d4FUdQyKsHUCxFVGK";
    $consumer_key               = "PzuVmIDEOaTuZRQJipW7jikzo";
    $consumer_secret            = "p9MkJdQ4wSP6SckogZBXP5eCU5ck1M9HIK2TSrKycMZBWgDn5p";

    $twitter_timeline           = "user_timeline";  //  mentions_timeline / user_timeline / home_timeline / retweets_of_me

    //  create request
        $request = array(
            'screen_name'       => 'CrunchPunchShop',
            'count'             => '200'
        );

    $oauth = array(
        'oauth_consumer_key'        => $consumer_key,
        'oauth_nonce'               => time(),
        'oauth_signature_method'    => 'HMAC-SHA1',
        'oauth_token'               => $oauth_access_token,
        'oauth_timestamp'           => time(),
        'oauth_version'             => '1.0'
    );

    //  merge request and oauth to one array
        $oauth = array_merge($oauth, $request);

    //  do some magic
        $base_info              = buildBaseString("https://api.twitter.com/1.1/statuses/$twitter_timeline.json", 'GET', $oauth);
        $composite_key          = rawurlencode($consumer_secret) . '&' . rawurlencode($oauth_access_token_secret);
        $oauth_signature            = base64_encode(hash_hmac('sha1', $base_info, $composite_key, true));
        $oauth['oauth_signature']   = $oauth_signature;

    //  make request
        $header = array(buildAuthorizationHeader($oauth), 'Expect:');
        $options = array( CURLOPT_HTTPHEADER => $header,
                          CURLOPT_HEADER => false,
                          CURLOPT_URL => "https://api.twitter.com/1.1/statuses/$twitter_timeline.json?". http_build_query($request),
                          CURLOPT_RETURNTRANSFER => true,
                          CURLOPT_SSL_VERIFYPEER => false);

        $feed = curl_init();
        curl_setopt_array($feed, $options);
        $json = curl_exec($feed);
        curl_close($feed);

    return json_decode($json, true);
}







// function twitter_oauth2(){
// 	$key=rawurlencode('PzuVmIDEOaTuZRQJipW7jikzo');
// 	$secret = rawurlencode('p9MkJdQ4wSP6SckogZBXP5eCU5ck1M9HIK2TSrKycMZBWgDn5p');
// 	$url = $key.':'.$secret;
// 	$encode_url = base64_encode ($url);
// 	$url = 'https://api.twitter.com/oauth2/token';
// 	$data = array('grant_type' => 'client_credentials');

// 	// use key 'http' even if you send the request to https://...
// 	$options = array(
// 	    'http' => array(
// 			"header" => ["Content-type: application/x-www-form-urlencoded;charset=UTF-8",
// 						"Authorization: Basic".$encode_url ],
// 			'method'  => 'POST',
// 	        'content' => http_build_query($data)
//     )
// 	);
// $context  = stream_context_create($options);
// $result = file_get_contents($url, false, $context);
// var_dump($result);
// }

//$screen_name = get_field("twitter_feed_slider_screen_name","options");
//$count = get_field("twitter_feed_count","options");


//we need the oauth token from Twitter
/*
function getConnectionWithAccessToken($oauth_token, $oauth_token_secret) {
  $connection = new TwitterOAuth(TWITTER_CONSUMER_KEY, TWITTER_CONSUMER_SECRET, $oauth_token, $oauth_token_secret);
  return $connection;
}
 
$connection = getConnectionWithAccessToken("abcdefg", "hijklmnop");
$content = $connection->get("statuses/home_timeline");

*/
//$json = file_get_contents("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=$screen_name&count=$count");



function twitter_feed_slider() {
    twitter_feed_slider_scripts();
    $twitter_name="CrunchPunchShop";
    $twitter_feed = return_tweet();
    // var_dump($twitter_feed);
    ?>

    <section id="twitter-feed-slider" data-slide-count='<?=count($twitter_feed)?>' >
            <div class="row feed_wrapper" >
                <div class="col-md-12 text-center" >
                <span class='fa fa-twitter fa-5x tweet_icon'></span>
                </div>
                <div class="col-md-12 text-center tweet_name" >
                #CrunchPunchShop
                </div>
                <? foreach ($twitter_feed as $key => $value) {?>
                <div class="container feed_inner <? if ($key==0) echo 'current_slide'; else echo 'off_screen';?>" data-slide-id='<?=$key?>'>
                <div class='col-md-1 feed_quote'>&ldquo;
                </div>
                <div class='col-md-8'>
                <?=$value['text']?>
                </div>
                <div class='col-md-3'>
                <div class="tweet_bubble">
                <?=$value['user']['name']?>
				<?=$value['user']['screen_name']?>
                </div>
                </div>
            	</div>
            	<?}?>
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
