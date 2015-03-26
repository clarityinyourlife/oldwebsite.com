<?php get_header(); ?>

		<div class="posted clearfix" id="post-<?php the_ID(); ?>">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
			<?php if ( get_option( 'woo_breadcrumbs' ) == 'true' ) { yoast_breadcrumb('<p id="breadcrumbs">','</p>'); } ?>
			
			<h2><?php the_title(); ?></h2>
			
			<div class="post-single">
				
				<?php the_content(); ?>
				
			</div>

		</div><!-- End posted -->

	<?php endwhile; else: ?>

		<p><?php _e('Sorry, no posts matched your criteria.',woothemes); ?></p>

<?php endif; ?>

	</div>
	
<?php include_once( TEMPLATEPATH . '/footer.php' ); ?>