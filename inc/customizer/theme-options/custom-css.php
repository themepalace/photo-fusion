<?php
/**
 * Custom CSS options
 *
 * @package Theme Palace
 * @subpackage Photo_Fusion
 * @since Photo Fusion 0.1
 */

$wp_customize->add_section( 'photo_fusion_custom_css', array(
	'description'	=> __( 'Custom/Inline CSS', 'photo-fusion'),
	'panel'  		=> 'photo_fusion_theme_options_panel',
	'title'    		=> __( 'Custom CSS', 'photo-fusion' ),
) );

$wp_customize->add_setting( 'photo_fusion_theme_options[custom_css]', array(
	'sanitize_callback' => 'photo_fusion_sanitize_custom_css',
) );

$wp_customize->add_control( 'photo_fusion_theme_options[custom_css]', array(
	'label'		=> __( 'Enter Custom CSS', 'photo-fusion' ),
	'section'   => 'photo_fusion_custom_css',
	'type'		=> 'textarea',
) );