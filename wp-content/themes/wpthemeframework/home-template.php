<?php
/*
Template Name: Home
*/ 

get_header(); ?>

<?php putRevSlider("home_slider"); ?>

<?php //get_template_part( 'section', 'aquagrade-map' ); ?>

<?php get_template_part( 'section', 'feature-circles' ); ?>

<?php gallery_grid(); ?>

<?php get_template_part( 'section', 'purchase-tester' ); ?>

<?php get_footer(); ?>