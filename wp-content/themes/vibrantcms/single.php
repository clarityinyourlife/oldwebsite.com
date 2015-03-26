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

		<?php if (have_posts()) : ?>
	
			<?php while (have_posts()) : the_post(); ?>										
					
			<div class="post">
		
				<span class="categories"><?php the_category(","); ?></span>
				
				<h2 class="title"><a title="<?php _e('Permanent Link to',woothemes); ?> <?php the_title(); ?>" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a><span class="date"><?php the_time('d M'); ?></span></h2>				
				
				<div class="entry">
				
					<?php the_content(); ?>						

				</div><!-- /entry -->

            <div id="comments">
            	<?php comments_template(); ?>
            </div>				
					
			</div><!-- /post -->
                  
			<?php endwhile; ?>
			
		<?php endif; ?>							

		</div><!-- /leftcontent -->
        
        <?php get_sidebar(); ?>        
        
	</div><!-- /container_16 -->

</div><!-- /content -->

<?php get_footer(); ?>