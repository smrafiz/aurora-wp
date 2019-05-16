<?php
/**
 * Customizer Section Class.
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
 * Customizer Sections Class.
 *
 * @since v1.0
 */
class Sections {

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
     * @return AuroraThemes\Customizer\Sections
     * @since  1.0
     */
    public static function get_instance() {
        if( null === self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Init Sections.
     *
     * @access public
     * @since  1.0
     */
	public function register() {

		$this->customize_settings = Customizer_Api::get_instance();

		$this->theme_sections();
	}

    /**
     * Theme Sections.
     *
     * @access private
     * @since  1.0
     */
	private function theme_sections() {

		$this->customize_settings->section_args = [
			'aurora_first_section'	=> [
				[
					'title' 		=> esc_html__( 'First Dummy Section', 'aurora-wp' ),
					'description' 	=> esc_html__( 'This is the first dummy Section', 'aurora-wp' ),
                    'panel'         => esc_attr( 'aurora_dummy_panel' ),
					'priority' 		=> 5,
				]
		    ],

            'aurora_second_section' => [
                [
                    'title'         => esc_html__( 'Second Dummy Section', 'aurora-wp' ),
                    'description'   => esc_html__( 'This is the second dummy Section', 'aurora-wp' ),
                    'panel'         => esc_attr( 'aurora_dummy_panel' ),
                    'priority'      => 10,
                ]
            ],

            'aurora_first_section_two'  => [
                [
                    'title'         => esc_html__( 'First Dummy Section two', 'aurora-wp' ),
                    'description'   => esc_html__( 'This is the first dummy Section', 'aurora-wp' ),
                    'panel'         => esc_attr( 'aurora_dummy_panel_two' ),
                    'priority'      => 5,
                ]
            ],

            'aurora_second_section_two' => [
                [
                    'title'         => esc_html__( 'Second Dummy Section two', 'aurora-wp' ),
                    'description'   => esc_html__( 'This is the second dummy Section', 'aurora-wp' ),
                    'panel'         => esc_attr( 'aurora_dummy_panel_two' ),
                    'priority'      => 10,
                ]
            ],
		];
	}

}