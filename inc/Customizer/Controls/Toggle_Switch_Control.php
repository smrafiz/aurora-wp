<?php
/**
 * Customizer Custom Control 'Toggle_Switch_Control' Class.
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
 * Customizer Custom Control 'Toggle_Switch_Control' Class.
 *
 * @since v1.0
 */
class Toggle_Switch_Control extends Control {

    /**
     * The type of control being rendered.
     *
     * @access public
     * @since  1.0
     */
    public $type = 'switch';

    /**
     * Enqueue scripts and styles.
     *
     * @access public
     * @since  1.0
     */
    public function enqueue() {
        wp_enqueue_style( 'aurora-customizer-control-styles', $this->get_assets_uri() . 'css/admin/customizer.css', [], $this->get_theme_version() );
    }

    /**
     * Render the control in the customizer.
     *
     * @access public
     * @since  1.0
     */
    public function render_content() {
    ?>
        <div class="aurora-custom-control toggle-switch-control">
            <div class="toggle-switch">
                <input type="checkbox" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" class="toggle-switch-checkbox" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); checked( $this->value() ); ?>>

                <label class="toggle-switch-label" for="<?php echo esc_attr( $this->id ); ?>">
                    <span class="toggle-switch-inner"></span>
                    <span class="toggle-switch-switch"></span>
                </label>
            </div><!-- .toggle-switch -->

            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>

            <?php
            if( ! empty( $this->description ) ) {
            ?>
                <span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
            <?php
            }
            ?>
        </div><!-- .toggle-switch-control -->
    <?php
    }
}
