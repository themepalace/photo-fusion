<?php
/**
 * Photo Fusion Theme Customizer
 *
 * @package Theme Palace
 * @subpackage Photo_Fusion
 * @since Photo Fusion 0.1
 */

// Load upgrade-to-pro functions.
require get_template_directory() . '/inc/customizer/upgrade-to-pro/class-customize.php';

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function photo_fusion_customize_register( $wp_customize ) {
	$options = photo_fusion_get_theme_options();


	// Load customize active callback functions.
	require get_template_directory() . '/inc/customizer/active-callbacks.php';

	// Load customize partial functions.
	require get_template_directory() . '/inc/customizer/partial.php';

	// Load customize validate functions.
	require get_template_directory() . '/inc/customizer/validate.php';

	// Load custom controls.
	require get_template_directory() . '/inc/customizer/custom-controls.php';

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	$wp_customize->get_control( 'custom_logo' )->description = __( 'The recommended size for the logo is 120px by 70px.', 'photo-fusion' );

	/**
	* Common Options
	*/
	// Add panel for common options
	$wp_customize->add_panel( 'photo_fusion_theme_options_panel' , array(
	    'title'      => __('Theme Options','photo-fusion'),
	    'description'=> __( 'Photo Fusion Theme Options.', 'photo-fusion' ),
	    'priority'   => 150,
	) );

	if ( version_compare( $GLOBALS['wp_version'], '4.7', '<' ) ) {
		// Load custom-css options.
		require get_template_directory() . '/inc/customizer/theme-options/custom-css.php';
	}

	// Load excerpt options.
	require get_template_directory() . '/inc/customizer/theme-options/excerpt.php';

	// Load footer options.
	require get_template_directory() . '/inc/customizer/theme-options/footer.php';

	// Load home-static options.
	require get_template_directory() . '/inc/customizer/theme-options/homepage-static.php';

	// Load paginations options.
	require get_template_directory() . '/inc/customizer/theme-options/pagination.php';

	/**
	* Theme Options for sections
	*/
	// Add panel for different sections
	$wp_customize->add_panel( 'photo_fusion_sections_panel' , array(
	    'title'      => __('Sections','photo-fusion'),
	    'description'=> __( 'Photo Fusion available sections.', 'photo-fusion' ),
	    'priority'   => 130,
	) );

	// Load slider options.
	require get_template_directory() . '/inc/customizer/sections/slider.php';

	// Load about section options.
	require get_template_directory() . '/inc/customizer/sections/about.php';

	// Load photo gallery section options.
	require get_template_directory() . '/inc/customizer/sections/photo-gallery.php';

	// Load portfolio section options.
	require get_template_directory() . '/inc/customizer/sections/portfolio.php';

	// Load blog section options.
	require get_template_directory() . '/inc/customizer/sections/blog.php';
	
	/**
	* Reset section
	*/
	// Add reset enable section
	$wp_customize->add_section( 'photo_fusion_reset_section', array(
		'title'             => __('Reset all settings','photo-fusion'),
		'description'       => __( 'Caution: All settings will be reset to default. Refresh the page after clicking Save & Publish.', 'photo-fusion' ),
	) );

	// Add reset enable setting and control.
	$wp_customize->add_setting( 'photo_fusion_theme_options[reset_options]', array(
		'default'           => $options['reset_options'],
		'sanitize_callback' => 'photo_fusion_sanitize_checkbox',
		'transport'			  => 'refresh'
	) );

	$wp_customize->add_control( 'photo_fusion_theme_options[reset_options]', array(
		'label'             => __( 'Check to reset all settings', 'photo-fusion' ),
		'section'           => 'photo_fusion_reset_section',
		'type'              => 'checkbox',
	) );
}
add_action( 'customize_register', 'photo_fusion_customize_register' );

/**
 * Reset all options
 *
 * @since Photo Fusion 0.1
 *
 * @param bool $checked Whether the reset is checked.
 * @return bool Whether the reset is checked.
 */
function photo_fusion_reset_options( ) {
	$options = photo_fusion_get_theme_options();
	if ( true === $options['reset_options'] ) {
		// Reset custom theme options.
		set_theme_mod( 'photo_fusion_theme_options', array() );
		// Reset custom header and backgrounds.
		remove_theme_mod( 'header_image' );
		remove_theme_mod( 'header_image_data' );
		remove_theme_mod( 'background_image' );
		remove_theme_mod( 'background_color' );

    }
  	else {
	    return false;
  	}
}
add_action( 'customize_save_after',  'photo_fusion_reset_options' );

/*
 * Load customizer sanitization functions.
 */
require get_template_directory() . '/inc/customizer/sanitize.php';

/**
 * Enqueue styles on customizer preview.
 */
function photo_fusion_customizer_styles() {
	if ( is_customize_preview() ) {
	   // Add fontawesome
		wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/assets/plugins/fontawesome/css/font-awesome.min.css', '', '4.6.3' );

		// Add custom css for customizer
		wp_enqueue_style( 'photo-fusion-customizer', get_template_directory_uri() . '/assets/css/customizer.min.css' );
	}
}
add_action( 'customize_controls_print_styles', 'photo_fusion_customizer_styles' );


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function photo_fusion_customize_preview_js() {
	wp_enqueue_script( 'photo_fusion_customizer', get_template_directory_uri() . '/assets/js/customizer.min.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'photo_fusion_customize_preview_js' );

/**
 * Add inline css
 */
function photo_fusion_inline_css() {
	$options            = photo_fusion_get_theme_options();

	$counter_bg_image   = ! empty( $options['counter_bg_image'] ) ? $options['counter_bg_image'] : get_template_directory_uri(). '/assets/uploads/background-01.jpg';

	// Declare variable to store custom css
	$photo_fusion_custom_css = '';
	// Check if the custom CSS feature of 4.7 exists
	if ( function_exists( 'wp_update_custom_css_post' ) ) {
	    // Migrate any existing theme CSS to the core option added in WordPress 4.7.
	    if( !empty( $options['custom_css'] ) )
	    $custom_css = $options['custom_css'];
	    
	    if ( $css ) {
	        $core_css = wp_get_custom_css(); // Preserve any CSS already added to the core option.
	        $return = wp_update_custom_css_post( $core_css . $custom_css );
			
	        if ( ! is_wp_error( $return ) ) {
	            // Remove the old theme_mod, so that the CSS is stored in only one place moving forward.
	   			$options['custom_css'] = '';
				set_theme_mod( 'photo_fusion_theme_options', $options );
	        }
	    }
	} else {
	    // Back-compat for WordPress < 4.7.
		if ( isset( $options['custom_css'] ) ) {
			$photo_fusion_custom_css = $options['custom_css'];
		}
	}

	$css = $photo_fusion_custom_css;

	if( get_header_textcolor() ) {
		$css .=  "#masthead .site-title a, .site-description{ color: #".  get_header_textcolor() ."; }". "\n";
	}

	$css .= '
		/* counter background image */
		#counter {
		    background-image: url("'.esc_url( $counter_bg_image ).'");
		    background-size: cover;
		    background-repeat : no-repeat;
		}
		.os-animation { opacity: 1; }
	';

	wp_add_inline_style( 'photo-fusion-default-color-layout', $css );
}
add_action( 'wp_enqueue_scripts', 'photo_fusion_inline_css', 10 );