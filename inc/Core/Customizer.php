<?php
/**
 * Customizer API.
 *
 * @package 	AuroraWPThemes
 * @since 		1.0
 */

namespace AuroraThemes\Core;

use AuroraThemes\Core\Base as Base;
use AuroraThemes\Customizer\Controls\Toggle_Switch_Control;
use AuroraThemes\Customizer\Controls\Radio_Image_Control;
use AuroraThemes\Customizer\Controls\Radio_Text_Control;
use AuroraThemes\Customizer\Controls\Range_Slider_Control;
use AuroraThemes\Customizer\Controls\Dropdown_Select2;
use AuroraThemes\Customizer\Controls\Color_Alpha_Control;
use AuroraThemes\Customizer\Controls\Editor_Control;
use AuroraThemes\Customizer\Controls\Typography_Control;
use WP_Customize_Color_Control;

// Do not allow directly accessing this file.
if( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

/**
 * Customizer API Class.
 *
 * @since v1.0
 */
class Customizer {

    /**
     * Customizer Panel Arguments.
     *
     * @var array
     * @access public
     * @since  1.0
     */
    public $panel_args = [];

	/**
	 * Customizer Section Arguments.
	 *
	 * @var array
     * @access public
     * @since  1.0
	 */
	public $section_args = [];

	/**
	 * Customizer Field Arguments.
	 *
	 * @var array
     * @access public
     * @since  1.0
	 */
	public $field_args = [];

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
     * @return AuroraThemes\Api\Customizer
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

		// Customizer Setup.
		add_action( 'customize_register', array( $this, 'setup' ) );

        // Customizer control css.
        add_action( 'customize_controls_enqueue_scripts', array( $this, 'customizer_enqueue' ) );
	}

    /**
     * Customizer Setup.
     *
     * @access public
     * @param  object $wp_customize An instance of the WP_Customize_Manager class.
     * @since  1.0
     */
	public function setup( $wp_customize ) {
        $this->panels( $wp_customize )->sections( $wp_customize )->fields( $wp_customize );
	}

    /**
     * Customizer Panels.
     *
     * @access public
     * @param  object $wp_customize An instance of the WP_Customize_Manager class.
     * @since  1.0
     */
    public function panels( $wp_customize ) {

        foreach ( $this->panel_args as $panel_id => $panel_value ) {
            foreach ( $panel_value as $key ) {
                $args = [
                    'title'         => $key['title'],
                    'description'   => $key['description'],
                    'priority'      => $key['priority'],
                ];

                $wp_customize->add_panel(
                    $panel_id,
                    $args
                );
            }
        }

        return $this;
    }

    /**
     * Customizer Sections.
     *
     * @access private
     * @param  object $wp_customize An instance of the WP_Customize_Manager class.
     * @since  1.0
     */
    private function sections( $wp_customize ) {

        foreach ( $this->section_args as $section_id => $section_value ) {
            foreach ( $section_value as $key ) {
                $args = [
                    'title'         => $key['title'],
                    'description'   => $key['description'],
                    'panel'         => ! empty( $key['panel'] ) ? $key['panel'] : '',
                    'priority'      => $key['priority'],
                ];

                $wp_customize->add_section(
                    $section_id,
                    $args
                );
            }
        }

        return $this;
    }

    /**
     * Customizer Fields.
     *
     * @access private
     * @param   object $wp_customize An instance of the WP_Customize_Manager class.
     * @since  1.0
     */
    private function fields( $wp_customize ) {

        if( ! aurora_array_key_check( $this->field_args, 'type' ) ) {
            return;
        }

        foreach ( $this->field_args as $field_id => $field_value ) {
            foreach ( $field_value as $key ) {

                $class_name = '';

                $settings_args = [
                    'default'           => ! empty( $key['default'] ) ? $key['default'] : '',
                    'transport'         => ! empty( $key['transport'] ) ? $key['transport'] : 'refresh',
                    'sanitize_callback' => $key['sanitize_callback'],
                ];

                $control_args = [];
                // $control_args = [
                //     'label'             => $key['label'],
                //     'description'       => $key['description'],
                //     'section'           => $key['section'],
                //     'settings'          => $field_id,
                //     'priority'          => ! empty( $key['priority'] ) ? $key['priority'] : '',
                //     'type'              => $key['type'],
                //     'active_callback'   => ! empty( $key['active_callback'] ) ? $key['active_callback'] : '',
                //     'choices'           => ! empty( $key['choices'] ) ? $key['choices'] : '',
                //     'button_labels'     => ! empty( $key['button_labels'] ) ? $key['button_labels'] : '',
                //     'input_attrs'       => [
                //         'class'         => ! empty( $key['input_attrs']['class'] ) ? $key['input_attrs']['class'] : '',
                //         'placeholder'   => ! empty( $key['input_attrs']['placeholder'] ) ? $key['input_attrs']['placeholder'] : '',
                //         'min'           => ! empty( $key['input_attrs']['min'] ) ? ( int ) $key['input_attrs']['min'] : '',
                //         'max'           => ! empty( $key['input_attrs']['max'] ) ? ( int ) $key['input_attrs']['max'] : '',
                //         'step'          => ! empty( $key['input_attrs']['step'] ) ? ( int ) $key['input_attrs']['step'] : '',
                //     ],
                // ];

                foreach ( $key as $control_key => $control_value ) {
                    $control_args[ $control_key ] = $control_value;
                }

                switch ( $key['type'] ) {
                    case 'color':
                        $class_name = esc_attr( 'WP_Customize_Color_Control' );
                        break;

                    case 'image':
                        $class_name = esc_attr( 'WP_Customize_Image_Control' );
                        break;

                    case 'switch':
                        $class_name = esc_attr( 'AuroraThemes\Customizer\Controls\Toggle_Switch_Control' );
                        break;

                    case 'radio-image-button':
                        $class_name = esc_attr( 'AuroraThemes\Customizer\Controls\Radio_Image_Control' );
                        break;

                    case 'radio-text-button':
                        $class_name = esc_attr( 'AuroraThemes\Customizer\Controls\Radio_Text_Control' );
                        break;

                    case 'range-slider':
                        $class_name = esc_attr( 'AuroraThemes\Customizer\Controls\Range_Slider_Control' );
                        break;

                    case 'dropdown-select2':
                        $class_name = esc_attr( 'AuroraThemes\Customizer\Controls\Dropdown_Select2' );
                        break;

                    case 'color-alpha':
                        $class_name = esc_attr( 'AuroraThemes\Customizer\Controls\Color_Alpha_Control' );
                        break;

                    case 'editor':
                        $class_name = esc_attr( 'AuroraThemes\Customizer\Controls\Editor_Control' );
                        break;

                    case 'typography':
                        $class_name = esc_attr( 'AuroraThemes\Customizer\Controls\Typography_Control' );
                        break;

                    default:
                        $class_name = esc_attr( 'WP_Customize_Control' );
                        break;
                };

                $wp_customize->add_setting(
                    $field_id,
                    $settings_args
                );

                $wp_customize->add_control(
                    new $class_name(
                        $wp_customize,
                        $field_id,
                        $control_args
                    )
                );
            }
        }

        return $this;
    }

    /**
     * Customizer CSS
     *
     * @access public
     * @param  object $wp_customize An instance of the WP_Customize_Manager class.
     * @since  v1.0
     */
    public function customizer_enqueue( $wp_customize ) {

        $base = Base::get_instance();
        wp_enqueue_style( 'aurora-customizer-control-styles', $base->get_assets_uri() . 'css/admin/customizer.css', [], $base->get_theme_version() );
    }
}
