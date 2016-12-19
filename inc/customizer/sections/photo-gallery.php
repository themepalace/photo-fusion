<?php
/**
 * Photo Gallery Customizer options
 *
 * @package Theme Palace
 * @subpackage Photo_Fusion
 * @since Photo Fusion 0.1
 */

// Add photo gallery enable section
$wp_customize->add_section( 'photo_fusion_photo_gallery_section', array(
	'title'             => __('Photo Gallery','photo-fusion'),
	'description'       => __( 'Photo gallery section options.', 'photo-fusion' ),
	'panel'             => 'photo_fusion_sections_panel'
) );

// Add photo gallery enable setting and control.
$wp_customize->add_setting( 'photo_fusion_theme_options[photo_gallery_enable]', array(
	'default'           => $options['photo_gallery_enable'],
	'sanitize_callback' => 'photo_fusion_sanitize_select'
) );

$wp_customize->add_control( 'photo_fusion_theme_options[photo_gallery_enable]', array(
	'label'             => __( 'Enable on', 'photo-fusion' ),
	'section'           => 'photo_fusion_photo_gallery_section',
	'type'              => 'select',
	'choices'           => photo_fusion_enable_disable_options()
) );

// Add photo gallery source
$wp_customize->add_setting( 'photo_fusion_theme_options[photo_gallery_source]', array(
	'default'           => $options['photo_gallery_source'],
	'sanitize_callback' => 'photo_fusion_sanitize_select'
) );

$wp_customize->add_control( 'photo_fusion_theme_options[photo_gallery_source]', array(
	'label'             => __( 'Photo Gallery Source', 'photo-fusion' ),
	'section'           => 'photo_fusion_photo_gallery_section',
	'type'              => 'select',
	'active_callback' => 'photo_fusion_photo_gallery_active', 
	'choices'           => photo_fusion_photo_gallery_source(),
) );

// Add photo gallery post image layout.
$wp_customize->add_setting( 'photo_fusion_theme_options[photo_gallery_image_layout]', array(
	'default'           => $options['photo_gallery_image_layout'],
	'sanitize_callback' => 'photo_fusion_sanitize_select'
) );

$wp_customize->add_control( 'photo_fusion_theme_options[photo_gallery_image_layout]', array(
	'label'             => __( 'Select Image Layout', 'photo-fusion' ),
	'section'           => 'photo_fusion_photo_gallery_section',
	'type'              => 'select',
	'choices'           => photo_fusion_photo_gallery_image_layout(),
	'active_callback' => 'photo_fusion_photo_gallery_active', 
) );

// Add photo gallery post image layout.
$wp_customize->add_setting( 'photo_fusion_theme_options[photo_gallery_no_of_img]', array(
	'default'           => $options['photo_gallery_no_of_img'],
	'sanitize_callback' => 'absint'
) );

$wp_customize->add_control( 'photo_fusion_theme_options[photo_gallery_no_of_img]', array(
	'label'             => __( 'No of Images', 'photo-fusion' ),
	'description'       => __( 'Max no of images is 15', 'photo-fusion' ),
	'section'           => 'photo_fusion_photo_gallery_section',
	'type'              => 'number',
	'input_attrs'		=> array(
		'min'          	=> 1,
		'max' 			=> 15,
		'style'        	=> 'width: 80px;'
	),
	'active_callback' => 'photo_fusion_photo_gallery_active', 
) );

// Add photo gallery content type setting and control.
$wp_customize->add_setting( 'photo_fusion_theme_options[photo_gallery_content_type]', array(
	'default'           => $options['photo_gallery_content_type'],
	'sanitize_callback' => 'photo_fusion_sanitize_category_list'
) );

$wp_customize->add_control( new Photo_Fusion_Dropdown_Category_Control( $wp_customize, 'photo_fusion_theme_options[photo_gallery_content_type]', array(
	'label'           => __( 'Select category', 'photo-fusion' ),
	'section'         => 'photo_fusion_photo_gallery_section',
	'type'            => 'dropdown-categories',
	'active_callback' => 'photo_fusion_photo_gallery_active', 
) ) );


