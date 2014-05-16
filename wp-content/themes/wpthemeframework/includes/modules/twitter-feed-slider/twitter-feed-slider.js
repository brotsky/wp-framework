$ = jQuery;
$(document).ready(function(){
window.setInterval(next_slide,8000);
});
function next_slide(){
	var current_slide = $('#twitter-feed-slider .current_slide');
	console.log("current_slide " + current_slide);
	current_slide.animate({"left":$(window).width()},"slow");
	// var current_slide_number = parseInt(current_slide.data('slide-id'));
	// console.log('current_slide_number '+current_slide_number);
	// var slide_count = parseInt($('#twitter-feed-slider').data('slide-count'));
	// console.log('slide_count '+slide_count);
	// var new_slide_id ;
	// if ((current_slide_number + 1) === slide_count )
	// {
	// 	new_slide_id = 0;
	// }
	// else
	// {
	// 	new_slide_id = current_slide_number + 1;
	// }
	// console.log('new_slide_id ' + new_slide_id);
	// var new_slide = $('#twitter-feed-slider [data-slide-id='+new_slide_id+']');
	// console.log('new_slide_id '+new_slide);
	// current_slide.animate({
	// 	left:'-150%'},1000,function(){
	// 		current_slide.removeClass("current_slide").addClass('off_screen');
	// 	});
	// new_slide.animate({
	// 	left:'50%'},1000, function(){
	// 		new_slide.removeClass("off_screen").addClass("current_slide");
	// 	});
	

	// current_slide.fadeOut("slow",function()
	// {
	// 	current_slide.removeClass("current_slide");
	// 	current_slide.hide();
	// 	new_slide.fadeIn("slow",function()
	// 	{
	// 		new_slide.addClass("current_slide");
	// 		new_slide.removeClass("off_screen");
	// 	});
	// });
	// new_slide.removeClass('off_screen').addClass('current_slide');
	

}
