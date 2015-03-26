<?php
/**
 * The menus functions deal with registering nav menus within WordPress for the core framework.
 *
 * @package Galaxy
 * @subpackage Functions
 */

/** Register nav menus. */
add_action( 'init', 'galaxy_register_menus' );

/** Registers the the core menus */
function galaxy_register_menus() {

	/** Get theme-supported menus. */
	$menus = get_theme_support( 'galaxy-core-menus' );
	
	/** If there is no array of menus IDs, return. */
	if ( !is_array( $menus[0] ) ) {
		return;
	}
	
	/* Register the 'primary' menu. */
	if ( in_array( 'galaxy-primary-menu', $menus[0] ) ) {
		register_nav_menu( 'galaxy-primary-menu', __( 'Galaxy Primary Menu', 'galaxy' ) );
	}
	
}
?>