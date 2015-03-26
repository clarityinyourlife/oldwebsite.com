<?php
/** Theme Custom Header */
$custom_header_support = array( 
	
	'default-image' => '',
	'random-default' => true,
	'width' => apply_filters( 'galaxy_header_image_width', 940 ),
	'height' => apply_filters( 'galaxy_header_image_height', 200 ),
	'flex-height' => true,
	'default-text-color' => 'fff',
	'header-text' => true,
	'wp-head-callback' => 'galaxy_header_style',
	'admin-head-callback' => 'galaxy_admin_header_style',
	'admin-preview-callback' => 'galaxy_admin_header_image'
	
);

/** This is all for compatibility with versions of WordPress prior to 3.4. */
if ( function_exists( 'get_custom_header' ) ) {	
	
	add_theme_support( 'custom-header', $custom_header_support );	

} else {

	define( 'HEADER_TEXTCOLOR', $custom_header_support['default-text-color'] );
	define( 'HEADER_IMAGE', $custom_header_support['default-image'] );
	define( 'HEADER_IMAGE_WIDTH', $custom_header_support['width'] );
	define( 'HEADER_IMAGE_HEIGHT', $custom_header_support['height'] );
	define( 'NO_HEADER_TEXT', false );
	
	/** Turn on random header image rotation by default. */
	add_theme_support( 'custom-header', array( 'random-default' => $custom_header_support['random-default'] ) );
	add_custom_image_header( $custom_header_support['wp-head-callback'], $custom_header_support['admin-head-callback'], $custom_header_support['admin-preview-callback'] );

}

/** Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI. */
register_default_headers( array(
	
	'galaxy' =>	array(
		  'url' => '%s/images/headers/header-galaxy.png',
		  'thumbnail_url' => '%s/images/headers/header-galaxy-thumb.png',
		  'description' => 'Galaxy'
	 ),	

) );

/** Styles the header image and text displayed on the blog / blog preview in admin. */
function galaxy_header_style() {
	
	$header_textcolor = get_header_textcolor();
	if( ( !empty( $header_textcolor ) && $header_textcolor != 'blank' ) || get_header_image() ):
	galaxy_admin_header_style();	
	endif;	

}

/** Styles the header image displayed on the Appearance > Header admin panel. */
function galaxy_admin_header_style() {
	
	if ( function_exists( 'get_custom_header' ) ) {
		
		$header_image_width  = get_custom_header()->width;
		$header_image_height = get_custom_header()->height;
	
	} else {
		
		$header_image_width  = HEADER_IMAGE_WIDTH;
		$header_image_height = HEADER_IMAGE_HEIGHT;
	
	}
	
?>
<style type="text/css">
.appearance_page_custom-header #head-wrap,
#head-wrap {
	font-family: Georgia, Times, serif;
	width: <?php echo $header_image_width; ?>px;
	height: <?php echo $header_image_height; ?>px;	
	text-align: center;
	text-shadow: #8e8e8e 1px 1px;
	overflow: hidden;
	border: none;
}

.appearance_page_custom-header .head-wrap-bg,
.head-wrap-bg {
	background: url(<?php header_image(); ?>) no-repeat;
}

#head-wrap #head-text .site-name {
	display: block;
	margin: 50px 50px 15px 50px;
}

#head-wrap #head-text .site-name a {
	font-size: 36px;
	line-height: 36px; 
	font-weight: normal; 
	color: #<?php echo esc_html( get_header_textcolor() ); ?>;
	text-decoration: none;
}

#head-wrap #head-text .site-description {
	display: block;
	font-size: 18px;
	font-style: italic;
	line-height: 25px;
	color: #<?php echo esc_html( get_header_textcolor() ); ?>;
	margin: 0 50px;	
}
</style>
<?php
}

/** Markup the header image displayed on the Appearance > Header admin panel. */
function galaxy_admin_header_image() {	
?>

    <?php
	$header_textcolor = get_header_textcolor(); 
	if( ( !empty( $header_textcolor ) && $header_textcolor != 'blank' ) ):
	$head_wrap_bg_class = ( get_header_image() )? 'head-wrap-bg' : '';
	?>    
    
    <div id="head-wrap" class="<?php echo $head_wrap_bg_class; ?>">
      <div id="head-text">
        <span class="site-name"><a href="<?php echo home_url( '/' ); ?>" onclick="return false;" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span>
        <span class="site-description"><?php bloginfo( 'description' ); ?></span>
      </div><!-- end of #head-text -->
    </div>
	
	<?php 
	elseif( get_header_image() ):
	
	if ( function_exists( 'get_custom_header' ) ) {
		
		$header_image_width  = get_custom_header()->width;
		$header_image_height = get_custom_header()->height;
	
	} else {
		
		$header_image_width  = HEADER_IMAGE_WIDTH;
		$header_image_height = HEADER_IMAGE_HEIGHT;
	
	}	
	?>
    
    <div id="head-wrap">
      <div id="head-image">
        <a href="<?php echo home_url( '/' ); ?>" onclick="return false;" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php header_image(); ?>" width="<?php echo $header_image_width; ?>" height="<?php echo $header_image_height; ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
      </div><!-- end of #logo -->
    </div>
    
	<?php endif; ?>

<?php
}
?>