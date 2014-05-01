<?php

define('GALLERY_GRID_DIR', get_template_directory_uri() . '/includes/modules/gallery-grid');

acf_add_options_sub_page( __('Gallery Grid') );
add_image_size( 'gallery-grid', 572, 354, true );

function gallery_grid() {
    gallery_grid_scripts();
    
    $gallery = get_field("gallery_grid","options");
    ?>
    
    <section id="gallery-grid">
        <?php if(get_field("gallery_grid_show_title_area","options")) { ?>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 text-center">
                    <h3><?php the_field("gallery_grid_title","options"); ?></h3>
                    <?php the_field("gallery_grid_caption","options"); ?>
                </div>
            </div>
        </div>
        <?php } ?>
        <div class="gallery">
            <?php foreach($gallery as $image){ 
                $thumb = $image["image"]["sizes"]["gallery-grid"];
                $full = $image["image"]["url"];
                $caption = $image["caption"];
            ?>
            <div class="image hidden">
                <a href="<?php echo $full; ?>" target="_blank" rel="gallery-grid" title="<?php echo $caption; ?>">
                    <img src="<?php echo $thumb; ?>" alt="<?php echo $caption; ?>" />
                    <div class="caption">
                        <div class="text">
                            <?php echo $caption; ?>
                        </div>
                    </div>
                </a>
            </div>
            <?php } ?>
        </div>
    </section>
    <?php
}

function gallery_grid_scripts() {
    wp_enqueue_style( 'fancybox', get_template_directory_uri() . '/js/vendor/fancybox/jquery.fancybox.css' );
    wp_enqueue_style( 'gallery-grid', GALLERY_GRID_DIR . '/gallery-grid.css' );
    
    wp_enqueue_script( 'fancybox', get_template_directory_uri() . '/js/vendor/fancybox/jquery.fancybox.js', array(), '2.1.5', true );
    wp_enqueue_script( 'gallery-grid', GALLERY_GRID_DIR . '/gallery-grid.js', array(), '1.0.0', true );
}

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_gallery-grid',
		'title' => 'Gallery Grid',
		'fields' => array (
			array (
				'key' => 'field_53618df4f897a',
				'label' => 'Show Title Area',
				'name' => 'gallery_grid_show_title_area',
				'type' => 'true_false',
				'message' => '',
				'default_value' => 1,
			),
			array (
				'key' => 'field_53618e7be90f7',
				'label' => 'Title',
				'name' => 'gallery_grid_title',
				'type' => 'text',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_53618df4f897a',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_53618ea3e90f8',
				'label' => 'Caption',
				'name' => 'gallery_grid_caption',
				'type' => 'wysiwyg',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_53618df4f897a',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
			array (
				'key' => 'field_5361862428aeb',
				'label' => 'Gallery Grid',
				'name' => 'gallery_grid',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_5361863728aec',
						'label' => 'Image',
						'name' => 'image',
						'type' => 'image',
						'column_width' => '',
						'save_format' => 'object',
						'preview_size' => 'thumbnail',
						'library' => 'all',
					),
					array (
						'key' => 'field_5361864528aed',
						'label' => 'Caption',
						'name' => 'caption',
						'type' => 'textarea',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'maxlength' => '',
						'rows' => '',
						'formatting' => 'br',
					),
				),
				'row_min' => '',
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Image',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'acf-options-gallery-grid',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}
