<?php
/**
 * Customizer Panel Class.
 *
 * @package 	AuroraWPThemes
 * @since 		1.0
 */

namespace AuroraThemes\Customizer;

use AuroraThemes\Core\Customizer as Customizer_Api;

// Do not allow directly accessing this file.
if ( ! defined('ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

/**
 * Customizer Panels Class.
 *
 * @since v1.0
 */
class Panels {

	/**
	 * Customizer Settings.
	 *
	 * @access private
	 * @var object
	 * @since  1.0
	 */
	private $customize_settings;

    /**
     * Refers to a single instance of this class.
     *
     * @static
     * @access public
     * @var null|object
     * @since  1.0
     */
    public static $instance = null;

    /**
     * Access the single instance of this class.
     *
     * @static
     * @access public
     * @return AuroraThemes\Customizer\Panels
     * @since  1.0
     */
    public static function get_instance() {
        if( null === self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Init Panels.
     *
     * @access public
     * @since  1.0
     */
	public function register() {

		$this->customize_settings = Customizer_Api::get_instance();

		$this->theme_panels();
	}

    /**
     * Theme Panels.
     *
     * @access private
     * @since  1.0
     */
	private function theme_panels() {

		$this->customize_settings->panel_args = [
			'aurora_dummy_panel'	=> [
				[
					'title' 		=> esc_html__( 'Dummy Panel', 'aurora-wp' ),
					'description' 	=> esc_html__( 'This is a dummy Panel', 'aurora-wp' ),
					'priority' 		=> 35,
				]
		    ],

			'aurora_dummy_panel_two'	=> [
				[
					'title' 		=> esc_html__( 'Dummy Panel two', 'aurora-wp' ),
					'description' 	=> esc_html__( 'This is a dummy Panel', 'aurora-wp' ),
					'priority' 		=> 36,
				]
		    ],
		];
	}

}