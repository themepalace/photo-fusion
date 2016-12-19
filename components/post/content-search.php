<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Photo_Fusion
 */

if ( ! function_exists( 'photo_fusion_search_content_part' ) ) :
	/**
	 * Header Codes
	 *
	 * @since Photo Fusion 0.1
	 *
	 */
	function photo_fusion_search_content_part( $int ) {
		// echo $int;
	if ( $int == 9 ) $int = 1;
		if ( $int == 1 || $int == 6 ) {
			$width_class = 'grid-item-width-1';
			$img_size = 'photo-fusion-gallery-portrait';
			$no_img_size = '330x400';
		} elseif ( $int == 2 || $int == 5 ) {
			$width_class = 'grid-item-width-2';
			$img_size = 'photo-fusion-gallery-landscape';
			$no_img_size = '900x400';
		} else {
			$width_class = '';
			$img_size = 'post-thumbnail';
			$no_img_size = '625x400';
		}
		
	?>
	<article <?php post_class( 'grid-item ' . $width_class ); ?>>
		<div class="blog-wrapper">
			<figure>
				<?php 
				if ( has_post_thumbnail() ) {
					the_post_thumbnail( $img_size, array( 'alt' => the_title_attribute( 'echo=0' ) ) );
				} else {
					echo '<img src="'. get_template_directory_uri() .'/assets/uploads/no-featured-image-'. $no_img_size .'.png" >';
				}
				?>
				
				<figcaption>
					<div class="blog-content">
						<?php 
						if ( 'post' === get_post_type() ) :
							get_template_part( 'components/post/content', 'meta' ); 
						endif;
						?>
						<header class="entry-header">
							<?php
							if ( is_single() ) {
								the_title( '<h1 class="entry-title">', '</h1>' );
							} else {
								the_title( '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark"><h2 class="entry-title">', '</h2></a>' );
							}
							?>
						</header>
					</div><!-- end .blog-contents -->
				</figcaption>
			</figure>
		</div><!-- end .blog-wrapper -->
	</article>
<?php	
	}
endif;
add_filter( 'photo_fusion_search_content_filter', 'photo_fusion_search_content_part', 10, 1 );