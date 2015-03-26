<?php 
$header_textcolor = get_header_textcolor();
if( ( !empty( $header_textcolor ) && $header_textcolor != 'blank' ) ):
$head_wrap_bg_class = ( get_header_image() )? 'head-wrap-bg' : '';
?>    

<div id="container_custom_header">
  <div class="container_12">
    <div class="grid_12">
      <div id="head-wrap" class="<?php echo $head_wrap_bg_class; ?>">
        <div id="head-text">
          <span class="site-name"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span>
          <span class="site-description"><?php bloginfo( 'description' ); ?></span>
        </div> <!-- end of #head-text -->
      </div> <!-- end of #head-wrap -->
    </div>
  </div>  <!-- end of .container_12 -->
</div>

<?php 
elseif( get_header_image() ):

if ( function_exists( 'get_custom_header' ) ) {
	
	$header_image_width  = get_custom_header()->width;
	$header_image_height = get_custom_header()->height;

} else {
	
	$header_image_width  = HEADER_IMAGE_WIDTH;
	$header_image_height = HEADER_IMAGE_HEIGHT;

}	
?>

<div id="container_custom_header">
  <div class="container_12">
    <div class="grid_12">
      <div id="head-wrap">
        <div id="head-image">
          <a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php header_image(); ?>" width="<?php echo $header_image_width; ?>" height="<?php echo $header_image_height; ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
        </div> <!-- end of #logo -->
      </div> <!-- end of #head-wrap -->
    </div>
  </div> <!-- end of .container_12 -->
</div>

<?php endif; ?>