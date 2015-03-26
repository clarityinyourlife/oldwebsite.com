<?php
/**
 * Functions file for loading scripts and stylesheets.
 *
 * @package Cayon
 * @subpackage Functions
 */

/** Register Galaxy Core scripts. */
add_action( 'wp_enqueue_scripts', 'galaxy_register_scripts', 1 );

/** Load Galaxy Core scripts. */
add_action( 'wp_enqueue_scripts', 'galaxy_enqueue_scripts' );

/** Register JavaScript and Stylesheet files for the framework. */
function galaxy_register_scripts() {

	/* Register the 'drop-downs' scripts if the current theme supports 'galaxy-core-menus'. */
	if ( current_theme_supports( 'galaxy-core-menus' ) ) {
		wp_register_script( 'galaxy-js-hoverintent', esc_url( trailingslashit( GALAXY_JS_URI ) . 'hoverintent.min.js' ), array( 'jquery' ), '5', true );
		wp_register_script( 'galaxy-js-superfish', esc_url( trailingslashit( GALAXY_JS_URI ) . 'superfish.min.js' ), array( 'jquery' ), '1.4.8', true );
		wp_register_script( 'galaxy-js-supersubs', esc_url( trailingslashit( GALAXY_JS_URI ) . 'supersubs.min.js' ), array( 'jquery' ), '0.2', true );
		wp_register_script( 'galaxy-js-drop-downs', esc_url( trailingslashit( GALAXY_JS_URI ) . 'drop-downs.js' ), array( 'jquery' ), '1.0', true );
	}
	
	/** Register '960.css' for grid. */
	wp_register_style( 'galaxy-css-960', esc_url( trailingslashit( GALAXY_CSS_URI ) . '960.css' ) );
}

/** Tells WordPress to load the scripts needed for the framework using the wp_enqueue_script() function. */
function galaxy_enqueue_scripts() {

	/** Load the comment reply script on singular posts with open comments if threaded comments are supported. */
	if ( is_singular() && get_option( 'thread_comments' ) && comments_open() ) {
		wp_enqueue_script( 'comment-reply' );
	}

	/** Load the 'drop-downs' script if the current theme supports 'galaxy-drop-downs'. */
	if ( current_theme_supports( 'galaxy-core-menus' ) ) {
		wp_enqueue_script( 'galaxy-js-hoverintent' );
		wp_enqueue_script( 'galaxy-js-superfish' );
		wp_enqueue_script( 'galaxy-js-supersubs' );
		wp_enqueue_script( 'galaxy-js-drop-downs' );
	}
	
	/** Load '960.css' for grid. */
	wp_enqueue_style( 'galaxy-css-960' );
}

/** Analytic Code */
add_action( 'wp_footer', 'galaxy_analytic_code_init' );
function galaxy_analytic_code_init() {
	
	$galaxy_options = galaxy_get_settings();
	
	if( $galaxy_options['galaxy_analytic'] == 1 ) :	
	echo htmlspecialchars_decode ( $galaxy_options['galaxy_analytic_code'] );	
	echo '<!-- end analytic-code -->';	
	endif;

}
?>