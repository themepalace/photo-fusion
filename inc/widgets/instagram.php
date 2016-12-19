<?php
/**
 * Instagram Widget
 *
 * @package Theme Palace
 * @subpackage Photo Fusion
 * @since Photo Fusion 0.1
 */


if ( ! class_exists( 'WP_Widget' ) ) {
	return null;
}

class Photo_Fusion_Instagram_Widget extends WP_Widget {

	/**
	 * Holds widget settings defaults, populated in constructor.
	 *
	 * @var array
	 */
	protected $defaults;

	/**
	 * Constructor. Set the default widget options and create widget.
	 *
	 * @since 0.1.0
	 */
	function __construct() {
		$this->defaults = array(
			'title'    => __( 'Instagram', 'photo-fusion' ),
			'username' => '',
			'layout'   => 'one-column',
			'number'   => 5,
			'size'     => 'small',
			'target'   => 0,
			'link'     => '',
		);

		$tp_widget_instagram = array(
			'classname'   => 'tp-instagram tpinstagram tpfeaturedpostpageimage',
			'description' => __( 'Displays your latest Instagram photos', 'photo-fusion' ),
		);

		$tp_control_instagram = array(
			'id_base' => 'tp-instagram',
		);

		parent::__construct(
			'tp-instagram', // Base ID
			__( 'TP: Instagram', 'photo-fusion' ), // Name
			$tp_widget_instagram,
			$tp_control_instagram
		);
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title', 'photo-fusion' ); ?>:</label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>"><?php _e( 'Username', 'photo-fusion' ); ?>:</label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'username' ) ); ?>" value="<?php echo esc_attr( $instance['username'] ); ?>" class="widefat" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'layout' ) ); ?>"><?php _e( 'Layout', 'photo-fusion' ); ?>:</label>
			<select id="<?php echo esc_attr( $this->get_field_id( 'layout' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'layout' ) ); ?>" class="widefat">
				<?php
					$post_type_choices = array(
						'one-col'   => __( '1 Column', 'photo-fusion' ),
						'two-col'   => __( '2 Column', 'photo-fusion' ),
						'three-col' => __( '3 Column', 'photo-fusion' ),
						'four-col'  => __( '4 Column', 'photo-fusion' ),
						'five-col'  => __( '5 Column', 'photo-fusion' ),
					);

				foreach ( $post_type_choices as $key => $value ) {
					echo '<option value="' . $key . '" '. selected( $key, $instance['layout'], false ) .'>' . $value .'</option>';
				}
				?>
			</select>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php _e( 'Number of photos', 'photo-fusion' ); ?>:</label>
			<input type="number" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" value="<?php echo absint( $instance['number'] ); ?>" class="small-text" min="1" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'size' ) ); ?>"><?php _e( 'Instagram Image Size', 'photo-fusion' ); ?>:</label>
			<select id="<?php echo esc_attr( $this->get_field_id( 'size' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'size' ) ); ?>" class="widefat">
				<?php
					$post_type_choices = array(
						'thumbnail' => __( 'Thumbnail', 'photo-fusion' ),
						'small'     => __( 'Small', 'photo-fusion' ),
						'large'     => __( 'Large', 'photo-fusion' ),
						'original'  => __( 'Original', 'photo-fusion' ),
					);

				foreach ( $post_type_choices as $key => $value ) {
					echo '<option value="' . $key . '" '. selected( $key, $instance['size'], false ) .'>' . $value .'</option>';
				}
				?>
			</select>
		</p>

		 <p>
        	<input class="checkbox" type="checkbox" <?php checked( $instance['target'], true ) ?> id="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'target' ) ); ?>" />
        	<label for="<?php echo esc_attr( $this->get_field_id('target' ) ); ?>"><?php _e( 'Check to Open Link in new Tab/Window', 'photo-fusion' ); ?></label><br />
        </p>

		<?php

	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title']    = sanitize_text_field( $new_instance['title'] );
		$instance['username'] = sanitize_text_field( $new_instance['username'] );
		$instance['layout']   = sanitize_key( $new_instance['layout'] );
		$instance['number']   = absint( $new_instance['number'] );
		$instance['size']     = sanitize_key( $new_instance['size'] );
		$instance['target']   = photo_fusion_sanitize_checkbox( $new_instance['target'] );

		return $instance;
	}

	function widget( $args, $instance ) {
		// Merge with defaults
		$instance = wp_parse_args( (array) $instance, $this->defaults );
		?>
		<section id="instagram" class="<?php echo esc_attr( $instance['layout'] ); ?>">
		<?php
		// Set up the author bio
		if ( ! empty( $instance['title'] ) ) {
			echo '<header class="entry-header">' . $args['before_title'] . apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) . $args['after_title'] . '</header>';
		}

		$username = empty( $instance['username'] ) ? '' : $instance['username'];
		$number   = empty( $instance['number'] ) ? 9 : $instance['number'];
		$size     = empty( $instance['size'] ) ? 'large' : $instance['size'];
		$link     = empty( $instance['link'] ) ? '' : $instance['link'];

		$target = '_self';

		if ( $instance['target'] ) {
			$target = '_blank';
		}

		if ( '' != $username ) {

			$media_array = $this->scrape_instagram( $username, $number );

			if ( is_wp_error( $media_array ) ) {

				echo wp_kses_post( $media_array->get_error_message() );

			}
			else {
				// filter for images only?
				if ( $images_only = apply_filters( 'photo_fusion_images_only', FALSE ) ) {
					$media_array = array_filter( $media_array, array( $this, 'images_only' ) );
				}
				?>

					<?php
					foreach ( $media_array as $item ) {
						echo '
						<div class="column-wrapper">
							<figure>
								<img src="'. esc_url( $item[$size] ) .'"  alt="'. esc_attr( $item['description'] ) .'"/>
								<div class="red-overlay"></div><!-- end .red-overlay -->
								<i class="fa fa-instagram"></i>
								<div class="popup-image">
				                    <a href="'. esc_url( $item['large'] ) .'" data-lightbox="masonry"><i class="fa fa-eye"></i></a>
				                    <a href="'. esc_url( $item['link'] ) .'" target="'. esc_attr( $target ) .'"><i class="fa fa-link"></i></a>
				                </div><!-- end .popup-image -->
				               	<figcaption> 
				                    <a href="'. esc_url( $item['link'] ) .'"><h5 class="instagram-title">'. esc_html(wp_trim_words( $item['description'], 3, '' ) ) .'</h5></a>
				                    <span class="instagram-title">'. esc_html( $username ) .'</span> 
				                </figcaption>
							</figure> 
						</div><!-- end .column-wrapper -->';
					}
			}
		}
		?>
		</section>
	<?php
	}

	// based on https://gist.github.com/cosmocatalano/4544576
	function scrape_instagram( $username, $slice = 9 ) {
		$username = strtolower( $username );
		$username = str_replace( '@', '', $username );

		if ( false === ( $instagram = get_transient( 'instagram-a3-'.sanitize_title_with_dashes( $username ) ) ) ) {

			$remote = wp_remote_get( 'http://instagram.com/'.trim( $username ) );

			if ( is_wp_error( $remote ) ) {
				return new WP_Error( 'site_down', esc_html__( 'Unable to communicate with Instagram.', 'photo-fusion' ) );
			}

			if ( 200 != wp_remote_retrieve_response_code( $remote ) ) {
				return new WP_Error( 'invalid_response', esc_html__( 'Instagram did not return a 200.', 'photo-fusion' ) );
			}

			$shards      = explode( 'window._sharedData = ', $remote['body'] );
			$insta_json  = explode( ';</script>', $shards[1] );
			$insta_array = json_decode( $insta_json[0], TRUE );

			if ( ! $insta_array ) {
				return new WP_Error( 'bad_json', esc_html__( 'Instagram has returned invalid data.', 'photo-fusion' ) );
			}

			if ( isset( $insta_array['entry_data']['ProfilePage'][0]['user']['media']['nodes'] ) ) {
				$images = $insta_array['entry_data']['ProfilePage'][0]['user']['media']['nodes'];
			}
			else {
				return new WP_Error( 'bad_json_2', esc_html__( 'Instagram has returned invalid data.', 'photo-fusion' ) );
			}

			if ( ! is_array( $images ) ) {
				return new WP_Error( 'bad_array', esc_html__( 'Instagram has returned invalid data.', 'photo-fusion' ) );
			}

			$instagram = array();

			foreach ( $images as $image ) {

				$image['thumbnail_src'] = preg_replace( '/^https?\:/i', '', $image['thumbnail_src'] );
				$image['display_src']   = preg_replace( '/^https?\:/i', '', $image['display_src'] );

				// handle both types of CDN url
				if ( (strpos( $image['thumbnail_src'], 's640x640' ) !== false ) ) {
					$image['thumbnail'] = str_replace( 's640x640', 's160x160', $image['thumbnail_src'] );
					$image['small']     = str_replace( 's640x640', 's320x320', $image['thumbnail_src'] );
				}
				else {
					$urlparts  = wp_parse_url( $image['thumbnail_src'] );
					$pathparts = explode( '/', $urlparts['path'] );

					array_splice( $pathparts, 3, 0, array( 's160x160' ) );

					$image['thumbnail'] = '//' . $urlparts['host'] . implode('/', $pathparts);
					$pathparts[3]       = 's320x320';
					$image['small']     = '//' . $urlparts['host'] . implode('/', $pathparts);
				}

				$image['large'] = $image['thumbnail_src'];

				if ( $image['is_video'] == true ) {
					$type = 'video';
				}
				else {
					$type = 'image';
				}

				$caption = __( 'Instagram Image', 'photo-fusion' );
				if ( ! empty( $image['caption'] ) ) {
					$caption = $image['caption'];
				}

				$instagram[] = array(
					'description'   => $caption,
					'link'		  	=> '//instagram.com/p/' . $image['code'],
					'time'		  	=> $image['date'],
					'comments'	  	=> $image['comments']['count'],
					'likes'		 	=> $image['likes']['count'],
					'thumbnail'	 	=> $image['thumbnail'],
					'small'			=> $image['small'],
					'large'			=> $image['large'],
					'original'		=> $image['display_src'],
					'type'		  	=> $type
				);
			}



			// do not set an empty transient - should help catch private or empty accounts
			if ( ! empty( $instagram ) ) {
				set_transient( 'instagram-a3-'.sanitize_title_with_dashes( $username ), $instagram, apply_filters( 'photo_fusion_instagram_cache_time', HOUR_IN_SECONDS*2 ) );
			}
		}

		if ( ! empty( $instagram ) ) {
			return array_slice( $instagram, 0, $slice );
		} else {

			return new WP_Error( 'no_images', esc_html__( 'Instagram did not return any images.', 'photo-fusion' ) );

		}
	}

	function images_only( $media_item ) {
		if ( $media_item['type'] == 'image' ) {
			return true;
		}

		return false;
	}
}

/*
 * Function to register instagram widget
 */
function photo_fusion_register_widgets() {
	register_widget( 'Photo_Fusion_Instagram_Widget' );
}
add_action( 'widgets_init', 'photo_fusion_register_widgets' );