<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Photo Fusion
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function photo_fusion_body_classes( $classes ) {
	$options = photo_fusion_get_theme_options();
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	if ( is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'right-sidebar';
	} else {
		$classes[] = 'no-sidebar';
	}

	if( $options['slider_enable'] != 'disabled' && $options['about_enable'] == 'disabled'  && ( $options['photo_gallery_enable'] != 'disabled'  || $options['portfolio_enable'] != 'disabled' || $options['blog_enable'] == true ) ){
		$classes[] = 'about-us-disabled';
	}

	// Add a class for typography
	$classes[] = 'montserrat';

	$classes[] = 'wide';

	return $classes;
}
add_filter( 'body_class', 'photo_fusion_body_classes' );