<?php
/**
 * Customizer Custom Control 'Dropdown_Select2' Class.
 *
 * @package 	AuroraWPThemes
 * @since 		1.0
 */

namespace AuroraThemes\Customizer\Controls;

use AuroraThemes\Customizer\Controls\Control;

// Do not allow directly accessing this file.
if ( ! defined('ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

// Exit if WP_Customize_Control does not exsist.
if ( ! class_exists( 'WP_Customize_Control' ) ) {
    return null;
}

/**
 * Customizer Custom Control 'Dropdown_Select2' Class.
 *
 * @since v1.0
 */
class Dropdown_Select2 extends Control {

    /**
     * The type of control being rendered.
     *
     * @access public
     * @since  1.0
     */
    public $type = 'dropdown-select2';

    /**
     * The type of Select2 Dropwdown to display.
     * Can be either a single select dropdown or a multi-select dropdown.
     *
     * @access private
     * @since  1.0
     */
    private $multiselect = false;

    /**
     * The Placeholder value to display.
     * Select2 requires a Placeholder value to be set when using the clearall option.
     *
     * @access private
     * @since  1.0
     */
    private $placeholder = null;

    /**
     * Constructor.
     *
     * @access public
     * @since  1.0
     */
    public function __construct( $manager, $id, $args = [], $options = [] ) {

        parent::__construct( $manager, $id, $args );

        // Check if this is a multi-select field.
        if ( isset( $this->input_attrs['multiselect'] ) && $this->input_attrs['multiselect'] ) {
            $this->multiselect = true;
        }

        // Check if a placeholder string has been specified.
        if ( isset( $this->input_attrs['placeholder'] ) && $this->input_attrs['placeholder'] ) {
            $this->placeholder = $this->input_attrs['placeholder'];
        } else {
            $this->placeholder = esc_html__( 'Click to Select...', 'aurora-wp' );
        }
    }

    /**
     * Enqueue scripts and styles.
     *
     * @access public
     * @since  1.0
     */
    public function enqueue() {
        wp_enqueue_style( 'aurora-select2-styles', $this->get_assets_uri() . 'css/select2.min.css', [], '4.0.7' );
        wp_enqueue_style( 'aurora-customizer-control-styles', $this->get_assets_uri() . 'css/admin/customizer.css', [], $this->get_theme_version() );
        wp_enqueue_script( 'aurora-select2-js', $this->get_assets_uri() . 'js/select2.min.js', [ 'jquery' ], '4.0.7', true );
        wp_enqueue_script( 'aurora-customizer-control-js', $this->get_assets_uri() . 'js/admin/customizer.js', ['jquery', 'aurora-select2-js'], $this->get_theme_version(), true );
    }

    /**
     * Render the control in the customizer.
     *
     * @access public
     * @since  1.0
     */
    public function render_content() {

        // Default Value.
        $default_value = $this->value();

        // Check for multiselect.
        if ( $this->multiselect ) {
            $default_value = explode( ',', $this->value() );
        }
        ?>
        <div class="aurora-custom-control dropdown-select2-control">

            <label for="<?php echo esc_attr( $this->id ); ?>" class="customize-control-title">
                <?php echo esc_html( $this->label ); ?>
            </label>

            <?php
            if( ! empty( $this->description ) ) {
            ?>
                <span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
            <?php
            }
            ?>

            <input type="hidden" id="<?php echo esc_attr( $this->id ); ?>" class="customize-control-dropdown-select2" value="<?php echo esc_attr( $this->value() ); ?>" name="<?php echo esc_attr( $this->id ); ?>" <?php $this->link(); ?> />

            <select name="select2-list-<?php echo ( $this->multiselect ? esc_attr( 'multi[]' ) : esc_attr( 'single' ) ); ?>" class="customize-control-select2" data-placeholder="<?php echo esc_attr( $this->placeholder ); ?>" <?php echo ( $this->multiselect ? 'multiple="multiple" ' : '' ); ?>>

                <?php
                if ( ! $this->multiselect ) {
                    // When using Select2 for single selection, the Placeholder needs an empty <option> at the top of the list for it to work.
                    echo '<option></option>';
                }

                foreach ( $this->choices as $key => $value ) {
                    if ( is_array( $value ) ) {
                        echo '<optgroup label="' . esc_attr( $key ) . '">';
                        foreach ( $value as $optgroupkey => $optgroupvalue ) {
                            echo '<option value="' . esc_attr( $optgroupkey ) . '" ' . ( in_array( esc_attr( $optgroupkey ), $default_value ) ? 'selected="selected"' : '' ) . '>' . esc_attr( $optgroupvalue ) . '</option>';
                        }
                        echo '</optgroup>';
                    }
                    else {
                        echo '<option value="' . esc_attr( $key ) . '" ' . selected( esc_attr( $key ), $default_value, false )  . '>' . esc_attr( $value ) . '</option>';
                    }
                }
                ?>
            </select><!-- .customize-control-select2 -->
        </div><!-- .dropdown-select2-control -->
    <?php
    }
}
