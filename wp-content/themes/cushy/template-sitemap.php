<?php
/*
Template Name: Sitemap
*/
?>

<?php get_header(); ?>

		<div class="posted clearfix" id="post-<?php the_ID(); ?>">
			
			<?php if ( get_option( 'woo_breadcrumbs' ) == 'true') { yoast_breadcrumb('<p id="breadcrumbs">','</p>'); } ?>
				
			<div class="archives_left">
			
				<h2><?php _e('Pages', 'woothemes') ?></h2>
	            	<ul>
	           	    	<?php wp_list_pages('depth=0&sort_column=menu_order&title_li=' ); ?>		
	            	</ul>
				
			</div><!-- /archives_left -->
			
			<div class="archives_right">
				
				<h2><?php _e('Categories', 'woothemes') ?></h2>
		            <ul>
	    	            <?php wp_list_categories('title_li=&hierarchical=0&show_count=1') ?>	
	        	    </ul>
					
			</div><!-- /archives_right -->

		</div><!-- End posted -->
		

	</div>
	
<?php include_once( TEMPLATEPATH . '/footer.php' ); ?>
