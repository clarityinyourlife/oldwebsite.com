<?php include(TEMPLATEPATH . '/includes/featured-slider.php'); ?>

<div id="content" class="fullspan">

	<div class="container_16 clearfix">
		<div class="grid_5">
			
            <?php if (function_exists('woo_sidebar') && woo_sidebar('home-1') ) : else : ?>		
            
            <?php endif; ?>   
			
		</div>
		
		<div class="grid_5">
			
            <?php if (function_exists('woo_sidebar') && woo_sidebar('home-2') ) : else : ?>		  
            
            <?php endif; ?>   
			
		</div>
			
		<div class="grid_6">
      
            <?php if (function_exists('woo_sidebar') && woo_sidebar('home-3') ) : else : ?>		  
            
            <?php endif; ?>
      
      </div>
	</div><!-- /container_16 -->

</div><!-- /content -->
