<?php


function insert_to_wordpress($foursq, $placeID,$placename,$address,$street,$state,$city,$country,$website,$placePhoto,$tdsNumber,$comment,$lat,$lon,$userID) {
    if($foursq != "") {

    echo "<strong>$address</strong>";   
   $state = strtoupper($state);
   if($state == "CALIFORNIA") $state = "CA";
   if($state == "NEVADA") $state = "NV";
   if($state == "VIRGINIA") $state = "VA";
   
   if($city == "Kailua Kona") $city = "Kailua-Kona";
   if($city == "Marina Del Rey") $city = "Marina del Rey";
   if($city == "SANTA ROSA" || $city == "Santa rosa") $city = "Santa Rosa";
   if($city == "surat") $city == "Surat";
   
    $updateFoursq = wp_insert_term( $foursq, 'foursquare_id' );
    $foursqID = (int)$updateFoursq->error_data['term_exists'];
    
    $updateState = wp_insert_term( $state, 'state' );
    $stateID = (int)$updateState->error_data['term_exists'];
    
    $updateCountry = wp_insert_term( $country, 'country' );
    $countryID = (int)$updateCountry->error_data['term_exists'];
    
    $updateCity = wp_insert_term( $city, 'city' );
    $cityID = (int)$updateCity->error_data['term_exists'];
    
    $updateAddress = wp_insert_term( $address, 'address' );
    $addressID = (int)$updateAddress->error_data['term_exists'];
    
    $updateStreet = wp_insert_term( $street, 'street' );
    $streetID = (int)$updateStreet->error_data['term_exists'];
    
    echo "$foursqID<br>";
    
    if(!placeExists($foursq)) {
        echo "<h2>new place!</h2>";
        $post = array(
          'post_status'    => 'publish',
          'post_title'     => $placename,
          'post_type'      => 'place'
        );  
        
        $post_id = wp_insert_post( $post );
        
       // add_post_meta($post_id,'foursquare_id',$foursq);
        
        wp_set_post_terms($post_id,array($foursqID),'foursquare_id');
        wp_set_post_terms($post_id,array($stateID),'state');
        wp_set_post_terms($post_id,array($countryID),'country');
        wp_set_post_terms($post_id,array($cityID),'city');
        wp_set_post_terms($post_id,array($addressID),'address');
        wp_set_post_terms($post_id,array($streetID),'street');
        
        update_post_meta($post_id,"tds",$tdsNumber);
        
    } else {
        echo "<h2>place exists</h2>";
    }
    }
}

function insert_test_to_wordpress($Placename,$DateCreated,$FsqId,$TestID,$UserID,$TdsNumber,$Lat,$Longi,$PlacePhoto,$Comment) {
    
    
    $the_query = new WP_Query( "post_type=test&meta_key=TestID&meta_value=$TestID&order=ASC" );

    if($the_query->have_posts() ) {
        echo $PlaceID.' already exists';
    } else if($DateCreated == "0000-00-00 00:00:00") {
        echo "No Date Yet";
    } else {
        $post = array(
          'post_status'    => 'publish',
          'post_title'     => $Placename,
          'post_type'      => 'test'
        );  
        
        $post_id = wp_insert_post( $post );
        update_post_meta($post_id,"DateCreated",$DateCreated);
        update_post_meta($post_id,"FsqId",$FsqId);
        update_post_meta($post_id,"TestID",$TestID);
        update_post_meta($post_id,"UserID",$UserID);
        update_post_meta($post_id,"TdsNumber",$TdsNumber);
        update_post_meta($post_id,"Lat",$Lat);
        update_post_meta($post_id,"Longi",$Longi);
        update_post_meta($post_id,"PlacePhoto",$PlacePhoto);
        update_post_meta($post_id,"Comment",$Comment);
        return $post_id;
    }
    return -1;
    
}

function placeExists($foursq) {
    $args = array(
    	'post_type' => 'place',
    	'foursquare_id' => $foursq,
	);
	
	$the_query = new WP_Query( $args );
	
	if(sizeof($the_query->posts) > 0) {
	    return true;
    }
    return false;
}

add_image_size( "single-main", "740", "1200", true );
add_image_size( "tiny-thumbnail", "240", "200", true );
add_image_size( "mobile-thumbnail", "100", "100", true );

function get_color_from_tds($tds) {
    $tds = (int)$tds;
    if($tds < 50)
        return "blue";
    else if($tds < 100)
        return "green";
    else if($tds < 200)
        return "yellow";
    else if($tds < 300)
        return "orange";
    else if($tds < 500)
        return "red";
    else if($tds >= 500)
        return "black";
    else
        return "error";
}

function map_scripts() {
    wp_enqueue_script( 'google-maps', '//maps.google.com/maps/api/js?sensor=true','1.0.0', true );
    wp_enqueue_script( 'aquagrade-map', get_template_directory_uri() . '/js/AquaGrade/map.js', array(), '1.0.0', true );
}