<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Photo_Fusion
 */

if ( ! function_exists( 'photo_fusion_excerpt_length' ) ) :

/**
 * Implement excerpt length
 *
 * @since Photo Fusion 0.1
 *
 * @param int $length The number of words.
 * @return int Excerpt length.
 */
function photo_fusion_excerpt_length( $length ) {
   $options = photo_fusion_get_theme_options();

	$excerpt_length = $options['excerpt_length'];
	if ( empty( $excerpt_length ) ) {
		$excerpt_length = $length;
	}
	return apply_filters( 'photo_fusion_filter_excerpt_length', esc_attr( $excerpt_length ) );
}
endif;
add_filter( 'excerpt_length', 'photo_fusion_excerpt_length', 999 );


if ( ! function_exists( 'photo_fusion_trim_content' ) ) :
/**
 * Trim content to word $length specified
 *
 * @param  integer $length            number of words
 *
 * @param  string  $content content to be trimmed
 *
 * @return string                     trimmed content
 *
 * @since Photo Fusion 0.1
 */
function photo_fusion_trim_content( $post_obj = null, $length = 40 ) {
	global $post;
	if ( is_null( $post_obj ) ) {
		$post_obj = $post;
	}

	$length = absint( $length );
	if ( $length < 1 ) {
		$length = 40;
	}

	$source_content = $post_obj->post_content;
	if ( ! empty( $post_obj->post_excerpt ) ) {
		$source_content = $post_obj->post_excerpt;
	}

	$source_content = preg_replace( '`\[[^\]]*\]`', '', $source_content );
	$trimmed_content = wp_trim_words( $source_content, $length, '...' );

   return apply_filters( 'photo_fusion_trim_content', $trimmed_content );
}
endif;


if ( ! function_exists( 'photo_fusion_excerpt_more' ) && ! is_admin() ) :
/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 *
 * Create your own photo_fusion_excerpt_more() function to override in a child theme.
 *
 * @since Photo Fusion 0.1
 *
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function photo_fusion_excerpt_more() {
	$link = sprintf( '<a href="%1$s" class="more-link">%2$s</a>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( __( ' <i class="fa fa-long-arrow-right"></i><span class="screen-reader-text"> "%s"</span>', 'photo-fusion' ), get_the_title( get_the_ID() ) )
	);
	return $link;
}
add_filter( 'excerpt_more', 'photo_fusion_excerpt_more' );
endif;


if ( ! function_exists( 'photo_fusion_post_thumbnail' ) ) :
/**
 * Displays an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 *
 * Create your own photo_fusion_post_thumbnail() function to override in a child theme.
 *
 * @since Photo Fusion 0.1
 */
function photo_fusion_post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}

	if ( is_singular() ) {
		the_post_thumbnail( 'full' );
	} else { 
	?>
	<a href="<?php the_permalink(); ?>">
		<?php the_post_thumbnail( 'post-thumbnail', array( 'alt' => the_title_attribute( 'echo=0' ) ) ); ?>
	</a>
	<?php } 
}
endif;


if ( ! function_exists( 'photo_fusion_single_post_navigation' ) ) :
/**
 * Displays an optional single post navigation
 *
 *
 * Create your own photo_fusion_post_navigation() function to override in a child theme.
 *
 * @since Photo Fusion 0.1
 */
function photo_fusion_single_post_navigation() {
	
	the_post_navigation( array(
		'prev_text' => '<span class="btn fill btn-js"><i class="fa fa-angle-double-left"></i> ' . __( 'Previous','photo-fusion' ) . '</span>',
		'next_text' => '<span class="btn fill btn-js">' . __( 'Next', 'photo-fusion' ) . ' <i class="fa fa-angle-double-right"></i></span>'
	) );
}
endif;


if ( ! function_exists( 'photo_fusion_archive_post_navigation' ) ) :
/**
 * Displays an optional archive navigation
 *
 *
 * Create your own photo_fusion_archive_post_navigation() function to override in a child theme.
 *
 * @since Photo Fusion 0.1
 */
function photo_fusion_archive_post_navigation() {
		
	$options = photo_fusion_get_theme_options();

	if ( ! $options['enable_pagination'] )
		return;
	if ( in_array( $options['pagination_type'], array( 'numeric', 'older-newer' ) ) ) : ?>
		<?php
		if ( 'numeric' == $options['pagination_type'] ) {
			if( is_singular() )
				return;
			
			the_posts_pagination( array(
				    'mid_size' => 4,
				    'prev_text' => '<span class="btn fill btn-js">' .__( 'Previous Posts', 'photo-fusion' ). '</span>',
				    'next_text' => '<span class="btn fill btn-js">' .__( 'Next Posts', 'photo-fusion' ). '</span>',
				    'before_page_number' => '<span class="btn fill btn-js">',
				    'after_page_number'	 => '</span>',
				) );
		} elseif( 'older-newer' == $options['pagination_type'] ) {
			the_posts_navigation( array(
					'prev_text' => '<span class="btn fill btn-js">' .__( 'Older Posts', 'photo-fusion' ). '</span>',
				    'next_text' => '<span class="btn fill btn-js">' .__( 'New Posts', 'photo-fusion' ). '</span>',
				) );
		}
	endif;
}
endif;


if ( ! function_exists( 'photo_fusion_the_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 * @since Photo Fusion 0.1
 */
function photo_fusion_the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}
endif;


if ( ! function_exists( 'photo_fusion_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function photo_fusion_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s"><i class="fa fa-clock-o"></i>%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s"><i class="fa fa-clock-o"></i>%2$s</time><time class="updated" datetime="%3$s"><i class="fa fa-clock-o"></i>%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$categories_content =  '';
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ' / ', 'photo-fusion' ) );
		if ( $categories_list && photo_fusion_categorized_blog() ) {
			$categories_content =  $categories_list; // WPCS: XSS OK.
		}
	}
	$posted_on = ' <span class="screen-reader-text">Posted on </span><a href="' . esc_url( get_day_link( get_the_time('Y'), get_the_time('m'), get_the_time('d') ) ) . '" rel="bookmark">' . $time_string . '</a>';

	echo '<span class="posted-on">' . $posted_on . $categories_content. '</span>'; // WPCS: XSS OK.

}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function photo_fusion_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'photo_fusion_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'photo_fusion_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so photo_fusion_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so photo_fusion_categorized_blog should return false.
		return false;
	}
}

/**
 * Returns no of comments in a post.
 */
function photo_fusion_no_of_comment() {
	$no_of_comment = number_format_i18n( get_comments_number() );

	echo  '<span class="comment-value"><i class="fa fa-comments"></i>'. absint( $no_of_comment ).'</span>';
}

/**
 * Flush out the transients used in photo_fusion_categorized_blog.
 */
function photo_fusion_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'photo_fusion_categories' );
}
add_action( 'edit_category', 'photo_fusion_category_transient_flusher' );
add_action( 'save_post',     'photo_fusion_category_transient_flusher' );
