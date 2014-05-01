$ = jQuery;

var themeDirURI = location.protocol + "//" + location.host + "/wp-content/themes/aquagrade/";

var data = {
    'data':"true",
    'order':"ASC",
    'orderby':"tds",
    'q':"",
    'tdsmin':0,
    'tdsmax':1000
};

$("#number-of-results").text($("#places-list .place").length);
$("#places-list").css("min-height",$(window).height());
$(window).resize(function(){
    $("#places-list").css("min-height",$(window).height());
});

function getBottles(data) {
    $( "#places-list" ).load( "?data=" + data['data'] + "&order=" + data['order'] + "&orderby=" + data['orderby'] + "&q=" + data['q'] + "&tdsmin=" + data['tdsmin'] + "&tdsmax=" + data['tdsmax'], function(){
        $("#number-of-results").text($("#places-list .place").length);
    } );
}

$("#place-q").on("change keyup", function(){
    data['q'] = $(this).val();
    setTimeout(function(){
        getBottles(data)
    }, 500);
});

$( "#tds-range" ).slider({
    range: true,
    min: 0,
    max: 1000,
    values: [ 0, 1000 ],
    slide: function( event, ui ) {
        $( "#amount" ).text( "TDS: " + ui.values[ 0 ] + " - " + ui.values[ 1 ] );
    },
    stop: function( event, ui ) {
        data['tdsmin'] = ui.values[ 0 ];
        data['tdsmax'] = ui.values[ 1 ];
        getBottles(data);
    }
});
$('#tds-range .ui-slider-handle').tooltip();
$( "#amount" ).val( "TDS: " + $( "#tds-range" ).slider( "values", 0 ) +
" - " + $( "#tds-range" ).slider( "values", 1 ) );

$("#places-sidebar #orderby-options ul li a").click(function(e){
    e.preventDefault();
    
    $("#places-sidebar #orderby-options #orderby-button").html($(this).text() + " <span class='caret'></span>");
    data['orderby'] = $(this).data("orderby");
    getBottles(data);
    
});

$("#order-button").click(function(){
    if(data['order'] == 'ASC') {
        $("#order-button").html("<i class='fa fa-arrow-down'></i>");
        data['order'] = 'DESC';
    } else if(data['order'] == 'DESC') {
        $("#order-button").html("<i class='fa fa-arrow-up'></i>");
        data['order'] = 'ASC';
    }
    getBottles(data);
});