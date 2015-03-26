	<!-- Footer Starts -->
	<div id="footer-wrap">
	<div id="footer">
	
	<?php if ( ( function_exists('woo_sidebar') && (woo_active_sidebar(3) || woo_active_sidebar(4) || woo_active_sidebar(5)) ) ) : ?>
		
		<!-- Footer Widget Area Starts -->
		<div class="footer-widgets">
		
			<div class="block">
				<?php woo_sidebar(3); ?>       
			</div>
			
			<div class="block">
				<?php woo_sidebar(4); ?>		           
			</div>
			
			<div class="block last">
				<?php woo_sidebar(5); ?>		           
			</div>
		
		</div>
		<!-- Footer Widget Area Ends -->
		
		<div class="fix"></div>
		
	<?php endif; ?>
		
		<div id="credits">
			
			<div id="copyright" class="col-left">
				<p>&copy; <?php echo date('Y'); ?> <?php bloginfo(); ?>. <?php _e('All Rights Reserved.', 'woothemes') ?></p>
			</div>
			
			<div id="credit" class="col-right">
				<p><?php _e('Powered by', 'woothemes') ?> <a href="http://www.wordpress.org">WordPress</a>. <?php _e('Designed by', 'woothemes') ?> <a href="http://www.woothemes.com"><img src="<?php bloginfo('template_directory'); ?>/images/woothemes.png" width="87" height="21" alt="Woo Themes" /></a></p>
			</div>
			
		</div>
		
	</div>
	</div>
	<!-- Footer Ends -->
	
</div><!-- /#container -->
<?php wp_footer(); ?>

</body>
</html>