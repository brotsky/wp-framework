<div class="media-gallery">

	<?php

	// style
	$style = get_post_meta($post->ID, 'vk_gallery', true);

	// caption
	if(is_single()) { $caption=true; } else { $caption=false; }
	
	// image size
	$size = get_option('vk_blog_size');
	
		if( !is_single() && $size=='blog-square') {

			$size = 'square';

		} else {

			$size = 'standard';
		}

	// exclude featured
	$excludefeature = get_post_meta($post->ID, 'vk_gallery_hide', true);

		if( $excludefeature=='on') {

			$ex_feat = true;

		} else {

			$ex_feat = false;

		}

	/*-----------------------------------------------------------------------------------*/
	/*
	/*  Slider Gallery Post
	/*
	/*-----------------------------------------------------------------------------------*/
	if( $style=='slider' || $size=='square' && !is_single() ) { ?>

		<div class="gallery-slider">

			<!-- slider -->
			<div class="cycle-slideshow"
			data-cycle-slides="> div"
			data-cycle-prev="#prev-<?php echo $post->ID; ?>"
			data-cycle-next="#next-<?php echo $post->ID; ?>"
			data-cycle-log="false"
			>

				<?php $slides = array(
					'postid'    => get_the_ID(),	/* The Post ID */
					'size'      => $size,  			/* The image size that should be returned */
					'hover'     => false,        	/* Should the images have a hover */
						'link'      => 'post',  		/* Should the hover link to POST or LIGHTBOX */

					'ex_feat' 	=> $ex_feat,		/* Exclude the featured post from the images returned */
					'caption'	=> $caption,		/* Should the captions be returned with the images */
					'container'	=> 'slide',			/* Wrap returned images in a DIV with custom class */
				);
				vk_images( $slides ); ?>

			</div>

			<!-- slider -->
			<div class="cycle-controls">

			    <span id="prev-<?php echo $post->ID; ?>" class="button">&#8592;</span> 

			    <span id="next-<?php echo $post->ID; ?>" class="button">&#8594;</span>

			</div>

		</div><!-- end .gallery-slider -->

	<?php
	/*-----------------------------------------------------------------------------------*/
	/*
	/*  List Gallery Post
	/*
	/*-----------------------------------------------------------------------------------*/
	} else { ?>

		<div class="gallery-list">

			<?php $list = array(
				'postid'    => get_the_ID(),	/* The Post ID */
				'size'      => $size,  			/* The image size that should be returned */
				'hover'     => false,        	/* Should the images have a hover */
				'link'      => 'post',  		/* Should the hover link to POST or LIGHTBOX */
				'ex_feat' 	=> $ex_feat,		/* Exclude the featured post from the images returned */
				'caption'	=> $caption,			/* Should the captions be returned with the images */
				'container'	=> 'list',			/* Wrap returned images in a DIV with custom class */
			);
			vk_images( $list ); ?>

		</div>


	<?php } ?>

	<div class="clear"></div>

</div>