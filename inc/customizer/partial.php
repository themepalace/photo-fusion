<?php
/**
 * Customizer Partial Functions
 *
 * @package Theme Palace
 * @subpackage Photo_Fusion
 * @since Photo Fusion 0.1
 */


if ( ! function_exists( 'photo_fusion_customize_partial_blog_title' ) ) :
	/**
	 * Render the blog title for the selective refresh partial.
	 *
	 * @since Photo Fusion 0.1
	 *
	 * @return string
	 */
	function photo_fusion_customize_partial_blog_title() {
		$options = photo_fusion_get_theme_options();
		return $options['blog_title'];
	}
endif;

if ( ! function_exists( 'photo_fusion_customize_partial_portfolio_title' ) ) :
	/**
	 * Render the portfolio title for the selective refresh partial.
	 *
	 * @since Photo Fusion 0.1
	 *
	 * @return string
	 */
	function photo_fusion_customize_partial_portfolio_title() {
		$options = photo_fusion_get_theme_options();
		return $options['portfolio_title'];
	}
endif;

if ( ! function_exists( 'photo_fusion_customize_partial_copyright_text' ) ) :
	/**
	 * Render the copyright text for the selective refresh partial.
	 *
	 * @since Photo Fusion 0.1
	 *
	 * @return string
	 */
	function photo_fusion_customize_partial_copyright_text() {
		$options = photo_fusion_get_theme_options();
		return $options['copyright_text'];
	}
endif;