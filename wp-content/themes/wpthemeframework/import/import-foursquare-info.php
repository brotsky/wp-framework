<?php
ini_set('max_execution_time', '100000');
/*
Template Name: Import FourSquare Info
*/

$places = get_posts( array("post_type" => "place", 'posts_per_page' => -1) );

$count_new_test = 0;

echo "<pre>";

foreach($places as $place) {
    echo $place->post_title;
    echo "<br>";
    update_foursquare_info($place->ID);
    echo "<hr>";
    flush();
}
