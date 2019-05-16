<?php
/**
 * Customizer Custom Control 'Radio_Image_Control' Class.
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
 * Customizer Custom Control 'Radio_Image_Control' Class.
 *
 * @since v1.0
 */
class Radio_Image_Control extends Control {

    /**
     * The type of control being rendered.
     *
     * @access public
     * @since  1.0
     */
    public $type = 'radio-image-button';

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
        <div class="aurora-custom-control image-radio-button-control">

            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>

            <?php
            if( ! empty( $this->description ) ) {
            ?>
                <span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
            <?php
            }
            ?>

            <?php
            foreach ( $this->choices as $key => $value ) {
            ?>
                <label class="radio-button-label">
                    <input type="radio" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $key ); ?>" <?php $this->link(); ?> <?php checked( esc_attr( $key ), $this->value() ); ?>/>
                    <img src="<?php echo esc_attr( $value['image'] ); ?>" alt="<?php echo esc_attr( $value['name'] ); ?>" title="<?php echo esc_attr( $value['name'] ); ?>" />
                </label>
            <?php
            }
            ?>
        </div><!-- .image-radio-button-control -->
    <?php
    }
}
