<?php
ini_set('max_execution_time', '100000');
/*
Template Name: Import
*/

import_everything();

/*
echo "<pre>";

$url = "http://trevorblanding.com/webservice/getAllPlaces.php?count=3000";

$json = file_get_contents($url);

$json = json_decode(utf8_encode($json));

foreach($json as $row) {
    echo "Bottle: $bottle->name<br/>";
    
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
	
	echo "FourSquare ID: $foursq<br>";
	echo "Place ID: $placeID<br>";
	echo "Place Name: $placename<br>";
	echo "Address: $address<br>";
	echo "Street: $street<br>";
	echo "State: $state<br>";
	echo "City: $city<br>";
	echo "Country: $country<br>";
	echo "Phone: $phone<br>";
	echo "Website: $website<br>";
	echo "Place Photo: $placePhoto<br>";
	echo "TDS Number: $tdsNumber<br>";
	echo "Comment: $comment<br>";
	echo "Lat: $lat<br>";
	echo "Lon: $lon<br>";
	echo "User ID: $userID<br>";
	
	insert_to_wordpress($foursq, $placeID,$placename,$address,$street,$state,$city,$country,$website,$placePhoto,$tdsNumber,$comment,$lat,$lon,$userID);
	
	
	echo "<hr>";
}
