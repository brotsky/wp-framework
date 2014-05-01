<div class="media-quote">

	<?php

	// text
	$text = get_post_meta($post->ID,'vk_quote_text',true);

	// source
	$source = get_post_meta($post->ID,'vk_quote_source',true);

	// color
	$color = get_post_meta( $post->ID,'vk_quote_color', true);

	// bg color
	$bg_color = get_post_meta( $post->ID,'vk_quote_bg_color', true);

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

	<!-- quote -->
	<div class="quote-wrap quote-<?php echo $size; ?> background-cover" style="color: <?php echo $color;?>; background-color: <?php echo $bg_color; ?>; background-image: url(<?php echo $bg_image[0]; ?>);">

		<div class="vertical-align">

			<h2 class="title"><?php echo $text; ?></h2>

			<?php if($source!='') { ?>

				<p><?php echo $source; ?></p>

			<?php } ?>

		</div>

	</div>

</div>