			<div class="container">
				
				<ul id="features-tabs" class="clearfix">
					
					<?php 
						
						$featpages = get_option('woo_featured_tabs');
						$featarr=split(",",$featpages);
						$featarr = array_diff($featarr, array(""));
						
						$i = 1;
						
						foreach ( $featarr as $featured_tab ) {

					?>
						
							<?php query_posts('page_id=' . $featured_tab); while (have_posts()) : the_post(); ?>
								<li><a href="#tab-<?php echo $i; ?>"><?php the_title(); ?></a></li>
							<?php endwhile; ?>
					
					<?php
						$i++;
						}
					?>
				</ul><!-- End features-tabs -->
			
				<div id="features-top"></div><!-- End features-top -->
				
				<div id="features">
					
					<?php 
						
						$featpages = get_option('woo_featured_tabs');
						$featarr=split(",",$featpages);
						$featarr = array_diff($featarr, array(""));
						
						$i = 1;
						
						foreach ( $featarr as $featured_tab ) {

					?>
						
						<?php query_posts('page_id=' . $featured_tab); while (have_posts()) : the_post(); ?>
					
						<div id="tab-<?php echo $i; ?>" class="clearfix">
					
							<div class="left <?php if(get_post_meta($post->ID, "image", $single = true) != "") { ?>double <?php } ?>">
								<?php if ( get_post_meta($post->ID, "excerpt", $single = true) <> "" ) { echo '<p>' . stripslashes( get_post_meta($post->ID, "excerpt", $single = true) ) . '</p>'; } else { the_content(); } ?>
							</div>
							
							<?php
								// Is the image field empty? Show nothing if not.
								if(get_post_meta($post->ID, "image", $single = true) != "") :
							?>
							
							<span class="right feature-image">
							
								<?php woo_image('link=img&height=160&width=270'); ?>
								
								<span class="caption"><?php echo nl2br( get_post_meta( $post->ID, "image_caption", $single = true ) ); ?></span>
							
							</span>
							
							<?php
								endif;
							?>
							
						</div>
						
						<?php endwhile; ?>
						
					<?php
						// End Features Loop
						$i++;
						}
					?>
				
				</div><!-- End features -->
