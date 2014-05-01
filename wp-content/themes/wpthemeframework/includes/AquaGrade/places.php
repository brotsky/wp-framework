<?php

if(is_page_template("places.php"))
    wp_enqueue_script( 'aquagrade-places', get_template_directory_uri() . '/js/AquaGrade/places.js', array(), '1.0.0', true );

function single_place_html($id) {
    single_place_general_content_html($id);
    single_place_history_html($id);
    get_place_location_html();
}

function single_place_general_content_html($id) {
    
    $thumbnail = get_the_post_thumbnail( $id, "full" , array() );
    if($thumbnail == "")
        $thumbnail = "<img src='" . get_post_meta($id,"foursquare_image_uri",true) . "' width='100%' height='100%' />";
    
    
    $types = wp_get_post_terms($id,"type",array());
    $values = get_post_meta($id,"values",true);

?>
    <div class="row">
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1><?php the_title(); ?></h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                
                    <div class="table">
                        <div class="tds">
                            <div class="inner">
                                <h5>TDS (Average)</h5>
                                <span><?php echo $values['average']; ?></span>
                            </div>
                        </div>
                        <div class="tds">
                            <div class="inner">
                                <h5>TDS (Most Recent)</h5>
                                <span><?php echo $values['most_recent']; ?></span>
                            </div>
                        </div>
                        <div class="tds">
                            <div class="inner">
                                <h5>Number of Tests</h5>
                                <span><?php echo $values['num_of_tests']; ?></span>
                            </div>
                        </div>
                        <div class="tds">
                            <div class="inner">
                                <h5>First Test Date</h5>
                                <span><?php echo $values['first_test_date']; ?></span>
                            </div>
                        </div>
                        <div class="tds">
                            <div class="inner">
                                <h5>Most Recent Test Date</h5>
                                <span><?php echo $values['most_recent_test_date']; ?></span>
                            </div>
                        </div>
                        <h4>Place Info</h4>
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
            </div>
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
        </div>
    </div>
    

<?php }

function get_place_location_html() {
    wp_enqueue_script( 'google-maps', '//maps.googleapis.com/maps/api/js?v=3.exp&sensor=false', array(), '1.0.0', true );
    wp_enqueue_script( 'aquagrade-map', get_template_directory_uri() . '/js/single-map.js', array(), '1.0.0', true );
    ?>
        <div class="map">
        	<div class="marker" data-lat="<?php the_field("foursquare_latitude"); ?>" data-lng="<?php the_field("foursquare_longitude"); ?>"></div>
        </div>
        </div>
<?php }

function get_place_tds_history_info($id) {
    $term_list = wp_get_post_terms($id, 'foursquare_id', array("fields" => "all"));
    
    $fsqids = array();
    foreach($term_list as $t) {            
        array_push($fsqids,$t->name);
    }
    
    $args = array(
            'post_type' => 'test',
            'posts_per_page' => -1,
            'orderby' => 'meta_value',
            'meta_key'=>'DateCreated',
            'order' => 'ASC',
            'meta_query' => array(
                array(
                'key' => 'FsqId',
                'value' => $fsqids,
                'compare' => 'IN'
                )
            )
        );
    
    $tests = new WP_Query( $args );
        
    $tds_scores = array();
    $test_dates = array();
    $test_history = array();
  //  $test_history_one_per_day = array();
    
    if ( $tests->have_posts() ) {    
    	while ( $tests->have_posts() ) {
    	    $tests->the_post();
    	    $tds = (int)get_field("TdsNumber");
    	    $date = get_field("DateCreated");
    	    array_push($tds_scores, $tds);
    	    array_push($test_dates, $date);
    	    array_push($test_history, array(
    	        "date" => $date,
    	        "tds" => $tds
    	    ));
    	}
	}
	wp_reset_postdata();
	
	
	
	$values = array(
	    "average" => floor( array_sum($tds_scores) / sizeof($tds_scores) ),
	    "most_recent" => $tds_scores[sizeof($tds_scores) - 1],
	    "num_of_tests" => sizeof($tds_scores),
	    "first_test_date" => $test_dates[0],
	    "most_recent_test_date" => $test_dates[sizeof($test_dates) - 1],
	    "history" => $test_history,
	   // "history_one_per_day" => $test_history_one_per_day
	);
	return $values;
}

function single_place_history_html($id) { ?>
        <div>
        <div class="row">
    <?php
        $term_list = wp_get_post_terms($id, 'foursquare_id', array("fields" => "all"));
        $fsqids = array();
        foreach($term_list as $t) {            
            array_push($fsqids,$t->name);
        }
        
        $args = array(
                'post_type' => 'test',
                'orderby' => 'meta_value',
                'meta_key'=>'DateCreated',
                'order' => 'ASC',
                'meta_query' => array(
                    array(
                    'key' => 'FsqId',
                    'value' => $fsqids,
                    'compare' => 'IN'
                    )
                )
            );
        
        $tests = new WP_Query( $args );
      //  print_r($tests);
        $chartdata = "";
        $ticks = "";
        $chartDataArray = array();
        
        // The Loop
if ( $tests->have_posts() ) {
    $dayCount = 0;
    
    graph_scripts();

        ?>
        <div class="col-md-6 test-history">
            <ul>
        <?php
        
	while ( $tests->have_posts() ) {
	    
		$tests->the_post();
		$id = get_the_ID();
		
		$dateCreated = get_field("DateCreated");
		$dateCreated = explode(" ", $dateCreated);
		$dateCreated = $dateCreated[0];
		$dateCreated = explode("-", $dateCreated);
		$year = $dateCreated[0];
		$month = $dateCreated[1];
		$day = $dateCreated[2];
		$dateCreated = "new Date($year,$month,$day)";
		
		if($tempDate != $dateCreated) {
		    $dayCount = 0;
    	    $chartdata .= "['$year/$month/$day', " . get_field("TdsNumber") ."],";
    	    
    	    array_push($chartDataArray , array("$year/$month/$day",get_field("TdsNumber")));
		}
		$dayCount++;
		$tempDate = $dateCreated;
		
		?>
        		<a href="<?php echo get_permalink(); ?>">
            		<li>
                		<div class="tds">
                            <div class="inner">
                                <h5>TDS</h5>
                                <span><?php the_field("TdsNumber"); ?></span>
                            </div>
                        </div>
                        <div class="tds">
                            <div class="inner">
                                <h5>Date</h5>
                                <span><?php the_field("DateCreated"); ?></span>
                            </div>
                        </div>
            		</li>
        		</a>
		<?php
		
	//	echo '<a href="' . get_permalink() .'"><li>Date: ' . get_field("DateCreated") . ' - TDS: ' . get_field("TdsNumber") . '</li></a>';
	}
	rtrim($chartdata, ',');
        ?>
            </ul>
        </div>
        <?php
} else {
	// no posts found
}
/* Restore original Post Data */
wp_reset_postdata();
    ?>
        
        <div class="col-md-6">
            <div id="chart"></div>
        </div>
    </div>
    <script type="text/javascript">
    $ = jQuery;
    
    $(document).ready(chartInit);
//    $(window).resize(chartInit);
    
    function chartInit() {
    
        var line=[<?php echo $chartdata; ?>];
        var plot = $.jqplot('chart', [line], {
            seriesColors: [ "#66ccff" ],
            title:'TDS History',
            axes:{xaxis:{renderer:$.jqplot.DateAxisRenderer}},
             grid: {
                drawGridLines: false,        // wether to draw lines across the grid or not.
                gridLineColor: '#cccccc',    // *Color of the grid lines.
                background: '#ffffff',      // CSS color spec for background color of grid.
                borderColor: '#999999',     // CSS color spec for border around grid.
                borderWidth: 2.0,           // pixel width of border around grid.
                shadow: false,               // draw a shadow for grid.
                shadowAngle: 45,            // angle of the shadow.  Clockwise from x axis.
                shadowOffset: 1.5,          // offset from the line of the shadow.
                shadowWidth: 3,             // width of the stroke for the shadow.
                shadowDepth: 3,             // Number of strokes to make when drawing shadow.
                                            // Each stroke offset by shadowOffset from the last.                                            // CanvasGridRenderer takes no additional options.
            },
            series:[{lineWidth:4, markerOptions:{style:'square'}}]
           
        });
    }

    </script>
    </div>
<?php }

function the_place_list_html($posts_array) {
    foreach($posts_array as $place) {
        $id = $place->ID;
        
        if($count % 3 == 0) echo "<div class='row'>";
        
        the_place_html($id);    
        
        if($count % 3 == 2) echo "</div>";
        
        $count++;
    }
    if(($count - 1) % 3 != 2) echo "</div>";
}

function the_place_html($id){
    $values = get_post_meta($id,"values",true);
    $average = $values['average'];
    $color = get_color_from_tds($average);
 ?>
    <a href="<?php echo get_permalink($id); ?>" title="<?php echo get_the_title($id); ?>">
    <div class="place col-md-4 <?php echo $color; ?>">
        <?php 
        $thumbnail = get_the_post_thumbnail( $id, "medium", array('class' => 'slow') ); 
        if($thumbnail != "") {
            echo $thumbnail;
        } else if(get_post_meta($id,"foursquare_image_uri",true) != ""){
            echo "<img src='" . get_post_meta($id,"foursquare_image_uri",true) . "' width='100%' height='100%' />";
        } else {
         ?> 
        <i class="fa fa-exclamation-circle slow placeholder"></i><br />
        No Image
        <?php  } ?>
        <div class="info">
            <h4><?php echo get_the_title($id); ?></h4>
            <div class="tds"><?php echo $average; ?></div>
            <i class="fa fa-caret-up"></i>
        </div>
    </div>
    </a>
<?php 

}

function file_get_contents_curl($url) {
    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    
    $data = curl_exec($ch);
    curl_close($ch);
    
    return $data;
}

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_place',
		'title' => 'Place',
		'fields' => array (
			array (
				'key' => 'field_532931a4ef9b3',
				'label' => 'FourSquare Image URI',
				'name' => 'foursquare_image_uri',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_532931bdef9b4',
				'label' => 'FourSquare Latitude',
				'name' => 'foursquare_latitude',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_532931d5ef9b5',
				'label' => 'FourSquare Longitude',
				'name' => 'foursquare_longitude',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_532936290d4a8',
				'label' => 'FourSquare Telephone',
				'name' => 'foursquare_telephone',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5329363e0d4a9',
				'label' => 'FourSquare Twitter Handle',
				'name' => 'foursquare_twitter_handle',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_532936590d4aa',
				'label' => 'FourSquare Twitter URL',
				'name' => 'foursquare_twitter_url',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_53293f1eb6797',
				'label' => 'Foursquare Website',
				'name' => 'foursquare_website',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_53294164a8bb8',
				'label' => 'Foursquare Website URL',
				'name' => 'foursquare_website_url',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'place',
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
