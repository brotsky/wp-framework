<?php

define('SCROLLING_BOXES_SLIDER_DIR', get_template_directory_uri() . '/includes/modules/scrolling-boxes-slider');

add_image_size( 'scrolling-boxes-slider', 580, 440, true );



function scrolling_boxes_slider() {
    scrolling_boxes_slider_scripts();
    
    ?>
    
    <section id="scrolling-boxes-slider">
        <?php $sliderImages = get_field("scrolling_boxes_images");
            
            $top_row = array();
            $bottom_row = array();
            
            $count = 0;
            foreach($sliderImages as $slide) {
                if($count % 2 == 0)
                    array_push($top_row, $slide);
                else
                    array_push($bottom_row, $slide);
                    
                $count++;
            }
            ?>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="slider-container">
                            <div class="image-row one">
                            <?php foreach($top_row as $i) { ?>
                                <div class="image">
                                    <img src="<?php echo $i['image']['sizes']['scrolling-boxes-slider']; ?>" alt="<?php echo $i['title']; ?>" />
                                </div>
                            <?php } ?>
                            </div>
                            <div class="image-row two">
                            <?php foreach($bottom_row as $i) { ?>
                                <div class="image">
                                    <img src="<?php echo $i['image']['sizes']['scrolling-boxes-slider']; ?>" alt="<?php echo $i['title']; ?>" />
                                </div>
                            <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
         ?>
    </section>
    <?php
}

function scrolling_boxes_slider_scripts() {
    wp_enqueue_style( 'scrolling-boxes-slider', SCROLLING_BOXES_SLIDER_DIR . '/scrolling-boxes-slider.css' );
    wp_enqueue_script( 'scrolling-boxes-slider', SCROLLING_BOXES_SLIDER_DIR . '/scrolling-boxes-slider.js', array(), '1.0.0', true );
}

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_scrolling-boxes-slider',
		'title' => 'Scrolling Boxes Slider',
		'fields' => array (
			array (
				'key' => 'field_536425dba9a65',
				'label' => 'Scrolling Boxes Images',
				'name' => 'scrolling_boxes_images',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_536425eda9a66',
						'label' => 'Image',
						'name' => 'image',
						'type' => 'image',
						'column_width' => '',
						'save_format' => 'object',
						'preview_size' => 'thumbnail',
						'library' => 'all',
					),
					array (
						'key' => 'field_536425faa9a67',
						'label' => 'Title',
						'name' => 'title',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
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
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'home-template.php',
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
