<?php
/**
* Pagination options
*
* @package Theme Palace
* @subpackage Photo_Fusion
* @since Photo Fusion 0.6
*/

// Add copyright section
$wp_customize->add_section( 'photo_fusion_pagination', array(
	'title'       => __('Pagination','photo-fusion'),
	'description' =>  __( 'Pagination options','photo-fusion' ),
	'panel'       => 'photo_fusion_theme_options_panel'
) );

// Disable Pagination setting and control.
$wp_customize->add_setting( 'photo_fusion_theme_options[enable_pagination]', array(
	'sanitize_callback' => 'photo_fusion_sanitize_checkbox',
	'default'           => $options['enable_pagination']
) );

$wp_customize->add_control( 'photo_fusion_theme_options[enable_pagination]', array(
	'label'   => __( 'Check to enable pagination', 'photo-fusion' ),
	'section' => 'photo_fusion_pagination',
	'type'    => 'checkbox'
) );

// Disable Pagination type setting and control.
$wp_customize->add_setting( 'photo_fusion_theme_options[pagination_type]', array(
	'sanitize_callback' => 'photo_fusion_sanitize_select',
	'default'           => $options['pagination_type']
) );

$wp_customize->add_control( 'photo_fusion_theme_options[pagination_type]', array(
	'label'           => __( 'Pagination type ( Only on Archives )', 'photo-fusion' ),
	'section'         => 'photo_fusion_pagination',
	'type'            => 'select',
	'choices'         => photo_fusion_pagination_type(),
	'active_callback' => 'photo_fusion_is_pagination_enable'
) );