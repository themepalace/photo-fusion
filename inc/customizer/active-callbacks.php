<?php
/**
 * Photo Fusion customizer active callbacks
 *
 * @package Theme Palace
 * @subpackage Photo_Fusion
 * @since Photo Fusion 0.1
 */


if ( ! function_exists( 'photo_fusion_is_slider_active' ) ) :
	/**
	 * Check if slider is active.
	 *
	 * @since Photo Fusion 0.1
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function photo_fusion_is_slider_active( $control ) {
		if ( 'disabled' != $control->manager->get_setting( 'photo_fusion_theme_options[slider_enable]' )->value() )
			return true;

		return false;
	}
endif;

if ( ! function_exists( 'photo_fusion_is_about_active' ) ) :
	/**
	 * Check if about is active.
	 *
	 * @since Photo Fusion 0.1
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function photo_fusion_is_about_active( $control ) {
		if ( 'disabled' != $control->manager->get_setting( 'photo_fusion_theme_options[about_enable]' )->value() )
			return true;

		return false;
	}
endif;

if ( ! function_exists( 'photo_fusion_is_portfolio_active' ) ) :
	/**
	 * Check if portfolio is active.
	 *
	 * @since Photo Fusion 0.1
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function photo_fusion_is_portfolio_active( $control ) {
		if ( 'disabled' != $control->manager->get_setting( 'photo_fusion_theme_options[portfolio_enable]' )->value() )
			return true;

		return false;
	}
endif;

if ( ! function_exists( 'photo_fusion_is_blog_section_active' ) ) :
	/**
	 * Check if blog is active.
	 *
	 * @since Photo Fusion 0.1
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function photo_fusion_is_blog_section_active( $control ) {
		if ( 'disabled' != $control->manager->get_setting( 'photo_fusion_theme_options[blog_enable]' )->value() )
			return true;

		return false;
	}
endif;

if ( ! function_exists( 'photo_fusion_photo_gallery_active' ) ) :
	/**
	 * Check if gallery is active.
	 *
	 * @since Photo Fusion 0.1
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function photo_fusion_photo_gallery_active( $control ) {
		if ( 'disabled' != $control->manager->get_setting( 'photo_fusion_theme_options[photo_gallery_enable]' )->value() )
			return true;

		return false;
	}
endif;


if ( ! function_exists( 'photo_fusion_is_pagination_enable' ) ) :
	/**
	 * Check if pagination is enabled.
	 *
	 * @since Photo Fusion 0.6
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function photo_fusion_is_pagination_enable( $control ) {
		return $control->manager->get_setting( 'photo_fusion_theme_options[enable_pagination]' )->value();
	}
endif;