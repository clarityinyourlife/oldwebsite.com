<?php
/**
 * Babylog functions and definitions
 *
 * @package Babylog
 * @since Babylog 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Babylog 1.0
 */

if ( ! isset( $content_width ) )
	$content_width = 646; /* pixels */

if ( ! function_exists( 'babylog_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since Babylog 1.0
 */
function babylog_setup() {

	/**
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );

	/**
	 * Custom functions that act independently of the theme templates
	 */
	require( get_template_directory() . '/inc/tweaks.php' );

	/**
	 * Custom Theme Options
	 */
	require( get_template_directory() . '/inc/theme-options/theme-options.php' );

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on Babylog, use a find and replace
	 * to change 'babylog' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'babylog', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Setup the WordPress core custom background feature.
	 * This includes support for the custom background textures included in Pinboard's Theme Options
	 *
	 * Use add_theme_support to register support for WordPress 3.4+
	 * as well as provide backward compatibility for previous versions.
	 * Use feature detection of wp_get_theme() which was introduced
	 * in WordPress 3.4.
	 *
	 */

	$options = babylog_get_theme_options();
	$colorscheme = $options['color_scheme'];

	if ( isset( $colorscheme ) && ! empty( $colorscheme ) ) {
		if ( 'green' == $colorscheme )
			$backgroundcolor = 'c2e2bf';
		else if ( 'blue' == $colorscheme )
			$backgroundcolor = '86afbf';
		else if ( 'pink' == $colorscheme )
			$backgroundcolor = 'e29393';
		else if ( 'purple' == $colorscheme )
			$backgroundcolor = 'bfa1c6';
	}
	else {
		$backgroundcolor = 'bfa1c6';
		$colorscheme = 'purple';
	}

    $args = array(
        'default-color' => $backgroundcolor,
        'default-image' => get_template_directory_uri() . '/images/background-' . $colorscheme . '.png',
    );

    $args = apply_filters( 'babylog_custom_background_args', $args );

    if ( function_exists( 'wp_get_theme' ) ) {
        add_theme_support( 'custom-background', $args );
    } else {
        define( 'BACKGROUND_COLOR', $args['default-color'] );
        define( 'BACKGROUND_IMAGE', $args['default-image'] );
        add_custom_background();
    }

	/**
	 * Enable support for Post Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'babylog' ),
	) );

}
endif; // babylog_setup
add_action( 'after_setup_theme', 'babylog_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since Babylog 1.0
 */
function babylog_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar', 'babylog' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s"><div class="widget-notitle-content-container">',
		'after_widget' => '</div></aside>',
		'before_title' => '</div><h1 class="widget-title">',
		'after_title' => '</h1><div class="widget-contents">',
	) );
}
add_action( 'widgets_init', 'babylog_widgets_init' );


/*
 * Create one function to register Google web fonts
 */
function babylog_fonts() {
	$protocol = is_ssl() ? 'https' : 'http';
	wp_register_style( 'babylog-vidaloka', "$protocol://fonts.googleapis.com/css?family=Vidaloka" );
}
add_action( 'init', 'babylog_fonts' );


/**
 * Enqueue scripts and styles
 */
function babylog_scripts() {
	wp_enqueue_style( 'style', get_stylesheet_uri() );

	wp_enqueue_style( 'babylog-vidaloka' );

	wp_enqueue_script( 'small-menu', get_template_directory_uri() . '/js/small-menu.js', array( 'jquery' ), '20120206', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}

}
add_action( 'wp_enqueue_scripts', 'babylog_scripts' );


/**
 * Output the custom baby graphic based on theme options
 */

function babylog_baby() {
	$options = babylog_get_theme_options();
	$haircolor = $options['hair_color'];
	$themecolor = $options['color_scheme'];
	$skincolor = $options['skin_tone'];
	$showbaby = $options['show_baby'];

	if ( isset( $showbaby ) && 'no' == $showbaby )
		return;

	if ( isset( $haircolor ) && ! empty( $haircolor ) )
		$haircolor = esc_attr( $haircolor );
	else
		$haircolor = 'brown';

	if ( isset( $skincolor ) && ! empty( $skincolor ) )
		$skincolor = esc_attr( $skincolor );
	else
		$skincolor = 'medium';

	if ( isset( $themecolor ) && ! empty( $themecolor ) )
		$themecolor = esc_attr( $themecolor );
	else
		$themecolor = 'purple';

	$babyurl = esc_attr( get_template_directory_uri() . '/images/' . $themecolor . '-' . $skincolor . '-' . $haircolor . '.png' );

	printf( '<div id="baby-graphic"><img src="' . $babyurl . '" alt="" /></div>' );
}

/**
 * Enqueue custom header fonts
 */

function babylog_custom_header_fonts( $hook_suffix ) {

	if ( 'appearance_page_custom-header' != $hook_suffix )
		return;

	wp_enqueue_style( 'babylog-vidaloka' );

}

add_action( 'admin_enqueue_scripts', 'babylog_custom_header_fonts' );

/**
 * Enqueue theme options script
 */

function babylog_theme_options_scripts( $hook_suffix ) {

	if ( 'appearance_page_theme_options' != $hook_suffix )
		return;

	$babylogdirectory = array( 'directory' => get_template_directory_uri() . '/images/' );
	wp_enqueue_script( 'babylog-admin-controls', get_template_directory_uri() . '/inc/theme-options/theme-options.js', array( 'jquery' ), '20120918' );
	wp_localize_script( 'babylog-admin-controls', 'template', $babylogdirectory );

}

add_action( 'admin_enqueue_scripts', 'babylog_theme_options_scripts' );


/**
 * Implement the Custom Header feature
 */
require( get_template_directory() . '/inc/custom-header.php' );
