<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class='row' style="margin-bottom:35px;">
<?
	$category = get_post_format();
	if($category == 'video') {
		get_template_part('format-video');
			$share_url = get_post_meta(get_the_ID(),"video_url",true);

	}
?>
<div class='col-md-12'  style="background-color:#eff5f7;box-shadow: 1px 1px 1px 0px #999;padding-top:1px;padding-bottom:5px;" >
    <h3><?php the_title(); ?></h3>
    <h5><?=the_author_posts_link();?> | <?=the_time('F jS, Y');?></h5>
    <hr style="display: block; height: 1px;
    border: 0; border-top: 1px solid #e5ecef;
    margin: 1em 0; padding: 0;"></hr>
   <ul class='list-inline' <? if (isset($share_url)) echo 'data-share-url="'.$share_url.'"';?> >
        <li>
            <a class='share-item' data-type='facebook' href="#">
            <i class="fa fa-facebook"></i>
            </a>
        </li>
        <li>
            <a class='share-item' data-type='twitter' href="#">
            <i class="fa fa-twitter"></i>
            </a>
        </li>
        <li>
            <a class='share-item' data-type='googleplus' href="#">
            <i class="fa fa-google-plus"></i>
            </a>
        </li>
        <li>
            <a class='share-item' data-type='email' href="#">
            <i class="fa fa-envelope-o"></i>
            </a>
        </li>
    </ul>
    <div id='post-content'>
    <?php the_content(); ?>
    </div>
</div>
</div>
</article>