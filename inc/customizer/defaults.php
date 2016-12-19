<?php
/**
 * Photo Fusion customizer default options
 *
 * @package Theme Palace
 * @subpackage Photo_Fusion
 * @since Photo Fusion 0.1
 */

/**
 * Returns the default options for photo-fusion.
 *
 * @since Photo Fusion 0.1
 * @return array An array of default values
 */
function photo_fusion_get_default_theme_options() {
	$theme_data  = wp_get_theme(); // get theme data
	$photo_fusion_default_options = array(
		//Slider options
		'slider_enable'         		=> 'disabled',
		'slider_content_type'   		=> 'page',

		//About options
		'about_enable'             		=> 'disabled',
		'about_type'             		=> 'page',
		'about_content_type'            => 0,

		//Photo Gallery options
		'photo_gallery_enable'          => 'static-frontpage',
		'photo_gallery_image_layout'    => 'grid',
		'photo_gallery_source'    		=> 'category',
		'photo_gallery_content_type'    => 1,
		'photo_gallery_no_of_img'    	=> 10,

		//Portfolio options
		'portfolio_title'          		=> __( 'My Latest Work', 'photo-fusion' ),
		'portfolio_enable'         		=> 'static-frontpage',
		'portfolio_source'    			=> 'category',
		'portfolio_no_of_img'    		=> 8,
		'portfolio_image_layout'    	=> 'grid',

		//blog options
		'blog_enable'              		=> 'static-frontpage',
		'blog_title'               		=> __( 'Blog Posts', 'photo-fusion' ),
		'blog_content_type'				=> 'recent-post',

		//Contact options
		'contact_enable'           		=> 'static-frontpage',
		'contact_section_title'    		=> __( 'Get in touch <span class="color-green">with us</span>', 'photo-fusion' ),

		/**
		* Theme Options
		*/
		'enable_pagination'        		=> false,
		'pagination_type'          		=> 'numeric',
		'excerpt_length'           		=> 15,
		'footer_logo'              		=> '',
		'copyright_text'           		=> esc_html__( 'Copyright &copy; All rights reserved.', 'photo-fusion' ),
		'reset_options'      			=> false,
		'enable_frontpage_content' 		=> true,
	);

	$output = apply_filters( 'photo_fusion_default_theme_options', $photo_fusion_default_options );
	// Sort array in ascending order, according to the key:
	if ( ! empty( $output ) ) {
		ksort( $output );
	}

	return $output;
}