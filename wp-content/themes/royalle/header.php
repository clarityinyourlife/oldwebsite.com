<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">

<title><?php woo_title(); ?></title>
<?php woo_meta(); ?>

<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="screen" />
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php if ( get_option('woo_feedburner_url') <> "" ) { echo get_option('woo_feedburner_url'); } else { echo get_bloginfo_rss('rss2_url'); } ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
   
	<!--[if IE 6]>
		<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/includes/js/pngfix.js"></script>
		<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/includes/js/menu.js"></script>
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_directory'); ?>/css/ie6.css" />
    <![endif]-->	
	
	<!--[if IE 7]>
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_directory'); ?>/css/ie7.css" />
	<![endif]-->
   
<?php if ( is_single() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<div id="container">
        
	<div id="header" class="col-full">
   
		<div id="logo">
	       
			<?php if (get_option('woo_texttitle') <> "true") : $logo = get_option('woo_logo'); ?>
	            <a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('description'); ?>">
	                <img src="<?php if ($logo) echo $logo; else { bloginfo('template_directory'); ?>/images/logo.png<?php } ?>" alt="<?php bloginfo('name'); ?>" />
	            </a>
	        <?php endif; ?> 
	        
	        <?php if( is_singular() ) : ?>
	            <span class="site-title"><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></span>
	        <?php else : ?>
	            <h1 class="site-title"><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
	        <?php endif; ?>
	            <span class="site-description"><?php bloginfo('description'); ?></span>
	      	
		</div><!-- /#logo -->
		
		<div id="sites">

		<ul>

			<?php if (function_exists('woo_sidebar') && woo_sidebar('social-sidebar') ) : else : ?>

				<?php if ( is_user_logged_in() ) { ?>
				<li class="empty">
					<a href="<?php bloginfo('url'); ?>/wp-admin/widgets.php" title="<?php _e('Add Your Social Links',woothemes); ?>">
						<span class="button">&nbsp;</span>
						<span class="text"><?php _e('Add',woothemes); ?></span>
					</a>
				</li>
				<?php } ?>
	
			<?php endif; ?>		

		</ul>

	</div><!-- /#sites -->
       
	</div><!-- /#header -->
	
	<!-- Optional Category Navigation Starts -->
	<?php if (get_option('woo_top_nav') == "true" ) { ?>  
	<div id="top-nav">
		<?php
		if ( function_exists('has_nav_menu') && has_nav_menu('primary-menu') ) {
			wp_nav_menu( array( 'depth' => 4, 'sort_column' => 'menu_order', 'container' => 'ul', 'menu_class' => 'nav fl', 'theme_location' => 'primary-menu' ) );
		} else {
		?>
        <ul class="nav fl">
        <?php 
        	if ( get_option('woo_custom_nav_menu') == 'true' ) {
        		if ( function_exists('woo_custom_navigation_output') )
					woo_custom_navigation_output('name=Woo Menu 1&depth=4');

			} else { ?>
			<?php if (is_page()) { $highlight = "page_item"; } else {$highlight = "page_item current_page_item"; } ?>
            <li class="<?php echo $highlight; ?>"><a href="<?php bloginfo('url'); ?>"><?php _e('Home', 'woothemes') ?></a></li>
            <?php 
    		if (get_option('woo_cat_menu') == 'false') 
    			wp_list_categories('sort_column=menu_order&depth=3&title_li=&exclude='.get_option('woo_top_nav_exclude')); 
            else
    			wp_list_pages('sort_column=menu_order&depth=1&title_li=&exclude='.get_option('woo_top_nav_exclude')); 
    		?>
    		<?php } ?>           
        </ul>
		<?php } ?>
	<div style="clear:both"></div>
    </div>
    <?php } ?>
	<!-- Optional Category Navigation Ends -->