<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.me/
 *
 * @package Photo_Fusion
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.me/support/responsive-videos/
 */
function photo_fusion_jetpack_setup() {
	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );
}
add_action( 'after_setup_theme', 'photo_fusion_jetpack_setup' );