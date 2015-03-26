			<div id="news">
			
				<div class="container clearfix">
				
					<div id="recent-news">
						
						<div class="posted">
							<?php 
								// Begin News Loop
								$get_news = new WP_Query( '&showposts=1&cat='.get_cat_id( get_option( 'woo_blog_cat' ) ) );
	 							while ($get_news->have_posts()) : $get_news->the_post();
							?>
								<h3><a href="<?php the_permalink(); ?>" title="<?php _e('Permalink to',woothemes); ?> &quot;<?php the_title(); ?>&quot;"><?php the_title(); ?></a></h3>
								<?php the_excerpt(); ?>
								
								<a href="<?php the_permalink(); ?>" class="read-more" title="<?php _e('Read more of',woothemes); ?> &quot;<?php the_title(); ?>&quot;"><?php _e('Read More',woothemes); ?></a>
								
	 						<?php 
								// End News Loop
								endwhile; 
							?>
														
						</div><!-- End post -->
						
					</div><!-- End recent-news -->
					
					<div id="from-the-blog">
					
						<a href="<?php echo bloginfo('url') . get_option( 'woo_blog_permalink' ); ?>" class="view-blog"><?php _e('View the Blog',woothemes); ?> &raquo;</a>			
												
						<?php 
							// Begin Blog Loop
							$get_news = new WP_Query( 'showposts=2&cat='.get_cat_id( get_option( 'woo_blog_cat' ) ).'&offset=1' );
	 						while ($get_news->have_posts()) : $get_news->the_post();
						?>
							<div class="posted">
						
								<h3><a href="<?php the_permalink(); ?>" title="<?php _e('Permalink to',woothemes); ?> &quot;<?php the_title(); ?>&quot;"><?php the_title(); ?></a></h3>
								
								<p><?php the_content_rss('Read More', FALSE, '', 20); ?></p>
								
							</div><!-- End post -->
								
	 					<?php 
							// End Blog Loop
							endwhile; 
						?>
													
					</div><!-- End from-the-blog -->
					
				</div><!-- End container -->
				
			</div><!-- End news -->