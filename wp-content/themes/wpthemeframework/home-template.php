<?php
/*
Template Name: Home
*/ 

get_header(); ?>

<?php putRevSlider("home_slider"); ?>

<?php gallery_grid(); ?>
<?php twitter_feed_slider(); ?>
<?php google_map_contact();?>

<?php get_footer(); ?>