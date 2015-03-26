<?php get_header(); ?>
       
    <div id="content" class="col-full">
		<div id="main" class="col-left">
            
            <?php if (have_posts()) : $count = 0; ?>
            
                <span class="archive_header"><?php _e('Search results', 'woothemes') ?>: <?php printf(the_search_query());?></span>
                
            <?php while (have_posts()) : the_post(); $count++; ?>
                                                                        
                <div class="post">

                    <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                    
                    <p class="post-meta">
					<span class="meta-holder">
                    	<?php _e('Posted on', 'woothemes') ?> <?php the_time(get_option('date_format')); ?>
                    	<?php _e('by', 'woothemes') ?>  <?php the_author_posts_link(); ?>
                    	<?php _e('in', 'woothemes') ?> <?php the_category(', ') ?>
					</span>
                    	<span class="comments"><?php comments_popup_link(__('0 Comments', 'woothemes'), __('1 Comment', 'woothemes'), __('% Comments', 'woothemes')); ?></span>
                    </p>
                    
                    <div class="entry">
	                    <?php the_excerpt(); ?>
	                </div><!-- /.entry -->

                </div><!-- /.post -->
                                                    
               <?php endwhile; else: ?>
					<div class="post">
                		<p><?php _e('Sorry, no posts matched your criteria.', 'woothemes') ?></p>
             	   </div><!-- /.post -->
         	   <?php endif; ?>  
        
                <div class="more_entries">
                    <?php if (function_exists('wp_pagenavi')) wp_pagenavi(); else { ?>
                    <div class="fl"><?php previous_posts_link(__('&laquo; Newer Entries ', 'woothemes')) ?></div>
                    <div class="fr"><?php next_posts_link(__(' Older Entries &raquo;', 'woothemes')) ?></div>
                    <br class="fix" />
                    <?php } ?> 
                </div>		
                
        </div><!-- /#main -->

        <?php get_sidebar(); ?>

    </div><!-- /#content -->
		
<?php get_footer(); ?>
