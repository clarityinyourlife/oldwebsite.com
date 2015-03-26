<?php
/*
Template Name: Archives
*/
?>

<?php get_header(); ?>

		<div class="posted clearfix" id="post-<?php the_ID(); ?>">
			
			<?php if ( get_option( 'woo_breadcrumbs' ) == 'true') { yoast_breadcrumb('<p id="breadcrumbs">','</p>'); } ?>
				
			<div class="archives_left">
			
				<h2><?php _e('Archives by Month:',woothemes); ?></h2>
					<ul>
						<?php wp_get_archives('type=monthly'); ?>
					</ul>
					
			</div><!-- /archives_left -->
			
			<div class="archives_right">
				
				<h2><?php _e('Archives by Subject:',woothemes); ?></h2>
					<ul>
						 <?php wp_list_categories('title_li='); ?>
					</ul>
					
			</div><!-- /archives_right -->

		</div><!-- End posted -->
		

	</div>
	
<?php include_once( TEMPLATEPATH . '/footer.php' ); ?>