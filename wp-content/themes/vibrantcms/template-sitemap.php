<?php
/*
Template Name: Sitemap
*/
?>

<?php get_header(); ?>

<div id="steps" class="fullspan">
	
	<div class="container_16">
	
		<div class="grid_16">
			<?php
			if ( function_exists('has_nav_menu') && has_nav_menu('archive-menu') ) {
				wp_nav_menu( array( 'depth' => 1, 'sort_column' => 'menu_order', 'container' => 'ul', 'menu_id' => 'pagenav', 'theme_location' => 'archive-menu' ) );
			} else {
			?>
			<ul id="pagenav">
				<?php
				if ( get_option('woo_custom_nav_menu') == 'true' && function_exists('woo_custom_navigation_output') ) {
        			
						woo_custom_navigation_output('depth=1&name=Woo Menu 2');
						
				} else { ?>		
									
				<li <?php if ( is_home() ) { ?> class="current_page_item" <?php } ?>><a href="<?php echo get_option('home'); ?>/"><?php _e('Home',woothemes); ?></a></li>
				<?php if ( get_option('woo_blog') == 'true' ) { ?><li <?php if ( is_category() ) { ?> class="current_page_item" <?php } ?>><a href="<?php echo get_option('home'); echo get_option('woo_blogcat'); ?>" title="Blog">Blog</a></li><?php } ?>

				<?php 
					
					wp_list_categories('depth=1&hierarchical=0&title_li=');				
								
				 } ?>
            </ul>
			<?php } ?>
		</div>
		
	</div><!-- /container_16 -->

</div><!-- /steps -->

<div id="content" class="fullspan">

	<div class="container_16 clearfix">
			
		<div id="leftcontent" class="grid_10">

		<div class="post">
	        
	        <h2 class="title"><?php the_title(); ?></h2>
	        	
	        	<div class="entry">
	            
	            	<h3><?php _e('Pages', 'woothemes') ?></h3>
	
	            	<ul>
	           	    	<?php wp_list_pages('depth=1&sort_column=menu_order&title_li=' ); ?>		
	            	</ul>				
	    
		            <h3><?php _e('Categories', 'woothemes') ?></h3>
	
		            <ul>
	    	            <?php wp_list_categories('title_li=&hierarchical=0&show_count=1') ?>	
	        	    </ul>
			        
			        <h3>Posts per category</h3>
			        
			        <?php
			    
			            $cats = get_categories();
			            foreach ($cats as $cat) {
			    
			            query_posts('cat='.$cat->cat_ID);
			
			        ?>
	        
	        			<h4><?php echo $cat->cat_name; ?></h4>
						
			        	<ul>	
	    	        	    <?php while (have_posts()) : the_post(); ?>
	        	    	    <li style="font-weight:normal !important;"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a> - <?php _e('Comments', 'woothemes') ?> (<?php echo $post->comment_count ?>)</li>
	            		    <?php endwhile;  ?>
			        	</ul>
	    
	    		    <?php } ?>
	    		
	    		</div><!-- /.entry -->
	    						
	        </div><!-- /.post -->							

		</div><!-- /leftcontent -->
        
        <?php get_sidebar(); ?>        
        
	</div><!-- /container_16 -->

</div><!-- /content -->

<?php get_footer(); ?>