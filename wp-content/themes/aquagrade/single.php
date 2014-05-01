<!-- Single Post -->
<?
	get_header(); 
?>
<div class="container">
<div class="row">
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
</div>
<?
    news_scripts();
    get_footer();
?>