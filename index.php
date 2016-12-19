<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
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
		<div class="grid">
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