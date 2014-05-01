
<? 
	//function parse get_next or previous_posts_link for url only 
	function get_next_prev_posts_link_url($next_prev_string)
	{
		$pos = strpos($next_prev_string, '"');
		$next_prev_string = substr($next_prev_string, $pos+1 );
		$pos = strpos($next_prev_string, '"');
		$next_prev_string = substr($next_prev_string, 0, $pos-1);
		return $next_prev_string;
	}

	function paginate_widget(){
		$page_string =  '<ul class="list-inline" >';
		if (get_previous_posts_link())
		{
			$page_string.=
			'<li>'.
				'<a href="'.get_next_prev_posts_link_url(get_previous_posts_link()).'"><h2><i class="fa fa-chevron-left"></i> Prev</h2></a>'.
			'</li>';
		}
		if (get_next_posts_link())
		{
			$page_string.=
			'<li>'.
				'<a href="'.get_next_prev_posts_link_url(get_next_posts_link()).'"><h2>Next <i class="fa fa-chevron-right"></i></h2></a>'.
			'</li>';
		}
		$page_string.='</ul>';
		return $page_string;
	}
	get_header(); 
?>
<div class="container">
<div class="row">
<div class='col-md-9 col-sm-9 col-xs-12' style="margin-top:20px;margin-bottom:10px;text-align:center;background-color:#eff5f7;display:block;" >
<?=paginate_widget();?>
</div>
<div class='col-md-9 col-sm-9 col-xs-12'>
<? 
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();
			get_template_part('content');
        }
	}
?>
</div>
<div class="col-md-3 col-sm-3 hidden-xs">
	<?php if ( dynamic_sidebar('home_right_1') ) : else : endif; ?>
</div>
</div>
<div class="row">
<div class='col-md-9 col-sm-9 col-xs-12' style="margin-top:-10px;margin-bottom:20px;text-align:center;background-color:#eff5f7;display:block;" >
<?=paginate_widget();?>
</div>
</div>
</div>
<?
	news_scripts(); 
	get_footer(); 
?>