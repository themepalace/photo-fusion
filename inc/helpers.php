<?php
/**
 * Photo Fusion custom helper funtions
 *
 * This is the template that includes all the other files for core featured of Photo Fusion
 *
 * @package Theme Palace
 * @subpackage Photo_Fusion
 * @since Photo Fusion 0.1
 */

if( ! function_exists( 'photo_fusion_check_enable_status' ) ):
	/**
	 * Check status of content.
	 *
	 * @since Photo Fusion 0.1
	 */
  	function photo_fusion_check_enable_status( $input, $content_enable ){
		 $options = photo_fusion_get_theme_options();

		 // Content status.
		 $content_status = $options[ $content_enable ];

		 // Get Page ID outside Loop.
		 $query_obj = get_queried_object();
		 $page_id   = null;
	    if ( is_object( $query_obj ) && 'WP_Post' == get_class( $query_obj ) ) {
	    	$page_id = get_queried_object_id();
	    }

		 // Front page displays in Reading Settings.
		 $page_on_front  = get_option( 'page_on_front' );

		 if ( ( ! is_home() && is_front_page() ) && ( 'static-frontpage' === $content_status ) || ( 'entire-site' === $content_status ) ) {
			$input = true;
		 }
		 else {
			$input = false;
		 }
		 return ( $input );

  	}
endif;
add_filter( 'photo_fusion_section_status', 'photo_fusion_check_enable_status', 10, 2 );


if ( ! function_exists( 'photo_fusion_is_jetpack_cpt_module_enable' ) ) :
    /**
     * Check if JetPack module is enabled
     *
     * @since Photo Fusion 0.1
     *
     * @param string $jetpack_cpt_option 		Jetpack enable checkbox value
     */
    function photo_fusion_is_jetpack_cpt_module_enable( $jetpack_cpt_option ) {
		if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'custom-content-types' ) &&  get_option( $jetpack_cpt_option ) ) :
			return true;
		endif;

		return false;
    }
endif;
add_action( 'plugins_loaded', 'photo_fusion_is_jetpack_cpt_module_enable' );
add_filter( 'photo_fusion_filter_is_jetpack_cpt_module_enable', 'photo_fusion_is_jetpack_cpt_module_enable' );

if ( ! function_exists( 'photo_fusion_is_sidebar_enable' ) ) :
	/**
	 * Check if sidebar is enabled in meta box first then in customizer
	 *
	 * @since Photo Fusion 0.1
	 */
	function photo_fusion_is_sidebar_enable() {

		if ( is_active_sidebar( 'sidebar-1' ) ) {
			return true;
		} else {
			return false;
		}

	}
endif;

if ( ! function_exists( 'photo_fusion_is_frontpage_content_enable' ) ) :
	/**
	 * Check home page ( static ) content status.
	 *
	 *.0
	 *
	 * @param bool $status Home page content status.
	 * @return bool Modified home page content status.
	 */
	function photo_fusion_is_frontpage_content_enable( $status ) {
		if ( is_front_page() ) {
			$options = photo_fusion_get_theme_options();
			$front_page_content_status = $options['enable_frontpage_content'];
			if ( false === $front_page_content_status ) {
				$status = false;
			}
		}
		return $status;
	}

endif;

add_filter( 'photo_fusion_filter_frontpage_content_enable', 'photo_fusion_is_frontpage_content_enable' );
