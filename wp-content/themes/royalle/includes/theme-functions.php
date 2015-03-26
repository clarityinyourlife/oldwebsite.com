<?php 
    
// Remove image dimentions from woo_get_image images
update_option('woo_force_all',false);
update_option('woo_force_single',false);

//Creates correct hCard naming class
function hcard_name() {

	$output = '';
	
	if ( get_option( 'woo_hcard_firstname' ) <> "" ) { $output .= get_option( 'woo_hcard_firstname' ) . ' '; }
	if ( get_option( 'woo_hcard_addname' ) <> "" ) { $output .= get_option( 'woo_hcard_addname' ) . ' '; }	
	if ( get_option( 'woo_hcard_surname' ) <> "" ) { $output .= get_option( 'woo_hcard_surname' ); }
	
	return $output;
	
}   

//Builds & displays the hCard
function build_hcard() {

?>

		<div id="address" class="widget">
			
			<h3>Contact</h3>

			<address>
					<strong><?php echo hcard_name(); ?></strong><br />
  					<?php if ( get_option( 'woo_hcard_street' ) <> "" ) {  ?><span class="street-address"><?php echo get_option( 'woo_hcard_street' ); ?></span><br/><?php } ?>
					<?php if ( get_option( 'woo_hcard_city' ) <> "" ) {  ?><span class="locality"><?php echo get_option( 'woo_hcard_city' ); ?></span><br/><?php } ?>
					<?php if ( get_option( 'woo_hcard_region' ) <> "" ) {  ?><span class="region"><?php echo get_option( 'woo_hcard_region' ); ?></span><br/><?php } ?>
					<?php if ( get_option( 'woo_hcard_postal' ) <> "" ) {  ?><span class="postal-code"><?php echo get_option( 'woo_hcard_postal' ); ?></span><br/><?php } ?>
					<?php if ( get_option( 'woo_hcard_country' ) <> "" ) {  ?><span class="country-name"><?php echo get_option( 'woo_hcard_country' ); ?></span><br/><?php } ?>
					<?php if ( get_option( 'woo_hcard_tel' ) <> "" ) {  ?><span class="tel"><?php echo get_option( 'woo_hcard_tel' ); ?></span><br/><?php } ?>
					<span class="mail"><a class="email" href="mailto:<?php echo get_option( 'woo_hcard_email' ); ?>"><?php echo get_option( 'woo_hcard_email' ); ?></a></span>
			</address>			
			
		</div><!-- /#address -->

<?php

}
    
/*-----------------------------------------------------------------------------------*/
/* WordPress 3.0 New Features Support */
/*-----------------------------------------------------------------------------------*/

if ( function_exists('wp_nav_menu') ) {
	add_theme_support( 'nav-menus' );
	register_nav_menus( array( 'primary-menu' => __( 'Primary Menu' ), 'sidebar-menu' => __( 'Sidebar Menu' ) ) );
}
    
?>