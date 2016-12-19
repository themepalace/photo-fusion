<?php
/**
 * Slider Customizer options
 *
 * @package Theme Palace
 * @subpackage Photo_Fusion
 * @since Photo Fusion 0.1
 */


// Add slider enable section
$wp_customize->add_section( 'photo_fusion_slider_section', array(
	'title'             => __('Slider','photo-fusion'),
	'description'       => __( 'Slider section options.', 'photo-fusion' ),
	'panel'             => 'photo_fusion_sections_panel'
) );

// Add slider enable setting and control.
$wp_customize->add_setting( 'photo_fusion_theme_options[slider_enable]', array(
	'default'           => $options['slider_enable'],
	'sanitize_callback' => 'photo_fusion_sanitize_select'
) );

$wp_customize->add_control( 'photo_fusion_theme_options[slider_enable]', array(
	'label'             => __( 'Enable on', 'photo-fusion' ),
	'section'           => 'photo_fusion_slider_section',
	'type'              => 'select',
	'choices'           => photo_fusion_enable_disable_options()
) );


// Add slider content type setting and control.
$wp_customize->add_setting( 'photo_fusion_theme_options[slider_content_type]', array(
	'default'           => $options['slider_content_type'],
	'sanitize_callback' => 'photo_fusion_sanitize_select'
) );

$wp_customize->add_control( 'photo_fusion_theme_options[slider_content_type]', array(
	'label'           => __( 'Content Type', 'photo-fusion' ),
	'description'           => __( 'Recommended slider image size is 1350x760 px', 'photo-fusion' ),
	'section'         => 'photo_fusion_slider_section',
	'type'            => 'select',
	'active_callback' => 'photo_fusion_is_slider_active',
	'choices'         => photo_fusion_content_type(),
) );

/**
 * Page Content Type
 */
for ($i=1; $i <= 3; $i++) {
	// Show page drop-down setting and control
	$wp_customize->add_setting( 'photo_fusion_theme_options[slider_content_page_'.$i.']', array(
		'sanitize_callback' => 'photo_fusion_sanitize_page'
	) );

	$wp_customize->add_control( 'photo_fusion_theme_options[slider_content_page_'.$i.']', array(
		'label'           => sprintf( __( 'Page Slider #%s', 'photo-fusion' ), $i ),
		'section'         => 'photo_fusion_slider_section',
		'active_callback' => 'photo_fusion_is_slider_active',
		'type'				=> 'dropdown-pages'
	) );

	// Slider page hr setting and control
	$wp_customize->add_setting( 'photo_fusion_theme_options[slider_content_page_hr'.$i.']', array(
		'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_control( new Photo_Fusion_Customize_Horizontal_Line( $wp_customize, 'photo_fusion_theme_options[slider_content_page_hr'.$i.']',
		array(
			'section'         => 'photo_fusion_slider_section',
			'active_callback' => 'photo_fusion_is_slider_active',
			'type'				=> 'hr'
	) ) );
}