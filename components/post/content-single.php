<?php
/**
 * Template part for displaying singl posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Photo_Fusion
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="archive-post-wrap blog-wrapper">
		<?php photo_fusion_post_thumbnail();?>
		<div class="entry-content">
		 	<div class="blog-content">
		 	<?php 	
		 		if ( 'post' === get_post_type() ) { 
		 			 	get_template_part( 'components/post/content', 'meta' ); }

				the_content( sprintf(
					/* translators: %s: Name of current post. */
					wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'photo-fusion' ), array( 'span' => array( 'class' => array() ) ) ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				) );

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'photo-fusion' ),
					'after'  => '</div>',
				) );
			?>
			</div><!-- end .blog-contents -->
			<?php
				if ( 'post' === get_post_type() ) { 
			 		get_template_part( 'components/post/content', 'footer' ); }
		 	?>
        </div><!-- end .entry-content -->

	</div>
</article><!-- #post-## -->