<?php if( has_post_thumbnail() ) {

	// single vars
	if( is_single() ) {

		$caption = true;
		$hover = false;
		$title = false;

	// blog archive vars
	} else {

		$caption = false;
		$hover = true;
		$title = get_option('vk_post_blog_hover');

		// check if user has entered a title
		if($title=='') { $title==false; }

	}

	// image size
	$size = get_option('vk_blog_size');
	
		if( !is_single() && $size=='blog-square') {

			$size = 'square';

		} else {

			$size = 'standard';
		}

	?>

	<div class="media-standard">

	   <?php $args = array(
	        'postid'    => get_the_ID(),		/* The Post ID */
	        'image'     => 'featured',  		/* URL to an image or FEATURED to grab the featured image */
	        'size'      => $size,  				/* The image size that should be returned */
	        'caption'	=> $caption,				/* If the image has a caption should be it displayed */
	        'hover'     => $hover,        		/* Should the image have a hover */
	        	'title'		=> $title,			/* include the title on image hover (can now be a string and will replace title) */
	        	'tax'		=> false,			/* include the taxonomy on image hover */
	        	'usetax'	=> '',				/* the taxonomy to use (leave blank if tax false) */
	        		'before'	=> '',
	        		'after'		=> '',

		        'link'      => 'post',				/* Should the hover link to POST or LIGHTBOX */
		        	'set'   	=> false,        	/* Should the lightbox include all the images attached to the post */
		        	'ex_feat' 	=> false,			/* Exclude the featured post from the lightbox set */

	    );
		vk_image($args); ?>

	</div>

<?php } ?>

