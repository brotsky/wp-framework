<div class="media-link">

	<?php

	// text
	$text = get_post_meta($post->ID,'vk_link_desc',true);

	// source
	$url = get_post_meta($post->ID, 'vk_link_url', true);

	// clean url
	$urlclean = preg_replace("/(http:\/\/)/i",'',$url);

	// color
	$color = get_post_meta( $post->ID,'vk_link_color', true);

	// bg color
	$bg_color = get_post_meta( $post->ID,'vk_link_bg_color', true);

	// image size
	$size = get_option('vk_blog_size');
	
		if( !is_single() && $size=='blog-square') {

			$size = 'square';

		} else {

			$size = 'standard';
		}

	// bg image
	$id_image = get_post_thumbnail_id($post->ID);
	
	// bg image src
	$bg_image = wp_get_attachment_image_src( $id_image, $size );

	?>

	<!-- link -->
	<div class="link-wrap link-<?php echo $size; ?> background-cover" style="color: <?php echo $color;?>; background-color: <?php echo $bg_color; ?>; background-image: url(<?php echo $bg_image[0]; ?>);">

		<div class="vertical-align">

			<?php if($text!='') { ?>

			<h2 class="title"><?php echo $text; ?></h2>

			<?php } ?>

			<p style="color: <?php echo $color; ?>"><a class="no-link" style="color: <?php echo $color; ?>" target="_blank" href="<?php echo $url; ?>"><?php echo $urlclean; ?></a></p>

		</div>

	</div>

</div>