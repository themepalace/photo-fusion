<?php
/**
 * Photo Fusion About Customizer options
 *
 * @package Theme Palace
 * @subpackage Photo_Fusion
 * @since Photo Fusion 0.1
 */


// Add about enable section
$wp_customize->add_section( 'photo_fusion_about_section', array(
	'title'             => __('About Us','photo-fusion'),
	'description'       => __( 'about section options.', 'photo-fusion' ),
	'panel'             => 'photo_fusion_sections_panel'
) );

// Add about enable setting and control.
$wp_customize->add_setting( 'photo_fusion_theme_options[about_enable]', array(
	'default'           => $options['about_enable'],
	'sanitize_callback' => 'photo_fusion_sanitize_select'
) );

$wp_customize->add_control( 'photo_fusion_theme_options[about_enable]', array(
	'label'             => __( 'Enable on', 'photo-fusion' ),
	'section'           => 'photo_fusion_about_section',
	'type'              => 'select',
	'choices'           => photo_fusion_enable_disable_options()
) );

// Add about enable setting and control.
$wp_customize->add_setting( 'photo_fusion_theme_options[about_type]', array(
	'default'           => $options['about_type'],
	'sanitize_callback' => 'photo_fusion_sanitize_select'
) );

$wp_customize->add_control( 'photo_fusion_theme_options[about_type]', array(
	'label'             => __( 'Select About Source', 'photo-fusion' ),
	'section'           => 'photo_fusion_about_section',
	'type'              => 'select',
	'choices'           => photo_fusion_about_source_options(),
	'active_callback'	=> 'photo_fusion_is_about_active'
) );

// Add about source.
$wp_customize->add_setting( 'photo_fusion_theme_options[about_content_type]', array(
	'default'           => $options['about_content_type'],
	'sanitize_callback' => 'photo_fusion_sanitize_page'
) );

$wp_customize->add_control( 'photo_fusion_theme_options[about_content_type]', array(
	'label'             => __( 'Select Page', 'photo-fusion' ),
	'section'           => 'photo_fusion_about_section',
	'type'              => 'dropdown-pages',
	'active_callback'	=> 'photo_fusion_is_about_active'
) );
