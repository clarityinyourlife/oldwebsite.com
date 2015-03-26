<div class="grid_6 omega">
    <div id="sidebar">

        <?php include('ads/ads-328x280.php'); ?>
        
        <?php if ( get_option('woo_tabber') == "true" ) { ?>
        
        <div id="tabbox">
    
            <ul class="idTabs">
                <li><a href="#pop"><?php _e('Popular',woothemes); ?></a></li>
                <li><a href="#comm"><?php _e('Comments',woothemes); ?></a></li>
            </ul><!--/idTabs-->	
            
            <div id="boxes">

                <ul class="list1" id="pop">            
					<?php popular_posts(); ?>                    
                </ul>

				<ul class="list1" id="comm">
					<?php recent_comments(); ?>                     
				</ul>	

            </div><!-- /boxes-->
        
        </div><!-- /tabbox -->
        
        <?php } ?>
        
        <div id="largewidget" class="widgetlist alpha grid_6">
        
            <?php if (function_exists('woo_sidebar') && woo_sidebar('sidebar-1') ) : else : ?>		
            
            <?php endif; ?>        
        
        </div>
        
            <div id="leftwidget" class="widgetlist alpha grid_3">

            <?php if (function_exists('woo_sidebar') && woo_sidebar('sidebar-2') ) : else : ?>		
            
            <?php endif; ?>
                
            </div><!-- /widgetlist -->
            
            <div id="rightwidget" class="widgetlist omega grid_3">

            <?php if (function_exists('woo_sidebar') && woo_sidebar('sidebar-3') ) : else : ?>		
                
            <?php endif; ?>                        
                
            </div><!-- /widgetlist -->
        
    </div><!-- /sidebar -->
</div><!-- /grid 6 -->
