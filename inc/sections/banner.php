<?php
/**
 * Custom header options
 *
 * @package Theme Palace
 * @subpackage Photo_Fusion
 * @since Photo Fusion 0.1
 */


if ( ! function_exists( 'photo_fusion_custom_header' ) ) :
/**
 * Implementation of the Custom Header feature
 * Setup the WordPress core custom header feature and default custom headers packaged with the theme.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
	function photo_fusion_custom_header() {

		/**
		 * Get Theme Options Values
		 */
		$options 	= photo_fusion_get_theme_options();

		$args = array(

		// Header image default
		'default-image'			=> get_template_directory_uri() . '/assets/images/header.jpg',

		// Set height and width, with a maximum value for the width.
		'height'                 => 400,
		'width'                  => 1200,

		// Support flexible height and width.
		'flex-height'            => true,
		'flex-width'             => true,

		// Random image rotation off by default.
		'random-default'         => false,
	);

	$args = apply_filters( 'custom-header', $args );

	// Add support for custom header
	add_theme_support( 'custom-header', $args );

	}
endif; // photo_fusion_custom_header
add_action( 'after_setup_theme', 'photo_fusion_custom_header' );


if ( ! function_exists( 'photo_fusion_feature_header_image' ) ) :
	/**
	 * Template for Featured Header Image from theme options
	 *
	 * @since Photo Fusion 0.1
	 */
	function photo_fusion_feature_header_image() {
		global $wp_query;

		// Get front page ID
		$page_on_front	  = get_option('page_on_front');
		$page_for_posts   = get_option('page_for_posts');
		// Get Page ID outside Loop
		$page_id          = $wp_query->get_queried_object_id();

		$banner_background_image = '';

		if( !is_home() && $page_on_front == $page_id   ){
			return;
		} else{
			$get_header_image = get_header_image();
			$header_image = ! empty ( $get_header_image ) ? $get_header_image : get_template_directory_uri(). '/assets/images/header.jpg';

			$banner_background_image = '
			/* Add banner background image */
			#banner-image{
				background-image : url("'. esc_url( $header_image ) .'");
				background-repeat: no-repeat;
				background-size  : cover
			}';
		}

		wp_add_inline_style( 'photo-fusion-style', $banner_background_image );
	}
endif;
add_action( 'wp_enqueue_scripts', 'photo_fusion_feature_header_image' );


if( !function_exists( 'photo_fusion_render_banner_section' ) ) :
	/**
	 * Hook to display banner section
	 *
	 * @since Photo Fusion 0.1
	 */
	function photo_fusion_render_banner_section() {
		global $wp_query, $post;

		$options = photo_fusion_get_theme_options(); // get theme options 	

		// Get front page ID
		$page_on_front	  = get_option('page_on_front');
		$page_for_posts   = get_option('page_for_posts');
		// Get Page ID outside Loop
		$page_id          = $wp_query->get_queried_object_id();

		// Check if banner is in front page 

        if( $options['slider_enable'] == 'disabled' &&  
            $options['about_enable'] == 'disabled'  && 
            $options['photo_gallery_enable'] == 'disabled' &&
            $options['portfolio_enable'] == 'disabled' )
        {
                $section_top_class = 'padding-top-section';
        }else{
        	 $section_top_class = '';
        }

		if( !is_home() && $page_on_front == $page_id ) {
			$section_id = 'home-banner';
			$section_class = $section_top_class;
		} else{
			$section_id = 'banner-image';
			$section_class = '';
		}
	?>
	<section id="<?php echo esc_attr( $section_id ); ?>">
        <div class="banner-wrapper banner-overlay <?php echo esc_attr( $section_class ); ?>">

            <div class="page-title">
              	<h1><?php
              	if ( is_home() && ! is_front_page() ) :
              		single_post_title();

              	elseif( is_singular() ) :
              		single_post_title();

              	elseif( is_home() ):
              		esc_html_e( 'Latest blog', 'photo-fusion');

              	elseif( is_search() ) :
              		printf( esc_html__( 'Search Results for: %s', 'photo-fusion' ), '<span>' . esc_html( get_search_query() ). '</span>' );

              	elseif( is_404() ) :
              		esc_html_e( 'Oops! That page can&rsquo;t be found.', 'photo-fusion' );

              	else:
	            	the_archive_title();
				endif;
				?></h1>
			</div>

			<?php 
				the_archive_description( '<div class="page-desc"><p>', '</p></div>' );
			?>

        </div><!-- end .banner-wrapper -->
    </section><!-- end #banner-image -->
	<?php
	}
endif;
add_action( 'photo_fusion_banner_section', 'photo_fusion_render_banner_section' );


