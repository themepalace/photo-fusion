<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Photo_Fusion
 */

get_header();
do_action( 'photo_fusion_banner_section' );
?>

<div class="container page-section">
	<div id="primary" class="content-area blog-masonry ">

		<?php
		if ( have_posts() ) : ?>
		<div id="grid" class="grid">
			<div class="grid-sizer"></div><!-- end .grid-sizer -->

			<?php
			/* Start the Loop */
			$i = 1;
			while ( have_posts() ) : the_post();
			
				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'components/post/content', get_post_format() );
				apply_filters( 'photo_fusion_post_content_filter', $i );
				?>
					
			<?php	
				$i++;
			endwhile;

		?>
		</div><!-- .grid -->
		<?php
			// displays default navigation
			photo_fusion_archive_post_navigation();
		else :

			get_template_part( 'components/post/content', 'none' );

		endif; ?>

	</div><!-- #primary -->
</div><!-- .section-layout -->

<?php
get_footer();