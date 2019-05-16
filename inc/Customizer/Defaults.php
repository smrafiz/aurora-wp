<?php
/**
 * Customizer Defaults Class.
 *
 * @package 	AuroraWPThemes
 * @since 		1.0
 */

namespace AuroraThemes\Customizer;

// Do not allow directly accessing this file.
if ( ! defined('ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

/**
 * Customizer Defaults Class.
 *
 * @since v1.0
 */
class Defaults {

	/**
	 * Customizer Default values.
     *
     * @static
	 * @access private
	 * @var object
	 * @since  1.0
	 */
	private static $customize_defaults;

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
     * @return AuroraThemes\Customizer\Defaults
     * @since  1.0
     */
    public static function get_instance() {
        if( null === self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Fetch Default Values.
     *
     * @static
     * @access public
     * @since  1.0
     */
	public static function fetch( $name ) {

		self::theme_defaults();

        if( ! array_key_exists( $name, self::$customize_defaults ) ) {
            return;
        }

        // var_dump($this->customize_defaults);

        return self::$customize_defaults[ $name ];

	}

    /**
     * Theme Defaults.
     *
     * @static
     * @access private
     * @since  1.0
     */
	private static function theme_defaults() {

		self::$customize_defaults = [
			'aurora_field_text'	            => esc_html__( 'Test default value', 'aurora-wp' ),
            'aurora_field_url'              => esc_url( 'google.com' ),
            'aurora_field_checkbox'         => intval( 1 ),
            'aurora_field_select'           => esc_attr( 'shopify' ),
            'aurora_field_radio'            => esc_attr( 'joomla' ),
            'aurora_field_textarea'         => esc_html__( 'This is a textarea', 'aurora-wp' ),
            'aurora_field_color'            => '#444',
            'aurora_field_switch'           => 0,
            'aurora_radio_image'            => esc_attr( 'sidebar-right' ),
            'aurora_radio_text'             => esc_attr( 'center' ),
            'aurora_field_slider'           => intval( 50 ),
            'aurora_field_typography'       => json_encode(
                [
                    'font'                  => 'Open Sans',
                    'regularweight'         => 'regular',
                    'italicweight'          => 'italic',
                    'boldweight'            => '700',
                    'category'              => 'sans-serif'
                ]
            ),
		];
	}

}