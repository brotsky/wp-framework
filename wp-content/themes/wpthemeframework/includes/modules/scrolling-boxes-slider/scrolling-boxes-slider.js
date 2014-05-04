$ = jQuery;
var img1,first1,row1;
var img2,first2,row2;

function imgScroll1(){
    row1 = $("#scrolling-boxes-slider .image-row.one");
    first1 = $("#scrolling-boxes-slider .image-row.one .image").first();
    img1 = $("#scrolling-boxes-slider .image-row.one .image");
    
    row1.animate({left:"+=310"},12000,'linear',function(){
        
        row1.css("left",0);
        
        first1.remove();
        $("#scrolling-boxes-slider .image-row.one").append(first1);
        imgScroll1();
    });
}

function imgScroll2(){
    row2 = $("#scrolling-boxes-slider .image-row.two");
    last2 = $("#scrolling-boxes-slider .image-row.two .image").last();
    img2 = $("#scrolling-boxes-slider .image-row.two .image");
    
    row2.animate({left:"+=310"},12000,'linear',function(){
        
        row2.css({
            "left":0
        });
        
        last2.remove();
        $("#scrolling-boxes-slider .image-row.two").prepend(last2);
        imgScroll2();
    });
}

$(document).ready(function(){
    imgScroll1();
    imgScroll2();
});
