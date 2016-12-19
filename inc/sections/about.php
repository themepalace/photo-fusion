<?php
/**
 * About section
 *
 * This is the template for the content of About section
 *
 * @package Theme Palace
 * @subpackage Photo_Fusion
 * @since Photo Fusion 0.1
 */

if ( ! function_exists( 'photo_fusion_add_about_section' ) ) :
    /**
     * Add about section
     *
     * @since Photo Fusion 0.1
     */
    function photo_fusion_add_about_section() {

        // Check if about is enabled on frontpage
        $about_enable = apply_filters( 'photo_fusion_section_status', true, 'about_enable' );
        if ( true !== $about_enable ) {
            return false;
        }

        // Get about section details
        $content_details = array();
        $content_details = apply_filters( 'photo_fusion_filter_about_section_details', $content_details );

        if ( empty( $content_details ) ) {
            return;
        }

        // Render about section now.
        photo_fusion_render_about_section( $content_details );
    }
endif;
add_action( 'photo_fusion_primary_content', 'photo_fusion_add_about_section', 15 );

if ( ! function_exists( 'photo_fusion_get_about_section_details' ) ) :
    /**
     * about section details.
     *
     * @since Photo Fusion 0.1
     *
     * @param array $input about section details.
     */
    function photo_fusion_get_about_section_details( $input ) {
        $options = photo_fusion_get_theme_options();

        // about type
        $about_content_type    = $options['about_content_type'];
        $about_content_source  = $options['about_type'];
       
        $content = array();
        switch ( $about_content_source ) {
            case 'page':
               $args = array(
                    'post_type'     => 'page',
                    'post__in'      => array( $about_content_type )
                );
            break;
            
            default:
            break;
        }

        if( ! empty ( $args ) ) :
            $custom_posts = get_posts( $args );
            foreach ( $custom_posts as $custom_post ) {

                $content[0]['url']         = get_permalink( $custom_post->ID );
                $content[0]['excerpt']     = photo_fusion_trim_content( $custom_post, 25 );
            }
        endif;

        if ( ! empty( $content ) ) {
            $input = $content;
        }
        return $input;

    }
endif;

// about section content details.
add_filter( 'photo_fusion_filter_about_section_details', 'photo_fusion_get_about_section_details' );

if ( ! function_exists( 'photo_fusion_render_about_section' ) ) :
    /**
     * Add about section
     *
     * @since Photo Fusion 0.1
     */
    function photo_fusion_render_about_section( $content_details = array() ) {
        if ( empty( $content_details ) ) {
            return;
        }
        $options = photo_fusion_get_theme_options(); // get theme options 

        if( $options['slider_enable'] == 'disabled' ){
            $section_top_class = 'padding-top-section';
        } else {
            $section_top_class = '';
        }
?>

        <section id="about-us" class="bg-white">
            <div class="page-section padding-bottom-0 <?php echo $section_top_class; ?>">
                <header class="entry-header">
                <?php foreach ($content_details as $content) : ?>
                    <span class="sub-title"><?php echo esc_html( $content['excerpt'] ); ?></span>
                    <div class="button">
                        <a href="<?php echo esc_url( $content['url'] ); ?>" class="btn fill btn-js"><?php _e( 'Read More', 'photo-fusion' ) ?></a>
                    </div><!-- end .button -->
                <?php endforeach; ?>
                </header><!-- end .entry-header -->
            </div>
        </section>

<?php
    }
endif;
