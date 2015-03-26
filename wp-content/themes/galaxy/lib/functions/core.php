<?php
/**
 * The core functions file for the Galaxy framework. Functions defined here are generally
 * used across the entire framework to make various tasks faster. This file should be loaded
 * prior to any other files because its functions are needed to run the framework.
 *
 * @package Galaxy
 * @subpackage Functions
 */

/** Function for setting the content width of a theme. */
function galaxy_set_content_width( $width = '' ) {
	global $content_width;
	$content_width = absint( $width );
}

/** Function for getting the theme's content width. */
function galaxy_get_content_width() {
	global $content_width;
	return $content_width;
}

/** Function for getting the theme's data */
function galaxy_theme_data( $path = 'template' ) {
	global $galaxy;
	
	/* If 'template' is requested, get the parent theme data. */
	if ( 'template' == $path ) {

		/* If the parent theme data isn't set, let grab it. */
		if ( empty( $galaxy->theme_data ) ) {
			
			$galaxy_theme_data = array();
			if( function_exists( 'wp_get_theme' ) ) {
			
				$theme_data = wp_get_theme();
				$galaxy_theme_data['Name'] = $theme_data->get( 'Name' );
				$galaxy_theme_data['ThemeURI'] = $theme_data->get( 'ThemeURI' );
				$galaxy_theme_data['AuthorURI'] = $theme_data->get( 'AuthorURI' );
				$galaxy_theme_data['Description'] = $theme_data->get( 'Description' );
				
				$galaxy->theme_data = $galaxy_theme_data;				
			
			} else {
			
				$theme_data = get_theme_data( trailingslashit( GALAXY_DIR ) . 'style.css' );
				$galaxy_theme_data['Name'] = $theme_data['Name'];
				$galaxy_theme_data['ThemeURI'] = $theme_data['URI'];
				$galaxy_theme_data['AuthorURI'] = $theme_data['AuthorURI'];
				$galaxy_theme_data['Description'] = $theme_data['Description'];
				
				$galaxy->theme_data = $galaxy_theme_data;				
			
			}
		
		}

		/* Return the parent theme data. */
		return $galaxy->theme_data;
	}	

	/* Return false for everything else. */
	return false;
}
?>