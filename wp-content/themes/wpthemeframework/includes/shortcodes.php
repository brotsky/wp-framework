<?php

add_filter('widget_text', 'do_shortcode');
add_filter('the_content', 'do_shortcode', 11);

function read_more_shortcode( $atts, $content = null ) {
	return '<a href="#readmore" class="button"><button type="button">Read More</button></a><div class="read-more-content hidden">' . do_shortcode($content) . '</div>';
}
add_shortcode( 'readmore', 'read_more_shortcode' );

function row_shortcode( $atts, $content = null ) {
    return '<div class="row">' . do_shortcode($content) . '</div>';
}
add_shortcode( 'row', 'row_shortcode' );

function one_half_shortcode( $atts, $content = null ) {
    extract( shortcode_atts( array(
		'size' => 'md'
	), $atts ) );
    return "<div class='col-$size-6'>" . do_shortcode($content) . "</div>";
}
add_shortcode( 'one_half', 'one_half_shortcode' );

function one_third_shortcode( $atts, $content = null ) {
    extract( shortcode_atts( array(
		'size' => 'md'
	), $atts ) );
    return "<div class='col-$size-4'>" . do_shortcode($content) . "</div>";
}
add_shortcode( 'one_third', 'one_third_shortcode' );

function two_thirds_shortcode( $atts, $content = null ) {
    extract( shortcode_atts( array(
		'size' => 'md'
	), $atts ) );
    return "<div class='col-$size-8'>" . do_shortcode($content) . "</div>";
}
add_shortcode( 'two_third', 'two_thirds_shortcode' );
add_shortcode( 'two_thirds', 'two_thirds_shortcode' );

function one_fourth_shortcode( $atts, $content = null ) {
    extract( shortcode_atts( array(
		'size' => 'md'
	), $atts ) );
    return "<div class='col-$size-3'>" . do_shortcode($content) . "</div>";
}
add_shortcode( 'one_fourth', 'one_fourth_shortcode' );

function three_fourth_shortcode( $atts, $content = null ) {
    extract( shortcode_atts( array(
		'size' => 'md'
	), $atts ) );
    return "<div class='col-$size-9'>" . do_shortcode($content) . "</div>";
}
add_shortcode( 'three_fourth', 'three_fourth_shortcode' );
add_shortcode( 'three_fourths', 'three_fourth_shortcode' );

function one_sixth_shortcode( $atts, $content = null ) {
    extract( shortcode_atts( array(
		'size' => 'md'
	), $atts ) );
    return "<div class='col-$size-2'>" . do_shortcode($content) . "</div>";
}
add_shortcode( 'one_sixth', 'one_sixth_shortcode' );

function five_sixth_shortcode( $atts, $content = null ) {
    extract( shortcode_atts( array(
		'size' => 'md'
	), $atts ) );
    return "<div class='col-$size-10'>" . do_shortcode($content) . "</div>";
}
add_shortcode( 'five_sixth', 'five_sixth_shortcode' );
add_shortcode( 'five_sixths', 'five_sixth_shortcode' );