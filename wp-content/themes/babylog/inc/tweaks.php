<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Babylog
 * @since Babylog 1.0
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @since Babylog 1.0
 */
function babylog_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'babylog_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @since Babylog 1.0
 */
function babylog_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a unique class for each theme color scheme as set in Theme Options
	$options = babylog_get_theme_options();
	$color = $options['color_scheme'];

	if( isset( $color ) ) {
		$classes[] .= 'theme-color-' . esc_attr( $color );
	}
	else {
		$classes[] .= 'theme-color-purple';
	}

	return $classes;
}
add_filter( 'body_class', 'babylog_body_classes' );

/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
 *
 * @since Babylog 1.0
 */
function babylog_enhanced_image_navigation( $url, $id ) {
	if ( ! is_attachment() && ! wp_attachment_is_image( $id ) )
		return $url;

	$image = get_post( $id );
	if ( ! empty( $image->post_parent ) && $image->post_parent != $id )
		$url .= '#main';

	return $url;
}
add_filter( 'attachment_link', 'babylog_enhanced_image_navigation', 10, 2 );