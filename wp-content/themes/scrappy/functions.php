<?php
/**
 * Scrappy functions and definitions
 *
 * @package Scrappy
 * @since Scrappy 1.3
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Scrappy 1.3
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

if ( ! function_exists( 'scrappy_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since Scrappy 1.3
 */
function scrappy_setup() {

	/**
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );

	/**
	 * Custom functions that act independently of the theme templates
	 */
	//require( get_template_directory() . '/inc/tweaks.php' );

	/**
	 * Custom Theme Options
	 */
	require( get_template_directory() . '/inc/theme-options/theme-options.php' );

	/**
	 * WordPress.com-specific functions and definitions
	 */
	//require( get_template_directory() . '/inc/wpcom.php' );

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on Scrappy, use a find and replace
	 * to change 'scrappy' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'scrappy', get_template_directory() . '/languages' );

	$locale = get_locale();
	$locale_file = get_template_directory() . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menu( 'menu', __( 'Header Navigation Menu' , 'scrappy' ) );

	/**
	 * Add support for editor style
	 */
	add_editor_style();

	/**
	 * Add support for custom backgrounds
	 */
	$scrappy_defaults = array(
		'default-color'          => '6d4238',
		'default-image'          => get_template_directory_uri() . '/img/bg.gif',
	);
	add_theme_support( 'custom-background', $scrappy_defaults );

	/**
	 * Add support for post thumbs
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 640, 200, true );

}
endif; // scrappy_setup
add_action( 'after_setup_theme', 'scrappy_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since Scrappy 1.3
 */
function scrappy_widgets_init() {
	register_sidebar( array(
		'id' => 'right-sidebar',
		'name' => __( 'Right Sidebar' , 'scrappy' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>'
		)
	);
	register_sidebar( array(
		'id' => 'footer-sidebar-1',
		'name' => __( 'Footer Sidebar 1', 'scrappy' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>'
		)
	);
	register_sidebar( array(
		'id' => 'footer-sidebar-2',
		'name' => __( 'Footer Sidebar 2', 'scrappy' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>'
		)
	);
	register_sidebar( array(
		'id' => 'footer-sidebar-3',
		'name' => __( 'Footer Sidebar 3', 'scrappy' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>'
		)
	);
}
add_action( 'widgets_init', 'scrappy_widgets_init' );

/**
 * Style for our theme options
 */
function scrappy_theme_header_style() {
	$options = scrappy_get_theme_options();
	$themestyle = $options['theme_styles'];

	if ( isset( $themestyle ) ) { ?>
		<style type="text/css">
			.stripes { background-image: url('<?php echo get_template_directory_uri(); ?>/img/<?php echo esc_attr( $themestyle ); ?>.gif'); }
		</style>
<?php
	}
}

add_action( 'wp_head', 'scrappy_theme_header_style' );


/**
 * Enqueue scripts and styles
 */
function scrappy_scripts() {
	global $post;

	wp_enqueue_style( 'style', get_stylesheet_uri() );

	wp_enqueue_script( 'jquery' );

	wp_enqueue_script( 'small-menu', get_template_directory_uri() . '/js/small-menu.js', 'jquery', '20120206', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image( $post->ID ) ) {
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}

}
add_action( 'wp_enqueue_scripts', 'scrappy_scripts' );


/**
 * Register Google Fonts
 */
function scrappy_register_fonts() {

	$protocol = is_ssl() ? 'https' : 'http';

	wp_register_style( 'scrappy-fonts', "$protocol://fonts.googleapis.com/css?family=Rochester|Unna|Alegreya:400italic,700italic,400,700" );


}
add_action( 'init', 'scrappy_register_fonts' );


/**
 * Enqueue Google Fonts
 */
function scrappy_enqueue_fonts() {

	wp_enqueue_style( 'scrappy-fonts' );


}
add_action( 'wp_enqueue_scripts', 'scrappy_enqueue_fonts' );


/**
 * Enqueue Google Fonts for Custom Header
 */
function scrappy_header_fonts( $hook_suffix ) {

	if ( 'appearance_page_custom-header' != $hook_suffix )
		return;

	wp_enqueue_style( 'scrappy-fonts' );


}
add_action( 'admin_enqueue_scripts', 'scrappy_header_fonts' );

/**
 * Implement the Custom Header feature
 */
require( get_template_directory() . '/inc/custom-header.php' );
