<?php
/**
 * Customizer Custom Control 'Radio_Text_Control' Class.
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
 * Customizer Custom Control 'Radio_Text_Control' Class.
 *
 * @since v1.0
 */
class Radio_Text_Control extends Control {

    /**
     * The type of control being rendered.
     *
     * @access public
     * @since  1.0
     */
    public $type = 'radio-text-button';

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
        <div class="aurora-custom-control text-radio-button-control">

                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>

            <?php
            if( ! empty( $this->description ) ) {
            ?>
                <span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
            <?php
            }
            ?>

            <div class="radio-buttons-wrapper">
                <?php
                foreach ( $this->choices as $key => $value ) {
                ?>
                    <label class="radio-button-label">
                        <input type="radio" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $key ); ?>" <?php $this->link(); ?> <?php checked( esc_attr( $key ), $this->value() ); ?>/>
                        <span><?php echo esc_attr( $value ); ?></span>
                    </label>
                <?php
                }
                ?>
            </div><!-- .radio-buttons-wrapper -->
        </div><!-- .text-radio-button-control -->
    <?php
    }
}
