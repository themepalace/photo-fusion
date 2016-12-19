<?php
/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  0.5
 * @access public
 */
final class Photo_Fusion_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  0.5
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  0.5
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  0.5
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  0.5
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		require_once( trailingslashit( get_template_directory() ) . 'inc/customizer/upgrade-to-pro/section-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'Photo_Fusion_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new Photo_Fusion_Customize_Section_Pro(
				$manager,
				'photo_fusion',
				array(
					'title'    => esc_html__( 'Photo Fusion Pro', 'photo-fusion' ),
					'pro_text' => esc_html__( 'Go Pro',         'photo-fusion' ),
					'pro_url'  => 'http://themepalace.com/downloads/photo-fusion-pro/'
				)
			)
		);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  0.5
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'photo-fusion-customize-controls', trailingslashit( get_template_directory_uri() ) . 'inc/customizer/upgrade-to-pro/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'photo-fusion-customize-controls', trailingslashit( get_template_directory_uri() ) . 'inc/customizer/upgrade-to-pro/customize-controls.css' );
	}
}

// Doing this customizer thang!
Photo_Fusion_Customize::get_instance();
