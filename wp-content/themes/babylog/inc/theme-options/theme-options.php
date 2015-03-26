<?php
/**
 * Babylog Theme Options
 *
 * @package Babylog
 * @since Babylog 1.0
 */

/**
 * Register the form setting for our babylog_options array.
 *
 * This function is attached to the admin_init action hook.
 *
 * This call to register_setting() registers a validation callback, babylog_theme_options_validate(),
 * which is used when the option is saved, to ensure that our option values are properly
 * formatted, and safe.
 *
 * @since Babylog 1.0
 */
function babylog_theme_options_init() {
	register_setting(
		'babylog_options', // Options group, see settings_fields() call in babylog_theme_options_render_page()
		'babylog_theme_options', // Database option, see babylog_get_theme_options()
		'babylog_theme_options_validate' // The sanitization callback, see babylog_theme_options_validate()
	);

	// Register our settings field group
	add_settings_section(
		'general', // Unique identifier for the settings section
		'', // Section title (we don't want one)
		'__return_false', // Section callback (we don't want anything)
		'theme_options' // Menu slug, used to uniquely identify the page; see babylog_theme_options_add_page()
	);
	add_settings_field( 'preview_image', __( 'Preview', 'babylog' ), 'babylog_settings_field_preview_image', 'theme_options', 'general' );
	add_settings_field( 'color_scheme', __( 'Color Scheme', 'babylog' ), 'babylog_settings_field_color_scheme', 'theme_options', 'general' );
	add_settings_field( 'skin_tone', __( 'Skin Tone', 'babylog' ), 'babylog_settings_field_skin_tone', 'theme_options', 'general' );
	add_settings_field( 'hair_color', __( 'Hair Color', 'babylog' ), 'babylog_settings_field_hair_color', 'theme_options', 'general' );
	add_settings_field( 'show_baby', __( 'Show the baby graphic', 'babylog' ), 'babylog_settings_field_show_baby', 'theme_options', 'general' );

}
add_action( 'admin_init', 'babylog_theme_options_init' );

/**
 * Change the capability required to save the 'babylog_options' options group.
 *
 * @see babylog_theme_options_init() First parameter to register_setting() is the name of the options group.
 * @see babylog_theme_options_add_page() The edit_theme_options capability is used for viewing the page.
 *
 * @param string $capability The capability used for the page, which is manage_options by default.
 * @return string The capability to actually use.
 */
function babylog_option_page_capability( $capability ) {
	return 'edit_theme_options';
}
add_filter( 'option_page_capability_babylog_options', 'babylog_option_page_capability' );

/**
 * Add our theme options page to the admin menu.
 *
 * This function is attached to the admin_menu action hook.
 *
 * @since Babylog 1.0
 */
function babylog_theme_options_add_page() {
	$theme_page = add_theme_page(
		__( 'Theme Options', 'babylog' ),   // Name of page
		__( 'Theme Options', 'babylog' ),   // Label in menu
		'edit_theme_options',          // Capability required
		'theme_options',               // Menu slug, used to uniquely identify the page
		'babylog_theme_options_render_page' // Function that renders the options page
	);
}
add_action( 'admin_menu', 'babylog_theme_options_add_page' );

/**
 * Returns an array of color scheme options registered for Babylog.
 *
 * @since Babylog 1.0
 */
function babylog_color_scheme() {
	$color_scheme = array(
		'purple' => array(
			'value' => 'purple',
			'label' => __( 'Purple', 'babylog' )
		),
		'pink' => array(
			'value' => 'pink',
			'label' => __( 'Pink', 'babylog' )
		),
		'green' => array(
			'value' => 'green',
			'label' => __( 'Green', 'babylog' )
		),
		'blue' => array(
			'value' => 'blue',
			'label' => __( 'Blue', 'babylog' )
		)
	);

	return apply_filters( 'babylog_color_scheme', $color_scheme );
}


/**
 * Returns an array of skin tones registered for Babylog.
 *
 * @since Babylog 1.0
 */
function babylog_skin_tone() {
	$skin_tone = array(
		'light' => array(
			'value' => 'light',
			'label' => __( 'Light', 'babylog' )
		),
		'medium' => array(
			'value' => 'medium',
			'label' => __( 'Medium', 'babylog' )
		),
		'dark' => array(
			'value' => 'dark',
			'label' => __( 'Dark', 'babylog' )
		)
	);

	return apply_filters( 'babylog_skin_tone', $skin_tone );
}

/**
 * Returns an array of hair colors registered for Babylog.
 *
 * @since Babylog 1.0
 */
function babylog_hair_color() {
	$hair_color = array(
		'brown' => array(
			'value' => 'brown',
			'label' => __( 'Brown', 'babylog' )
		),
		'black' => array(
			'value' => 'black',
			'label' => __( 'Black', 'babylog' )
		),
		'blonde' => array(
			'value' => 'blonde',
			'label' => __( 'Blonde', 'babylog' )
		),
		'red' => array(
			'value' => 'red',
			'label' => __( 'Red', 'babylog' )
		)
	);

	return apply_filters( 'babylog_hair_color', $hair_color );
}

/**
 * Returns an array of hair colors registered for Babylog.
 *
 * @since Babylog 1.0
 */
function babylog_show_baby() {
	$show_baby = array(
		'yes' => array(
			'value' => 'yes',
			'label' => __( 'Yes', 'babylog' )
		),
		'no' => array(
			'value' => 'no',
			'label' => __( 'No', 'babylog' )
		),
	);

	return apply_filters( 'babylog_show_baby', $show_baby );
}

/**
 * Returns the options array for Babylog.
 *
 * @since Babylog 1.0
 */
function babylog_get_theme_options() {
	$saved = (array) get_option( 'babylog_theme_options' );
	$defaults = array(
		'color_scheme'  => 'purple',
		'skin_tone'  => 'medium',
		'hair_color'  => 'brown',
		'show_baby'  => 'yes',
	);

	$defaults = apply_filters( 'babylog_default_theme_options', $defaults );

	$options = wp_parse_args( $saved, $defaults );
	$options = array_intersect_key( $options, $defaults );

	return $options;
}

/**
 * Renders the color scheme setting field.
 *
 * @since Babylog 1.0
 */
function babylog_settings_field_color_scheme() {
	$options = babylog_get_theme_options();

	foreach ( babylog_color_scheme() as $button ) {
	?>
	<div class="layout">
		<label class="description">
			<input type="radio" id="color-<?php echo esc_attr( $button['value'] ); ?>" name="babylog_theme_options[color_scheme]" value="<?php echo esc_attr( $button['value'] ); ?>" <?php checked( $options['color_scheme'], $button['value'] ); ?> />
			<?php echo $button['label']; ?>
		</label>
	</div>
	<?php
	}
}

/**
 * Renders the skin tone setting field.
 *
 * @since Babylog 1.0
 */
function babylog_settings_field_skin_tone() {
	$options = babylog_get_theme_options();

	foreach ( babylog_skin_tone() as $button ) {
	?>
	<div class="layout">
		<label class="description">
			<input type="radio" id="skin-<?php echo esc_attr( $button['value'] ); ?>" name="babylog_theme_options[skin_tone]" value="<?php echo esc_attr( $button['value'] ); ?>" <?php checked( $options['skin_tone'], $button['value'] ); ?> />
			<?php echo $button['label']; ?>
		</label>
	</div>
	<?php
	}
}


/**
 * Renders the hair_color setting field.
 *
 * @since Babylog 1.0
 */
function babylog_settings_field_hair_color() {
	$options = babylog_get_theme_options();

	foreach ( babylog_hair_color() as $button ) {
	?>
	<div class="layout">
		<label class="description">
			<input type="radio" id="hair-<?php echo esc_attr( $button['value'] ); ?>" name="babylog_theme_options[hair_color]" value="<?php echo esc_attr( $button['value'] ); ?>" <?php checked( $options['hair_color'], $button['value'] ); ?> />
			<?php echo $button['label']; ?>
		</label>
	</div>
	<?php
	}
}


/**
 * Renders the show_baby setting field.
 *
 * @since Babylog 1.0
 */
function babylog_settings_field_show_baby() {
	$options = babylog_get_theme_options();

	foreach ( babylog_show_baby() as $button ) {
	?>
	<div class="layout">
		<label class="description">
			<input type="radio" id="show-baby-<?php echo esc_attr( $button['value'] ); ?>" name="babylog_theme_options[show_baby]" value="<?php echo esc_attr( $button['value'] ); ?>" <?php checked( $options['show_baby'], $button['value'] ); ?> />
			<?php echo $button['label']; ?>
		</label>
	</div>
	<?php
	}
}


/**
 * Renders the hair_color setting field.
 *
 * @since Babylog 1.0
 */
function babylog_settings_field_preview_image() {
	$options = babylog_get_theme_options();
	$showbaby = esc_attr( $options['show_baby'] );
	$haircolor = esc_attr( $options['hair_color'] );
	$themecolor = esc_attr( $options['color_scheme'] );
	$skincolor = esc_attr( $options['skin_tone'] );

	if ( isset( $showbaby ) && 'no' == $showbaby ) :
		$imgstring = '<img style="max-width: 100%; height: auto;" />';
	else :
		$imgstring = '<img src="' . get_template_directory_uri() . '/images/' . $themecolor . '-' . $skincolor . '-' . $haircolor . '.png" alt="' . esc_attr( 'Image preview', 'babylog' ) . '" style="max-width: 100%; height: auto;" />';
	endif;

	if ( isset( $themecolor ) && ! empty( $themecolor ) ) {
		if ( 'green' == $themecolor )
			$backgroundcolor = 'c2e2bf';
		else if ( 'blue' == $themecolor )
			$backgroundcolor = '86afbf';
		else if ( 'pink' == $themecolor )
			$backgroundcolor = 'e29393';
		else if ( 'purple' == $themecolor )
			$backgroundcolor = 'bfa1c6';
	}
	else {
		$backgroundcolor = 'bfa1c6';
		$themecolor = 'purple';
	}

	if ( !isset( $haircolor ) || empty( $haircolor ) )
		$haircolor = 'brown';

	if ( !isset( $haircolor ) || empty( $haircolor ) )
		$haircolor = 'brown';
?>
	<div id="preview-image" style="background-color: #<?php echo $backgroundcolor; ?>; width: 162px; height: 120px; padding: 10px;"><?php echo $imgstring; ?></div>
<?php
}


/**
 * Renders the Theme Options administration screen.
 *
 * @since Babylog 1.0
 */
function babylog_theme_options_render_page() {
	?>
	<div class="wrap">
		<?php screen_icon(); ?>
		<?php $theme_name = function_exists( 'wp_get_theme' ) ? wp_get_theme() : get_current_theme(); ?>
		<h2><?php printf( __( '%s Theme Options', 'babylog' ), $theme_name ); ?></h2>
		<?php settings_errors(); ?>

		<form method="post" action="options.php">
			<?php
				settings_fields( 'babylog_options' );
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
 * @see babylog_theme_options_init()
 * @todo set up Reset Options action
 *
 * @param array $input Unknown values.
 * @return array Sanitized theme options ready to be stored in the database.
 *
 * @since Babylog 1.0
 */
function babylog_theme_options_validate( $input ) {
	$output = array();

	// The Color Scheme radio button value must be in our array of radio button values
	if ( isset( $input['color_scheme'] ) && array_key_exists( $input['color_scheme'], babylog_color_scheme() ) )
		$output['color_scheme'] = $input['color_scheme'];

	// The Skin Tone radio button value must be in our array of radio button values
	if ( isset( $input['skin_tone'] ) && array_key_exists( $input['skin_tone'], babylog_skin_tone() ) )
		$output['skin_tone'] = $input['skin_tone'];

	// The hair color radio button value must be in our array of radio button values
	if ( isset( $input['hair_color'] ) && array_key_exists( $input['hair_color'], babylog_hair_color() ) )
		$output['hair_color'] = $input['hair_color'];

	// The show baby radio button value must be in our array of radio button values
	if ( isset( $input['show_baby'] ) && array_key_exists( $input['show_baby'], babylog_show_baby() ) )
		$output['show_baby'] = $input['show_baby'];

	return apply_filters( 'babylog_theme_options_validate', $output, $input );
}


/*
 * Add theme options to the customizer
 */

function babylog_customize_register( $wp_customize ) {

	$wp_customize->add_section( 'babylog_theme_options', array(
		'title'          => __( 'Theme Options', 'babylog' ),
		'priority'       => 35,
	) );

	$wp_customize->add_setting( 'babylog_theme_options[color_scheme]', array(
		'default'        => 'purple',
		'type'           => 'option',
		'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( 'babylog_theme_style', array(
		'label'   => 'Color Scheme:',
		'section' => 'babylog_theme_options',
		'settings'	=> 'babylog_theme_options[color_scheme]',
		'type'    => 'select',
		'choices' => array(
					 'purple' 	=> __( 'Purple', 'babylog' ),
					 'pink' 	=> __( 'Pink', 'babylog' ),
					 'green'	=> __( 'Green', 'babylog' ),
					 'blue' 	=> __( 'Blue', 'babylog' ),
					)
	) );

	$wp_customize->add_setting( 'babylog_theme_options[skin_tone]', array(
		'default'        => 'medium',
		'type'           => 'option',
		'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( 'babylog_skin_tone', array(
		'label'   => 'Skin Tone:',
		'section' => 'babylog_theme_options',
		'settings'	=> 'babylog_theme_options[skin_tone]',
		'type'    => 'select',
		'choices' => array(
					 'light' 	=> __( 'Light', 'babylog' ),
					 'medium' 	=> __( 'Medium', 'babylog' ),
					 'dark'	=> __( 'Dark', 'babylog' ),
					)
	) );

	$wp_customize->add_setting( 'babylog_theme_options[hair_color]', array(
		'default'        => 'brown',
		'type'           => 'option',
		'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( 'babylog_hair_color', array(
		'label'   => 'Hair Color:',
		'section' => 'babylog_theme_options',
		'settings'	=> 'babylog_theme_options[hair_color]',
		'type'    => 'select',
		'choices' => array(
					 'brown' 	=> __( 'Brown', 'babylog' ),
					 'black' 	=> __( 'Black', 'babylog' ),
					 'blonde'	=> __( 'Blonde', 'babylog' ),
					 'red' 	=> __( 'Red', 'babylog' ),
					)
	) );

	$wp_customize->add_setting( 'babylog_theme_options[show_baby]', array(
		'default'        => 'yes',
		'type'           => 'option',
		'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( 'babylog_show_baby', array(
		'label'   => 'Show the baby graphic?',
		'section' => 'babylog_theme_options',
		'settings'	=> 'babylog_theme_options[show_baby]',
		'type'    => 'select',
		'choices' => array(
					 'yes' 	=> __( 'Yes', 'babylog' ),
					 'no' 	=> __( 'No', 'babylog' ),
					)
	) );

}

add_action( 'customize_register', 'babylog_customize_register' );
