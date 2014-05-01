<? 
	$video_url = get_post_meta(get_the_ID(),"video_url",true);
	if ($video_url!=="")
	{?>
		<?
		if (strpos($video_url,"youtube")!==false)
		{
			if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $video_url, $match))
    		{
    			$video_id = $match[1];
			}
			?>
			<div class="video-container" data-video-type='youtube' data-video-id='<?=$video_id?>'>
			<img src="https://img.youtube.com/vi/<?=$video_id?>/0.jpg">
			<img class='youtube-button' src="<?=get_template_directory_uri()?>/img/youtube-play-button.png">
			</div>
		<?}
		else if (strpos($video_url,"vimeo")!==false)
		{
			$video_id = substr(parse_url($video_url, PHP_URL_PATH), 1);
			$video_json = file_get_contents('http://vimeo.com/api/v2/video/'.$video_id.'.json');
			$video_json = json_decode($video_json);

			?>
			<div class="video-container" data-video-type='vimeo' data-video-id='<?=$video_id?>'>
			<? $new_video_string = substr_replace($video_json[0]->thumbnail_large, 's', 4, 0); ?>
			<img  src="<?=$new_video_string?>">
			<img class='vimeo-button' src="<?=get_template_directory_uri();?>/img/vimeo-play-button.png">
			</div>
		<?}?>

	<?}
?>
