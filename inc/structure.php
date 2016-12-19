<?php
/**
 * Photo Fusion basic theme structure hooks
 *
 * This file contains structural hooks.
 *
 * @package Theme Palace
 * @subpackage Photo_Fusion
 * @since Photo Fusion 0.1
 */

$options = photo_fusion_get_theme_options();


if ( ! function_exists( 'photo_fusion_doctype' ) ) :
	/**
	 * Doctype Declaration.
	 *
	 * @since Photo Fusion 0.1
	 */
	function photo_fusion_doctype() {
	?>
		<!DOCTYPE html>
			<html <?php language_attributes(); ?>>
	<?php
	}
endif;

add_action( 'photo_fusion_doctype', 'photo_fusion_doctype', 10 );


if ( ! function_exists( 'photo_fusion_head' ) ) :
	/**
	 * Header Codes
	 *
	 * @since Photo Fusion 0.1
	 *
	 */
	function photo_fusion_head() {
		?>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
			<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php endif;
	}
endif;
add_action( 'photo_fusion_before_wp_head', 'photo_fusion_head', 10 );


if ( ! function_exists( 'photo_fusion_page_start' ) ) :
	/**
	 * Start div id #page and screen reader link
	 *
	 * @since Photo Fusion 0.1
	 *
	 */
	function photo_fusion_page_start() {
		?>
		<div id="page" class="hfeed site">
			<div class="site-inner">
				<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'photo-fusion' ); ?></a>
		<?php
	}
endif;
add_action( 'photo_fusion_page_start', 'photo_fusion_page_start', 10 );

if ( ! function_exists( 'photo_fusion_header_start' ) ) :
	/**
	 * Start div id #masthead
	 *
	 * @since Photo Fusion 0.1
	 *
	 */
	function photo_fusion_header_start() {
		$options = photo_fusion_get_theme_options();
		$section_top_class = ( $options['slider_enable'] == 'disabled' ) ? 'header-bg' : ''; 
		?>
		<header id="masthead" class="site-header make-sticky <?php echo esc_attr( $section_top_class );?>" role="banner">
			<div class="container">
		<?php
	}
endif;
add_action( 'photo_fusion_header', 'photo_fusion_header_start', 10 );


if ( ! function_exists( 'photo_fusion_site_branding' ) ) :
	/**
	 * Start .site-branding
	 *
	 * @since Photo Fusion 0.1
	 *
	 */
	function photo_fusion_site_branding() {
		get_template_part( 'components/header/site', 'branding' );
	}
endif;
add_action( 'photo_fusion_header', 'photo_fusion_site_branding', 20 );

if ( ! function_exists( 'photo_fusion_site_nav' ) ) :
	/**
	 * Site navigation
	 *
	 * @since Photo Fusion 0.1
	 *
	 */
	function photo_fusion_site_nav() {
		get_template_part( 'components/navigation/navigation', 'top' );
	}
endif;
add_action( 'photo_fusion_header', 'photo_fusion_site_nav', 30 );

if ( ! function_exists( 'photo_fusion_header_end' ) ) :
	/**
	 * Header ends
	 *
	 * @since Photo Fusion 0.1
	 *
	 */
	function photo_fusion_header_end() { ?>
			</div><!-- .header-wrap -->
		</header>
	<?php
	}
endif;
add_action( 'photo_fusion_header', 'photo_fusion_header_end', 100 );


if ( ! function_exists( 'photo_fusion_mobile_menu' ) ) :
	/**
	 * End div id #content
	 *
	 * @since Photo Fusion 0.1
	 *
	 */
	function photo_fusion_mobile_menu() {
		?>
		 <!-- Mobile Menu -->
        <nav id="sidr-left-top" class="mobile-menu sidr left">
        <?php $custom_logo = photo_fusion_the_custom_logo();

        	if( !empty( $custom_logo ) ){ ?>
            <div class="site-branding alignleft"><!-- use alignright class to change logo position -->
                <div class="site-logo">
                <?php echo $custom_logo(); ?>
                </div><!-- end .site-logo -->
            </div><!-- end .site-branding -->
            <?php } ?>
            <?php
            if ( has_nav_menu( 'top' ) ) {
			    $args = array(
			        'theme_location'  => 'top',
			        'container'       => 'false',
			        'container_id'    => 'site-navigation',
			        'container_class' => 'main-navigation ',
			        'menu_id'         => 'primary-menu',
			        'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
			        'depth'           => 0,
			    );
    			wp_nav_menu( $args );
			}?>
        </nav><!-- end left-menu -->
        <a id="sidr-left-top-button" class="menu-button right" href="#sidr-left-top"><i class="fa fa-bars"></i></a>
		<?php
	}
endif;
add_action( 'photo_fusion_header', 'photo_fusion_mobile_menu', 110 );

if ( ! function_exists( 'photo_fusion_content_start' ) ) :
	/**
	 * Start div id #content
	 *
	 * Site content starts
	 *
	 * @since Photo Fusion 0.1
	 *
	 */
	function photo_fusion_content_start() { ?>
		<div id="content" class="site-content">
	<?php
	}
endif;
add_action( 'photo_fusion_content_start', 'photo_fusion_content_start', 10 );

if ( ! function_exists( 'photo_fusion_content_end' ) ) :
	/**
	 * End div id #content
	 *
	 * Site content ends
	 *
	 * @since Photo Fusion 0.1
	 *
	 */
	function photo_fusion_content_end() { ?>
		</div><!-- end #content-->
	<?php
	}
endif;
add_action( 'photo_fusion_content_end', 'photo_fusion_content_end', 100 );


if ( ! function_exists( 'photo_fusion_scroll_top' ) ) :
	/**
	 * Start div class .backtotop
	 *
	 * Scroll to top
	 *
	 * @since Photo Fusion 0.1
	 *
	 */
	function photo_fusion_scroll_top() { ?>
		<div class="backtotop fa fa-angle-up"></div>
	<?php
	}
endif;
add_action( 'photo_fusion_scroll_top', 'photo_fusion_scroll_top', 10 );


if ( ! function_exists( 'photo_fusion_footer_start' ) ) :
	/**
	 * Start footer id .colophon
	 *
	 * Footer start
	 *
	 * @since Photo Fusion 0.1
	 *
	 */
	function photo_fusion_footer_start() {
		$col = ( is_active_sidebar( 'footer-2' ) || has_nav_menu('footer-menu') ) ? 'two-col' : 'one-col';?>
			<footer id="colophon" class="site-footer <?php echo $col; ?>">
		<?php
	}
endif;
add_action( 'photo_fusion_footer', 'photo_fusion_footer_start', 10 );

if ( ! function_exists( 'photo_fusion_footer' ) ) :
	/**
	 * Footer
	 *
	 * @since Photo Fusion 0.1
	 *
	 */
	function photo_fusion_footer() {
	?>
	<div class="column-wrapper">
        <?php
        	if( is_active_sidebar( 'footer-1' ) ){
        		dynamic_sidebar( 'footer-1' );
        	}
	   		get_template_part( 'components/footer/site', 'info' );
	   ?>
    </div><!-- end .column-wrapper -->

    <div class="column-wrapper">

       <?php
       		if( has_nav_menu('footer-menu') ){
       	?>
       	<div class="one-col footer-nav">
       	<?php
			   /**
				* Displays a navigation menu
				* @param array $args Arguments
				*/
				$args = array(

					'theme_location'  => 'footer-menu',
			        'container'       => 'false',
			        'menu_id'         => 'primary-menu',
			        'menu_class'      => 'menu nav-menu',
			        'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
			        'depth'           => 0,
				);

				wp_nav_menu( $args );
		?>
       </div><!-- .one-col -->
       	<?php
       		}

	       	if( is_active_sidebar( 'footer-2' ) ){ ?>
			<div class="one-col footer-second-widget">
			    	<?php dynamic_sidebar( 'footer-2' ); ?>
			   
			</div>
			<?php  } ?>
	</div><!-- end .column-wrapper -->
	<?php
	}
endif;
add_action( 'photo_fusion_footer', 'photo_fusion_footer', 30 );

if ( ! function_exists( 'photo_fusion_footer_end' ) ) :
	/**
	 * End div .site-info
	 *
	 * Footer end
	 *
	 * @since Photo Fusion 0.1
	 *
	 */
	function photo_fusion_footer_end() {
		?>
		</footer>
		<?php
	}
endif;
add_action( 'photo_fusion_footer', 'photo_fusion_footer_end', 100 );


if ( ! function_exists( 'photo_fusion_page_end' ) ) :
	/**
	 * End div id #content
	 *
	 * @since Photo Fusion 0.1
	 *
	 */
	function photo_fusion_page_end() {
		?>
				</div><!--end site-inner -->
		</div><!-- end site-->
		<?php
	}
endif;
add_action( 'photo_fusion_page_end', 'photo_fusion_page_end', 100 );
