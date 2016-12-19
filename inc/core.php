<?php
/**
 * Photo Fusion core file.
 *
 * This is the template that includes all the other files for core featured of Photo Fusion
 *
 * @package Theme Palace
 * @subpackage Photo_Fusion
 * @since Photo Fusion 0.1
 */

/**
 * Load theme updater functions.
 * Action is used so that child themes can easily disable.
 */

/**
 * Include options function.
 */
require get_template_directory() . '/inc/options.php';


// Load customizer defaults values
require get_template_directory() . '/inc/customizer/defaults.php';


/**
 * Merge values from default options array and values from customizer
 *
 * @return array Values returned from customizer
 * @since Photo Fusion 0.1
 */
function photo_fusion_get_theme_options() {
  $photo_fusion_default_options = photo_fusion_get_default_theme_options();

  return array_merge( $photo_fusion_default_options , get_theme_mod( 'photo_fusion_theme_options', $photo_fusion_default_options ) ) ;
}


/**
  * Write message for featured image upload
  *
  * @return array Values returned from customizer
  * @since Photo Fusion 0.1
*/
function photo_fusion_slider_image_instruction( $content, $post_id ) {
  $allowed = array( 'page' );
  if ( in_array( get_post_type( $post_id ), $allowed ) ) {
    return $content .= '<p><b>' . __( 'Note', 'photo-fusion' ) . ':</b>' . __( ' The recommended size for image is 1350px by 760 while using it for slider', 'photo-fusion' ) . '</p>';
  }
  return $content;
}
add_filter( 'admin_post_thumbnail_html', 'photo_fusion_slider_image_instruction', 10, 2);

/**
 * Add helper functions.
 */
require get_template_directory() . '/inc/helpers.php';

/**
 * Add structural hooks.
 */
require get_template_directory() . '/inc/structure.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/sections/sections.php';

/**
 * Custom widget additions.
 */
require get_template_directory() . '/inc/widgets/widgets.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';
