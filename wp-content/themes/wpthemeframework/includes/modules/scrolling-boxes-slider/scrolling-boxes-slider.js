$ = jQuery;
var img1,first1,row1;
var img2,first2,row2;

function imgScroll1(){
    row1 = $("#scrolling-boxes-slider .image-row.one");
    first1 = $("#scrolling-boxes-slider .image-row.one .image").first();
    row1.css("left",290);
    row1.animate({left:"-=310"},24000,'linear',function(){
        
        row1.css("left",290);
        
        first1.remove();
        $("#scrolling-boxes-slider .image-row.one").append(first1);
        imgScroll1();
    });
}

function imgScroll2(){
    row2 = $("#scrolling-boxes-slider .image-row.two");
    first2 = $("#scrolling-boxes-slider .image-row.two .image").first();    
    row2.css("left",145);
    row2.animate({left:"-=310"},24000,'linear',function(){
        
        row2.css("left",145);
        
        first2.remove();
        $("#scrolling-boxes-slider .image-row.two").append(first2);
        imgScroll2();
    });
}

$(document).ready(function(){
    imgScroll1();
    imgScroll2();
});
