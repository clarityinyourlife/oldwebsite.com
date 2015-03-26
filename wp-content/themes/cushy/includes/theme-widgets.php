<?php
class Woo_Widget_Ads extends WP_Widget {

	/*----------------------------------------
	  Constructor.
	  ----------------------------------------
	  
	  * The constructor. Sets up the widget.
	----------------------------------------*/
	
	function Woo_Widget_Ads () {
		
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'adspace-widget', 'description' => __( 'Use this widget to display adverts in your sidebars.', 'woothemes' ) );

		/* Widget control settings. */
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'adspace-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'adspace-widget', __('Woo - Ads 125x125', 'woothemes' ), $widget_ops, $control_ops );
		
	} // End Constructor
	
	/*----------------------------------------
	  widget()
	  ----------------------------------------
	  
	  * Displays the widget on the frontend.
	----------------------------------------*/

	function widget( $args, $instance ) {  
		
		$html = '';
		
		extract( $args, EXTR_SKIP );
		
		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'], $instance, $this->id_base );
		
		$number = $instance['ads_number'];
		
		/* Widget content. */
		
		// Add actions for plugins/themes to hook onto.
		do_action( 'widget_woo_ads_top' );
		
		$img_url = array();
		$dest_url = array();
		
		$numbers = range(1,$number); 
		$counter = 0;
		
		if ( get_option('woo_ads_rotate') == 'true' ) {
			shuffle($numbers);
		}
		?>
		<div id="ads">
		<?php
			foreach ($numbers as $number) {	
				$counter++;
				$img_url[$counter] = get_option('woo_ad_image_'.$number);
				$dest_url[$counter] = get_option('woo_ad_url_'.$number);
			
		?>
		        <a href="<?php echo "$dest_url[$counter]"; ?>"><img src="<?php echo "$img_url[$counter]"; ?>" alt="Ad" /></a>
		<?php } ?>
		</div>
		<!--/ads -->
		<?php
		// Add actions for plugins/themes to hook onto.
		do_action( 'widget_woo_ads_bottom' );

	} // End widget()
	
	/*----------------------------------------
	  update()
	  ----------------------------------------
	  
	  * Function to update the settings from
	  * the form() function.
	  
	  * Params:
	  * - Array $new_instance
	  * - Array $old_instance
	----------------------------------------*/
	
	function update ( $new_instance, $old_instance ) {
		
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		// $instance['title'] = strip_tags( $new_instance['title'] );
		$instance['ads_number'] = esc_attr( $new_instance['ads_number'] );

		return $instance;
		
	} // End update()
	
	/*----------------------------------------
	  form()
	  ----------------------------------------
	  
	  * The form on the widget control in the
	  * widget administration area.
	  
	  * Make use of the get_field_id() and 
	  * get_field_name() function when creating
	  * your form elements. This handles the confusing stuff.
	  
	  * Params:
	  * - Array $instance
	----------------------------------------*/

	function form ( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => __( 'Adverts', 'woothemes' ), 'ads_number' => 1 );
		$instance = wp_parse_args( (array) $instance, $defaults );
		       
		$instance = wp_parse_args( $instance, array_fill_keys( array( 'title', 'ads_number' ), '' ) );
		
		/* Make the ad code read-only if the user can't work with unfiltered HTML. */
		$read_only = '';
		if ( ! current_user_can( 'unfiltered_html' ) ) { $read_only = ' readonly="readonly"'; }
?>
        <!-- Widget Number of Ads: Text Input -->
        <p>
            <label for="<?php echo $this->get_field_id( 'ads_number' ); ?>"><?php _e( 'Number of Ads (1 - 4):', 'woothemes' ); ?></label>
            <select name="<?php echo $this->get_field_name( 'ads_number' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'ads_number' ); ?>">
            <?php
            	$html = '';
            	for ( $i = 1; $i <= 4; $i++ ) {
            	
            		$html .= '<option value="' . $i . '"' . selected( $i, $instance['ads_number'] ) . '>' . $i . '</option>' . "\n";
            	
            	}
            	echo $html;
            ?>
            </select>
        </p>
<?php
	} // End form()

} // End Class

/*----------------------------------------
  Register the widget on `widgets_init`.
  ----------------------------------------
  
  * Registers this widget.
----------------------------------------*/

add_action( 'widgets_init', create_function( '', 'return register_widget("Woo_Widget_Ads");' ), 1 );

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
		echo '<h3>'.__('Twitter Updates',woothemes).'</h3>';              
		echo '<ul id="twitter_update_list"><li></li></ul>
		      <script type="text/javascript" src="http://twitter.com/javascripts/blogger.js"></script>';
		echo '<script type="text/javascript" src="http://twitter.com/statuses/user_timeline/'.$account.'.json?callback=twitterCallback2&amp;count='.$show.'"></script>';


		// echo widget closing tag
		echo $after_widget;
	}

	// Settings form
	function widget_Twidget_control() {

		// Get options
		$options = get_option('widget_Twidget');
		// options exist? if not set defaults
		if ( !is_array($options) )
			$options = array('account'=>'woothemes', 'title'=>'Twitter Updates', 'show'=>'5');

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
	register_sidebar_widget(array('Woo - Twitter', 'widgets'), 'widget_Twidget');

	// Register settings for use, 300x200 pixel form
	register_widget_control(array('Woo - Twitter', 'widgets'), 'widget_Twidget_control', 300, 200);
}

// Run code and init
add_action('widgets_init', 'widget_Twidget_init');


?>