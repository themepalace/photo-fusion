<?php
/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}

if ( ! function_exists( 'photo_fusion_alter_comment_form_fields' ) ) {
	/**
	* Alter the comment form fields
	* @param  array Array of fields to be customized
	* @return array Array of customized fields
	*/
	function photo_fusion_alter_comment_form_fields($fields){
		$fields['author'] = '<div class="form-group"><input id="author" name="author" type="text" placeholder="' . __( 'Name*', 'photo-fusion' ) . '" size="30"/>';
		$fields['email'] 	= '<input id="email" name="email" type="text" placeholder="' . __( 'Email*', 'photo-fusion' ) . '"size="30"/>';
		$fields['url'] 	= '<input id="url" name="url" type="text" placeholder="' . __( 'Website', 'photo-fusion' ) . '"size="30" /></div><!-- end .form-group -->';
		return $fields;
	}
	add_filter('comment_form_default_fields','photo_fusion_alter_comment_form_fields');
}

$tp_fields = array(
	'comment_field' => '<div class="form-group"><textarea id="comment" name="comment" cols="15" rows="6" placeholder="' . __( 'Comments*', 'photo-fusion' ) . '" aria-required="true"></textarea></div><!-- end .form-group -->',
	'submit_button' => '<div class="form-group btn fill btn-js"><input type="submit" class="submit" value="'. __( 'POST COMMENT', 'photo-fusion' ) .'"></div>',
);

if ( ! function_exists( 'photo_fusion_move_comment_field_to_bottom' ) ) {
	/**
	* move comment form to bottom
	*/
	function photo_fusion_move_comment_field_to_bottom( $fields ) {
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;
	return $fields;
	}
}
add_filter( 'comment_form_fields', 'photo_fusion_move_comment_field_to_bottom' );
?>

<section id="comments" class="comments-area">
	 <div class="comments">

		<?php if ( have_comments() ) : ?>
			 <h3>
				<?php
					printf( // WPCS: XSS OK.
						esc_html( _nx( ' Comment ( %1$s )', 'Comments ( %1$s )', get_comments_number(), 'photo-fusion', 'photo-fusion' ) ),
						number_format_i18n( get_comments_number() ), get_the_title()
					);
				?>
			</h3>

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
				<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'photo-fusion' ); ?></h2>
				<div class="nav-links">
					<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'photo-fusion' ) ); ?></div>
					<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'photo-fusion' ) ); ?></div>
				</div><!-- .nav-links -->
			</nav><!-- #comment-nav-above -->
			<?php endif; // Check for comment navigation. ?>
			<div class="entry-content">
				<ul>
	            <?php
					wp_list_comments( array(
						'callback' 		=> 'photo_fusion_comments_callback',
						'avatar_size'   => 100,
						) );
	            ?>
	         	</ul>
	        </div><!-- .entry-content -->
			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
				<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'photo-fusion' ); ?></h2>
				<div class="nav-links">

					<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'photo-fusion' ) ); ?></div>
					<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'photo-fusion' ) ); ?></div>

				</div><!-- .nav-links -->
			</nav><!-- #comment-nav-below -->
			<?php endif; // Check for comment navigation. ?>

		<?php endif; // Check for have_comments(). ?>

		<?php
			// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'photo-fusion' ); ?></p>
		<?php endif; ?>

		<?php comment_form( $tp_fields ); ?>
	</div><!-- end .standard-layout -->
</section><!-- #comments -->

<?php
function photo_fusion_comments_callback( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
    <article id="comment-<?php comment_ID(); ?>" class="comment">

        <div class="parent">
            <div class="image">
                <?php echo get_avatar( $comment ); ?>
            </div>
            <div class="admin-name">
            	<h5><?php echo esc_attr( get_comment_author() ); ?></h5>
            	<div class="time">
					<time class="entry-date published"><i class="fa fa-clock-o"></i>
						<?php printf( __( '%1$s', 'photo-fusion' ), get_comment_date() ); ?>
					</time>
					<div class="reply"><?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'photo-fusion' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></div>
				</div><!-- end .time -->
			</div><!-- end .admin-name -->
			<div class="comment-desc">
				<p><?php comment_text(); ?></p>
			</div><!--end comment-desc-->
        </div><!-- end .parent -->

    </article>
</li>
<?php
}

