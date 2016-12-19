<?php
/**
 * components functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Photo_Fusion
 */

if ( ! function_exists( 'photo_fusion_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the aftercomponentsetup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function photo_fusion_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on components, use a find and replace
	 * to change 'photo-fusion' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'photo-fusion', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 625, 400, true );

	add_image_size( 'photo-fusion-slider-image', 1350, 760, true );
	add_image_size( 'photo-fusion-portfolio-grid', 300, 300, true );
	add_image_size( 'photo-fusion-portfolio-landscape', 500, 250, true );
	add_image_size( 'photo-fusion-portfolio-portrait', 250, 500, true );
	add_image_size( 'photo-fusion-portfolio-condensed', 250, 316, true );
	add_image_size( 'photo-fusion-gallery-portrait', 330, 400, true );
	add_image_size( 'photo-fusion-gallery-landscape', 900, 400, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'top'           => esc_html__( 'Primary Header Menu', 'photo-fusion' ),
		'footer-menu' => esc_html__( 'Footer Menu', 'photo-fusion' )
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'photo_fusion_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'assets/css/editor-style.min.css' ) );

	add_theme_support( 'custom-logo', array(
		'height'      => 75,
		'width'       => 150,
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => array( 'site-title', 'site-description' ),
	) );

}
endif;
add_action( 'after_setup_theme', 'photo_fusion_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function photo_fusion_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'photo_fusion_content_width', 640 );
}
add_action( 'after_setup_theme', 'photo_fusion_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function photo_fusion_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'photo-fusion' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="entry-title widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Instagram Sidebar', 'photo-fusion' ),
		'id'            => 'instagram-sidebar',
		'description'   => __( 'This is an Instagram widget area. It typically appears above footer section. This widget works best with an Instagram widget.', 'photo-fusion' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="entry-title widget-title">',
		'after_title'   => '</h2>',
	) );

	for ($i=1; $i <= 2 ; $i++) {
		register_sidebar( array(
			'name'          => sprintf( esc_html__( 'Footer %s', 'photo-fusion' ), $i ),
			'id'            => 'footer-'.$i,
			'description'   => '',
			'before_widget' => '<div id="%1$s" class="widget-wrap %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="entry-title widget-title">',
			'after_title'   => '</h3>',
		) );
	}
}
add_action( 'widgets_init', 'photo_fusion_widgets_init' );


if ( ! function_exists( 'photo_fusion_fonts_url' ) ) :
/**
 * Register Google fonts for Photo Fusion
 *
 * Create your own photo_fusion_fonts_url() function to override in a child theme.
 *
 * @since Photo Fusion 0.1
 *
 * @return string Google fonts URL for the theme.
 */
function photo_fusion_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Montserrat Sans, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Montserrat font: on or off', 'photo-fusion' ) ) {
		$fonts[] = 'Montserrat:400';
	}

	/* translators: If there are characters in your language that are not supported by Courgette, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Courgette font: on or off', 'photo-fusion' ) ) {
		$fonts[] = 'Courgette:400';
	}

	/* translators: If there are characters in your language that are not supported by Roboto, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Roboto font: on or off', 'photo-fusion' ) ) {
		$fonts[] = 'Roboto:400';
	}

	/* translators: If there are characters in your language that are not supported by Raleway, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Raleway font: on or off', 'photo-fusion' ) ) {
		$fonts[] = 'Raleway:400';
	}

	/* translators: If there are characters in your language that are not supported by Poppins, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Poppins font: on or off', 'photo-fusion' ) ) {
		$fonts[] = 'Poppins:400';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;


/**
 * Enqueue scripts and styles.
 */
function photo_fusion_scripts() {
	
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'photo-fusion-fonts', photo_fusion_fonts_url(), array(), null );

	// Add fontawesome
	wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/assets/plugins/fontawesome/css/font-awesome.min.css', '', '4.6.3' );

	//Add sidr-light style
	wp_enqueue_style( 'jquery-sidr-light', get_template_directory_uri() . '/assets/css/jquery.sidr.light.min.css', '', '2.8.2' );

	//Add lightbox style
	wp_enqueue_style( 'lightbox', get_template_directory_uri() . '/assets/css/lightbox.min.css', '', '2.8.2' );

	// Theme stylesheet.
	wp_enqueue_style( 'photo-fusion-style', get_stylesheet_uri() );

	//Add default color layout
	wp_enqueue_style( 'photo-fusion-default-color-layout', get_template_directory_uri() . '/assets/colors/default.min.css', array( 'photo-fusion-style' ), '3.5.1' );

	wp_enqueue_script( 'photo-fusion-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.min.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Add cycle2 js
	wp_enqueue_script( 'cycle2', get_template_directory_uri() . '/assets/plugins/cycle2/cycle2.min.js', array( 'jquery' ), '2.1.6', true );

	// Add sidr js
	wp_enqueue_script( 'jquery-sidr', get_template_directory_uri() . '/assets/js/jquery.sidr.min.js', array( 'jquery' ), '2.2.1', true );

	// Add images loader pkgd js
	wp_enqueue_script( 'imagesloaded', get_template_directory_uri() . '/assets/js/imagesloaded.min.js', array(), '3.1.8', true );

	// Add lightbox js
	wp_enqueue_script( 'lightbox', get_template_directory_uri() . '/assets/js/lightbox.min.js', array( 'jquery' ), '2.8.2', true );

	// Add isotope js
	wp_enqueue_script( 'isotope', get_template_directory_uri() . '/assets/js/isotope.min.js', array( 'jquery' ), '3.0.0', true );

	// Add smoothscroll js
	wp_enqueue_script( 'smoothscroll', get_template_directory_uri() . '/assets/js/smoothscroll.min.js', array( 'jquery' ), '3.0.0', true );

	// Add custom js
	wp_enqueue_script( 'photo-fusion-custom', get_template_directory_uri() . '/assets/js/custom.min.js', array( 'jquery' ), '', true );

	// Load the html5 shiv.
	wp_enqueue_script( 'html5', get_template_directory_uri() . '/assets/js/html5.min.js', array(), '3.7.3' );
	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );
}
add_action( 'wp_enqueue_scripts', 'photo_fusion_scripts' );


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load Photo Fusion core file
 */
require get_template_directory() . '/inc/core.php';

/*
*Register gallery thumbnail size to media.
*/
function photo_fusion_custom_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'photo-fusion-portfolio-grid' 		=> __( 'Gallery Thumbnail', 'photo-fusion' ),
        'photo-fusion-portfolio-condensed' 	=> __( 'Gallery Portrait Thumbnail', 'photo-fusion' ),
    ) );
}
add_filter( 'image_size_names_choose', 'photo_fusion_custom_sizes' );