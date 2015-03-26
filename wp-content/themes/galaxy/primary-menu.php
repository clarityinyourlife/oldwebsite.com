<?php
/** Primary Menu Callback */
function galaxy_primary_menu_cb() {
	wp_page_menu();		 
}
?>
<div id="container_primary_menu">
  <div class="container_12">
    <div class="grid_12">
      <div class="menu1">
        <div class="menu1-data">
  	      <?php
          if ( has_nav_menu( 'galaxy-primary-menu' ) ):
    	
		    $args = array(
			
				'container' => 'div', 
				'container_class' => 'primary-container', 
				'theme_location' => 'galaxy-primary-menu',
				'menu_class' => 'sf-menu1',
				'depth' => 0,
				'fallback_cb' => 'galaxy_primary_menu_cb'
						
		    );
		
		    wp_nav_menu( $args );
		
	      else:
		
		    galaxy_primary_menu_cb();	
	
	      endif;
          ?>
          <div class="clear"></div>
        </div>
      </div>  <!-- end .menu1 --> 
    </div>
  </div> <!-- end .container_12 primary-menu -->
</div>