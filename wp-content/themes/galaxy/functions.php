<?php
/** Load the Core Files */
require_once( trailingslashit( get_template_directory() ) . 'lib/init.php' );
new Galaxy();

/** Do theme setup on the 'after_setup_theme' hook. */
add_action( 'after_setup_theme', 'galaxy_theme_setup' );

/** Theme setup function. */
function galaxy_theme_setup() {
	
	/** Add theme support for core framework features. */
	add_theme_support( 'galaxy-core-menus', array( 'galaxy-primary-menu' ) );
	add_theme_support( 'galaxy-core-sidebars', array( 'galaxy-primary-sidebar' ) );
	add_theme_support( 'galaxy-core-featured-image' );
	add_theme_support( 'galaxy-core-custom-header' );
	
	/** Add theme support for WordPress features. */
	add_theme_support( 'automatic-feed-links' );
	
	/** Add theme support for Custom Background. */
	if ( function_exists( 'get_custom_header' ) ) {
		add_theme_support( 'custom-background', array( 'default-image' => '%s/images/galaxy.png', 'wp-head-callback' => 'galaxy_custom_background_callback' ) );
	} else {
		add_custom_background( 'galaxy_custom_background_callback' );
	}
	
	/** Set content width. */
	galaxy_set_content_width( 590 );
	
	/** Add custom image sizes. */
	add_action( 'init', 'galaxy_add_image_sizes' );	

}

/** Adds custom image sizes */
function galaxy_add_image_sizes() {
	add_image_size( 'featured', 620, 255, true );
}

/**
 * This is a fix for when a user sets a custom background color with no custom background image.  What 
 * happens is the theme's background image hides the user-selected background color.  If a user selects a 
 * background image, we'll just use the WordPress custom background callback.
 *
 * @since 0.1.0
 * @link http://core.trac.wordpress.org/ticket/16919
 */
function galaxy_custom_background_callback() {

	/* Get the background image. */
	$image = get_background_image();

	/* If there's an image, just call the normal WordPress callback. We won't do anything here. */
	if ( !empty( $image ) ) {
		_custom_background_cb();
		return;
	}

	/* Get the background color. */
	$color = get_background_color();

	/* If no background color, return. */
	if ( empty( $color ) ) {
		return;
	}

	/* Use 'background' instead of 'background-color'. */
	$style = "background: #{$color};";

?>
<style type="text/css">body.custom-background { <?php echo trim( $style ); ?> }</style>
<?php
}
?>