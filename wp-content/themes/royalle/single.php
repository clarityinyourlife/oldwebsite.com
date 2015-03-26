<?php get_header(); ?>
       
    <div id="content" class="col-full">
		<div id="main" class="col-left">
            
            <?php if (have_posts()) : $count = 0; ?>
            <?php while (have_posts()) : the_post(); $count++; ?>
            
                <div class="post featured">

                    <h2 class="featured-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                                
                     <p class="post-meta">
					 <span class="meta-holder">- 
        			<?php the_time(get_option('date_format')); ?>
        			<?php _e('in', 'woothemes') ?> <?php the_category(', ') ?>
        			-
					</span>
       				 </p>
        
                    <div class="comment-cloud">
                        <a href="<?php comments_link(); ?>"><?php comments_number('0','1','%'); ?></a>
                    </div>
                    
                    <?php woo_get_image('image',get_option('woo_image_width'),get_option('woo_image_height')); ?> 
                    
                    <div class="entry">
                    	<?php echo woo_get_embed('embed','620','376'); ?>
                    	<?php the_content(); ?>
					</div>
										
					<?php the_tags('<p class="tags">Tags: ', ', ', '</p>'); ?>
					
					<div class="pagenav single">
						<div class="prev fl"><?php previous_post_link('%link', __('Prev',woothemes)); ?></div>
						<div class="next fr"><?php next_post_link('%link', __('Next',woothemes)); ?> </div>
			            <div class="fix"></div>
			      	</div>

                </div><!-- /.post -->
                
				<?php comments_template(); ?>
                                                    
			<?php endwhile; else: ?>
				<div class="post">
                	<p><?php _e('Sorry, no posts matched your criteria.', 'woothemes') ?></p>
  				</div><!-- /.post -->             
           	<?php endif; ?>  
        
		</div><!-- /#main -->

        <?php get_sidebar(); ?>

    </div><!-- /#content -->
		
<?php get_footer(); ?>