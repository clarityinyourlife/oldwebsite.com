<?php if ( get_option('woo_show_mpu') == "true" ) { ?>

	<a <?php do_action('premiumnews_external_ad_link'); ?> href="<?php echo get_option('woo_block_url'); ?>"><img class="bigad" src="<?php echo get_option('woo_block_image'); ?>" alt="" /></a>

<?php } ?>