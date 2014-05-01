<?php
/**
 * Single product short description
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post;

if ( ! $post->post_content ) return;
?>
<div itemprop="description" class="product-content">
	<?php the_content(); ?>
</div>
<div class="shopping-icons">
    <img src="<?php echo get_template_directory_uri(); ?>/img/satisfaction-guaranteed.png" />
    <img src="<?php echo get_template_directory_uri(); ?>/img/free-shipping.png" />
    <img src="<?php echo get_template_directory_uri(); ?>/img/secure.png" />
    <img src="<?php echo get_template_directory_uri(); ?>/img/SecurePayments.jpg" />
</div>