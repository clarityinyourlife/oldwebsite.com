<?php

	$featpages = get_option('woo_featpages');
	$featarr=split(",",$featpages);
	$featarr = array_diff($featarr, array(""));
	$testlast = count($featarr);
	
	$steps = array("Select Format:","1., 2., 3.","01., 02., 03.","1 >, 2 >, 3 >","01 >, 02 >, 03 >","Step 01 >,Step 02 >,Step 03 >",);
	
	$stepsformat = get_option('woo_steps');
	$show = true;	
	
	if ( $stepsformat == "Select Format:" ) {
		$show = false;
	
	} elseif ( $stepsformat == "1., 2., 3.") {
		$show = true;
		$before = '';
		$after = '. ';
	} elseif ( $stepsformat == "01., 02., 03.") {
		$show = true;
		$before = '0';
		$after = '. ';
	} elseif ( $stepsformat == "1 >, 2 >, 3 >") {
		$show = true;
		$before = '';
		$after = ' > ';
	} elseif ( $stepsformat == "01 >, 02 >, 03 >") {
		$show = true;
		$before = '0';
		$after = ' > ';
	} elseif ( $stepsformat == "Step 01 >,Step 02 >,Step 03 >") {
		$show = true;
		$before = 'Step 0';
		$after = ' > ';
	}

?>

<div id="featured" class="fullspan">
	
	<div class="container_16 clearfix">

			<div class="crop">
        
        				<div class="widearea">
        					
        					<?php $counter = 0; ?>
        					
        					<?php foreach ( $featarr as $featitem ) { ?>
        					
        					<?php query_posts('page_id=' . $featitem); ?>
	
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>		        					
        				
                		<div class="pageitem" id="div<?php echo $featitem; ?>">

							<div class="grid_10 alpha" style="padding-left:10px;">
		 
								<h2><?php the_title(); ?></h2>

								<?php the_content(); ?>
			
								<p class="buttons floatright">
									
									<?php $counter++; ?>
									
									<?php if ( $counter <> 1 ) { ?><a class="prev floatleft" id="prev<?php $btn = $counter - 1; echo $btn; ?>" href="#" title="<?php _e('Click for previous',woothemes); ?>"><?php _e('Prev',woothemes); ?></a><?php } ?>
									<?php if ( $counter <> $testlast ) { ?><a class="next floatright" id="next<?php $btn = $counter + 1; echo $btn; ?>"  href="#" title="<?php _e('Click for next',woothemes); ?>"><?php _e('Next',woothemes); ?></a><?php } ?>
								
								</p>
			
							</div><!-- /grid_10 -->
							
							<?php $left = get_post_meta($post->ID, "left", $image = true); ?>
							<?php $top = get_post_meta($post->ID, "top", $image = true); ?>
		
							<div class="grid_6 omega">
								<div class="featimg" style="<?php if ( get_post_meta($post->ID, "left", $image = true) ) { ?>margin-left:<?php echo $left; ?>px;<?php } ?><?php if ( get_post_meta($post->ID, "top", $image = true) ) { ?>margin-top:<?php echo $top; ?>px;<?php } ?>">
				
								<?php if ( get_post_meta($post->ID,'image', true) ) { ?> <!-- DISPLAYS THE IMAGE URL SPECIFIED IN THE CUSTOM FIELD -->
        
                    			<img src="<?php echo get_post_meta($post->ID, "image", $image = true); ?>" alt="<?php the_title(); ?>" style="top: <?php echo get_post_meta($post->ID, "top", $image = true); ?>px !important; left: <?php echo get_post_meta($post->ID, "left", $image = true); ?>px !important;" />
        
                			<?php } ?>
            
								</div><!-- /featimg -->
							</div><!-- /grid_6 -->                                                                    
               		 
               		 </div><!-- /pageitem -->
               		 
               		 <?php endwhile; endif; ?>
               		 
               		 <?php } ?>
        				
        				</div><!-- /widearea -->
		
			</div><!-- /crop -->

	</div><!-- /container_16 -->

</div><!-- /featured -->

<div id="steps" class="fullspan">
	
	<div class="container_16">
	
		<div class="grid_16">
			<ul>
				<?php $counter = 0; ?>
				
				<?php foreach ( $featarr as $featitem ) { ?>
					
					  <?php query_posts('page_id=' . $featitem); ?>
	
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
							
							<li>
							<a href="#" id="button<?php $counter++; echo $counter; ?>">
								
								<?php if ($show) { echo '<strong>' . $before . $counter . $after . '</strong>'; } ?><?php the_title(); ?>
							
							</a>
							</li>	
						
						<?php endwhile; endif; ?>
					
				<?php } ?>
			</ul>
		</div>
		
	</div><!-- /container_16 -->

</div><!-- /steps -->