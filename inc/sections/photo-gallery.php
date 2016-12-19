<?php
/**
 * photo_gallery section
 *
 * This is the template for the content of photo_gallery section
 *
 * @package Theme Palace
 * @subpackage Photo_Fusion
 * @since Photo Fusion 0.1
 */
if ( ! function_exists( 'photo_fusion_add_photo_gallery_section' ) ) :
    /**
     * Add photo_gallery section
     *
     * @since Photo Fusion 0.1
     */
    function photo_fusion_add_photo_gallery_section() {

        // Check if photo_gallery is enabled on frontpage
        $photo_gallery_enable = apply_filters( 'photo_fusion_section_status', true, 'photo_gallery_enable' );
        if ( true !== $photo_gallery_enable ) {
            return false;
        }

        // Get photo_gallery section details
        $content_details = array();
        $content_details = apply_filters( 'photo_fusion_filter_photo_gallery_section_details', $content_details );

        if ( empty( $content_details ) ) {
            return;
        }

        // Render photo_gallery section now.
        photo_fusion_render_photo_gallery_section( $content_details );
    }
endif;
add_action( 'photo_fusion_primary_content', 'photo_fusion_add_photo_gallery_section', 20 );

if ( ! function_exists( 'photo_fusion_get_photo_gallery_section_details' ) ) :
    /**
     * photo_gallery section details.
     *
     * @since Photo Fusion 0.1
     *
     * @param array $input photo_gallery section details.
     */
    function photo_fusion_get_photo_gallery_section_details( $input ) {
        $options = photo_fusion_get_theme_options();

        // photo_gallery type
        $photo_gallery_source          = $options['photo_gallery_source'];
        $photo_gallery_content_type    = $options['photo_gallery_content_type'];
        $photo_gallery_image_layout    = $options['photo_gallery_image_layout'];
        $photo_gallery_no_of_image     = ( $photo_gallery_image_layout == 'grid' ) ? $options['photo_gallery_no_of_img'] : 11;

        $content = array();
        switch ( $options['photo_gallery_source'] ) {
           case 'category':
               $args = array(
                'post_type'         => 'post',
                'posts_per_page'    => $photo_gallery_no_of_image,
                'category__in'      => $photo_gallery_content_type,
                );
            break;
        }

        if( ! empty( $args ) ) :
            $custom_posts = get_posts( $args );

            $i = 1;
            foreach ( $custom_posts as $key => $custom_post ) {

                if ( has_post_thumbnail( $custom_post->ID ) ) {
                    if ( $photo_gallery_image_layout == 'grid' ) {
                        $img_array = wp_get_attachment_image_src( get_post_thumbnail_id( $custom_post->ID ), 'photo-fusion-portfolio-grid' );
                    } elseif ( $photo_gallery_image_layout == 'masonry' ) {
                        if ( $i == 1 || $i == 10 ) :
                            $img_array = wp_get_attachment_image_src( get_post_thumbnail_id( $custom_post->ID ), 'photo-fusion-portfolio-landscape' );
                        elseif ( $i == 4 || $i == 5 ) :
                            $img_array = wp_get_attachment_image_src( get_post_thumbnail_id( $custom_post->ID ), 'photo-fusion-portfolio-portrait' );
                        else :
                            $img_array = wp_get_attachment_image_src( get_post_thumbnail_id( $custom_post->ID ), 'photo-fusion-portfolio-grid' );
                        endif;
                    }

                    $img_array_large = wp_get_attachment_image_src( get_post_thumbnail_id( $custom_post->ID ), 'large' );
                } else {
                     $img_array = '';
                }

                if ( isset( $img_array ) && isset( $img_array_large ) ) {
                    $content[$i]['img_array'] = $img_array;
                    $content[$i]['img_array_large'] = $img_array_large;
                }              

                $content[$i]['url']         = get_permalink( $custom_post->ID );
                $content[$i]['title']       = get_the_title( $custom_post->ID );
                $content[$i]['excerpt']     = photo_fusion_trim_content( $custom_post, absint( $options['excerpt_length'] ) );
                $content[$i]['terms']       = get_the_category( $custom_post->ID );
            $i++;
            }
        endif;

        if ( ! empty( $content ) ) {
            $input = $content;
        }
        return $input;

    }
endif;
// photo_gallery section content details.
add_filter( 'photo_fusion_filter_photo_gallery_section_details', 'photo_fusion_get_photo_gallery_section_details' );

if ( ! function_exists( 'photo_fusion_render_photo_gallery_section' ) ) :
    /**
     * Add photo_gallery section
     *
     * @since Photo Fusion 0.1
     */
    function photo_fusion_render_photo_gallery_section( $content_details = array() ) {
        if ( empty( $content_details ) ) {
            return;
        } 

        $options = photo_fusion_get_theme_options();
        $photo_gallery_source          = $options['photo_gallery_source'];
        $photo_gallery_image_layout    = ( $photo_gallery_source == 'demo' ) ? 'masonry' : $options['photo_gallery_image_layout'];

        if( $options['slider_enable'] == 'disabled' &&
            $options['about_enable'] == 'disabled' ) {
                $section_top_class = 'padding-top-section';
        } else {
            $section_top_class = '';
        }
?>

    <section id="photo-gallery" class="bg-white">
        <div class="page-section padding-bottom-0 <?php echo $section_top_class; ?>">
            <div class="entry-content gallery">
                <div class="grid">
                    <div class="grid-sizer"></div>
                    <?php
                    $i = 1;
                    foreach ( $content_details as $content_detail ) :
                        $post_categories = $content_detail['terms'];
                        ?>
                        <div class="grid-item 
                            <?php 
                            if ( $photo_gallery_image_layout == 'masonry' ) :
                                if( $i == 1 || $i == 10 ) echo 'grid-item-width1';
                            endif;
                            ?>
                        ">
                            <?php if( ! empty( $content_detail['img_array'][0] ) ): ?>
                                <figure>
                                        <img src="<?php echo esc_url( $content_detail['img_array'][0] ); ?>" alt="<?php echo esc_attr( $content_detail['title'] ); ?>">
                                        <div class="red-overlay"></div><!-- end .red-overlay -->
                                    <figcaption>
                                        <div class="popup-image">
                                            <a href="<?php echo esc_url( $content_detail['img_array_large'][0] ); ?>" data-lightbox="masonry"><i class="fa fa-eye"></i></a>
                                            <a href="<?php echo esc_url( $content_detail['url'] ); ?>"><i class="fa fa-link"></i></a>
                                        </div><!-- end .popup-image -->

                                        <div class="gallery-content">
                                            <?php if($options['photo_gallery_source'] != 'demo'): ?>
                                                <div class="tag">
                                                    <small>
                                                        <?php
                                                        $no_of_cat = 1;
                                                        foreach ( $post_categories as $post_category ) {
                                                            $category_id   = $post_category->term_id;
                                                            $category_name = $post_category->name;
                                                            $category_url  = get_category_link( $category_id );

                                                            echo ' <a href="' . esc_url( $category_url ) . '">'. esc_html( $category_name ) . '</a>';
                                                            if( $no_of_cat == 10 ) break;
                                                            $no_of_cat++;
                                                        } 
                                                        ?>
                                                    </small>
                                                </div>
                                            <?php else : ?>
                                                <div class="tag">
                                                    <small>
                                                        <?php
                                                            echo ' <a href="#">'. esc_html( $post_categories ) . '</a>';
                                                        ?>
                                                    </small>
                                                </div>
                                            <?php endif; ?>
                                            <div class="gallery-title">
                                                <a href="<?php echo esc_url( $content_detail['url'] ); ?>"><h4><?php echo esc_html( $content_detail['title'] ); ?></h4></a>
                                            </div><!-- end .gallery-title -->

                                        </div><!-- end .gallery-content -->
                                    </figcaption>
                                </figure>
                            <?php else : ?>
                                <div class="gallery-post-content">
                                    <header class="entry-header">
                                        <h2 class="entry-title"><?php echo esc_html( $content_detail['title'] ); ?></h2>
                                    </header>
                                    <div class="entry-content">
                                        <p><?php echo esc_html( $content_detail['excerpt'] ); ?></p>
                                    </div><!-- end .entry-content -->
                                    <a href="<?php echo esc_url( $content_detail['url'] ); ?>" class="btn border"><?php _e( 'Read More', 'photo-fusion' ); ?></a>
                                </div>
                            <?php endif; ?>
                        </div><!-- end .grid-item/.grid-item-width1 -->
                            
                        <?php
                        $i++; 
                    endforeach; ?>
                </div><!-- end .grid -->
            </div><!-- end .entry-content -->
        </div><!-- end .page-section -->
    </section>

<?php
    }
endif;
