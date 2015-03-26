				
			            
			</div><!-- End container -->
			
			<?php if( is_page() || is_404() || is_single() ) : ?>
				<br /><br /><br />
				<?php include_once( TEMPLATEPATH . '/includes/news.php' ); ?>
			<?php endif; ?>
			
			<div id="footer" class="container clearfix" style="margin-bottom:50px;">
			
				<ul id="footer-info">
				
				<?php woo_sidebar('footer'); ?>
									
				</ul>
				
				<div id="copyright">
				
					<a href="http://www.woothemes.com" title="WooThemes"><?php _e('Cushy Theme by',woothemes); ?> <img src="<?php bloginfo('template_directory'); ?>/images/woothemes-logo.png" alt="Woo Logo" /></a>
					
				</div>
				
			</div><!-- End container -->
			
		</div><!-- End content-left -->
		
	</div><!-- End content-repeat -->
			
	<?php wp_footer(); ?>
	
	
</body>
</html>