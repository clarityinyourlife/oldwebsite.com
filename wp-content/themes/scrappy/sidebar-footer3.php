<?php
/**
 * The Sidebar containing the footer widget area.
 *
 * @package Scrappy
 * @since Scrappy 1.3
 */
?>
		<div id="tertiary-3" class="footer-sidebar" role="complementary">
			<?php do_action( 'before_sidebar' ); ?>
			<?php if ( ! dynamic_sidebar( 'footer-sidebar-3' ) ) : ?>
			<?php endif; // end sidebar widget area ?>
		</div><!-- #tertiary .footer-sidebar -->
