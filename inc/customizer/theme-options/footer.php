<?php
/**
* Copyright options
*
* @package Theme Palace
* @subpackage Photo_Fusion
* @since Photo Fusion 0.1
*/

// Add copyright section
$wp_customize->add_section( 'photo_fusion_footer', array(
	'title'               => __('Footer','photo-fusion'),
	'description'         => __( 'Footer section options.', 'photo-fusion' ),
	'panel'               => 'photo_fusion_theme_options_panel'
) );

// Copyright text setting and control.
$wp_customize->add_setting( 'photo_fusion_theme_options[copyright_text]', array(
	'sanitize_callback'   => 'photo_fusion_sanitize_footer_content',
	'transport'           => 'postMessage',
	'default'             => $options['copyright_text']
) );

$wp_customize->add_control( 'photo_fusion_theme_options[copyright_text]', array(
	'label'               => __( 'Copyright', 'photo-fusion' ),
	'section'             => 'photo_fusion_footer',
	'type'                => 'textarea',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial( 'photo_fusion_theme_options[copyright_text]', array(
		'selector'            => '#colophon .site-info span.site-title',
		'render_callback'     => 'photo_fusion_customize_partial_copyright_text',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
	) );
}