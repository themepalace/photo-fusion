<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Photo_Fusion
 */

get_header();

	if ( true === apply_filters( 'photo_fusion_filter_frontpage_content_enable', true ) ) : 
		do_action( 'photo_fusion_banner_section' );
		?>
		<div class="container page-section">
			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">

					<?php
					while ( have_posts() ) : the_post();

						get_template_part( 'components/page/content', 'page' );

						// If comments are open or we have at least one comment, load up the comment template.
						if ( !is_front_page() && ( comments_open() || get_comments_number() ) ) :
							comments_template();
						endif;

					endwhile; // End of the loop.
					?>
				</main>
			</div>
			<?php
				if ( photo_fusion_is_sidebar_enable() ) {
					get_sidebar();
				}
			?>
		</div>
		<?php
	endif;
get_footer();