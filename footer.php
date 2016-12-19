<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Photo_Fusion
 */


/**
* photo_fusion_primary_content_end hook
*
* @hooked photo_fusion_add_blog_section -  90
* @hooked photo_fusion_add_instagram_section -  100
* @hooked photo_fusion_add_contact_section -  110
*
*/
do_action( 'photo_fusion_primary_content_end' );


/**
* photo_fusion_content_end hook
*
* @hooked photo_fusion_content_end -  100
*
*/
do_action( 'photo_fusion_content_end' );


/**
* photo_fusion_scroll_top hook
*
* @hooked photo_fusion_scroll_top - 10
*
*/
do_action( 'photo_fusion_scroll_top' );


/**
* photo_fusion_footer hook
*
* @hooked photo_fusion_footer_start - 10
* @hooked photo_fusion_footer -  30
* @hooked photo_fusion_footer_end - 100
*
*/
do_action( 'photo_fusion_footer' );


/**
* photo_fusion_page_end hook
*
* @hooked photo_fusion_page_end -  100
*
*/
do_action( 'photo_fusion_page_end' );
?>

<?php wp_footer(); ?>

</body>
</html>
