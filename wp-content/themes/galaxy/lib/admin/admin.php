<?php
/**
 * Theme administration functions.
 *
 * @package Galaxy
 * @subpackage Admin
 */

class GalaxyAdmin {
		
		/** Constructor Method */
		function __construct() {
	
			/** Load the admin_init functions. */
			add_action( 'admin_init', array( &$this, 'admin_init' ) );
			
			/* Hook the settings page function to 'admin_menu'. */
			add_action( 'admin_menu', array( &$this, 'settings_page_init' ) );		
	
		}
		
		/** Initializes any admin-related features needed for the framework. */
		function admin_init() {
			
			/** Registers admin JavaScript and Stylesheet files for the framework. */
			add_action( 'admin_enqueue_scripts', array( &$this, 'admin_register_scripts' ), 1 );
		
			/** Loads admin JavaScript and Stylesheet files for the framework. */
			add_action( 'admin_enqueue_scripts', array( &$this, 'admin_enqueue_scripts' ) );
			
		}
		
		/** Registers admin JavaScript and Stylesheet files for the framework. */
		function admin_register_scripts() {
			
			/** Register Admin Stylesheet */
			wp_register_style( 'galaxy-admin-css-style', esc_url( trailingslashit( GALAXY_ADMIN_URI ) . 'style.css' ) );
			wp_register_style( 'galaxy-admin-css-ui-smoothness', esc_url( trailingslashit( GALAXY_JS_URI ) . 'ui/css/smoothness/jquery-ui-1.8.18.custom.css' ) );
			
			/** Register Admin Scripts */
			wp_register_script( 'galaxy-admin-js-galaxy', esc_url( trailingslashit( GALAXY_ADMIN_URI ) . 'galaxy.js' ), array( 'jquery-ui-tabs' ) );
			wp_register_script( 'galaxy-admin-js-jquery-cookie', esc_url( trailingslashit( GALAXY_JS_URI ) . 'jquery.cookie.js' ), array( 'jquery' ) );
			
		}
		
		/** Loads admin JavaScript and Stylesheet files for the framework. */
		function admin_enqueue_scripts() {			
		}
		
		/** Initializes all the theme settings page functionality. This function is used to create the theme settings page */
		function settings_page_init() {
			
			global $galaxy;
			
			/** Register theme settings. */
			register_setting( 'galaxy_options_group', 'galaxy_options', array( &$this, 'galaxy_options_validate' ) );
			
			/* Create the theme settings page. */
			$galaxy->settings_page = add_theme_page( 
				esc_html( __( 'Galaxy Options', 'galaxy' ) ),	/** Settings page name. */
				esc_html( __( 'Galaxy Options', 'galaxy' ) ),	/** Menu item name. */
				$this->settings_page_capability(),				/** Required capability */
				'galaxy-options', 								/** Screen name */
				array( &$this, 'settings_page' )				/** Callback function */
			);
			
			/* Check if the settings page is being shown before running any functions for it. */
			if ( !empty( $galaxy->settings_page ) ) {
				
				/** Add contextual help to the theme settings page. */
				add_action( 'load-'. $galaxy->settings_page, array( &$this, 'settings_page_contextual_help' ) );
				
				/* Load the JavaScript and stylesheets needed for the theme settings screen. */
				add_action( 'admin_enqueue_scripts', array( &$this, 'settings_page_enqueue_scripts' ) );
				
				/** Configure settings Sections and Fileds. */
				$this->settings_sections();
				
				/** Configure default settings. */
				$this->settings_default();				
				
			}
			
		}
		
		/** Returns the required capability for viewing and saving theme settings. */
		function settings_page_capability() {
			return 'edit_theme_options';
		}
		
		/** Displays the theme settings page. */
		function settings_page() {
			require( trailingslashit( GALAXY_ADMIN_DIR ) . 'page.php' );
		}
		
		/** Text for the contextual help for the theme settings page in the admin. */
		function settings_page_contextual_help() {
			
			/** Get the parent theme data. */
			$theme = galaxy_theme_data();
			$AuthorURI = $theme['AuthorURI'];
			$ThemeURI = $theme['ThemeURI'];
		
			/** Get the current screen */
			$screen = get_current_screen();
			
			/** Help Tab */
			$screen->add_help_tab( array(
				
				'id' => 'theme-settings-support',
				'title' => __( 'Theme Support', 'galaxy' ),
				'content' => implode( '', file( trailingslashit( GALAXY_ADMIN_DIR ) . 'help/support.html' ) ),				
				
				)
			);
			
			/** Help Sidebar */
			$sidebar = '<p><strong>' . __( 'For more information:', 'galaxy' ) . '</strong></p>';
			if ( !empty( $AuthorURI ) ) {
				$sidebar .= '<p><a href="' . esc_url( $AuthorURI ) . '" target="_blank">' . __( 'Galaxy Project', 'galaxy' ) . '</a></p>';
			}
			if ( !empty( $ThemeURI ) ) {
				$sidebar .= '<p><a href="' . esc_url( $ThemeURI ) . '" target="_blank">' . __( 'Galaxy Official Page', 'galaxy' ) . '</a></p>';
			}			
			$screen->set_help_sidebar( $sidebar );
			
		}
		
		/** Loads admin JavaScript and Stylesheet files for displaying the theme settings page in the WordPress admin. */
		function settings_page_enqueue_scripts( $hook ) {
			
			/** Load Scripts For Galaxy Options Page */
			if( $hook === 'appearance_page_galaxy-options' ) {
				
				/** Load Admin Stylesheet */
				wp_enqueue_style( 'galaxy-admin-css-style' );
				wp_enqueue_style( 'galaxy-admin-css-ui-smoothness' );
				
				/** Load Admin Scripts */
				wp_enqueue_script( 'galaxy-admin-js-galaxy' );
				wp_enqueue_script( 'galaxy-admin-js-jquery-cookie' );
				
			}
				
		}
		
		/** Configure settings Sections and Fileds */		
		function settings_sections() {
		
			/** Blog Section */
			add_settings_section( 'galaxy_section_blog', 'Blog Options', array( &$this, 'galaxy_section_blog_fn' ), 'galaxy_section_blog_page' );			
			
			add_settings_field( 'galaxy_field_post_style', __( 'Post Style', 'galaxy' ), array( &$this, 'galaxy_field_post_style_fn' ), 'galaxy_section_blog_page', 'galaxy_section_blog' );
			add_settings_field( 'galaxy_field_post_nav_style', __( 'Post Navigation Style', 'galaxy' ), array( &$this, 'galaxy_field_post_nav_style_fn' ), 'galaxy_section_blog_page', 'galaxy_section_blog' );
			
			/** General Section */
			add_settings_section( 'galaxy_section_general', 'General Options', array( &$this, 'galaxy_section_general_fn' ), 'galaxy_section_general_page' );
			
			add_settings_field( 'galaxy_field_analytic', __( 'Use Analytic', 'galaxy' ), array( &$this, 'galaxy_field_analytic_fn' ), 'galaxy_section_general_page', 'galaxy_section_general' );
			add_settings_field( 'galaxy_field_analytic_code', __( 'Enter Analytic Code', 'galaxy' ), array( &$this, 'galaxy_field_analytic_code_fn' ), 'galaxy_section_general_page', 'galaxy_section_general' );
			add_settings_field( 'galaxy_field_copyright', __( 'Enter Copyright Text', 'galaxy' ), array( &$this, 'galaxy_field_copyright_fn' ), 'galaxy_section_general_page', 'galaxy_section_general' );
			add_settings_field('galaxy_field_reset', __( 'Reset Theme Options', 'galaxy' ), array( &$this, 'galaxy_field_reset_fn' ), 'galaxy_section_general_page', 'galaxy_section_general' );
		
		}
		
		/** Configure default settings. */		
		function settings_default() {
			global $galaxy;
			
			$galaxy_reset = false;
			$galaxy_options = galaxy_get_settings();
			
			/** Galaxy Reset Logic */
			if ( !is_array( $galaxy_options ) ) {			
				$galaxy_reset = true;			
			} 						
			elseif ( $galaxy_options['galaxy_reset'] == 1 ) {			
				$galaxy_reset = true;			
			}			
			
			/** Let Reset Galaxy */
			if( $galaxy_reset == true ) {
				
				$default = array(
					
					'galaxy_post_style' => 'content',
					'galaxy_post_nav_style' => 'numeric',
					
					'galaxy_analytic' => 0,
					'galaxy_analytic_code' => 'Analytic Code',
					
					'galaxy_copyright' => '&copy; Copyright '. date( 'Y' ) .' - <a href="'. home_url( '/' ) .'">'. get_bloginfo( 'name' ) .'</a>',
					
					'galaxy_reset' => 0,
					
				);
				
				update_option( 'galaxy_options' , $default );
			
			}
		
		}
		
		/** Galaxy Pre-defined Range */
		
		/* Boolean Yes | No */		
		function galaxy_pd_boolean() {			
			return array( 1 => __( 'yes', 'galaxy' ), 0 => __( 'no', 'galaxy' ) );		
		}
		
		/* Post Style Range */		
		function galaxy_pd_post_style() {			
			return array( 'content' => __( 'Content', 'galaxy' ), 'excerpt' => __( 'Excerpt (Magazine Style)', 'galaxy' ) );			
		}
		
		/* Post Navigation Style Range */		
		function galaxy_pd_post_nav_style() {			
			return array( 'numeric' => __( 'Numeric', 'galaxy' ), 'older-newer' => __( 'Older / Newer', 'galaxy' ) );			
		}
		
		/** Galaxy Options Validation */				
		function galaxy_options_validate( $input ) {
			
			/* Validation: galaxy_post_style */
			$galaxy_pd_post_style = $this->galaxy_pd_post_style();
			if ( ! array_key_exists( $input['galaxy_post_style'], $galaxy_pd_post_style ) ) {
				 $input['galaxy_post_style'] = 'excerpt';
			}
			
			/* Validation: galaxy_post_nav_style */
			$galaxy_pd_post_nav_style = $this->galaxy_pd_post_nav_style();
			if ( ! array_key_exists( $input['galaxy_post_nav_style'], $galaxy_pd_post_nav_style ) ) {
				 $input['galaxy_post_nav_style'] = 'numeric';
			}								
			
			/* Validation: galaxy_analytic */
			$galaxy_pd_boolean = $this->galaxy_pd_boolean();
			if ( ! array_key_exists( $input['galaxy_analytic'], $galaxy_pd_boolean ) ) {
				 $input['galaxy_analytic'] = 0;
			}
			
			/* Validation: galaxy_analytic_code */
			if( !empty( $input['galaxy_analytic_code'] ) ) {
				$input['galaxy_analytic_code'] = htmlspecialchars ( $input['galaxy_analytic_code'] );
			}
			
			/* Validation: galaxy_copyright */
			if( !empty( $input['galaxy_copyright'] ) ) {
				$input['galaxy_copyright'] = esc_html ( $input['galaxy_copyright'] );
			}
			
			/* Validation: galaxy_reset */
			$galaxy_pd_boolean = $this->galaxy_pd_boolean();
			//if ( ! array_key_exists( galaxy_undefined_index_fix ( $input['galaxy_reset'] ), $galaxy_pd_boolean ) ) {
			if ( ! array_key_exists( $input['galaxy_reset'], $galaxy_pd_boolean ) ) {
				 $input['galaxy_reset'] = 0;
			}
			
			add_settings_error( 'galaxy_options', 'galaxy_options', __( 'Settings Saved.', 'galaxy' ), 'updated' );
			
			return $input;
		
		}
		
		/** Blog Section Callback */				
		function galaxy_section_blog_fn() {
			_e( 'Galaxy Blog Options', 'galaxy' );
		}
		
		/* Post Style Callback */		
		function galaxy_field_post_style_fn() {
			
			$galaxy_options = get_option('galaxy_options');
			$items = $this->galaxy_pd_post_style();			
			
			foreach( $items as $key => $val ) {
			?>
            <label><input type="radio" id="galaxy_post_style[]" name="galaxy_options[galaxy_post_style]" value="<?php echo $key; ?>" <?php checked( $key, $galaxy_options['galaxy_post_style'] ); ?> /> <?php echo $val; ?></label><br />
            <?php
			}		
		
		}
		
		/* Post Style Navigaiton Callback */		
		function galaxy_field_post_nav_style_fn() {
			
			$galaxy_options = get_option('galaxy_options');
			$items = $this->galaxy_pd_post_nav_style();			
			
			foreach( $items as $key => $val ) {
			?>
            <label><input type="radio" id="galaxy_post_nav_style[]" name="galaxy_options[galaxy_post_nav_style]" value="<?php echo $key; ?>" <?php checked( $key, $galaxy_options['galaxy_post_nav_style'] ); ?> /> <?php echo $val; ?></label><br />
            <?php
			}
		
		}
		
		/** General Section Callback */				
		function galaxy_section_general_fn() {
			_e( 'Galaxy General Options', 'galaxy' );
		}
		
		/* Analytic Callback */		
		function  galaxy_field_analytic_fn() {
			
			$galaxy_options = get_option( 'galaxy_options' );
			$items = $this->galaxy_pd_boolean();
			
			echo '<select id="galaxy_analytic" name="galaxy_options[galaxy_analytic]">';
			foreach( $items as $key => $val ) {
			?>
            <option value="<?php echo $key; ?>" <?php selected( $key, $galaxy_options['galaxy_analytic'] ); ?>><?php echo $val; ?></option>
            <?php
			}
			echo '</select>';
			echo '<div><small>'. __( 'Select yes to add your Analytic code.', 'galaxy' ) .'</small></div>';
		
		}
		
		function galaxy_field_analytic_code_fn() {
			
			$galaxy_options = get_option('galaxy_options');
			echo '<textarea type="textarea" id="galaxy_analytic_code" name="galaxy_options[galaxy_analytic_code]" rows="7" cols="50">'. htmlspecialchars_decode ( $galaxy_options['galaxy_analytic_code'] ) .'</textarea>';
			echo '<div><small>'. __( 'Enter the Analytic code.', 'galaxy' ) .'</small></div>';
		
		}
		
		/* Copyright Text Callback */		
		function galaxy_field_copyright_fn() {
			
			$galaxy_options = get_option('galaxy_options');
			echo '<textarea type="textarea" id="galaxy_copyright" name="galaxy_options[galaxy_copyright]" rows="7" cols="50">'. esc_html ( $galaxy_options['galaxy_copyright'] ) .'</textarea>';
			echo '<div><small>'. __( 'Enter Copyright Text.', 'galaxy' ) .'</small></div>';
			echo '<div><small>Example: <strong>&amp;copy; Copyright '.date('Y').' - &lt;a href="'. home_url( '/' ) .'"&gt;'. get_bloginfo('name') .'&lt;/a&gt;</strong></small></div>';
		
		}		
		
		/* Theme Reset Callback */		
		function galaxy_field_reset_fn() {
			
			$galaxy_options = get_option('galaxy_options');			
			$items = $this->galaxy_pd_boolean();			
			echo '<label><input type="checkbox" id="galaxy_reset" name="galaxy_options[galaxy_reset]" value="1" /> '. __( 'Reset Theme Options.', 'galaxy' ) .'</label>';
		
		}
}

/** Initiate Admin */
new GalaxyAdmin();
?>