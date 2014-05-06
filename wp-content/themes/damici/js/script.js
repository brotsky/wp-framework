$ = jQuery;

$(document).ready(damiciInit);
$(window).load(damiciInit).resize(damiciInit);

function damiciInit() {
    if($(window).height() < $(".wrapper").height() + $("footer").height() + 10)
        $(".wrapper").css("margin-bottom",0);
    else
        $(".wrapper").css("margin-bottom",-$("footer").height() - 10);
}