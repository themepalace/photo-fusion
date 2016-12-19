<?php
/**
 * portfolio section
 *
 * This is the template for the content of portfolio section
 *
 * @package Theme Palace
 * @subpackage Photo_Fusion
 * @since Photo Fusion 0.1
 */

if ( ! function_exists( 'photo_fusion_add_portfolio_section' ) ) :
    /**
     * Add portfolio section
     *
     * @since Photo Fusion 0.1
     */
    function photo_fusion_add_portfolio_section() {

        // Check if portfolio is enabled on frontpage
        $portfolio_enable = apply_filters( 'photo_fusion_section_status', true, 'portfolio_enable' );
        if ( true !== $portfolio_enable ) {
            return false;
        }

        // Get portfolio section details
        $content_details = array();
        $content_details = apply_filters( 'photo_fusion_filter_portfolio_section_details', $content_details );

        if ( empty( $content_details ) ) {
            return;
        }

        // Render portfolio section now.
        photo_fusion_render_portfolio_section( $content_details );
    }
endif;
add_action( 'photo_fusion_primary_content', 'photo_fusion_add_portfolio_section', 30 );

if ( ! function_exists( 'photo_fusion_get_portfolio_section_details' ) ) :
    /**
     * portfolio section details.
     *
     * @since Photo Fusion 0.1
     *
     * @param array $input portfolio section details.
     */
    function photo_fusion_get_portfolio_section_details( $input ) {
        $options = photo_fusion_get_theme_options();

        // portfolio type
        $portfolio_source          = $options['portfolio_source'];
        $portfolio_content_type    = ! empty( $options['portfolio_content_type'] ) ? $options['portfolio_content_type'] : '';
        $portfolio_img_layout      = $options['portfolio_image_layout'];
        $portfolio_no_of_img       = $options['portfolio_no_of_img'];        
       
        $content = array();

        switch ( $portfolio_source ) {
            case 'category':
                $args = array(
                    'posts_per_page'    => $portfolio_no_of_img,
                    'category__in'      => $portfolio_content_type,
                );
            break;
        }

        if( ! empty ( $args ) ) :
            $i = 1; 
            $img_count = 1;
            $custom_posts = get_posts( $args );
            foreach ( $custom_posts as $custom_post ) {

                if ( has_post_thumbnail( $custom_post->ID ) ) {
                    
                    if ( $img_count == 9 ) $img_count = 1;
                    if ( $portfolio_img_layout == 'grid' ) {
                        $tp_image_type = 'grid';
                    } else {
                        $tp_image_type = ( $img_count == 2 || $img_count == 4 || $img_count == 7 || $img_count == 8 ) ? 'grid' : 'condensed';
                    }

                    $img_array = wp_get_attachment_image_src( get_post_thumbnail_id( $custom_post->ID ), 'photo-fusion-portfolio-' . $tp_image_type );
                
                    
                    $img_array_large = wp_get_attachment_image_src( get_post_thumbnail_id( $custom_post->ID ), 'large' );
                } else {
                    if ( $portfolio_img_layout == 'grid' ) {
                        $tp_image_size = '300x300';
                    } else {
                        $tp_image_size = ( $img_count == 2 || $img_count == 4 || $img_count == 7 || $img_count == 8 ) ? '300x300' : '250x316';
                    }
                     $img_array[0]        = get_template_directory_uri().'/assets/uploads/no-featured-image-'.$tp_image_size.'.png';
                     $img_array_large[0]  = get_template_directory_uri().'/assets/uploads/no-featured-image-'.$tp_image_size.'.png';
                }

                if ( isset( $img_array ) && isset( $img_array_large ) ) {
                    $content[$i]['img_array']       = $img_array;
                    $content[$i]['img_array_large'] = $img_array_large;
                }

                $content[$i]['url']         = get_permalink( $custom_post->ID );
                $content[$i]['title']       = get_the_title( $custom_post->ID );
                $content[$i]['excerpt']     = photo_fusion_trim_content( $custom_post, absint( $options['excerpt_length'] ) );
                $content[$i]['terms']       = get_the_category( $custom_post->ID );
                $i++;
                $img_count++;
            }
        endif;

        if ( ! empty( $content ) ) {
            $input = $content;
        }
        return $input;

    }
endif;

// portfolio section content details.
add_filter( 'photo_fusion_filter_portfolio_section_details', 'photo_fusion_get_portfolio_section_details' );

if ( ! function_exists( 'photo_fusion_render_portfolio_section' ) ) :
    /**
     * Add portfolio section
     *
     * @since Photo Fusion 0.1
     */
    function photo_fusion_render_portfolio_section( $content_details = array() ) {
        $options = photo_fusion_get_theme_options(); // get theme options 
        $portfolio_source        = $options['portfolio_source'];
        $portfolio_title         = ! empty( $options['portfolio_title'] ) ? $options['portfolio_title'] : '';
        $portfolio_content_type  = ! empty( $options['portfolio_content_type'] ) ? $options['portfolio_content_type'] : '';

        if ( empty( $content_details ) ) {
            return;
        } 

        if( $options['slider_enable'] == 'disabled' &&  
            $options['about_enable'] == 'disabled'  && 
            $options['photo_gallery_enable'] == 'disabled' ){
                $section_top_class = 'padding-top-section';
        } else{
            $section_top_class = '';
        }
?>

        <section id="portfolio" class="bg-white">
            <div class="page-section padding-bottom-0 <?php echo $section_top_class; ?>">
                <?php if ( ! empty( $portfolio_title ) ) : ?>
                    <header class="entry-header">
                        <h2 class="entry-title"><?php echo esc_html( $portfolio_title ); ?></h2>
                    </header><!-- end .entry-header -->
                <?php endif; ?>
                <div class="entry-content">
                    <nav class="portfolio-filter">
                        <ul>
                            <li><a href="#" data-filter="*" class="active"><?php _e( 'All', 'photo-fusion' ); ?></a></li>
                            <?php
                            if ( ! empty( $portfolio_content_type ) && $portfolio_source != 'demo' ) :
                                foreach ( $portfolio_content_type as $tp_cat_id ) {
                                    $tp_category = get_category( $tp_cat_id );
                                    echo '<li><a href="#" data-filter=".' . esc_attr( $tp_category->slug ) . '">' . esc_html( $tp_category->name ) . '</a></li>';
                                }
                            endif;
                            ?>
                        </ul>
                    </nav><!-- end .portfolio-filter -->

                    <div id="fourcol" class="tp-portfolio">
                        <?php
                        $i = 1;
                        $int = 1; 

                        foreach ( $content_details as $content_detail ) :
                            $post_categories = $content_detail['terms'];
                             if( ! empty( $content_detail['img_array'][0] ) ): 
                        ?>
                            <div class="box item-w1
                            <?php 
                            if ( $int == 9 ) $int = 1;
                            echo ( $int == 2 || $int == 4 || $int == 5 || $int == 7  ) ? ' item-h2 ' : ' item-h1 ';
                            if ( $portfolio_source != 'demo' ) :
                                    foreach ( $post_categories as $post_category ) {
                                        $category_slug = $post_category->slug;
                                        echo esc_attr( $category_slug ) . ' ';
                                    }
                            endif;
                            ?>
                            ">
                                <figure>

                                    <img src="<?php echo esc_url( $content_detail['img_array'][0] ); ?>" alt="<?php echo esc_attr( $content_detail['title'] ); ?>">
                                    <div class="red-overlay"></div><!-- end .red-overlay -->
                                    <figcaption>
                                        <div class="popup-image">
                                            <a href="<?php echo esc_url( $content_detail['img_array_large'][0] ); ?>" data-lightbox="masonry"><i class="fa fa-eye"></i></a>
                                            <a href="<?php echo esc_url( $content_detail['url'] ); ?>"><i class="fa fa-link"></i></a>
                                        </div><!-- end .popup-image -->

                                        <div class="portfolio-content">
                                            <?php if( $portfolio_source != 'demo' ): ?>
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
                                            <div class="portfolio-title">
                                                <a href="<?php echo esc_url( $content_detail['url'] ); ?>"><h4><?php echo esc_html( $content_detail['title'] ); ?></h4></a>
                                            </div><!-- end .portfolio-title -->

                                            <div class="portfolio-desc">
                                                <p class="desc"><?php echo esc_html( $content_detail['excerpt'] ); ?></p>
                                            </div><!-- end .portfolio-title -->

                                        </div><!-- end .portfolio-content -->
                                    </figcaption>
                                </figure>
                            </div><!-- end box -->
                        <?php   endif; $int++; $i++;
                        endforeach; ?>
                    </div><!-- end portfolio -->
                </div><!-- end .entry-content -->
            </div><!-- end .container -->
        </section>

<?php
    }
endif;
