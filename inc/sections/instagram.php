<?php
/**
 * Instagram section
 *
 * This is the template for the content of instagram section
 *
 * @package Theme Palace
 * @subpackage Photo_Fusion
 * @since Photo Fusion 0.1
 */

if ( ! function_exists( 'photo_fusion_add_instagram_section' ) ) :
    /**
     * Add instagram section
     *
     * @since Photo Fusion 0.1
     */
    function photo_fusion_add_instagram_section() {
        if( is_active_sidebar( 'instagram-sidebar' ) ) {

        $options = photo_fusion_get_theme_options(); // get theme options
        
        if( $options['slider_enable'] == 'disabled' &&  
            $options['about_enable'] == 'disabled'  && 
            $options['photo_gallery_enable'] == 'disabled' &&
            $options['portfolio_enable'] == 'disabled' &&
            $options['enable_frontpage_content'] == false &&
            $options['blog_enable'] == 'disabled'
            ){
                $section_top_class = 'padding-top-section';
        } else{
            $section_top_class = '';
        }
        ?> 
            <div class="clear"></div>
            <div class="<?php echo $section_top_class; ?>">
            <?php dynamic_sidebar( 'instagram-sidebar' );  ?>
            </div>
            <div class="clear"></div>
        <?php
        }
    }
endif;
add_action( 'photo_fusion_primary_content_end', 'photo_fusion_add_instagram_section', 100 );
