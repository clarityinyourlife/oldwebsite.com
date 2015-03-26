<?php get_header(); ?>

    <div id="content" class="col-full">
		<div id="main" class="col-left">
            
			<!-- Latest Starts -->
						
					<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; query_posts("post_type=post&paged=$paged"); ?>
					<?php if (have_posts()) : $count = 0; ?>
					<?php while (have_posts()) : the_post(); $postcount++;?>
	
                        <!-- Featured Starts -->
                        <?php if ( $postcount <= get_option('woo_featured_posts') && !$is_paged ) { ?>
                        
                        <div class="post featured">

                                <h2 class="featured-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                                
                                 <p class="post-meta">
								 <span class="meta-holder">- 
                    			<?php the_time(get_option('date_format')); ?>
                    			<?php _e('in', 'woothemes') ?> <?php the_category(', ') ?>
                    			-</span>
                   				 </p>
                    
                                <div class="comment-cloud">
                                    <a href="<?php comments_link(); ?>"><?php comments_number('0','1','%'); ?></a>
                                </div>
                                
                                 <?php echo woo_get_embed('embed','620','376'); ?>
                                 <?php woo_get_image('image',get_option('woo_image_width'),get_option('woo_image_height')); ?> 
                                
                            <div class="entry">
                    			<?php if ( get_option('woo_featured_content') == "true" ) { ?>
								<?php the_content(__('...', 'woothemes')); ?>
	                            <?php } else { ?>
								<?php the_excerpt(); ?>
								<?php } ?>
                   			 </div>
                            
                            <div class="continue"><a href="<?php the_permalink() ?>"><?php _e('Continue Reading',woothemes); ?></a></div>
                            
                            <div class="fix"></div>
                        
                        </div>
                        
						<?php continue; } ?>
						
                <!-- Featured Ends -->
                                                                        
                <div class="post">

                    <h2 class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                    
                    <p class="post-meta">
					<span class="meta-holder">
                    	<?php the_time(get_option('date_format')); ?>
                    	<?php _e('in', 'woothemes') ?> <?php the_category(', ') ?>
						</span>
                    	<span class="comments"> <a href="<?php comments_link(); ?>"><?php comments_number('0','1','%'); ?></a></span>
                    </p>
                    
                    <div class="entry">
                    	<?php echo woo_get_embed('embed','620','376'); ?>
                    	<?php woo_get_image('image',260,190,'thumbnail_bg'); ?>
                    	<?php if ( get_option('woo_home_content') == "true" ) { ?>
						<?php the_content(__('...', 'woothemes')); ?>
                        <?php } else { ?>
						<?php the_excerpt(); ?>
						<?php } ?>
                    </div>
                    
                    <div class="continue"><a href="<?php the_permalink() ?>"><?php _e('Continue Reading',woothemes); ?></a></div>
					
					<div class="fix"></div>
					
                </div><!-- /.post -->
                                                    
			<?php endwhile; else: ?>
				<div class="post">
                	<p><?php _e('Sorry, no posts matched your criteria.', 'woothemes') ?></p>
                </div><!-- /.post -->
            <?php endif; ?>  
        
                <div class="more_entries">
                    <?php if (function_exists('wp_pagenavi')) wp_pagenavi(); else { ?>
                    <div class="prev fl"><?php previous_posts_link(__('&laquo; Newer Entries ', 'woothemes')) ?></div>
                    <div class="next fr"><?php next_posts_link(__(' Older Entries &raquo;', 'woothemes')) ?></div>
                    <br class="fix" />
                    <?php } ?> 
                </div>		
                
		</div><!-- /#main -->

        <?php get_sidebar(); ?>

    </div><!-- /#content -->
		
<?php get_footer(); ?>