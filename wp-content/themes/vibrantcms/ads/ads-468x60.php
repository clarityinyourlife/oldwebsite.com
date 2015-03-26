<?php 
$showadbelow = get_option('woo_show_ad'); 
if ($showadbelow == "true") { 

	// Get block code //
	$ad_below_img = get_option('woo_ad_below_image');
	$ad_below_url = get_option('woo_ad_below_url');
	$ad_below_adpage = get_option('woo_ad_below_adpage');

?>

    <div id="postad">
        <a href="<?php echo "$ad_below_url"; ?>" title="#"><img src="<?php echo "$ad_below_img"; ?>" alt="#" /></a>
    </div><!-- /postad -->         

<?php } ?>
<!-- end display ad -->
