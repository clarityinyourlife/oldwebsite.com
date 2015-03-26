<?php
/**
 * Functions for dealing with theme settings on both the front end of the site and the admin.
 *
 * @package Galaxy
 * @subpackage Functions
 */

/** Loads the Galaxy theme setting. */
function galaxy_get_settings() {
	global $galaxy;

	/* If the settings array hasn't been set, call get_option() to get an array of theme settings. */
	if ( !isset( $galaxy->settings ) ) {
		$galaxy->settings = get_option( 'galaxy_options' );
	}
	
	/** return settings. */
	return $galaxy->settings;
}
?>