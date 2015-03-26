<?php

// =============================== Twitter widget ======================================

function widget_Twidget_init() {

	if ( !function_exists('register_sidebar_widget') )
		return;

	function widget_Twidget($args) {

		// "$args is an array of strings that help widgets to conform to
		// the active theme: before_widget, before_title, after_widget,
		// and after_title are the array keys." - These are set up by the theme
		extract($args);

		// These are our own options
		$options = get_option('widget_Twidget');
		$account = $options['account'];  // Your Twitter account name
		$title = $options['title'];  // Title in sidebar for widget
		$show = $options['show'];  // # of Updates to show

        // Output
		echo $before_widget ;

		// start
		echo '<div class="twitter_inner">';  
		echo '<h3 id="twitter">'. __('Twitter',woothemes) .'</h3>';             
		echo '<ul id="twitter_update_list"><li></li></ul><div class="follow"><a href="http://www.twitter.com/'.$account.'/" title="'. __('Follow me',woothemes) .'">'. __('Follow me',woothemes) .'</a></div>
		      <script type="text/javascript" src="http://twitter.com/javascripts/blogger.js"></script>';
		echo '<script type="text/javascript" src="http://twitter.com/statuses/user_timeline/'.$account.'.json?callback=twitterCallback2&amp;count='.$show.'"></script>';
		echo '</div>'; 

		// echo widget closing tag
		echo $after_widget;
	}

	// Settings form
	function widget_Twidget_control() {

		// Get options
		$options = get_option('widget_Twidget');
		// options exist? if not set defaults
		if ( !is_array($options) )
			$options = array('account'=>'woothemes', 'title'=>'Twitter Updates', 'show'=>'3');

        // form posted?
		if ( $_POST['Twitter-submit'] ) {

			// Remember to sanitize and format use input appropriately.
			$options['account'] = strip_tags(stripslashes($_POST['Twitter-account']));
			$options['title'] = strip_tags(stripslashes($_POST['Twitter-title']));
			$options['show'] = strip_tags(stripslashes($_POST['Twitter-show']));
			update_option('widget_Twidget', $options);
		}

		// Get options for form fields to show
		$account = htmlspecialchars($options['account'], ENT_QUOTES);
		$title = htmlspecialchars($options['title'], ENT_QUOTES);
		$show = htmlspecialchars($options['show'], ENT_QUOTES);

		// The form fields
		echo '<p style="text-align:right;">
				<label for="Twitter-account">' . __('Account:') . '
				<input style="width: 200px;" id="Twitter-account" name="Twitter-account" type="text" value="'.$account.'" />
				</label></p>';
		echo '<p style="text-align:right;">
				<label for="Twitter-title">' . __('Title:') . '
				<input style="width: 200px;" id="Twitter-title" name="Twitter-title" type="text" value="'.$title.'" />
				</label></p>';
		echo '<p style="text-align:right;">
				<label for="Twitter-show">' . __('Show:') . '
				<input style="width: 200px;" id="Twitter-show" name="Twitter-show" type="text" value="'.$show.'" />
				</label></p>';
		echo '<input type="hidden" id="Twitter-submit" name="Twitter-submit" value="1" />';
	}


	// Register widget for use
	register_sidebar_widget(array('Woo - Twitter (Sidebar)', 'widgets'), 'widget_Twidget');

	// Register settings for use, 300x200 pixel form
	register_widget_control(array('Woo - Twitter (Sidebar)', 'widgets'), 'widget_Twidget_control', 300, 200);
}

// Run code and init
add_action('widgets_init', 'widget_Twidget_init');

// =============================== RSS widget ======================================
function connectWidget()
{
	$settings = get_option("widget_connectwidget");
	$title = $settings['title'];	

?>

				<div id="subscribe" class="widget">
				
					<h3><?php if ( $title ) { echo $title; } else { echo _e('Most Recent','woothemes'); } ?></h3>
					
						<ul>
							<li><a href="<?php if ( get_option('woo_feedburner_url') <> "" ) { echo get_option('woo_feedburner_url'); } else { echo get_bloginfo_rss('rss2_url'); } ?>" title="<?php _e('Subscribe to Posts RSS', 'woothemes') ?>"><img src="<?php bloginfo('template_directory'); ?>/images/subscribe_rss_btn.png" alt="Subscribe to my RSS" /></a></li>
							<li><a href="<?php bloginfo('comments_rss2_url'); ?>" title="<?php _e('Subscribe to Comments RSS', 'woothemes') ?>"><img src="<?php bloginfo('template_directory'); ?>/images/subscribe_comments_rss_btn.png" alt="Subscribe to my RSS" /></a></li>
						</ul>
						
						<div class="fix"></div>
				
				</div><!-- /#subscribe -->

<?php
}

function connectWidgetAdmin() {

	$settings = get_option("widget_connectwidget");

	// check if anything's been sent
	if (isset($_POST['update_connect'])) {
		$settings['title'] = strip_tags(stripslashes($_POST['connect_title']));		

		update_option("widget_connectwidget",$settings);
	}

	echo '<p>
			<label for="connect_title">Widget Title:
			<input id="connect_title" name="connect_title" type="text" class="widefat" value="'.$settings['title'].'" /></label></p>';
	echo '<input type="hidden" id="update_connect" name="update_connect" value="1" />';

}

register_sidebar_widget('Woo - Connect', 'connectWidget');
register_widget_control('Woo - Connect', 'connectWidgetAdmin', 400, 200);

// =============================== Social Profiles Widget ======================================

function social_colour( $hexcolour ) {
	
	if ( $hexcolour <> "" ) { echo 'style="background-color:' . $hexcolour . ';"'; }
	
}

class AS_SocialWidget extends WP_Widget {

   function AS_SocialWidget() {
       parent::WP_Widget(false, $name = __('Social Profiles', woothemes));    
   }


   function widget($args, $instance) {        
       extract( $args );
       
       $preset = $instance['preset'];
       $url = $instance['url'];
       $title = $instance['title'];
       $custom_title = $instance['custom'];
       $custom_color = $instance['custom_color'];

       ?>   		

			<li <?php if ( $preset <> "select" ) { echo 'class="' . $preset . '"'; } ?>>
				<a href="<?php echo $url; ?>" title="<?php echo $preset; ?>">
					<span class="button" <?php social_colour( $custom_color ); ?>>&nbsp;</span>
					<span class="text"><?php if ( $custom_title <> "" ) { echo $custom_title; } else { echo ucfirst( $preset ); } ?></span>
				</a>
			</li>

       <?php
   }

   function update($new_instance, $old_instance) {                
       return $new_instance;
   }

   function form($instance) {                
       $preset = esc_attr($instance['preset']);
       $url = esc_attr($instance['url']);
       $title = esc_attr($instance['title']);
       $custom_title = esc_attr($instance['custom']);
       $custom_color = esc_attr($instance['custom_color']);
       ?>
       <p>
       <label for="<?php echo $this->get_field_id('preset'); ?>"><?php _e('Preset:'); ?></label>
       <select name="<?php echo $this->get_field_name('preset'); ?>" class="widefat" id="<?php echo $this->get_field_id('preset'); ?>">
           <option value="select">-- <?php _e('Select Preset',woothemes); ?> --</option>
           <option value="brightkite" <?php if($preset== 'brightkite'){ echo "selected='selected'";} ?>>Brightkite</option>
           <option value="delicious" <?php if($preset== 'delicious'){ echo "selected='selected'";} ?>>Delicious</option>           
           <option value="deviantart" <?php if($preset== 'deviantart'){ echo "selected='selected'";} ?>>DeviantArt</option>           
           <option value="digg" <?php if($preset== 'digg'){ echo "selected='selected'";} ?>>Digg</option>
           <option value="facebook" <?php if($preset== 'facebook'){ echo "selected='selected'";} ?>>Facebook</option>
           <option value="flickr" <?php if($preset== 'flickr'){ echo "selected='selected'";} ?>>Flickr</option>
           <option value="friendfeed" <?php if($preset== 'friendfeed'){ echo "selected='selected'";} ?>>FriendFeed</option>
           <option value="lastfm" <?php if($preset== 'lastfm'){ echo "selected='selected'";} ?>>LastFM</option>
           <option value="linkedin" <?php if($preset == 'linkedin'){ echo "selected='selected'";} ?>>LinkedIn</option>           
           <option value="posterous" <?php if($preset== 'posterous'){ echo "selected='selected'";} ?>>Posterous</option>
           <option value="stumbleupon" <?php if($preset== 'stumbleupon'){ echo "selected='selected'";} ?>>Stumbleupon</option>
           <option value="tumblr" <?php if($preset== 'tumblr'){ echo "selected='selected'";} ?>>Tumblr</option>
           <option value="twitter" <?php if($preset == 'twitter'){ echo "selected='selected'";} ?>>Twitter</option>
           <option value="vimeo" <?php if($preset== 'vimeo'){ echo "selected='selected'";} ?>>Vimeo</option>
           <option value="youtube" <?php if($preset== 'youtube'){ echo "selected='selected'";} ?>>YouTube</option>           
       </select>
       </p>
       <p style="display:none">
       <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?>
       <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php if ( $preset <> "select" ) { echo $preset; } else { echo $custom_title; } ?>" />
       </label>
       </p>     
       <p>
       <label for="<?php echo $this->get_field_id('url'); ?>"><?php _e('URL:'); ?>
       <input class="widefat" id="<?php echo $this->get_field_id('url'); ?>" name="<?php echo $this->get_field_name('url'); ?>" type="text" value="<?php echo $url; ?>" />
       </label>
       </p>
       <p><strong><?php _e('OR specify a custom value',woothemes); ?></strong></p>
       <p>
       <label for="<?php echo $this->get_field_id('custom'); ?>"><?php _e('Custom Title:'); ?>
       <input class="widefat" id="<?php echo $this->get_field_id('custom'); ?>" name="<?php echo $this->get_field_name('custom'); ?>" type="text" value="<?php echo $custom_title; ?>" />
       </label>
       </p>       
       <p>
       <label for="<?php echo $this->get_field_id('custom_color'); ?>"><?php _e('Custom Color:'); ?>
       <input class="widefat" id="<?php echo $this->get_field_id('custom_color'); ?>" name="<?php echo $this->get_field_name('custom_color'); ?>" type="text" value="<?php echo $custom_color; ?>" />
       </label>
       </p>
       <?php 
   }

} 

register_widget('AS_SocialWidget');

// =============================== Recent Comments Widget ======================================
function CommentsWidget()
{
	$settings = get_option("widget_commentswidget");

	$number = $settings['number'];
	if ( $number == "" ) { $number = 3; }

?>

				<div id="comment-widget" class="widget">
				
					<h3><?php _e('Recent Comments',woothemes); ?></h3>
				
					<ul>
					
						<?php include( TEMPLATEPATH . '/includes/comments.php' ); ?>
					
					</ul>
				
				</div><!-- /.widget -->

<?php
}

function CommentsWidgetAdmin() {

	$settings = get_option("widget_commentswidget");

	// check if anything's been sent
	if (isset($_POST['update_comments'])) {
		$settings['number'] = strip_tags(stripslashes($_POST['comments_number']));	

		update_option("widget_commentswidget",$settings);
	}
			
	echo '<p>
			<label for="comments_number">Number of Comments:
			<input id="comments_number" name="comments_number" type="text" class="widefat" value="'.$settings['number'].'" /></label></p>';
	echo '<input type="hidden" id="update_comments" name="update_comments" value="1" />';

}

register_sidebar_widget('Woo - Recent Comments (Footer 3)', 'CommentsWidget');
register_widget_control('Woo - Recent Comments (Footer 3)', 'CommentsWidgetAdmin', 400, 200);

// =============================== Categories Widget ======================================

function CategoriesWidget()
{
	$settings = get_option("widget_categorieswidget");

	$exclude = $settings['exclude'];

?>

				<div id="list-widget" class="widget">
				
					<h3><?php _e('Categories',woothemes); ?></h3>
					
					 <?php $categories = get_categories('pad_counts=1&exclude=' . $exclude); ?>
				
					<ul>
						<?php foreach ( $categories as $cat ) { ?>
							<li><a href="<?php echo get_category_link( $cat->cat_ID ); ?> " title="<?php _e('Archive for',woothemes); ?> <?php echo $cat->cat_name; ?>"><span class="count"><?php echo $cat->category_count; ?></span><span class="name"><?php echo $cat->cat_name; ?></span></a></li>
						<?php } ?>
					</ul>
				
				</div><!-- /.widget -->

<?php
}

function categoriesWidgetAdmin() {

	$settings = get_option("widget_categorieswidget");

	// check if anything's been sent
	if (isset($_POST['update_categories'])) {
		$settings['exclude'] = strip_tags(stripslashes($_POST['categories_exclude']));	

		update_option("widget_categorieswidget",$settings);
	}
			
	echo '<p>
			<label for="categories_exclude">Category IDs to exclude:
			<input id="categories_exclude" name="categories_exclude" type="text" class="widefat" value="'.$settings['exclude'].'" /></label></p>';
	echo '<input type="hidden" id="update_categories" name="update_categories" value="1" />';

}

register_sidebar_widget('Woo - Categories (Footer)', 'CategoriesWidget');
register_widget_control('Woo - Categories (Footer)', 'CategoriesWidgetAdmin', 400, 200);

// =============================== Flickr widget ======================================
function flickrWidget()
{
	$settings = get_option("widget_flickrwidget");

	$id = $settings['id'];
	$number = $settings['number'];

?>

<div id="flickr" class="widget">
	<h3 class="widget_title"><?php _e('Photos on <span>flick<span>r</span></span>', 'woothemes') ?></h3>
	<div class="wrap">
		<div class="fix"></div>
		<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $number; ?>&amp;display=latest&amp;size=s&amp;layout=x&amp;source=user&amp;user=<?php echo $id; ?>"></script>        
		<div class="fix"></div>
	</div>
</div>

<?php
}

function flickrWidgetAdmin() {

	$settings = get_option("widget_flickrwidget");

	// check if anything's been sent
	if (isset($_POST['update_flickr'])) {
		$settings['id'] = strip_tags(stripslashes($_POST['flickr_id']));
		$settings['number'] = strip_tags(stripslashes($_POST['flickr_number']));

		update_option("widget_flickrwidget",$settings);
	}

	echo '<p>
			<label for="flickr_id">Flickr ID (<a href="http://www.idgettr.com">idGettr</a>):
			<input id="flickr_id" name="flickr_id" type="text" class="widefat" value="'.$settings['id'].'" /></label></p>';
	echo '<p>
			<label for="flickr_number">Number of photos:
			<input id="flickr_number" name="flickr_number" type="text" class="widefat" value="'.$settings['number'].'" /></label></p>';
	echo '<input type="hidden" id="update_flickr" name="update_flickr" value="1" />';

}

register_sidebar_widget('Woo - Flickr', 'flickrWidget');
register_widget_control('Woo - Flickr', 'flickrWidgetAdmin', 400, 200);


// =============================== Ad 125x125 widget ======================================
function adsWidget()
{
$settings = get_option("widget_adswidget");
$number = $settings['number'];
if ($number == 0) $number = 1;
$img_url = array();
$dest_url = array();

$numbers = range(1,$number); 
$counter = 0;

if (get_option('woo_ads_rotate') == 'true') {
	shuffle($numbers);
}
?>
<div id="ads" class="widget">

<h3><?php _e('Sponsors',woothemes); ?></h3>

<?php
	foreach ($numbers as $number) {	
		$counter++;
		$img_url[$counter] = get_option('woo_ad_image_'.$number);
		$dest_url[$counter] = get_option('woo_ad_url_'.$number);
	
?>
        <a href="<?php echo "$dest_url[$counter]"; ?>"><img src="<?php echo "$img_url[$counter]"; ?>" alt="Ad" /></a>
<?php } ?>

<div class="clear"></div>

</div><!-- /#ads -->
<?php

}
register_sidebar_widget('Woo - Ads 125x125', 'adsWidget');

function adsWidgetAdmin() {

	$settings = get_option("widget_adswidget");

	// check if anything's been sent
	if (isset($_POST['update_ads'])) {
		$settings['number'] = strip_tags(stripslashes($_POST['ads_number']));

		update_option("widget_adswidget",$settings);
	}

	echo '<p>
			<label for="ads_number">Number of ads (1-4):
			<input id="ads_number" name="ads_number" type="text" class="widefat" value="'.$settings['number'].'" /></label></p>';
	echo '<input type="hidden" id="update_ads" name="update_ads" value="1" />';

}
register_widget_control('Woo - Ads 125x125', 'adsWidgetAdmin', 200, 200);

// =============================== Search widget ======================================
function searchWidget()
{
include(TEMPLATEPATH . '/search-form.php');
}
register_sidebar_widget('Woo - Search', 'SearchWidget');


// =============================== CampaignMonitor Subscribe widget ===================

class woo_CampaignMonitorWidget extends WP_Widget {
	function woo_CampaignMonitorWidget() {
		$widget_ops = array('classname' => 'widget_campaign_monitor', 'description' => 'Add a Campaign Monitor subscription form' );
		$this->WP_Widget('campaign_monitor', 'Woo - Campaign Monitor', $widget_ops);
	}

	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		echo $before_widget;
		$title = empty($instance['title']) ? 'Subscribe Now' : apply_filters('widget_title', $instance['title']);
		$action = empty($instance['action']) ? '#' : apply_filters('widget_action', $instance['action']);
		$id = empty($instance['id']) ? '' : apply_filters('widget_id', $instance['id']);

		echo '<div id="campaignmonitor" class="widget">';
		echo '<h3>'.$title.'</h3>';
		echo '<form name="campaignmonitorform" id="campaignmonitorform" action="'.$action.'" method="post">';
		echo '<input type="text" name="cm-'.$id.'" id="'.$id.'" class="field" value="Enter your e-mail address" onfocus="if (this.value == \'Enter your e-mail address\') {this.value = \'\';}" onblur="if (this.value == \'\') {this.value = \'Enter your e-mail address\';}" />';
		echo '<input id="newsletter-submit" class="submit" type="submit" name="submit" value="Submit" />';
		echo '</form>';
		echo '</div><!-- /campaignmonitor -->';
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['action'] = $new_instance['action'];
		$instance['id'] = strip_tags($new_instance['id']);
		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'action' => '', 'id' => '' ) );
		$title = strip_tags($instance['title']);
		$action = $instance['action'];
		$id = strip_tags($instance['id']);
?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('action'); ?>">Form Action: <input class="widefat" id="<?php echo $this->get_field_id('action'); ?>" name="<?php echo $this->get_field_name('action'); ?>" type="text" value="<?php echo attribute_escape($action); ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('id'); ?>">Campaign Monitor ID: <input class="widefat" id="<?php echo $this->get_field_id('id'); ?>" name="<?php echo $this->get_field_name('id'); ?>" type="text" value="<?php echo attribute_escape($id); ?>" /></label></p>
<?php
	}
}
register_widget('woo_CampaignMonitorWidget');

// =============================== Featured widget ======================================
function featuredWidget()
{
	$settings = get_option("widget_featured");

	$title = $settings['title'];
	$tag = $settings['tag'];
	$number = $settings['number'];

?>

<div class="widget" id="featured">
    <h3><?php echo $title; ?></h3>

	<?php query_posts('tag=' . $tag . '&showposts=' . $number); ?>
        
    <?php if (have_posts()) : ?>

    <ul>

	    <?php while (have_posts()) : the_post(); $preview = get_post_meta($post->ID, 'preview', true); ?>				

        <li>
        <a href="<?php the_permalink() ?>"><?php the_title(); ?></a><br />
        <span class="post-meta"><?php _e('by', 'woothemes'); ?> <?php the_author(); ?> <?php _e('on', 'woothemes'); ?> <?php the_time('M. j, Y'); ?></span>
        </li>

        <?php endwhile; ?>

    </ul>

    <?php endif; ?>							

</div>

<?php
}

function featuredWidgetAdmin() {

	$settings = get_option("widget_featured");

	// check if anything's been sent
	if (isset($_POST['update_featured'])) {
		$settings['title'] = strip_tags(stripslashes($_POST['featured_title']));
		$settings['tag'] = strip_tags(stripslashes($_POST['featured_tag']));
		$settings['number'] = strip_tags(stripslashes($_POST['featured_number']));

		update_option("widget_featured",$settings);
	}

	echo '<p>
			<label for="featured_title">Title:
			<input id="featured_title" name="featured_title" type="text" class="widefat" value="'.$settings['title'].'" /></label></p>';			
	echo '<p>
			<label for="featured_tag">Tag:
			<input id="featured_tag" name="featured_tag" type="text" class="widefat" value="'.$settings['tag'].'" /></label></p>';			
	echo '<p>
			<label for="featured_number">Number of posts:
			<input id="featured_number" name="featured_number" type="text" class="widefat" value="'.$settings['number'].'" /></label></p>';						
	echo '<input type="hidden" id="update_featured" name="update_featured" value="1" />';

}

register_sidebar_widget('Woo - Featured', 'featuredWidget');
register_widget_control('Woo - Featured', 'featuredWidgetAdmin', 400, 200);



/* Deregister Default Widgets */

/*
function woo_deregister_widgets(){
    unregister_widget('WP_Widget_Search');         
}
add_action('widgets_init', 'woo_deregister_widgets');  
*/

?>