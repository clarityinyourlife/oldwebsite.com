<?php if ( get_option('woo_extended_footer') == 'true'): ?>
<div id="bottom" class="fullspan">
	
	<div class="container_16 clearfix">
		
		<?php if ( get_option('woo_about') != 'Select a page:' ): ?>
		<div class="grid_10">

        	<?php query_posts('page_id=' . get_page_id ( get_option('woo_about') ) ); ?>
	
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<h2><?php the_title(); ?></h2>
				
				<?php the_content(); ?>				
			
			<?php endwhile; endif; ?>
		
		</div>
		<?php endif; ?>
		
		<?php if ( get_option('woo_contact') != 'Select a page:' ): ?>
		<div class="grid_6">
			<div id="newsletter">

        	<?php query_posts('page_id=' . get_page_id ( get_option('woo_contact') ) ); ?>
	
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<h3><?php the_title(); ?></h3>
				
				<?php the_content(); ?>				
			
			<?php endwhile; endif; ?>
			</div><!-- /newsletter -->
		</div>
		<?php endif; ?>
		
	</div><!-- /container_16 -->

</div><!-- /bottom -->
<?php endif; ?>

<div id="footer" class="fullspan">

	<div class="container_16">
		<div class="grid_16">
			<p><span class="floatleft"><?php _e('Copyright',woothemes); ?> &copy; <?php bloginfo(); ?></span><span class="floatright"> <a href="http://www.woothemes.com">VibrantCMS Theme</a> <?php _e('by',woothemes); ?> <a href="http://www.woothemes.com" title="WooThemes - Premium WordPress Themes"><img src="<?php bloginfo('template_directory'); ?>/images/woothemes.png" alt="WooThemes - Premium WordPress Themes" /></a></span></p>
		</div>
	</div><!-- /container_16 -->

</div><!-- /footer -->

</div><!-- /wrap -->

<?php wp_footer(); ?>



</body>
</html>