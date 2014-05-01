$ = jQuery;

function galleryGridInit() {
    var count = 0;
    $("#gallery-grid .image").each(function(){
        if($(window).width() <= 500 && count > 7)
            $(this).addClass("hidden");
        else
            $(this).removeClass("hidden").css("height",$("#gallery-grid .image:first").width()/1.618);

        count++;
    });
    
    $("#gallery-grid .image a").fancybox();
}

$(document).ready(galleryGridInit);
$(window).resize(galleryGridInit);