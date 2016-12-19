<?php
/**
* Homepage (Static ) options
*
* @package Theme Palace
* @subpackage Photo_Fusion
* @since Photo Fusion 0.1
*/

// Add homepage ( static ) section
$wp_customize->add_section( 'photo_fusion_static_frontpage', array(
	'title'               => __('Homepage ( Static )','photo-fusion'),
	'description'         => __( 'Homepage ( Static ) section options.', 'photo-fusion' ),
	'panel'               => 'photo_fusion_theme_options_panel'
) );

// Homepage (Static ) setting and control.
$wp_customize->add_setting( 'photo_fusion_theme_options[enable_frontpage_content]', array(
	'sanitize_callback'   => 'photo_fusion_sanitize_checkbox',
	'default'             => $options['enable_frontpage_content']
) );

$wp_customize->add_control( 'photo_fusion_theme_options[enable_frontpage_content]', array(
	'label'       => __( 'Enable Content', 'photo-fusion' ),
	'description' => __( 'Check to enable content on static front page only.', 'photo-fusion' ),
	'section'     => 'photo_fusion_static_frontpage',
	'type'        => 'checkbox'
) );