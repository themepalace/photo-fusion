<?php
/**
 * Portfolio Customizer options
 *
 * @package Theme Palace
 * @subpackage Photo_Fusion
 * @since Photo Fusion 0.1
 */

// Add portfolio enable section
$wp_customize->add_section( 'photo_fusion_portfolio_section', array(
	'title'             => __('Portfolio','photo-fusion'),
	'panel'             => 'photo_fusion_sections_panel'
) );

// Add portfolio enable setting and control.
$wp_customize->add_setting( 'photo_fusion_theme_options[portfolio_enable]', array(
	'default'           => $options['portfolio_enable'],
	'sanitize_callback' => 'photo_fusion_sanitize_select'
) );

$wp_customize->add_control( 'photo_fusion_theme_options[portfolio_enable]', array(
	'label'             => __( 'Enable on', 'photo-fusion' ),
	'section'           => 'photo_fusion_portfolio_section',
	'type'              => 'select',
	'choices'           => photo_fusion_enable_disable_options()
) );

// Add photo portfolio source
$wp_customize->add_setting( 'photo_fusion_theme_options[portfolio_source]', array(
	'default'           => $options['portfolio_source'],
	'sanitize_callback' => 'photo_fusion_sanitize_select'
) );

$wp_customize->add_control( 'photo_fusion_theme_options[portfolio_source]', array(
	'label'             => __( 'Photo Gallery Source', 'photo-fusion' ),
	'section'           => 'photo_fusion_portfolio_section',
	'type'              => 'select',
	'active_callback' 	=> 'photo_fusion_is_portfolio_active', 
	'choices'           => photo_fusion_photo_gallery_source(),
) );

// Add portfolio title setting and control.
$wp_customize->add_setting( 'photo_fusion_theme_options[portfolio_title]', array(
	'default'           => $options['portfolio_title'],
	'sanitize_callback' => 'sanitize_text_field',
	'transport'         => 'postMessage',
) );

$wp_customize->add_control( 'photo_fusion_theme_options[portfolio_title]', array(
	'label'           => __( 'Title', 'photo-fusion' ),
	'section'         => 'photo_fusion_portfolio_section',
	'type'            => 'text',
	'active_callback' => 'photo_fusion_is_portfolio_active',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial( 'photo_fusion_theme_options[portfolio_title]', array(
		'selector'            => '#portfolio h2.entry-title',
		'render_callback'     => 'photo_fusion_customize_partial_portfolio_title',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
	) );
}

// no of images in portfolio.
$wp_customize->add_setting( 'photo_fusion_theme_options[portfolio_no_of_img]', array(
	'default'           => $options['portfolio_no_of_img'],
	'sanitize_callback' => 'absint'
) );

$wp_customize->add_control( 'photo_fusion_theme_options[portfolio_no_of_img]', array(
	'label'             => __( 'No of Images', 'photo-fusion' ),
	'section'           => 'photo_fusion_portfolio_section',
	'type'              => 'number',
	'input_attrs'		=> array(
		'min'          	=> 1,
		'max' 			=> 16,
		'style'        	=> 'width: 80px;'
	),
	'active_callback' => 'photo_fusion_is_portfolio_active', 
) );

// Add photo portfolio post image layout.
$wp_customize->add_setting( 'photo_fusion_theme_options[portfolio_image_layout]', array(
	'default'           => $options['portfolio_image_layout'],
	'sanitize_callback' => 'photo_fusion_sanitize_select'
) );

$wp_customize->add_control( 'photo_fusion_theme_options[portfolio_image_layout]', array(
	'label'             => __( 'Select Image Layout', 'photo-fusion' ),
	'section'           => 'photo_fusion_portfolio_section',
	'type'              => 'select',
	'choices'           => photo_fusion_photo_gallery_image_layout(),
	'active_callback' => 'photo_fusion_is_portfolio_active', 
) );

// Add portfolio content type setting and control.
$wp_customize->add_setting( 'photo_fusion_theme_options[portfolio_content_type]', array(
	'sanitize_callback' => 'photo_fusion_sanitize_category_list'
) );

$wp_customize->add_control( new Photo_Fusion_Dropdown_Category_Control( $wp_customize, 'photo_fusion_theme_options[portfolio_content_type]', array(
	'label'           => __( 'Select category', 'photo-fusion' ),
	'section'         => 'photo_fusion_portfolio_section',
	'type'            => 'dropdown-categories',
	'active_callback' => 'photo_fusion_is_portfolio_active', 
) ) );
