<?php
if ( !is_singular() ):

	galaxy_loop_nav();
	
elseif ( is_singular( 'post' ) ) :

	galaxy_loop_nav_singular_post();

endif;
?>