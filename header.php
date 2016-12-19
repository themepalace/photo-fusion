<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Photo_Fusion
 */

/**
* photo_fusion_doctype hook
*
* @hooked photo_fusion_doctype -  10
*
*/
do_action( 'photo_fusion_doctype' );?>

<head>
<?php
	/**
	 * photo_fusion_before_wp_head hook
	 *
	 * @hooked photo_fusion_head -  10
	 *
	 */
	do_action( 'photo_fusion_before_wp_head' );

	wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php
/**
 * photo_fusion_page_start hook
 *
 * @hooked photo_fusion_page_start -  10
 *
 */
do_action( 'photo_fusion_page_start' );

/**
 * photo_fusion_before_header hook
 *
 */
do_action( 'photo_fusion_before_header' );


/**
* photo_fusion_header hook
*
* @hooked photo_fusion_header_start -  10
* @hooked photo_fusion_site_branding -  20
* @hooked photo_fusion_site_nav -  30
* @hooked photo_fusion_header_end -  100
* @hooked photo_fusion_mobile_menu -  110
*
*/
do_action( 'photo_fusion_header' );


/**
* photo_fusion_content_start hook
*
* @hooked photo_fusion_content_start -  10
*
*/
do_action( 'photo_fusion_content_start' );

/**
* photo_fusion_primary_content hook
*
* @hooked photo_fusion_add_slider_section - 10
* @hooked photo_fusion_add_about_section -  15
* @hooked photo_fusion_add_photo_gallery_section -  20
* @hooked photo_fusion_add_portfolio_section -  30
*
*/
do_action( 'photo_fusion_primary_content' );