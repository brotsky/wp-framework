$ = jQuery;

var themeDirURI = location.protocol + "//" + location.host + "/wp-content/themes/aquagrade/";

var map;
var stations = [];
var markers = [];

String.prototype.trim=function(){return this.replace(/^\s+|\s+$/g, '');};

$(document).ready(function(){

	//------- Google Maps ---------//

	// Creating a LatLng object containing the coordinate for the center of the map
	var latlng = new google.maps.LatLng(34.029169, -118.42333);
	var bounds = new google.maps.LatLngBounds();
	console.log(bounds.getSouthWest().lng());

	// Creating an object literal containing the properties we want to pass to the map
	var options = {
		zoom: 13, // This number can be set to define the initial zoom level of the map
		center: latlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP // This value can be set to define the map type ROADMAP/SATELLITE/HYBRID/TERRAIN
	};
	// Calling the constructor, thereby initializing the map
	map = new google.maps.Map(document.getElementById('map'), options);

	google.maps.event.addListener(map, 'dragend', function()
	{
		requestStations();
	});
	
	google.maps.event.addListener(map, 'zoom_changed', function()
	{
		requestStations();
	});
	
	requestStations();
	
});

function requestStations()
{
	var ll = map.getCenter();
	var corners = map.getBounds();
	
	if(corners) {
    	var params =
    	{
    		'count': 5000,
    		'sw_lat': corners.getSouthWest().lat(),
    		'sw_lon': corners.getSouthWest().lng(),
    		'ne_lat': corners.getNorthEast().lat(),
    		'ne_lon': corners.getNorthEast().lng()
    	};
	    	
    	console.log(params);
    	
    	$.ajax(
    	{
    		url: '//trevorblanding.com/webservice/findNearbyRect.php',
    		type: "GET",
    		dataType: 'JSONP',
    		data: params,
    		success: gotStations,
    		error: function(xhr, textStatus, errorThrown)
    		{
    			console.log(errorThrown);
    		}
    	});
	}
    else {
    	var params =
    	{
    		'count': 5000,
    		'lat': ll.lat(),
    		'lon': ll.lng()
    	};
    	
    	
    	$.ajax(
    	{
    		url: '//trevorblanding.com/webservice/findNearby.php',
    		type: "GET",
    		dataType: 'JSONP',
    		data: params,
    		success: gotStations,
    		error: function(xhr, textStatus, errorThrown)
    		{
    			console.log(errorThrown);
    		}
    	});
	}
}

function gotStations(data)
{
	if(!data)
		return;
		
	stations = data;
	
	console.log(markers.length);
	//clear out old markers
//	for(var m = 0; m < markers.length; m++)
//		markers[m].setMap(null);
			
	//add new markers
	for(var s = 0; s < stations.length; s++)
		addStation(stations[s]);
}

function addStation(station)
{
console.log(station);

	var img;
	
	if(station.TdsNumber < 50)
		img = themeDirURI + "img/map/" + 'blue.png'; //blue
	else if(station.TdsNumber < 100)
		img = themeDirURI + "img/map/" + 'green.png'; //green
	else if(station.TdsNumber < 200)
		img = themeDirURI + "img/map/" + 'yellow.png'; //yellow
	else if(station.TdsNumber < 300)
		img = themeDirURI + "img/map/" + 'orange.png'; //
	else if(station.TdsNumber < 500)
		img = themeDirURI + "img/map/" + 'red.png'; //
	else if(station.TdsNumber >= 500)
		img = themeDirURI + "img/map/" + 'black.png'; //
	else
		img = '';

// Define Marker properties
	var image = new google.maps.MarkerImage(img,

		new google.maps.Size(32, 39),
		// The origin for this image is 0,0.
		new google.maps.Point(0,0),
		// The anchor for this image is the base of the flagpole at 18,42.
		new google.maps.Point(16, 19)
	);

	// Add Marker
	var marker1 = new google.maps.Marker({
		position: new google.maps.LatLng(station.Lat, station.Longi),
		map: map,
		icon: image // This path is the custom pin to be shown. Remove this line and the proceeding comma to use default pin
	});
	
	markers.push(marker1);

	// Add listener for a click on the pin
	google.maps.event.addListener(marker1, 'click', function() {
		infowindow1.open(map, marker1);
	});

	// Add information window
	var infowindow1 = new google.maps.InfoWindow({
		content:  createInfo(station.Placename, 'TDS: ' + station.TdsNumber)
	});

	// Create information window
	function createInfo(title, content) {
		return '<div class="infowindow"><strong>'+ title +'</strong><br />'+content+'</div>';
	}

}

var currentIPhoneRotation = 0;

$(".banner #hide-iphone").click(function(e){
    e.preventDefault();
    $(".banner .iphone").css({
        "transform":"rotate(0deg)",
        "transform-origin":"100% 100%"
    });
    $(this).fadeOut(500);
    hideIphone();
});

$(window).load(function(){
    setTimeout(function(){
        $(".banner #hide-iphone").trigger("click");
    }, 3000);
});

function hideIphone() {
    if(currentIPhoneRotation >= -90) {
        $(".banner .iphone").css({
            "transform":"rotate(" + currentIPhoneRotation + "deg)"
        });
        currentIPhoneRotation--;
        setTimeout(hideIphone,5);
    } else {
        $(".banner .iphone").remove();
    }
}