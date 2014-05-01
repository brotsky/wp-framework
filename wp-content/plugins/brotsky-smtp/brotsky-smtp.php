<?php
/*
Plugin Name: Brotsky SMTP
Plugin URI: http://www.brandonbrotsky.com
Description: This is for SMTP emails for WordPress sites on Brotsky Designs servers
Author: Brandon Brotsky
Author URI: http://www.brandonbrotsky.com
Version: 1.0
*/

add_action( 'phpmailer_init', 'brotsky_phpmailer_init' );

function brotsky_phpmailer_init( PHPMailer $phpmailer ) {
    if(DB_HOST == '10.32.102.164' || $_SERVER['SERVER_ADDR'] == '173.236.56.186') {
        $phpmailer->Host = 'smtp.sendgrid.net';
        $phpmailer->Port = 465; // could be different
        $phpmailer->Username = 'brotsky'; // if required
        $phpmailer->Password = 'q<Jh73fxrL4Ek7Y'; // if required
        $phpmailer->SMTPAuth = true; // if required
        $phpmailer->SMTPSecure = 'ssl'; // enable if required, 'tls' is another possible value
        $phpmailer->IsSMTP();
    }
}