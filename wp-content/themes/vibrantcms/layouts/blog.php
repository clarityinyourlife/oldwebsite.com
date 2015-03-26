<div id="steps" class="fullspan">
	
	<div class="container_16">
	
		<div class="grid_16">
			<ul><?php wp_list_categories('hierarchical=0&title_li='); ?></ul>
		</div>
		
	</div><!-- /container_16 -->

</div><!-- /steps -->

<div id="content" class="fullspan">

	<div class="container_16 clearfix">
			
		<div id="leftcontent" class="grid_10">

		<?php if (have_posts()) : ?>
	
			<?php while (have_posts()) : the_post(); ?>	
			
			<?php $aside = get_post_meta($post->ID, "aside", $single = true); ?>
				
			<?php if ( $aside == '1' ) { ?>

			<div class="asides">
			
				<div class="asidespost">
					
					<?php the_content(); ?>
					
					<p><strong><?php comments_popup_link(__('Add Your Comment! 0 Comments Already...',woothemes), __('Add Your Comment! 1 Comment Already...',woothemes), __('Add Your Comment! % Comments Already...',woothemes)); ?></strong></p>
						
				</div><!-- /asidespost -->	
			
			</div><!-- /asides -->				
			
			<?php } else { ?>											
					
			<div class="post">
		
				<span class="categories"><?php the_category(","); ?></span>
				
				<h2 class="title"><a title="<?php _e('Permanent Link to',woothemes); ?> <?php the_title(); ?>" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a><span class="date"><?php the_time('d M'); ?></span></h2>				
				
				<div class="entry">
				
					<?php the_content(); ?>						

				</div><!-- /entry -->
					
			</div><!-- /post -->
			
			<?php } ?>		
                  
			<?php endwhile; ?>
			
			<div id="postnav">
				<p class="floatleft prev"><?php next_posts_link(__('Previous Entries',woothemes)) ?></p>
				<p class="floatright next"><?php previous_posts_link(__('Newer Entries',woothemes)) ?></p>
			</div><!-- /postnav -->
			
		<?php endif; ?>							

		</div><!-- /leftcontent -->
        
        <?php get_sidebar(); ?>        
        
	</div><!-- /container_16 -->

</div><!-- /content -->