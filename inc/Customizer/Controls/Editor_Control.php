<?php
/**
 * Customizer Custom Control 'Editor_Control' Class.
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
 * Customizer Custom Control 'Editor_Control' Class.
 *
 * @since v1.0
 */
class Editor_Control extends Control {

    /**
     * The type of control being rendered.
     *
     * @access public
     * @since  1.0
     */
    public $type = 'editor';

    /**
     * Enqueue scripts and styles.
     *
     * @access public
     * @since  1.0
     */
    public function enqueue() {
        wp_enqueue_style( 'aurora-customizer-control-styles', $this->get_assets_uri() . 'css/admin/customizer.css', [], $this->get_theme_version() );
        wp_enqueue_script( 'aurora-customizer-control-js', $this->get_assets_uri() . 'js/admin/customizer.js', ['jquery'], $this->get_theme_version(), true );
    }

    /**
     * Pass TinyMCE toolbar string to JS.
     *
     * @access public
     * @since  1.0
     */
    public function to_json() {

        // Call parent to_json() method to get the core defaults like "label", "description", etc.
        parent::to_json();

        // Settings toolbar 1.
        $this->json['auroraeditortoolbar1']         = isset( $this->input_attrs['toolbar1'] ) ? esc_attr( $this->input_attrs['toolbar1'] ) : esc_attr( 'bold italic bullist numlist blockquote link' );

        // Settings toolbar 2.
        $this->json['auroraeditortoolbar2']         = isset( $this->input_attrs['toolbar2'] ) ? esc_attr( $this->input_attrs['toolbar2'] ) : '';

        // Settings Media Buttons.
        $this->json['auroraeditormediabuttons']     = isset( $this->input_attrs['mediaButtons'] ) && ( true === $this->input_attrs['mediaButtons'] ) ? true : false;
    }

    /**
     * Render the control in the customizer.
     *
     * @access public
     * @since  1.0
     */
    public function render_content() {
        ?>
        <div class="aurora-custom-control tinymce-custom-control">

            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>

            <?php
            if( !empty( $this->description ) ) {
            ?>
                <span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
            <?php
            }
            ?>

            <textarea id="<?php echo esc_attr( $this->id ); ?>" class="customize-control-tinymce-editor" <?php $this->link(); ?>><?php echo esc_attr( $this->value() ); ?></textarea>
        </div><!-- .tinymce-custom-control -->
        <?php
    }
}
