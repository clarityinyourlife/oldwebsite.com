<?php

// Company / Product News Widget
function newsWidget()
{

?>

			<div id="news">
				<h3><?php _e('Company / Product News',woothemes); ?></h3>
				
				<a class="feed" href="<?php if ( get_option('woo_feedburner_url') <> "" ) { echo get_option('woo_feedburner_url'); } else { echo get_bloginfo_rss('rss2_url'); } ?>" title="<?php _e('Subscribe to our RSS feed',woothemes); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/design/rss.gif" alt="RSS" /></a>
				
				<ul>
					<?php
                    inc_cats();              
                    $the_query = new WP_Query('cat=' . inc_cats() . '&orderby=post_date&order=desc');		
                    while ($the_query->have_posts()) : $the_query->the_post(); $do_not_duplicate = $post->ID;		
                	?>

					<li><a title="<?php _e('Permanent Link to',woothemes); ?> <?php the_title(); ?>" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a><span class="date"><?php the_time('j.m'); ?></span></li>
				
					<?php endwhile; ?>
                </ul>
				
				<?php $archives_page = get_option('woo_archives_page') . '/'; ?>
				<p class="more alignr"><a href="<?php echo get_option('home'); echo get_option('woo_blogcat'); ?>" title="<?php _e('Read More',woothemes); ?>"><?php _e('Read More',woothemes); ?></a></p>
				
			</div><!-- /news -->


<?php
}

register_sidebar_widget('Woo - Company / Product News (Home)', 'newsWidget');

// More Info #1 (Home)
function moreinfo1Widget()
{
	$settings = get_option("widget_moreinfo1widget");

	$title = $settings['title'];
	$ID = $settings['ID'];
	$linktext = $settings['linktext'];	
	$link = $settings['link'];			

?>

        	<?php query_posts('page_id=' . $ID); ?>
	
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>					
			
			<div class="moreinfo">
				<h3><?php if ( $title <> "" ) { echo $title; } else { the_title(); } ?></h3>
				
				<?php the_content(); ?>

				<?php if ( $link <> "" ) { ?><p class="more"><a href="<?php echo $link; ?>" title="<?php echo $linktext; ?>"><?php echo $linktext; ?></a></p><?php } ?>
			</div><!-- /moreinfo -->
			
			<?php endwhile; endif; ?>	

<?php
}

function moreinfo1WidgetAdmin() {

	$settings = get_option("widget_moreinfo1widget");

	// check if anything's been sent
	if (isset($_POST['update_moreinfo1'])) {
		$settings['title'] = strip_tags(stripslashes($_POST['moreinfo1_title']));
		$settings['ID'] = strip_tags(stripslashes($_POST['moreinfo1_ID']));
		$settings['linktext'] = strip_tags(stripslashes($_POST['moreinfo1_linktext']));			
		$settings['link'] = strip_tags(stripslashes($_POST['moreinfo1_link']));						

		update_option("widget_moreinfo1widget",$settings);
	}

	echo '<p>
			<label for="moreinfo1_title">Title:
			<input id="moreinfo1_title" name="moreinfo1_title" type="text" class="widefat" value="'.$settings['title'].'" /></label></p>';
	echo '<p>
			<label for="moreinfo1_ID">Page ID:
			<input id="moreinfo1_ID" name="moreinfo1_ID" type="text" class="widefat" value="'.$settings['ID'].'" /></label></p>';			
	echo '<p>
			<label for="moreinfo1_linktext">More Info Link Text:
			<input id="moreinfo1_linktext" name="moreinfo1_linktext" type="text" class="widefat" value="'.$settings['linktext'].'" /></label></p>';						
	echo '<p>
			<label for="moreinfo1_link">More Info Link URL:
			<input id="moreinfo1_link" name="moreinfo1_link" type="text" class="widefat" value="'.$settings['link'].'" /></label></p>';						
	echo '<input type="hidden" id="update_moreinfo1" name="update_moreinfo1" value="1" />';

}

register_sidebar_widget('Woo - More Info (Home) #1', 'moreinfo1Widget');
register_widget_control('Woo - More Info (Home) #1', 'moreinfo1WidgetAdmin', 400, 200);

// More Info #2 (Home)
function moreinfo2Widget()
{
	$settings = get_option("widget_moreinfo2widget");

	$title = $settings['title'];
	$ID = $settings['ID'];
	$linktext = $settings['linktext'];		
	$link = $settings['link'];		

?>

        	<?php query_posts('page_id=' . $ID); ?>
	
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>					
			
			<div class="moreinfo">
				<h3><?php if ( $title <> "" ) { echo $title; } else { the_title(); } ?></h3>
				
				<?php the_content(); ?>

				<?php if ( $link <> "" ) { ?><p class="more"><a href="<?php echo $link; ?>" title="<?php echo $linktext; ?>"><?php echo $linktext; ?></a></p><?php } ?>
			</div><!-- /moreinfo -->
			
			<?php endwhile; endif; ?>	

<?php
}

function moreinfo2WidgetAdmin() {

	$settings = get_option("widget_moreinfo2widget");

	// check if anything's been sent
	if (isset($_POST['update_moreinfo2'])) {
		$settings['title'] = strip_tags(stripslashes($_POST['moreinfo2_title']));
		$settings['ID'] = strip_tags(stripslashes($_POST['moreinfo2_ID']));
		$settings['linktext'] = strip_tags(stripslashes($_POST['moreinfo2_linktext']));					
		$settings['link'] = strip_tags(stripslashes($_POST['moreinfo2_link']));				

		update_option("widget_moreinfo2widget",$settings);
	}

	echo '<p>
			<label for="moreinfo2_title">Title:
			<input id="moreinfo2_title" name="moreinfo2_title" type="text" class="widefat" value="'.$settings['title'].'" /></label></p>';
	echo '<p>
			<label for="moreinfo2_ID">Page ID:
			<input id="moreinfo2_ID" name="moreinfo2_ID" type="text" class="widefat" value="'.$settings['ID'].'" /></label></p>';			
	echo '<p>
			<label for="moreinfo2_linktext">More Info Link Text:
			<input id="moreinfo2_linktext" name="moreinfo2_linktext" type="text" class="widefat" value="'.$settings['linktext'].'" /></label></p>';									
	echo '<p>
			<label for="moreinfo2_link">More Info Link URL:
			<input id="moreinfo2_link" name="moreinfo2_link" type="text" class="widefat" value="'.$settings['link'].'" /></label></p>';						
	echo '<input type="hidden" id="update_moreinfo2" name="update_moreinfo2" value="1" />';

}

register_sidebar_widget('Woo - More Info (Home) #2', 'moreinfo2Widget');
register_widget_control('Woo - More Info (Home) #2', 'moreinfo2WidgetAdmin', 400, 200);


// Show a testimonial from a client
function testimonialWidget() {

	$settings = get_option("widget_testimonialwidget");

	$title = $settings['title'];
	$text = $settings['text'];
	$by = $settings['by'];

?>

			<div class="moreinfo">
				<h3><?php echo $title; ?></h3>

       		 <blockquote>
           		 <p><?php echo $text; ?></p>
        		</blockquote>				
				
				<p><cite>- <?php echo $by; ?></cite></p>     
			</div><!-- /moreinfo -->
	
<?php
}


// Testimonial widget
function testimonialwidgetAdmin() {

	$settings = get_option("widget_testimonialwidget");

	// check if anything's been sent
	if (isset($_POST['update_testimonial'])) {
		$settings['title'] = strip_tags(stripslashes($_POST['testimonial_title']));
		$settings['text'] = strip_tags(stripslashes($_POST['testimonial_text']));
		$settings['by'] = strip_tags(stripslashes($_POST['testimonial_by']));

		update_option("widget_testimonialwidget",$settings);
	}

	echo '<p>
			<label for="testimonial_title">Title:
			<input id="testimonial_title" name="testimonial_title" type="text" class="widefat" value="'.$settings['title'].'" /></label></p>';
	echo '<p>
			<label for="testimonial_text">Text:
			<input id="testimonial_text" name="testimonial_text" type="text" class="widefat" value="'.$settings['text'].'" /></label></p>';
	echo '<p>
			<label for="testimonial_by">Citation:
			<input id="testimonial_by" name="testimonial_by" type="text" class="widefat" value="'.$settings['by'].'" /></label></p>';
	echo '<input type="hidden" id="update_testimonial" name="update_testimonial" value="1" />';

}

register_sidebar_widget('Woo - Testimonial (Home)', 'testimonialwidget');
register_widget_control('Woo - Testimonial (Home)', 'testimonialwidgetAdmin', 400, 200);

?>