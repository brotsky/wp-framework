$ = jQuery;

var currentMousePosY;
var bottleImageHeight;
var bottleImageContainerHeight;
var deltaImageHeight;
var imageOffset;
$("#bottle-image img").attr("height","");

$(".single-bottle .additional-images .image a").click(function(e){
    e.preventDefault();
    $("#bottle-image").html("<img src='" + $(this).attr("href") +"' width='100%' />");
    $(".single-bottle .additional-images .image a").removeClass("current");
    $(this).addClass("current");
    
    $(".single-bottle .bottle img").attr("style","");
});

$("#bottle-image img").one("load",function(){
    currentMousePosY = 0;
    bottleImageHeight = $("#bottle-image img").height();
    bottleImageContainerHeight = $("#bottle-image").height() + 50;
    
    console.log("Image Height: " + bottleImageHeight + " Container: " + bottleImageContainerHeight);
    
    deltaImageHeight = Math.abs( bottleImageHeight - bottleImageContainerHeight );
    imageOffset = 0;

    if(deltaImageHeight > 0) {
        $(".single-bottle #bottle-image").mousemove(function(event) {
            currentMousePosY = event.offsetY;
            imageOffset = currentMousePosY / bottleImageContainerHeight * deltaImageHeight;
            $(".single-bottle #bottle-image img").css("top",-imageOffset);
        });
    } else {
        $(".single-bottle #bottle-image img").css("top",-deltaImageHeight/2);
    }
});