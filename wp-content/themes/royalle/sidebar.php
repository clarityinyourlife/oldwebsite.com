<div id="sidebar" class="col-right">

	<div id="sidebar_navigation">

		<?php
		if ( function_exists('has_nav_menu') && has_nav_menu('sidebar-menu') ) {
			wp_nav_menu( array( 'depth' => 1, 'sort_column' => 'menu_order', 'container' => 'ul', 'menu_id' => 'nav', 'menu_class' => 'fl', 'theme_location' => 'sidebar-menu' ) );
		} else {
		?>

        <ul id="nav" class="fl">

            <?php 

        	if ( get_option('woo_custom_nav_menu') == 'true' ) {

        		if ( function_exists('woo_custom_navigation_output') )

					woo_custom_navigation_output('name=Woo Menu 2');



			} else { ?>

            <?php if (is_page()) { $highlight = "page_item"; } else {$highlight = "page_item current_page_item"; } ?>

            <li class="<?php echo $highlight; ?>"><a href="<?php bloginfo('url'); ?>"><?php _e('Home', 'woothemes') ?></a></li>

            <?php 

    		if (get_option('woo_page_menu') == 'true') 

    			wp_list_categories('sort_column=menu_order&depth=1&title_li=&exclude='.get_option('woo_sidebar_nav_exclude')); 

            else

    			wp_list_pages('sort_column=menu_order&depth=1&title_li=&exclude='.get_option('woo_sidebar_nav_exclude')); 

    		?>

    		<?php } ?>

        </ul><!-- /#nav -->

        <?php } ?>

	</div><!-- /#navigation -->
	
	<div class="fix"></div> 



	<!-- Widgetized Sidebar -->	

	<?php woo_sidebar(1); ?>
	
	<?php if ( get_option( 'woo_hcard' ) == 'true' ) { build_hcard(); } ?>		           

	

</div><!-- /#sidebar -->