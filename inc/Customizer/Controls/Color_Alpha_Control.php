<?php
/**
 * Customizer Custom Control 'Color_Alpha_Control' Class.
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
 * Customizer Custom Control 'Color_Alpha_Control' Class.
 *
 * @since v1.0
 */
class Color_Alpha_Control extends Control {

    /**
     * The type of control being rendered.
     *
     * @access public
     * @since  1.0
     */
    public $type = 'color-alpha';

    /**
     * Add support for palettes to be passed in.
     * Supported palette values are true, false, or an array of RGBa and Hex colors.
     *
     * @access public
     * @since  1.0
     */
    public $palette;

    /**
     * Add support for showing the opacity value on the slider handle.
     *
     * @access public
     * @since  1.0
     */
    public $show_opacity;

    /**
     * Enqueue scripts and styles.
     *
     * @access public
     * @since  1.0
     */
    public function enqueue() {
        wp_enqueue_style( 'aurora-customizer-control-styles', $this->get_assets_uri() . 'css/admin/customizer.css', ['wp-color-picker'], $this->get_theme_version() );
        wp_enqueue_script( 'aurora-customizer-control-js', $this->get_assets_uri() . 'js/admin/customizer.js', ['jquery', 'wp-color-picker'], $this->get_theme_version(), true );
    }

    /**
     * Render the control in the customizer.
     *
     * @access public
     * @since  1.0
     */
    public function render_content() {

        // Process the palette.
        if ( is_array( $this->palette ) ) {
            $palette = implode( '|', $this->palette );
        } else {
            // Default to true.
            $palette = ( false === $this->palette || 'false' === $this->palette ) ? 'false' : 'true';
        }

        // Support passing show_opacity as string or boolean. Default to true.
        $show_opacity = ( false === $this->show_opacity || 'false' === $this->show_opacity ) ? 'false' : 'true';

        ?>

        <div class="aurora-custom-control color-alpha-custom-control">
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <?php
                if( ! empty( $this->description ) ) {
                ?>
                    <span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
                <?php
                }
                ?>
            </label>
            <input class="alpha-color-control" type="text" data-show-opacity="<?php echo $show_opacity; ?>" data-palette="<?php echo esc_attr( $palette ); ?>" data-default-color="<?php echo esc_attr( $this->settings['default']->default ); ?>" <?php $this->link(); ?>  />
        </div><!-- .color-alpha-custom-control -->

        <?php
    }
}
