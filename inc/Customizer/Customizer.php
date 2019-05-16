<?php
/**
 * Customizer Class.
 *
 * @package 	AuroraWPThemes
 * @since 		1.0
 */

namespace AuroraThemes\Customizer;

use AuroraThemes\Core\Customizer as Customizer_Api;

// Do not allow directly accessing this file.
if ( !defined('ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

/**
 * Customizer Class.
 * This Class uses Cusomizer related methods
 * by tapping into the customizer api class.
 *
 * @since v1.0
 */
class Customizer {

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
     * @return AuroraThemes\Customizer\Customizer
     * @since  1.0
     */
    public static function get_instance() {
        if( null === self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Init Customizer.
     *
     * @access public
     * @since  1.0
     */
	public function register() {
		$this->customize_settings = Customizer_Api::get_instance();

        foreach ( $this->get_classes() as $class ) {
            $theme_customizer = $class::get_instance();

            if ( method_exists( $theme_customizer, 'register' ) ) {
                $theme_customizer->register();
            }
        }

        $this->customizer_init();
	}

    /**
     * Store all the classes.
     *
     * @static
     * @access private

     * @since  1.0
     */
    private function get_classes() {
        $classes = [
            \AuroraThemes\Customizer\Panels::class,
            \AuroraThemes\Customizer\Sections::class,
            \AuroraThemes\Customizer\Fields::class,
        ];

        return $classes;
    }

	/**
	 * Triggers the register method of the Customizer API Class.
	 *
	 * @access private
	 * @since  v1.0
	 */
	private function customizer_init() {
		$this->customize_settings->register();
	}
}
