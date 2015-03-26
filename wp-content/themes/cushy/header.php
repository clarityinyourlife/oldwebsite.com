<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
	
	<title><?php woo_title(); ?></title>
	<?php woo_meta(); ?>

	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php if ( get_option('woo_feedburner_url') <> "" ) { echo get_option('woo_feedburner_url'); } else { echo get_bloginfo_rss('rss2_url'); } ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	
	<!--[if IE 6]>
		<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/ie6.css" type="text/css" media="screen" />
		<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/includes/js/suckerfish.js"></script> 
	<![endif]-->
	
	<!--[if IE 7]>
		<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/ie7.css" type="text/css" media="screen" />
	<![endif]-->
		     	
	<?php if ( is_single() ) wp_enqueue_script( 'comment-reply' ); ?>
	<?php wp_head(); ?>
	
	<!-- Custom Logo -->
	<?php if ( get_option('woo_logo') <> "" ) { ?>
	
		<style>
			h1 {
				background:url(<?php echo get_option( 'woo_logo' ); ?>) no-repeat center left !important;
			}
		</style>
	
	<?php } ?>
	
</head>
<body <?php body_class(); ?>>

	<div id="header-repeat">
		
		<div id="header-left">
		
			<div class="container">
			
				<?php include_once( TEMPLATEPATH . '/searchform-header.php' ); ?>
		
				<div id="logo">
					
					<a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('description'); ?>"><img class="title" src="<?php if ( get_option('woo_logo') <> "" ) { echo get_option('woo_logo'); } else { bloginfo('template_directory'); ?>/images/logo.gif<?php } ?>" alt="<?php bloginfo('name'); ?>" /></a>
					<h1><?php bloginfo('name'); ?></h1>
				
				</div><!-- End Logo -->
				<?php
    		if ( function_exists('has_nav_menu') && has_nav_menu('primary-menu') ) {
    			wp_nav_menu( array( 'depth' => 2, 'sort_column' => 'menu_order', 'container' => 'ul', 'link_before' => '<span><span><span>', 'link_after' => '</span></span></span>', 'menu_id' => 'navigation', 'menu_class' => 'clearfix', 'theme_location' => 'primary-menu' ) );
    		} else {
    		?>									
				<ul id="navigation" class="clearfix">
					<?php 
               		if ( get_option('woo_custom_nav_menu') == 'true' ) {
                    	if ( function_exists('woo_custom_navigation_output') )
                        	woo_custom_navigation_output('depth=2&name=Woo Menu 1&before_title=<span><span><span>&after_title=</span></span></span>');
    
                	} else { ?>
					<li class="<?php if ( is_home() ) { echo 'current_page_item'; } ?>"><a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"><span><span><span><?php _e('Home',woothemes); ?></span></span></span></a></li>
					
					<?php
						
						$exclude = '';
						$exclude = get_option('woo_pages_ex') . ',' . get_option('woo_featured_tabs') .  ',' . get_option('woo_features_page') .  ',' . $exclude;
						wp_list_pages('title_li=&depth=2&link_before=<span><span><span>&link_after=</span></span></span>&exclude=' . $exclude);
					
					?>
					<?php } ?>
				</ul><!-- End navigation -->									
				<?php } ?>									
			</div><!-- End container -->
		
		</div><!-- End header-left -->
	
	</div><!-- End header-repeat -->
	
	<div id="content-repeat">
	
		<div id="content-left">
	
			<div class="container clearfix">
				
				<div id="content" class="clearfix">
				