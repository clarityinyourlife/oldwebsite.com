<?php get_header(); ?>

	<div id="left-col">

		<?php 
			if (have_posts()) : 
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; 
				query_posts( 'cat=-' . get_cat_id( $woo_features_cat ) . '&paged='.$paged );  
			?>
    
            <?php while (have_posts()) : the_post(); ?>
    			
				<ul class="cat-tabs clearfix">
					<?php 
						foreach( get_the_category() as $cat ) {
							echo '<li class="active"><a href="'. get_category_link( $cat->term_id ) . '">' . $cat->cat_name .'</a></li>';
						} 
					?>
					<li><small><?php the_time('F jS, Y') ?></small></li>
				</ul>
				
				<div class="post-top"></div><!-- End post-top -->
				
                <div class="post" id="post-<?php the_ID(); ?>">
                    <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to',woothemes); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
    
					<?php the_content( '' ); ?>
					
					<a href="<?php the_permalink(); ?>#more-<?php the_ID(); ?>" class="read-more" title="<?php _e('Read more of',woothemes); ?> &quot;<?php the_title(); ?>&quot;">Read More</a>
					
                </div>
    
            <?php endwhile; ?>
    
            <div class="navigation clearfix">
                <div class="left"><?php next_posts_link(__('&laquo; Older Entries',woothemes)) ?></div>
                <div class="right"><?php previous_posts_link(__('Newer Entries &raquo;',woothemes)) ?></div>
            </div>
    
        <?php else : ?>
    
            <h2 class="center"><?php _e('Not Found',woothemes); ?></h2>
            <p class="center"><?php _e("Sorry, but you are looking for something that isn't here.",woothemes); ?></p>
            <?php include (TEMPLATEPATH . "/searchform.php"); ?>
    
        <?php endif; ?>

	</div><!-- End leftcol -->
    
    <div id="right-col">
    
    	<?php get_sidebar(); ?>
    
    </div><!-- End rightcol -->

<?php get_footer(); ?>
