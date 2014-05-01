<div class="media-audio">

	<?php

	// if has featured image
	if( has_post_thumbnail() ) { ?>

		<div class="player-position-wrap">

			<?php

			// caption
			if(is_single()) { $caption=true; } else { $caption=false; }

			// image size
			$size = get_option('vk_blog_size');
			
				if( !is_single() && $size=='blog-square') {

					$size = 'square';

				} else {

					$size = 'standard';
				}

			// image
			$args = array(
		        'postid'    => get_the_ID(),		/* The Post ID */
		        'image'     => 'featured',  		/* URL to an image or FEATURED to grab the featured image */
		        'size'      => $size,  				/* The image size that should be returned */
		        'caption'	=> $caption,			/* If the image has a caption should be it displayed */
		        'hover'     => false,				/* Should the image have a hover */
		        	'title'		=> false,			/* include the title on image hover */
		        	'tax'		=> false,			/* include the taxonomy on image hover */
		        	'usetax'	=> '',				/* the taxonomy to use (leave blank if tax false) */
		        		'before'	=> '',
		        		'after'		=> '',

			        'link'      => 'post',				/* Should the hover link to POST or LIGHTBOX */
			        	'set'   	=> false,        	/* Should the lightbox include all the images attached to the post */
			        	'ex_feat' 	=> false,			/* Exclude the featured post from the lightbox set */

		    );
			vk_image($args);

			echo vk_audio($post->ID); ?>

		</div><!-- end player-position-wrap -->


	<?php } else {

		echo vk_audio($post->ID);

	} ?>


</div>