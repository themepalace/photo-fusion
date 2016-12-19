<?php
/**
 * Slider section
 *
 * This is the template for the content of slider section
 *
 * @package Theme Palace
 * @subpackage Photo_Fusion
 * @since Photo Fusion 0.1
 */
if ( ! function_exists( 'photo_fusion_add_slider_section' ) ) :
  /**
   * Add slider section
   *
   * @since Photo Fusion 0.1
   */
  function photo_fusion_add_slider_section() {

    // Check if slider is enabled on frontpage
    $slider_enable = apply_filters( 'photo_fusion_section_status', true, 'slider_enable' );
    if ( true !== $slider_enable ) {
      return false;
    }

    // Get slider section details
    $section_details = array();
    $section_details = apply_filters( 'photo_fusion_filter_slider_section_details', $section_details );

    if ( empty( $section_details ) ) {
      return;
    }

    // Render slider section now.
    photo_fusion_render_slider_section( $section_details );
  }
endif;
add_action( 'photo_fusion_primary_content', 'photo_fusion_add_slider_section', 10 );


if ( ! function_exists( 'photo_fusion_get_slider_section_details' ) ) :
  /**
   * Slider section details.
   *
   * @since  Photo Fusion 0.1
   *
   * @param array $input Slider section details.
   */
  function photo_fusion_get_slider_section_details( $input ) {
    $options = photo_fusion_get_theme_options();

    // Slider type
    $slider_content_type  = $options['slider_content_type'];

    $content = array();
    switch ( $slider_content_type ) {

      case 'page':
        $ids = array();

        for ( $i = 1; $i <= 3; $i++ ) {
            $id = null;
            if ( isset( $options[ 'slider_content_page_'.$i ] ) ) {
                $id = $options[ 'slider_content_page_'.$i ];
            }
            if ( ! empty( $id ) ) {
                $ids[] = absint( $id );
            }
        }

        // Bail if no valid pages are selected.
        if ( empty( $ids ) ) {
            return $input;
        }

        $args = array(
            'no_found_rows'  => true,
            'orderby'        => 'post__in',
            'post_type'      => 'page',
            'post__in'       => $ids,
        );
      break;

      default:
      break;
    }

    // Fetch posts.
        $posts = get_posts( $args );

        if ( ! empty( $posts ) ) {

            $i = 1;
            foreach ( $posts as $key => $post ) {
                $page_id = $post->ID;
                $img_array = null;

                if ( has_post_thumbnail( $page_id ) ) {
                    $img_array = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'photo-fusion-slider-image' );
                } else {
                    $img_array[0] =  get_template_directory_uri().'/assets/uploads/no-featured-image-1920x1080.png';
                }

                if ( isset( $img_array ) ) {
                  $content[$i]['img_array'] = $img_array;
                }

                $content[$i]['author']   = get_the_author_meta('user_nicename', $post->post_author );
                $content[$i]['url']      = get_permalink( $page_id );
                $content[$i]['title']    = get_the_title( $page_id );
                $content[$i]['excerpt']  = photo_fusion_trim_content( $post, 25 );
                $content[$i]['alt']      = get_the_title( $page_id );

                $i++;
            }
        }

        if ( ! empty( $content ) ) {
          $input = $content;
        }

    return $input;

  }
endif;
// Slider section content details.
add_filter( 'photo_fusion_filter_slider_section_details', 'photo_fusion_get_slider_section_details' );


if ( ! function_exists( 'photo_fusion_render_slider_section' ) ) :
  /**
   * Start section class .main-slider
   *
   * @return string Slider content
   * @since  Photo Fusion 0.1
   *
   */
   function photo_fusion_render_slider_section( $content_details = array() ) {
    $options = photo_fusion_get_theme_options();

    if ( empty( $content_details ) ) {
      return;
    } ?>
    <section class="main-slider">
        <div class="cycle-slideshow" 
            data-cycle-timeout="2500" 
            data-cycle-pause-on-hover="true" 
            data-cycle-speed="800" 
            data-cycle-fx="scrollHorz"
            data-cycle-slides=">figure" 
            data-cycle-next="#next" 
            data-cycle-prev="#prev" 
            data-cycle-pager=".cycle-pager">

            <?php foreach ( $content_details as $content ): ?>
            <figure>    
                <a href="<?php echo esc_url( $content['url'] ); ?>"><img src="<?php echo esc_url( $content['img_array'][0]); ?>" alt="<?php echo esc_attr( $content['alt'] ); ?>" class="slider-img"></a>
                <div class="black-overlay"></div><!-- end .black-overlay -->
                <div class="slider-contents">
                    <div class="text-wrapper">
                        <div class="layer-1">
                            <h5><?php echo esc_html( $content['author'] ); ?></h5>
                        </div><!-- end .layer-1 --> 

                        <div class="layer-2">
                            <a href="<?php echo esc_url( $content['url'] ); ?>">
                              <h1><?php echo esc_html( $content['title'] ); ?></h1>
                            </a>
                        </div><!-- end .layer-2 --> 

                        <div class="layer-3">
                            <h5><?php echo esc_html( $content['excerpt'] ); ?></h5>
                        </div><!-- end .layer-3 --> 
                    </div><!-- end .text-wrapper -->

                    <div class="layer-4">
                      <a href="<?php echo esc_url( $content['url'] ); ?>" class="btn fill btn-js"><?php _e( 'View Details', 'photo-fusion' ); ?></a>
                    </div><!-- end .layer-4 --> 
                </div><!-- end .slider-contents -->
            </figure><!-- end first slide-->
            <?php endforeach; ?>

            <div class="control-align-right">

                <div class="controls">
                    <div class="cycle-prev"><a href="#" id="prev"><i class="fa fa-angle-up"></i></a></div>
                    <div class="cycle-pager"></div><!-- end .cycle-pager -->
                    <div class="cycle-next"><a href="#" id="next"><i class="fa fa-angle-down"></i></a></div>
                </div><!--end .controls-->
            </div>
           
        </div><!--end .cycle-slideshow-->
    </section><!--end .main-slider -->

<?php }
endif;