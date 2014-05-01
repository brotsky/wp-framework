$ = jQuery;

var themeDirURI = location.protocol + "//" + location.host + "/wp-content/themes/aquagrade/";

$(".video-container").on('click',function(){
	if ($(this).data('video-type')==='youtube')
	{
		var youtube_embed = '<iframe src="https://www.youtube.com/embed/'+$(this).data('video-id')+'?autoplay=1" frameborder=0 allowfullscreen></iframe>';
		$(this).html(youtube_embed);
		console.log(youtube_embed);
	}
	else if ($(this).data('video-type')==='vimeo')
	{
		var vimeo_embed = '<iframe src="https://player.vimeo.com/video/'+$(this).data('video-id')+'?autoplay=1" frameborder="0"></iframe>';
 		$(this).html(vimeo_embed);
 		console.log(vimeo_embed);
	}
		$(this).css('cursor','default');
		$(this).css('cursor','default');
		$(this).css('background-color','000000');
		$(this).off( "click" );
});


$(".share-item").on('click',function(ev){
	ev.preventDefault();
	var height, width, url, video_url, params;
	height = width = 0;
	url = params = video_url = '';
	if ($(this).closest('ul').data('share-url'))
	{
		video_url = $(this).closest('ul').data('share-url');
	}
	var parent = $(this).closest('.col-md-12');
	if (parent.find('.more-link'))
	{
		url = parent.find('.more-link').attr('href');
	}
	else
	{
		url = location.protocol + "//" + location.host + window.location.pathname;
	}
	if (parent.children('h3').text()!=='')
	{
		var title = parent.children('h3').text();
	}
	if (parent.children('h5').text()!=='')
	{
		var author_date = parent.children('h5').text();
	}
	if (parent.children('#post-content').text()!=='')
	{
		var post_content = parent.children('#post-content').text();
		if (post_content.toLowerCase().indexOf("(more…)") >= 0)
		{
			post_content = post_content.replace( '(more…)' , '' ); 
		}
	}
	switch($(this).data('type'))
	{
		case 'facebook':
			params += '?p[title]='+ title + 
			'&p[url]=' + url  + 
			'&p[summary]=' + author_date + ' ' + post_content;
			url = "https://www.facebook.com/sharer/sharer.php" + params;
			width = 900;
			height = 500;	
			break;
		case 'twitter':
			params += '?url=' + encodeURIComponent(url) +
			'&text=' + encodeURIComponent(title) + ' - ' +
			encodeURIComponent(author_date) ;
			url = 'https://twitter.com/intent/tweet' + params;
			width = 650;
			height = 360;
			break;
		case 'googleplus':
			params +='?url=' + url + '&hl=en-US';
			url = 'https://plus.google.com/share' + params;
			width = 900;
			height = 500;	
			break;
		case 'email':
			url = 'mailto:?subject=Aquagrade - ' + title +
			' | ' + encodeURIComponent(author_date) + '&body=' +
			encodeURIComponent(url) + " " + encodeURIComponent(post_content);
			window.location.href = url;
			console.log("hello");
	}
	if ($(this).data('type')!=='email')
	{
		window.open(url, "", "toolbar=0, status=0, width=" + width + ", height=" + height);
	}
});
