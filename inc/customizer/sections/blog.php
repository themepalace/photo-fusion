<?php
/**
 * Photo Fusion Blog Customizer options
 *
 * @package Theme Palace
 * @subpackage Photo_Fusion
 * @since Photo Fusion 0.1
 */


// Add blog enable section
$wp_customize->add_section( 'photo_fusion_blog_section', array(
	'title'             => __('Blog','photo-fusion'),
	'description'       => __( 'Blog section options.', 'photo-fusion' ),
	'panel'             => 'photo_fusion_sections_panel'
) );

// Add blog enable setting and control.
$wp_customize->add_setting( 'photo_fusion_theme_options[blog_enable]', array(
	'default'           => $options['blog_enable'],
	'sanitize_callback' => 'photo_fusion_sanitize_select'
) );

$wp_customize->add_control( 'photo_fusion_theme_options[blog_enable]', array(
	'label'             => __( 'Enable on', 'photo-fusion' ),
	'section'           => 'photo_fusion_blog_section',
	'type'              => 'select',
	'choices'           => photo_fusion_enable_disable_options()
) );

// Add blog content type setting and control.
$wp_customize->add_setting( 'photo_fusion_theme_options[blog_content_type]', array(
	'default'           => $options['blog_content_type'],
	'sanitize_callback' => 'photo_fusion_sanitize_select'
) );

$wp_customize->add_control( 'photo_fusion_theme_options[blog_content_type]', array(
	'label'           => __( 'Content Type', 'photo-fusion' ),
	'section'         => 'photo_fusion_blog_section',
	'type'            => 'select',
	'active_callback' => 'photo_fusion_is_blog_section_active',
	'choices'         => photo_fusion_blog_content_type()
) );

// Add blog title setting and control.
$wp_customize->add_setting( 'photo_fusion_theme_options[blog_title]', array(
	'default'           => $options['blog_title'],
	'transport'         => 'postMessage',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( 'photo_fusion_theme_options[blog_title]', array(
	'label'           => __( 'Title', 'photo-fusion' ),
	'section'         => 'photo_fusion_blog_section',
	'type'            => 'text',
	'active_callback' => 'photo_fusion_is_blog_section_active',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial( 'photo_fusion_theme_options[blog_title]', array(
		'selector'            => '#blog h2.entry-title',
		'render_callback'     => 'photo_fusion_customize_partial_blog_title',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
	) );
}