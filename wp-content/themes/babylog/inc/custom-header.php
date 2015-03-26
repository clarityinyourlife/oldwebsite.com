<?php
/**
 * Sample implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * You can add an optional custom header image to header.php like so ...

	<?php $header_image = get_header_image();
	if ( ! empty( $header_image ) ) { ?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
			<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" />
		</a>
	<?php } // if ( ! empty( $header_image ) ) ?>

 *
 * @package Babylog
 * @since Babylog 1.0
 */

/**
 * Setup the WordPress core custom header feature.
 *
 * Use add_theme_support to register support for WordPress 3.4+
 * as well as provide backward compatibility for previous versions.
 * Use feature detection of wp_get_theme() which was introduced
 * in WordPress 3.4.
 *
 * @todo Rework this function to remove WordPress 3.4 support when WordPress 3.6 is released.
 *
 * @uses babylog_header_style()
 * @uses babylog_admin_header_style()
 * @uses babylog_admin_header_image()
 *
 * @package Babylog
 */
function babylog_custom_header_setup() {
	$args = array(
		'default-image'          => '',
		'default-text-color'     => 'fff',
		'width'                  => 920,
		'height'                 => 250,
		'flex-height'            => true,
		'wp-head-callback'       => 'babylog_header_style',
		'admin-head-callback'    => 'babylog_admin_header_style',
		'admin-preview-callback' => 'babylog_admin_header_image',
	);

	$args = apply_filters( 'babylog_custom_header_args', $args );

	if ( function_exists( 'wp_get_theme' ) ) {
		add_theme_support( 'custom-header', $args );
	} else {
		// Compat: Versions of WordPress prior to 3.4.
		define( 'HEADER_TEXTCOLOR',    $args['default-text-color'] );
		define( 'HEADER_IMAGE',        $args['default-image'] );
		define( 'HEADER_IMAGE_WIDTH',  $args['width'] );
		define( 'HEADER_IMAGE_HEIGHT', $args['height'] );
		add_custom_image_header( $args['wp-head-callback'], $args['admin-head-callback'], $args['admin-preview-callback'] );
	}
}
add_action( 'after_setup_theme', 'babylog_custom_header_setup' );

/**
 * Shiv for get_custom_header().
 *
 * get_custom_header() was introduced to WordPress
 * in version 3.4. To provide backward compatibility
 * with previous versions, we will define our own version
 * of this function.
 *
 * @todo Remove this function when WordPress 3.6 is released.
 * @return stdClass All properties represent attributes of the curent header image.
 *
 * @package Babylog
 * @since Babylog 1.1
 */

if ( ! function_exists( 'get_custom_header' ) ) {
	function get_custom_header() {
		return (object) array(
			'url'           => get_header_image(),
			'thumbnail_url' => get_header_image(),
			'width'         => HEADER_IMAGE_WIDTH,
			'height'        => HEADER_IMAGE_HEIGHT,
		);
	}
}

if ( ! function_exists( 'babylog_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see babylog_custom_header_setup().
 *
 * @since Babylog 1.0
 */
function babylog_header_style() {

	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
	if ( HEADER_TEXTCOLOR == get_header_textcolor() )
		return;
	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == get_header_textcolor() ) :
	?>
		.site-title,
		.site-description {
			position: absolute !important;
			clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		.site-title a,
		.site-description {
			color: #<?php echo get_header_textcolor(); ?> !important;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // babylog_header_style

if ( ! function_exists( 'babylog_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see babylog_custom_header_setup().
 *
 * @since Babylog 1.0
 */
function babylog_admin_header_style() {

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

?>
	<style type="text/css">
	.appearance_page_custom-header #headimg {
		background-color: #<?php echo $backgroundcolor; ?>;
		background-image: url(<?php echo get_template_directory_uri() . '/images/background-' . $colorscheme . '.png'; ?>);
		border: none;
		display: inline-block;
		padding: 20px;
		width: 90%;
	}
	#headimg h1,
	#desc {
	}
	#headimg h1 {
	}
	#headimg h1 a {
		color: #fff;
		float: left;
		font-family: Vidaloka, Georgia, "Times New Roman", Times, serif;
		font-size: 50px;
		font-weight: bold;
		letter-spacing: -1px;
		line-height: normal;
		margin-top: 15px;
		position: relative;
		text-decoration: none;
	}
	#desc {
		clear: both;
		float: left;
		font-family: Arial, Helvetica, sans-serif;
		font-style: italic;
		font-size: 18px;
		opacity: .7;
		padding: 0 0 10px 0;
		position: relative;
	}
	#headimg img {
		border-radius: 8px;
		max-width: 100%;
		height: auto;
	}
	</style>
<?php
}
endif; // babylog_admin_header_style

if ( ! function_exists( 'babylog_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see babylog_custom_header_setup().
 *
 * @since Babylog 1.0
 */
function babylog_admin_header_image() { ?>
	<div id="headimg">
		<?php
		if ( 'blank' == get_header_textcolor() || '' == get_header_textcolor() )
			$style = ' style="display:none;"';
		else
			$style = ' style="color:#' . get_header_textcolor() . ';"';
		?>
		<?php $header_image = get_header_image();
		if ( ! empty( $header_image ) ) : ?>
			<img src="<?php echo esc_url( $header_image ); ?>" alt="" />
		<?php endif; ?>
		<h1><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<div id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
	</div>
<?php }
endif; // babylog_admin_header_image