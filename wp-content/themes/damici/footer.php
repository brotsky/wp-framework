
	<footer>
	    <?php if(!is_page_template('splash-template.php')) { ?>
	    <img class="diagonal-red" src="<?php echo get_stylesheet_directory_uri() ?>/images/diagonal-red.png" alt="" />
	    <?php } ?>
	    <div class="container">
	        <?php if(!is_page_template('splash-template.php')) { ?>
	        <div class="row">
	            <div class="col-md-6 col-md-offset-3 text-center">
	                <img id="footer-pig" src="<?php echo get_stylesheet_directory_uri() ?>/images/pig.png" alt="Pig" />
	            </div>
	        </div>
            <?php } ?>
	        <div class="row">
	            <div class="col-md-6 text-left">
    	            <p>Copyright &#169; d'Amici. <?php echo date("Y"); ?></p>
    	            <p>Website Developed by <a href="http://www.brotskydesigns.com/" target="_blank">Brotsky Designs</a></p>
	            </div>
	            <div class="col-md-6 text-right">
	                <?php get_social_links(); ?>
	            </div>
	        </div>
	    </div>
	</footer>
	<?php wp_footer(); ?>
    </body>
</html>