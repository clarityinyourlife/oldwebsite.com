<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package Scrappy
 * @since Scrappy 1.3
 */
?>

	</div><!-- #main -->
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="footer-sidebars">
			<?php get_sidebar( 'footer1' );
				  get_sidebar( 'footer2' );
				  get_sidebar( 'footer3' ); ?>
			<div class="stripes">&nbsp;</div>
		</div>
		<div class="site-info">
			<?php do_action( 'scrappy_credits' ); ?>
			<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'scrappy' ) ); ?>" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'scrappy' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'scrappy' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( __( 'Theme: %1$s by %2$s', 'scrappy' ), 'Scrappy', '<a href="http://carolinemoore.net/" rel="designer">Caroline Moore</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- .site-footer .site-footer -->
</div><!-- #page .hfeed .site -->

<?php wp_footer(); ?>

</body>
</html>