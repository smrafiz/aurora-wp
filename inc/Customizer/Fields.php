<?php
/**
 * Customizer Fields Class.
 *
 * @package 	AuroraWPThemes
 * @since 		1.0
 */

namespace AuroraThemes\Customizer;

use AuroraThemes\Core\Base as Base;
use AuroraThemes\Core\Customizer as Customizer_Api;
use AuroraThemes\Customizer\Defaults as Defaults;
use AuroraThemes\Customizer\Controls\Toggle_Switch;

// Do not allow directly accessing this file.
if ( !defined('ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

/**
 * Customizer Fields Class.
 *
 * @since v1.0
 */
class Fields {

    /**
     * Customizer Settings.
     *
     * @access private
     * @var object
     * @since  1.0
     */
    private $customize_settings;

    /**
     * Customizer Sanitized Value.
     *
     * @access private
     * @var object
     * @since  1.0
     */
    private $sanitize;

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
     * @return AuroraThemes\Customizer\Fields
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
        $this->defaults = Defaults::get_instance();

		$this->theme_fields();
	}

    /**
     * Theme Sections.
     *
     * @access private
     * @since  1.0
     */
	private function theme_fields() {

		$this->customize_settings->field_args = [
			'aurora_field_text' => [
				[
					'label' 		        => esc_html__( 'Text Field', 'aurora-wp' ),
					'description' 	        => esc_html__( 'This is a text field', 'aurora-wp' ),
                    'type'                  => 'text',
                    'section'               => esc_attr( 'aurora_first_section' ),
					'priority'              => 5,
                    'default'               => Defaults::fetch( 'aurora_field_text' ),
                    'sanitize_callback'     => 'aurora_sanitize_text',
				]
		    ],

            'aurora_field_editor' => [
                [
                    'label'                 => esc_html__( 'Editor Field', 'aurora-wp' ),
                    'description'           => esc_html__( 'This is an WP editor field', 'aurora-wp' ),
                    'type'                  => 'editor',
                    'section'               => esc_attr( 'aurora_first_section' ),
                    'priority'              => 5,
                    'sanitize_callback'     => 'aurora_sanitize_text',
                    'input_attrs'           => [
                        'mediaButtons'      => true,
                    ],
                ]
            ],

            'aurora_field_url' => [
                [
                    'label'                 => esc_html__( 'URL Field', 'aurora-wp' ),
                    'description'           => esc_html__( 'This is an URL field', 'aurora-wp' ),
                    'type'                  => 'url',
                    'section'               => esc_attr( 'aurora_first_section' ),
                    'priority'              => 5,
                    'default'               => Defaults::fetch( 'aurora_field_url' ),
                    'sanitize_callback'     => 'aurora_sanitize_url',
                ]
            ],

            'aurora_field_checkbox' => [
                [
                    'label'                 => esc_html__( 'Checkbox Field', 'aurora-wp' ),
                    'description'           => esc_html__( 'This is a checkbox field', 'aurora-wp' ),
                    'type'                  => 'checkbox',
                    'section'               => esc_attr( 'aurora_first_section' ),
                    'priority'              => 10,
                    'default'               => Defaults::fetch( 'aurora_field_checkbox' ),
                    'sanitize_callback'     => 'aurora_sanitize_checkbox',
                ]
            ],

            'aurora_field_select' => [
                [
                    'label'                 => esc_html__( 'Select Field', 'aurora-wp' ),
                    'description'           => esc_html__( 'This is a select field', 'aurora-wp' ),
                    'type'                  => 'dropdown-select2',
                    'section'               => esc_attr( 'aurora_first_section' ),
                    'priority'              => 15,
                    'default'               => Defaults::fetch( 'aurora_field_select' ),
                    'sanitize_callback'     => 'aurora_sanitize_select2',
                    'choices' => [
                        'wordpress'         => esc_html__( 'WordPress', 'aurora-wp' ),
                        'joomla'            => esc_html__( 'Joomla', 'aurora-wp' ),
                        'shopify'           => esc_html__( 'Shopify', 'aurora-wp' ),
                        'drupal'            => esc_html__( 'Drupal', 'aurora-wp' ),
                    ],
                    'input_attrs'           => [
                        'multiselect'       => false,
                        'placeholder'       => esc_html__( 'Click to Select', 'aurora-wp' ),
                    ],
                ]
            ],

            'aurora_field_radio' => [
                [
                    'label'                 => esc_html__( 'Radio Field', 'aurora-wp' ),
                    'description'           => esc_html__( 'This is a radio field', 'aurora-wp' ),
                    'type'                  => 'radio',
                    'section'               => esc_attr( 'aurora_first_section' ),
                    'priority'              => 20,
                    'default'               => Defaults::fetch( 'aurora_field_radio' ),
                    'sanitize_callback'     => 'aurora_sanitize_select',
                    'choices' => [
                        'wordpress'         => esc_html__( 'WordPress', 'aurora-wp' ),
                        'joomla'            => esc_html__( 'Joomla', 'aurora-wp' ),
                        'shopify'           => esc_html__( 'Shopify', 'aurora-wp' ),
                        'drupal'            => esc_html__( 'Drupal', 'aurora-wp' ),
                    ],
                ]
            ],

            'aurora_field_dropdown_pages' => [
                [
                    'label'                 => esc_html__( 'Dropdown Pages Field', 'aurora-wp' ),
                    'description'           => esc_html__( 'This is a dropdown page field', 'aurora-wp' ),
                    'type'                  => 'dropdown-pages',
                    'section'               => esc_attr( 'aurora_first_section' ),
                    'priority'              => 25,
                    'default'               => '',
                    'sanitize_callback'     => 'aurora_sanitize_number',
                ]
            ],

            'aurora_field_textarea' => [
                [
                    'label'                 => esc_html__( 'Textarea Field', 'aurora-wp' ),
                    'description'           => esc_html__( 'This is a textarea field', 'aurora-wp' ),
                    'type'                  => 'textarea',
                    'section'               => esc_attr( 'aurora_first_section' ),
                    'priority'              => 30,
                    'default'               => Defaults::fetch( 'aurora_field_textarea' ),
                    'sanitize_callback'     => 'aurora_sanitize_text',
                ]
            ],

            'aurora_field_color' => [
                [
                    'label'                 => esc_html__( 'Color Field', 'aurora-wp' ),
                    'description'           => esc_html__( 'This is a color field', 'aurora-wp' ),
                    'type'                  => 'color',
                    'section'               => esc_attr( 'aurora_second_section' ),
                    'priority'              => 10,
                    'default'               => Defaults::fetch( 'aurora_field_color' ),
                    'sanitize_callback'     => 'sanitize_hex_color',
                ]
            ],

            'aurora_field_image' => [
                [
                    'label'                 => esc_html__( 'Image Field', 'aurora-wp' ),
                    'description'           => esc_html__( 'This is a image field', 'aurora-wp' ),
                    'type'                  => 'image',
                    'section'               => esc_attr( 'aurora_second_section' ),
                    'priority'              => 15,
                    'default'               => '',
                    'sanitize_callback'     => 'aurora_sanitize_number',
                    'button_labels'         => [
                        'select'            => esc_html__( 'Select Image', 'aurora-wp' ),
                        'change'            => esc_html__( 'Change Image', 'aurora-wp' ),
                        'remove'            => esc_html__( 'Remove', 'aurora-wp' ),
                        'default'           => esc_html__( 'Default', 'aurora-wp' ),
                        'placeholder'       => esc_html__( 'No image selected', 'aurora-wp' ),
                        'frame_title'       => esc_html__( 'Select Image', 'aurora-wp' ),
                        'frame_button'      => esc_html__( 'Choose Image', 'aurora-wp' ),
                    ],
                ]
            ],

            'aurora_field_switch' => [
                [
                    'label'                 => esc_html__( 'Switch Field', 'aurora-wp' ),
                    'description'           => esc_html__( 'This is a switch field', 'aurora-wp' ),
                    'type'                  => 'switch',
                    'section'               => esc_attr( 'aurora_second_section' ),
                    'priority'              => 20,
                    'default'               => Defaults::fetch( 'aurora_field_switch' ),
                    'sanitize_callback'     => 'aurora_sanitize_switch',
                ]
            ],

            'aurora_radio_image' => [
                [
                    'label'                 => esc_html__( 'Radio Image Field', 'aurora-wp' ),
                    'description'           => esc_html__( 'This is a radio image field', 'aurora-wp' ),
                    'type'                  => 'radio-image-button',
                    'section'               => esc_attr( 'aurora_second_section' ),
                    'priority'              => 25,
                    'default'               => Defaults::fetch( 'aurora_radio_image' ),
                    'sanitize_callback'     => 'aurora_sanitize_select',
                    'choices' => [
                        'sidebar-left'      => [
                            'image'         => esc_url( Base::get_instance()->get_assets_uri() . 'images/admin/customizer/2col-left.png' ),
                            'name'          => esc_html__( 'Left Sidebar', 'aurora-wp' ),
                        ],
                        'sidebar-none'      => [
                            'image'         => esc_url( Base::get_instance()->get_assets_uri() . 'images/admin/customizer/1col.png' ),
                            'name'          => esc_html__( 'No Sidebar', 'aurora-wp' ),
                        ],
                        'sidebar-right'     => [
                            'image'         => esc_url( Base::get_instance()->get_assets_uri() . 'images/admin/customizer/2col-right.png' ),
                            'name'          => esc_html__( 'Right Sidebar', 'aurora-wp' ),
                        ],
                    ],
                ]
            ],

            'aurora_radio_text' => [
                [
                    'label'                 => esc_html__( 'Radio Text', 'aurora-wp' ),
                    'description'           => esc_html__( 'This is a radio text field', 'aurora-wp' ),
                    'type'                  => 'radio-text-button',
                    'section'               => esc_attr( 'aurora_second_section' ),
                    'priority'              => 30,
                    'default'               => Defaults::fetch( 'aurora_radio_text' ),
                    'sanitize_callback'     => 'aurora_sanitize_select',
                    'choices'               => [
                        'left'              => esc_html__( 'Left', 'aurora-wp' ),
                        'right'             => esc_html__( 'Right', 'aurora-wp' ),
                        'center'            => esc_html__( 'Center', 'aurora-wp' ),
                    ],
                ]
            ],

            'aurora_field_slider' => [
                [
                    'label'                 => esc_html__( 'Slider Field [px]', 'aurora-wp' ),
                    'description'           => esc_html__( 'This is a slider field in px', 'aurora-wp' ),
                    'type'                  => 'range-slider',
                    'section'               => esc_attr( 'aurora_second_section' ),
                    'priority'              => 30,
                    'default'               => Defaults::fetch( 'aurora_field_slider' ),
                    'sanitize_callback'     => 'aurora_sanitize_number',
                    'input_attrs'           => [
                        'min'               => 10,
                        'max'               => 90,
                        'step'              => 1,
                    ],
                ]
            ],

            'aurora_field_text_two' => [
                [
                    'label'                 => esc_html__( 'Text Field two', 'aurora-wp' ),
                    'description'           => esc_html__( 'This is a text field', 'aurora-wp' ),
                    'type'                  => 'text',
                    'section'               => esc_attr( 'aurora_first_section_two' ),
                    'priority'              => 5,
                    'default'               => 'Test default value',
                    'sanitize_callback'     => 'aurora_sanitize_text',
                ]
            ],

            'aurora_field_color_two' => [
                [
                    'label'                 => esc_html__( 'Color Field two', 'aurora-wp' ),
                    'description'           => esc_html__( 'This is a color field', 'aurora-wp' ),
                    'type'                  => 'color-alpha',
                    'section'               => esc_attr( 'aurora_second_section_two' ),
                    'priority'              => 10,
                    'default'               => '#999',
                    'sanitize_callback'     => '',
                ]
            ],

            'aurora_field_typography' => [
                [
                    'label'                 => esc_html__( 'Typography Field', 'aurora-wp' ),
                    'description'           => esc_html__( 'This is a typography field', 'aurora-wp' ),
                    'type'                  => 'typography',
                    'section'               => esc_attr( 'aurora_second_section_two' ),
                    'priority'              => 10,
                    'default'               => Defaults::fetch( 'aurora_field_typography' ),
                    'sanitize_callback'     => 'skyrocket_google_font_sanitization',
                    'input_attrs'           => [
                        'font_count'        => 50,
                        'orderby'           => 'popular',
                    ],
                ]
            ],
		];
	}

}