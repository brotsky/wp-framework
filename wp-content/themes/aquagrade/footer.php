	    <?php if(!is_home()) { ?>
	    </div>
	    <?php } ?>
	<footer>
	    <div class="container">
	        <div class="row">
	            <div class="col-md-6">
    	            <p>Copyright &#169; AquaGrade, Inc. <?php echo date("Y"); ?></p>
    	            <p>Website Developed by <a href="http://www.brotskydesigns.com/" target="_blank">Brotsky Designs</a></p>
	            </div>
	            <div class="col-md-6 text-right">
	                <?php wp_nav_menu( array( 'theme_location' => 'footer-menu', 'container_class' => '' ) ); ?>
	            </div>
	        </div>
	    </div>
	</footer>
	<?php wp_footer(); ?>
    </body>
</html>