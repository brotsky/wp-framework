<?php

ini_set('max_execution_time', '100000');

add_action( 'wp', 'prefix_setup_schedule' );

function prefix_setup_schedule() {
	if ( ! wp_next_scheduled( 'prefix_hourly_event' ) ) {
		wp_schedule_event( time(), 'daily', 'prefix_hourly_event');
	}
}

add_action( 'prefix_hourly_event', 'prefix_do_this_hourly' );

function prefix_do_this_hourly() {
	import_everything();
}

function import_everything() {
    $time_start = microtime(true);
    import_places();
    import_places();
    import_foursquare_info();
    import_tests();
    $time_end = microtime(true);
}

function import_places() {
    $url = "http://trevorblanding.com/webservice/getAllPlaces.php?count=200";
    
    $json = file_get_contents($url);
    
    $json = json_decode(utf8_encode($json));
    
    foreach($json as $row) {    
        $foursq = $row->FoursquareID;
        
        $placeID = $row->PlaceID;
    	$placename = $row->Placename;
    	
    	$address = $row->Address;
    	$street = $row->Street;
    	$state = $row->State;
    	$city = $row->City;
    	$country = $row->Country;
    	$phone = $row->Phone;
    	$website = $row->URL;
    	
    	$placePhoto = $row->PlacePhoto;
    	$tdsNumber = $row->TdsNumber;
    	$comment = $row->Comment;
    
    	$lat = $row->Lat;
    	$lon = $row->Longi;
    	
    	$userID = $row->UserID;
    	
    	insert_to_wordpress($foursq, $placeID,$placename,$address,$street,$state,$city,$country,$website,$placePhoto,$tdsNumber,$comment,$lat,$lon,$userID);
    }

}

function import_foursquare_info() {
    $places = get_posts( array("post_type" => "place", 'posts_per_page' => -1) );

    $count_new_test = 0;
    foreach($places as $place) {
        update_foursquare_info($place->ID);
    }
}

function update_foursquare_info($id) {
    $foursquare = wp_get_post_terms($id,"foursquare_id",array());
    $foursquare = $foursquare[0]->name;
    if($foursquare != "") {
        $foursquareHTML = file_get_contents_curl("https://foursquare.com/v/$foursquare");
        
        $doc = new DOMDocument();
        @$doc->loadHTML($foursquareHTML);
        
        $metas = $doc->getElementsByTagName('meta');
        
        
        $image_count = 0;
        
        for ($i = 0; $i < $metas->length; $i++) {
            $meta = $metas->item($i);            
            if($meta->getAttribute('property') == "og:title") {            
                wp_update_post( array("ID" => $id,"post_title" => $meta->getAttribute('content')) );
            }
            if($meta->getAttribute('property') == "og:image" && $image_count == 0) {                            
                update_post_meta($id,"foursquare_image_uri",$meta->getAttribute('content'));
                $image_count++;
            }
            if($meta->getAttribute('property') == "playfoursquare:location:latitude") {
                update_post_meta($id,"foursquare_latitude",$meta->getAttribute('content'));
            }
            if($meta->getAttribute('property') == "playfoursquare:location:longitude") {
                update_post_meta($id,"foursquare_longitude",$meta->getAttribute('content'));
            }
        }
        
        $spans = $doc->getElementsByTagName('span');
        
        for ($i = 0; $i < $spans->length; $i++) {
            $span = $spans->item($i);
            if($span->getAttribute('itemprop') == "telephone")
                update_post_meta($id,"foursquare_telephone", $span->nodeValue, PHP_EOL);
        }
        
        $as = $doc->getElementsByTagName("a");
        
        $cat_count = 0;
        
        for ($i = 0; $i < $as->length; $i++) {
            $a = $as->item($i);
            
            if($a->getAttribute('class') == "twitterPageLink") {
                update_post_meta($id,"foursquare_twitter_handle", $a->nodeValue, PHP_EOL);
                update_post_meta($id,"foursquare_twitter_url", $a->getAttribute('href'));
            }
            
            if($a->getAttribute('itemprop') == "url") {
                update_post_meta($id,"foursquare_website", $a->nodeValue, PHP_EOL);
                update_post_meta($id,"foursquare_website_url", $a->getAttribute('href'));
            }
            
            if($a->getAttribute('class') == "categoryLink") {
            
                $category = $a->nodeValue;
                $updateCategory = wp_insert_term( $category, 'place_category' );
                $catID[$cat_count] = (int)$updateCategory->error_data['term_exists'];
                $cat_count++;
            }            
        }
        for($i = 0 ; $i < $cat_count ; $i++) {
            wp_set_post_terms($id,$catID,'place_category');
        }
        
    } else {
        wp_delete_post($id,true);
    }
}

function import_tests() {
    $places = get_posts( array("post_type" => "place", 'posts_per_page' => -1) );
    
    $count_new_test = 0;
        
    foreach($places as $place) {
        $foursquare_ids = get_the_terms($place->ID,"foursquare_id");
        $fsqid = "";
        $count = 0;
        if($foursquare_ids) {
            foreach($foursquare_ids as $f) {
                if($count != 0)
                    $fsqid += "," . $f->name;
                else
                    $fsqid = $f->name;
                    
                $count++;
            }    
            $url = "http://trevorblanding.com/webservice/?op=getOnePlaceFourSquare&fsqid=" . $fsqid;
            $json = file_get_contents($url);
            $json = json_decode(utf8_encode($json));
            $tests = $json->Response;
            if($tests)
                foreach($tests as $test) {
                  //  print_r($test);
                    $DateCreated = $test->DateCreated;
                    $FsqId = $test->FsqId;
                    $PlaceID = intval($test->PlaceID); //its really the test ID
                    $PlaceID = sprintf( '%08d', $PlaceID );
                    $UserID = $test->UserID;
                    $TdsNumber = $test->TdsNumber;
                    $Lat = $test->Lat;
                    $Longi = $test->Longi;
                    $PlacePhoto = $test->PlacePhoto;
                    $Comment = $test->Comment;
                    
                    $Placename = $test->Placename;
                    
                    $id = insert_test_to_wordpress($Placename,$DateCreated,$FsqId,$PlaceID,$UserID,$TdsNumber,$Lat,$Longi,$PlacePhoto,$Comment);                    
                    
                    if($id != -1)
                        $count_new_test++;
                                        
                }
        }
    
        $PlaceValues = get_place_tds_history_info($place->ID);
        update_post_meta($place->ID,"values",$PlaceValues);
    
    }
    
    if($count_new_test != 0) {
        wp_mail( "trevor@aquagrade.com", "$count_new_test New Tests!", "There were $count_new_test new tests in the last hour!" );
        wp_mail( "brandon@brotskydesigns.com", "$count_new_test New Tests!", "There were $count_new_test new tests in the last hour!" );
    }
}