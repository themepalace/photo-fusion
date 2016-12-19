<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Photo_Fusion
 */

get_header();?>
	<?php do_action( 'photo_fusion_banner_section' ); //get banner section ?>
	<div class="container page-section">
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'components/post/content', 'single' );

				photo_fusion_single_post_navigation();
				
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

			</main>
		</div><!-- .content-area -->
		<?php
		if ( photo_fusion_is_sidebar_enable() ) {
			get_sidebar();
		}
		?>
	</div>
<?php
get_footer();
