<?php
/**
 * Blog section
 *
 * This is the template for the content of Blog section in front page
 *
 * @package Theme Palace
 * @subpackage Photo_Fusion
 * @since Photo Fusion 0.1
 */
if ( ! function_exists( 'photo_fusion_add_blog_section' ) ) :
    /**
     * Add Blog section
     *
     * @since Photo Fusion 0.1
     */
    function photo_fusion_add_blog_section() {

        // Check if Blog is enabled on frontpage
        $blog_enable = apply_filters( 'photo_fusion_section_status', true, 'blog_enable' );
        if ( true !== $blog_enable ) {
            return false;
        }

        // Get Blog section details
        $section_details = array();
        $section_details = apply_filters( 'photo_fusion_filter_blog_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }
        // Render Blog section now.
        photo_fusion_render_blog_section( $section_details );
    }
endif;
add_action( 'photo_fusion_primary_content_end', 'photo_fusion_add_blog_section', 90 );

if ( ! function_exists( 'photo_fusion_get_blog_section_details' ) ) :
    /**
     * Blog section details.
     *
     * @since Photo Fusion 0.1
     *
     * @param array $input Blog section details.
     */
    function photo_fusion_get_blog_section_details( $input ) {
        $options = photo_fusion_get_theme_options();

        // Slider type
        $slider_content_type    = $options['blog_content_type'];

        $content = array();

        switch ( $slider_content_type ) {

            case 'recent-post':
                $args = array(
                    'posts_per_page'      => 3,
                    'ignore_sticky_posts' => true,
                );
            break;

            default:
            break;
        }

        $query = new WP_Query( $args );
        $j = 1;

        if ( $query->have_posts() ) {
            while ( $query->have_posts() ) {
                $query->the_post();

                $img_array = null;

                if ( has_post_thumbnail() ) {
                        $img_array = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'photo-fusion-portfolio-grid' );
                    } else {
                        $img_array[0] = get_template_directory_uri().'/assets/uploads/no-featured-image-300x300.png';
                    }

                    if ( isset( $img_array ) ) {
                        $content[$j]['img_array'] = $img_array;
                    }

                    $content[$j]['url']     = get_permalink();
                    $content[$j]['title']   = get_the_title();
                    $content[$j]['date']    = get_the_date('');
                    $content[$j]['date_url']= get_day_link( get_the_time('Y'), get_the_time('m'), get_the_time('d') );
                    $content[$j]['categories'] = get_the_category_list( esc_html__( ' / ', 'photo-fusion' ) );
                    $content[$j]['comment_no'] = get_comments_number();

                $j++;
            }
        }

        if ( ! empty( $content ) ) {
            $input = $content;
        }
        return $input;
    }
endif;
// Blog section content details.
add_filter( 'photo_fusion_filter_blog_section_details', 'photo_fusion_get_blog_section_details' );

if ( ! function_exists( 'photo_fusion_render_blog_section' ) ) :
    /**
     * Start section id .Blog
     *
     * @return string Blog content
     * @since Photo Fusion 0.1
     *
     */
    function photo_fusion_render_blog_section( $content_details = array() ) {
        $options = photo_fusion_get_theme_options();
        $content_type = $options['blog_content_type']; 

        if ( empty( $content_details ) ) {
            return;
        }

        $section_top_class = '';
        if( $options['slider_enable'] == 'disabled' &&  
            $options['about_enable'] == 'disabled'  && 
            $options['photo_gallery_enable'] == 'disabled' &&
            $options['portfolio_enable'] == 'disabled'
            ){
                $section_top_class = 'padding-top-section';
        }

        if( 'demo' == $content_type ){
            $section_title = __( 'Our blog', 'photo-fusion' );
            $section_desc  = __( 'Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.', 'photo-fusion' );
        }else{
            $section_title = !empty( $options['blog_title'] ) ? $options['blog_title'] : '';
        }

        ?>
        <section id="blog" class="bg-white">
            <div class="container page-section padding-top-0 padding-bottom-0 <?php echo $section_top_class; ?>">
            <?php if( !empty( $section_title ) ) : ?>
                <header class="entry-header">
                    <?php if( !empty( $section_title ) ){ ?>
                        <h2 class="entry-title"><?php echo esc_html( $section_title ); ?></h2>
                    <?php } ?>
                </header><!-- end .entry-header -->
            <?php endif; ?>
                <div class="entry-content three-col">

                <?php foreach ( $content_details as $content ) : ?>
                    <div class="column-wrapper">
                        <div class="blog-wrapper">
                            <figure>
                               <img src="<?php echo esc_url( $content['img_array'][0] ); ?>" alt="<?php echo esc_html( $content['title'] );?>">
                                <figcaption>
                                    <div class="blog-content">
                                        <div class="date">
                                            <span><i class="fa fa-clock-o"></i><a href="<?php echo esc_url( $content['date_url'] ); ?>"><?php echo esc_html( $content['date'] ).'</a> / '. $content['categories']; ?></span>
                                            <span><i class="fa fa-comments"></i><?php echo absint( $content['comment_no'] ); ?></span>
                                        </div><!-- end .date -->
                                        <div class="blog-title">
                                            <a href="<?php echo esc_url( $content['url'] );?>"><h4><?php echo esc_html( $content['title'] ); ?></h4></a>
                                        </div><!-- end .blog-title -->
                                    </div><!-- end .blog-contents -->
                                </figcaption>
                            </figure>
                        </div><!-- end .blog-wrapper -->
                    </div><!-- end .column-wrapper -->
                <?php endforeach; ?>

                    <div class="clear"></div><!-- end .clear -->
                </div><!-- end .entry-content -->
            </div><!-- end .container -->
        </section><!-- end #blog -->

<?php
    }
endif;