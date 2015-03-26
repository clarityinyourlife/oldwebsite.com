<?php get_header(); ?>

		<?php
            
            $layout = get_option('woo_layout');
			if ($layout <> '')
	            include('layouts/'.$layout);
			else 
				include('layouts/default.php');
            
        ?>      

<?php get_footer(); ?>