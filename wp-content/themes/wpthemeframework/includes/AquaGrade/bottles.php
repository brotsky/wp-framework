<?php

if(get_post_type() == "bottle")
    wp_enqueue_script( 'aquagrade-single-bottle', get_template_directory_uri() . '/js/AquaGrade/single-bottle.js', array(), '1.0.0', true );
    
if(is_page_template("bottles.php"))
    wp_enqueue_script( 'aquagrade-bottles', get_template_directory_uri() . '/js/AquaGrade/bottles.js', array(), '1.0.0', true );

function the_bottle_list_html($posts_array) {
    foreach($posts_array as $bottle) {
        $id = $bottle->ID;
        
        if($count % 3 == 0) echo "<div class='row'>";
        
        the_bottle_html($id);    
        
        
        if($count % 3 == 2) echo "</div>";
        
        $count++;
    }
    if(($count - 1) % 3 != 2) echo "</div>";
}

function the_bottle_html($id){ ?>
    <a href="<?php echo get_permalink($id); ?>" title="<?php echo get_the_title($id); ?>">
    <div class="bottle col-md-4">
        <?php 
        $thumbnail = get_the_post_thumbnail( $id, "medium", array('class' => 'slow') ); 
        if($thumbnail != "") {
            echo $thumbnail;
        } else {
         ?> 
        <i class="fa fa-exclamation-circle slow placeholder"></i><br />
        No Image
        <?php  } ?>
        <div class="info">
            <h4><?php echo get_the_title($id); ?></h4>
            <div class="tds"><?php the_field("tds",$id); ?></div>
            <i class="fa fa-caret-up"></i>
        </div>
    </div>
    </a>
<?php }

function single_bottle_html() {
$id = get_the_ID();

$thumbnail = get_the_post_thumbnail( $id, "full" , array() );

$types = wp_get_post_terms($id,"type",array());

?>
    <div class="row">
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2><?php the_title(); ?></h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                
                    <div class="table">
                        <div class="tds">
                            <div class="inner">
                                <h5>TDS</h5>
                                <span><?php the_field("tds"); ?></span>
                            </div>
                        </div>
                        <h4>Bottle Info</h4>
                        <?php 
                            if(sizeof($types) > 0) { ?>
                        <div class="cell">
                            
                            <div class="title">
                            <?php
                                echo "Type";
                                if(sizeof($types) > 1)
                                    echo "s";
                             ?>
                            </div>
                            <div class="field">
                             <?php   
                                $count = 0;
                                foreach($types as $type) {
                                    if($count > 0)
                                        echo ", ";
                                    $term = get_term($type->term_id, "type");
                                    echo $term->name;
                                    $count++;
                                }  ?>
                            </div>
                        </div>
                        <?php }
                        $website = get_field("website");
                        if($website) { ?>
                        <div class="cell">
                            <div class="title">
                                Website
                            </div>
                            <div class="field">
                                <?php echo $website; ?>
                            </div>
                        </div>
                        <?php }
                        $phone = get_field("phone_number");
                        if($phone) { ?>
                        <div class="cell">
                            <div class="title">
                                Phone
                            </div>
                            <div class="field">
                                <?php echo $phone; ?>
                            </div>
                        </div>
                        <?php }
                        $customer_service = get_field("customer_service");
                        if($customer_service) { ?>
                        <div class="cell">
                            <div class="title">
                                Customer Service
                            </div>
                            <div class="field">
                                <?php echo $customer_service; ?>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-md-6 description">
                    <h4>Bottle Description</h4>
                    <?php echo get_post_field('post_content', $id); ?>
                </div>
            </div>
    
    
        <?php 
        $location = get_field("factory_address"); 
        if( !empty($location) ) { 
            wp_enqueue_script( 'aquagrade-map', get_template_directory_uri() . '/js/AquaGrade/single-map.js', array(), '1.0.0', true );
            wp_enqueue_script( 'google-maps', '//maps.googleapis.com/maps/api/js?v=3.exp&sensor=false', array(), '1.0.0', true );
        ?>
        <h4><?php the_field("map_title"); ?></h4>
        <div class="map">
        	<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
        </div>
        <?php } ?>  
        </div>
        <div class="col-md-4">
            <div id="bottle-image" class="bottle<?php if($thumbnail == "") echo " no-image" ?>">
                <?php 
                if($thumbnail != "") {
                    echo $thumbnail;
                } else { ?>
                    <i class="fa fa-exclamation-circle slow placeholder"></i><br />
                    No Image
                <?php } ?>
            </div>
            <?php single_bottle_additional_images(); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
        <?php echo get_post_field('post_content', 1939); ?>
        </div>
    </div>
    

<?php }

function single_bottle_additional_images() {
    $id = get_the_ID();
    $images = get_field("images");
    if($images) {
        $main_image_id = get_post_thumbnail_id($id);
        $main_image_small = wp_get_attachment_image_src( $main_image_id, 'tiny-thumbnail');
        $main_image_small = $main_image_small[0];
        $main_image = wp_get_attachment_image_src( $main_image_id, 'single-main');
        $main_image = $main_image[0];
        ?>
        <div class="additional-images">
            <div class="image first">
                <a class="current" href="<?php echo $main_image; ?>">
                    <img src="<?php echo $main_image_small; ?>" width="100%" class="slow" />
                </a>
            </div>
            <?php 
            $count = 1;
            foreach($images as $image) { ?>
                <div class="image<?php if($count % 3 == 0) echo " first" ?>">
                    <a href="<?php echo $image['image']['sizes']['single-main']; ?>">
                        <img src="<?php echo $image['image']['sizes']['tiny-thumbnail']; ?>" width="100%" class="slow" />
                    </a>
                </div>
            <?php $count++;
            } ?>
        </div>
    <?php }
}

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_bottles',
		'title' => 'Bottles',
		'fields' => array (
			array (
				'key' => 'field_52a3cc7de5dc0',
				'label' => 'TDS',
				'name' => 'tds',
				'type' => 'number',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'min' => 0,
				'max' => '',
				'step' => 1,
			),
			array (
				'key' => 'field_52a3cc9ae5dc1',
				'label' => 'Phone Number',
				'name' => 'phone_number',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_52a3cd193a29f',
				'label' => 'Website',
				'name' => 'website',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_52e5aec5779ec',
				'label' => 'Customer Service',
				'name' => 'customer_service',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_52a3ccdae5dc3',
				'label' => 'Date Entered',
				'name' => 'date_entered',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_52a3d316cc8e2',
				'label' => 'Old Image URL',
				'name' => 'old_image_url',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_52c0be8ec22f2',
				'label' => 'Additional Images',
				'name' => 'images',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_52c0bea2c22f3',
						'label' => 'Image',
						'name' => 'image',
						'type' => 'image',
						'column_width' => '',
						'save_format' => 'object',
						'preview_size' => 'thumbnail',
						'library' => 'all',
					),
				),
				'row_min' => '',
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Image',
			),
			array (
				'key' => 'field_52e1837c406cc',
				'label' => 'Map Title',
				'name' => 'map_title',
				'type' => 'select',
				'choices' => array (
					'Water Source Location' => 'Water Source Location',
					'Bottling Company Location' => 'Bottling Company Location',
					'Distributor Location' => 'Distributor Location',
				),
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_52e173689a7a7',
				'label' => 'Factory Address',
				'name' => 'factory_address',
				'type' => 'google_map',
				'center_lat' => '',
				'center_lng' => '',
				'zoom' => '',
				'height' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'bottle',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}

