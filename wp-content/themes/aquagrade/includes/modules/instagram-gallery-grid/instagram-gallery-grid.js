$ = jQuery;

function galleryGridInit() {
    var count = 0;
    $("#gallery-grid .image").each(function(){
        if($(window).width() <= 500 && count > 7)
            $(this).hide();
        else
            $(this).show().css("height",$("#gallery-grid .image:first").width());

        count++;
    });
    
}

$(document).ready(galleryGridInit);
$(window).resize(galleryGridInit);