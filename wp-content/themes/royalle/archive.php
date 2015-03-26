<?php get_header(); ?>
       
    <div id="content" class="col-full">
		<div id="main" class="col-left">
            
            <?php if (have_posts()) : $count = 0; ?>
            
				<?php if (is_category()) { ?>
                <span class="archive_header"><span class="fl cat"><?php _e('Archive', 'woothemes'); ?> | <?php echo single_cat_title(); ?></span> <span class="fr catrss"><?php $cat_obj = $wp_query->get_queried_object(); $cat_id = $cat_obj->cat_ID; echo '<a href="'; get_category_rss_link(true, $cat, ''); echo '">RSS feed for this section</a>'; ?></span></span>        
            
                <?php } elseif (is_day()) { ?>
                <span class="archive_header"><?php _e('Archive', 'woothemes'); ?> | <?php the_time(get_option('date_format')); ?></span>
    
                <?php } elseif (is_month()) { ?>
                <span class="archive_header"><?php _e('Archive', 'woothemes'); ?> | <?php the_time('F, Y'); ?></span>
    
                <?php } elseif (is_year()) { ?>
                <span class="archive_header"><?php _e('Archive', 'woothemes'); ?> | <?php the_time('Y'); ?></span>
    
                <?php } elseif (is_author()) { ?>
                <span class="archive_header"><?php _e('Archive by Author', 'woothemes'); ?></span>
    
                <?php } elseif (is_tag()) { ?>
                <span class="archive_header"><?php _e('Tag Archives:', 'woothemes'); ?> <?php echo single_tag_title('', true); ?></span>
                
                <?php } ?>
				
				<div class="fix"></div>
            
            <?php while (have_posts()) : the_post(); $count++; ?>
                                                                        
                <!-- Post Starts -->
                <div class="post">

                    <h2 class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                    
                    <p class="post-meta">
						<span class="meta-holder">
                    	<?php _e('Posted on', 'woothemes') ?> <?php the_time(get_option('date_format')); ?>
                    	<?php _e('by', 'woothemes') ?>  <?php the_author_posts_link(); ?>
                    	<?php _e('in', 'woothemes') ?> <?php the_category(', ') ?>
						</span>
                    	<span class="comments"><?php comments_popup_link(__('0', 'woothemes'), __('1', 'woothemes'), __('%', 'woothemes')); ?></span>
                    </p>
                    
                    <div class="entry">
                    	<?php echo woo_get_embed('embed','620','376'); ?>
                    	<?php woo_get_image('image',260,190,'thumbnail_bg'); ?>
	                    <?php if ( get_option('woo_archive_content') == "true" ) { ?>
						<?php the_content(__('...', 'woothemes')); ?>
                        <?php } else { ?>
						<?php the_excerpt(); ?>
						<?php } ?>
	                </div><!-- /.entry -->
	                
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