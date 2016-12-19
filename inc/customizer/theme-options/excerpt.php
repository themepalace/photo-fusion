<?php
/**
 * Excerpt options
 *
 * @package Theme Palace
 * @subpackage Photo_Fusion
 * @since Photo Fusion 0.1
 */

// Add excerpt section
$wp_customize->add_section( 'photo_fusion_excerpt_section', array(
	'title'             => __('Excerpt','photo-fusion'),
	'description'       => __( 'Excerpt section options.', 'photo-fusion' ),
	'panel'             => 'photo_fusion_theme_options_panel'
) );

// Excerpt length setting and control.
$wp_customize->add_setting( 'photo_fusion_theme_options[excerpt_length]', array(
	'sanitize_callback' => 'photo_fusion_sanitize_number_range',
	'validate_callback' => 'photo_fusion_validate_excerpt_length',
	'default'			  => $options['excerpt_length']
) );

$wp_customize->add_control( 'photo_fusion_theme_options[excerpt_length]', array(
	'label'       => __( 'Thumbnail Excerpt Length', 'photo-fusion' ),
	'description' => __( 'Total words to be displayed.', 'photo-fusion' ),
	'section'     => 'photo_fusion_excerpt_section',
	'type'        => 'number',
	'input_attrs' => array(
		'style'       => 'width: 80px;',
		'max'         => 15,
		'min'         => 5,
	),
) );