<?php get_header(); ?>

		<div class="posted clearfix">
		
			<h2><?php _e('Error: 404 Page Not Found',woothemes); ?></h2>
			<p><?php _e('This page does not exist! Try another link please.',woothemes); ?></p>

			<?php include( TEMPLATEPATH . '/searchform.php' ); ?>
			
			<br /><br />

		</div><!-- End posted -->
		

	</div>
	
<?php get_footer(); ?>