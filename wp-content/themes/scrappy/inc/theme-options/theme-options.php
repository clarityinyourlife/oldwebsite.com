<?php
/**
 * Scrappy Theme Options
 *
 * @package Scrappy
 * @since Scrappy 1.3
 */

/**
 * Register the form setting for our scrappy_options array.
 *
 * This function is attached to the admin_init action hook.
 *
 * This call to register_setting() registers a validation callback, scrappy_theme_options_validate(),
 * which is used when the option is saved, to ensure that our option values are complete, properly
 * formatted, and safe.
 *
 * We also use this function to add our theme option if it doesn't already exist.
 *
 * @since Scrappy 1.3
 */
function scrappy_theme_options_init() {

	// If we have no options in the database, let's add them now.
	if ( false === scrappy_get_theme_options() )
		add_option( 'scrappy_theme_options', scrappy_get_default_theme_options() );

	register_setting(
		'scrappy_options',       // Options group, see settings_fields() call in scrappy_theme_options_render_page()
		'scrappy_theme_options', // Database option, see scrappy_get_theme_options()
		'scrappy_theme_options_validate' // The sanitization callback, see scrappy_theme_options_validate()
	);

	// Register our settings field group
	add_settings_section(
		'general', // Unique identifier for the settings section
		'', // Section title (we don't want one)
		'__return_false', // Section callback (we don't want anything)
		'theme_options' // Menu slug, used to uniquely identify the page; see scrappy_theme_options_add_page()
	);

	// Register our individual settings fields
	add_settings_field( 'theme_styles', __( 'Header Pattern', 'scrappy' ), 'scrappy_settings_field_theme_styles', 'theme_options', 'general' );

	add_settings_field(
		'support', // Unique identifier for the field for this section
		__( 'Support Caroline Themes', 'scrappy' ), // Setting field label
		'scrappy_settings_field_support', // Function that renders the settings field
		'theme_options', // Menu slug, used to uniquely identify the page; see scrappy_theme_options_add_page()
		'general' // Settings section. Same as the first argument in the add_settings_section() above
	);

}
add_action( 'admin_init', 'scrappy_theme_options_init' );

/**
 * Change the capability required to save the 'scrappy_options' options group.
 *
 * @see scrappy_theme_options_init() First parameter to register_setting() is the name of the options group.
 * @see scrappy_theme_options_add_page() The edit_theme_options capability is used for viewing the page.
 *
 * @param string $capability The capability used for the page, which is manage_options by default.
 * @return string The capability to actually use.
 */
function scrappy_option_page_capability( $capability ) {
	return 'edit_theme_options';
}
add_filter( 'option_page_capability_scrappy_options', 'scrappy_option_page_capability' );

/**
 * Add our theme options page to the admin menu.
 *
 * This function is attached to the admin_menu action hook.
 *
 * @since Scrappy 1.3
 */
function scrappy_theme_options_add_page() {
	$theme_page = add_theme_page(
		__( 'Theme Options', 'scrappy' ),   // Name of page
		__( 'Theme Options', 'scrappy' ),   // Label in menu
		'edit_theme_options',                    // Capability required
		'theme_options',                         // Menu slug, used to uniquely identify the page
		'scrappy_theme_options_render_page' // Function that renders the options page
	);
}
add_action( 'admin_menu', 'scrappy_theme_options_add_page' );

/**
 * Returns an array of theme options registered for Scrappy.
 *
 * @since Scrappy 1.3
 */
function scrappy_theme_styles() {
	$theme_styles = array(
		'stripes' => array(
			'value' => 'stripes',
			'label' => __( 'Stripes', 'scrappy' )
		),
		'polkadots' => array(
			'value' => 'polkadots',
			'label' => __( 'Polkadots', 'scrappy' )
		),
		'swirls' => array(
			'value' => 'swirls',
			'label' => __( 'Swirls', 'scrappy' )
		),
		'letters' => array(
			'value' => 'letters',
			'label' => __( 'Letters', 'scrappy' )
		),
		'madras' => array(
			'value' => 'madras',
			'label' => __( 'Madras', 'scrappy' )
		),
		'flowers' => array(
			'value' => 'flowers',
			'label' => __( 'Flowers', 'scrappy' )
		)
	);

	return apply_filters( 'scrappy_theme_styles', $theme_styles );
}

/**
 * Returns the default options for Scrappy.
 *
 * @since Scrappy 1.3
 */
function scrappy_get_default_theme_options() {
	$default_theme_options = array(
		'support' => 'off',
		'theme_styles' => 'stripes',
	);

	return apply_filters( 'scrappy_default_theme_options', $default_theme_options );
}

/**
 * Returns the options array for Scrappy.
 *
 * @since Scrappy 1.3
 */
function scrappy_get_theme_options() {
	return get_option( 'scrappy_theme_options', scrappy_get_default_theme_options() );
}

/**
 * Renders the Support setting field.
 */
function scrappy_settings_field_support() {
	$options = scrappy_get_theme_options();

	if ( $options['support'] !== 'on' || !isset( $options['support'] ) ) {

	?>
	<label for"scrappy-support">
		<a href="<?php echo esc_url( 'https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=6G3NYZ5EN28EY' ); ?>" target="_blank">
			<img src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" alt="PayPal - The safer, easier way to pay online!" class="alignright">
		</a>
		<?php _e( 'If you enjoy my themes, please consider making a secure donation using the PayPal button to your right. Anything is appreciated!', 'scrappy' ); ?>

		<br /><input type="checkbox" name="scrappy_theme_options[support]" id="support" <?php checked( 'on', $options['support'] ); ?> />
		<label class="description" for="support">
			<?php _e( 'No, thank you! Dismiss this message.', 'scrappy' ); ?>
		</label>
	</label>
	<?php
	}
	else { ?>
		<label class="description" for="support">
			<?php _e( 'Hide Donate Button', 'scrappy' ); ?>
		</label>
		<input type="checkbox" name="scrappy_theme_options[support]" id="support" <?php checked( 'on', $options['support'] ); ?> />

	</td>

	<?php
	}

}

/**
 * Renders the theme style setting field.
 *
 * @since Scrappy 1.3
 */
function scrappy_settings_field_theme_styles() {
	$options = scrappy_get_theme_options();

	foreach ( scrappy_theme_styles() as $button ) {
	?>
	<div class="layout">
		<label class="description">
			<input type="radio" name="scrappy_theme_options[theme_styles]" value="<?php echo esc_attr( $button['value'] ); ?>" <?php checked( $options['theme_styles'], $button['value'] ); ?> />
			<img src="<?php echo get_template_directory_uri(); ?>/img/<?php echo $button['value']; ?>.gif" alt="<?php echo $button['label']; ?>" title="<?php echo $button['label']; ?>" />
		</label>
	</div>
	<?php
	}
}

/**
 * Theme Options Admin Styles
*/

function scrappy_theme_options_admin_styles() {
	echo "<style type='text/css'>";
	echo ".layout .description img { width: 900px; margin-bottom: 10px; padding: 10px; height: auto; max-height: 50px; }";
	echo "</style>";
}

add_action( 'admin_print_styles-appearance_page_theme_options', 'scrappy_theme_options_admin_styles' );

/**
 * Returns the options array for Scrappy.
 *
 * @since Scrappy 1.3
 */
function scrappy_theme_options_render_page() {
	?>
	<div class="wrap">
		<?php screen_icon(); ?>
		<h2><?php printf( __( '%s Theme Options', 'scrappy' ), get_current_theme() ); ?></h2>
		<?php settings_errors(); ?>

		<form method="post" action="options.php">
			<?php
				settings_fields( 'scrappy_options' );
				do_settings_sections( 'theme_options' );
				submit_button();
			?>
		</form>
	</div>
	<?php
}

/**
 * Sanitize and validate form input. Accepts an array, return a sanitized array.
 *
 * @see scrappy_theme_options_init()
 * @todo set up Reset Options action
 *
 * @since Scrappy 1.3
 */
function scrappy_theme_options_validate( $input ) {
	$output = $defaults = scrappy_get_default_theme_options();

	// The support checkbox should either be on or off
	if ( ! isset( $input['support'] ) )
		$input['support'] = 'off';
	$output['support'] = ( $input['support'] == 'on' ? 'on' : 'off' );

	// The theme styles value must be in our array of radio button values
	if ( isset( $input['theme_styles'] ) && array_key_exists( $input['theme_styles'], scrappy_theme_styles() ) )
		$output['theme_styles'] = $input['theme_styles'];

	return apply_filters( 'scrappy_theme_options_validate', $output, $input, $defaults );
}


/*
 * Add theme options to the customizer
 */

function scrappy_customize_register( $wp_customize ) {

	$wp_customize->add_section( 'scrappy_theme_options', array(
		'title'          => __( 'Theme Options', 'scrappy' ),
		'priority'       => 35,
	) );

	$wp_customize->add_setting( 'scrappy_theme_options[theme_styles]', array(
		'default'        => 'stripes',
		'type'           => 'option',
		'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( 'scrappy_theme_styles', array(
		'label'   => 'Color Scheme:',
		'section' => 'scrappy_theme_options',
		'settings'	=> 'scrappy_theme_options[theme_styles]',
		'type'    => 'select',
		'choices' => array(
						'stripes' =>  __( 'Stripes', 'scrappy' ),
						'polkadots' => __( 'Polkadots', 'scrappy' ),
						'swirls' => __( 'Swirls', 'scrappy' ),
						'letters' => __( 'Letters', 'scrappy' ),
						'madras' => __( 'Madras', 'scrappy' ),
						'flowers' => __( 'Flowers', 'scrappy' )
					),
	) );

}

add_action( 'customize_register', 'scrappy_customize_register' );

