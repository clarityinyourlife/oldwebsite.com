<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">

	<title><?php woo_title(); ?></title>
	<?php woo_meta(); ?>

	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php if ( get_option('woo_feedburner_url') <> "" ) { echo get_option('woo_feedburner_url'); } else { echo get_bloginfo_rss('rss2_url'); } ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_directory'); ?>/css/reset.css" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_directory'); ?>/css/text.css" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_directory'); ?>/css/960.css" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" />
	
	<!--[if lte IE 6]>
    	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/includes/js/pngfix.js"></script>
    	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/includes/js/menu.js"></script>
	<![endif]-->
	
	<!--[if IE 7]>
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_directory'); ?>/css/ie7.css" />
	<![endif]-->
   	
	<!--[if IE 8]>
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_directory'); ?>/css/ie7.css" />
	<![endif]-->
	
	<?php if ( is_single() ) wp_enqueue_script( 'comment-reply' ); ?>
	<?php wp_head(); ?>
	

</head>

<body <?php body_class(); ?>>

<?php
	$template_path = get_bloginfo('template_directory');
	$GLOBALS['defaultgravatar'] = $template_path . '/images/gravatar.jpg';
?>

<div id="wrap">

<div id="header" class="fullspan">

	<div class="container_16">
		
		<div class="grid_8">

		<?php if ( get_option('woo_logo') == "" ) { ?>
        
            <h1 class="title"><a href="<?php echo get_settings('home'); ?>/" title="Home"><?php bloginfo('name'); ?></a></h1>
			<p class="description"><?php bloginfo('description'); ?></p>
            
		<?php } else { ?>
                
            <h1 class="title" style=""><a href="<?php echo get_settings('home'); ?>/" title="Home"><img src="<?php echo get_option('woo_logo'); ?>" /></a></h1>
        
        <?php } ?>
        
		</div>
		
		<div id="rss">
			<a href="<?php if ( get_option('woo_feedburner_url') <> "" ) { echo get_option('woo_feedburner_url'); } else { echo get_bloginfo_rss('rss2_url'); } ?>" title="<?php _e('Subscribe to our RSS feed',woothemes); ?>"><?php _e('Stay updated on our news',woothemes); ?></a>
		</div><!-- /rss -->
		
		<div id="nav">
			<?php
			if ( function_exists('has_nav_menu') && has_nav_menu('primary-menu') ) {
				wp_nav_menu( array( 'depth' => 3, 'sort_column' => 'menu_order', 'container' => 'ul', 'menu_id' => 'pagenav', 'theme_location' => 'primary-menu' ) );
			} else {
			?>
			<ul id="pagenav">
				<?php
				if ( get_option('woo_custom_nav_menu') == 'true' && function_exists('woo_custom_navigation_output') ) {
        			
						woo_custom_navigation_output('depth=3');
						
				} else { ?>		
									
				<li <?php if ( is_home() ) { ?> class="current_page_item" <?php } ?>><a href="<?php echo get_option('home'); ?>/"><?php _e('Home',woothemes); ?></a></li>
				<?php if ( get_option('woo_blog') == 'true' ) { ?><li <?php if ( is_category() ) { ?> class="current_page_item" <?php } ?>><a href="<?php echo get_option('home'); echo get_option('woo_blogcat'); ?>" title="Blog">Blog</a></li><?php } ?>

				<?php 
					if (get_option('woo_cat_menu') == 'true') 
						wp_list_categories('sort_column=menu_order&depth=3&title_li=&exclude='.get_option('woo_nav_exclude')); 
					else
						wp_list_pages('sort_column=menu_order&depth=3&title_li=&exclude='.get_option('woo_nav_exclude')); 
				?>
				
				<?php } ?>
            </ul>
			<?php } ?>
		</div><!-- /nav -->
		
	</div><!-- /container_16 -->

</div><!-- /header -->
