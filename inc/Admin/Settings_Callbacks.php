<?php
/**
 * Callbacks for Settings API.
 *
 * @package 	AuroraWPThemes
 * @since 		1.0
 */

namespace AuroraThemes\Admin;

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

/**
 * Settings API Callbacks Class.
 *
 * @since v1.0
 */
class Settings_Callbacks {

	/**
	 * Render Page.
	 *
	 * @var string
     * @access private
     * @since  1.0
	 */
    private $render_page = '';

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
     * @return AuroraThemes\Init
     * @since  1.0
     */
    public static function get_instance() {
        if ( null === self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
	}

	/**
	 * Method to render admin welcome page.
	 *
	 * @access private
	 * @return string  The HTML markup of pagination.
	 * @since  1.0
	 */
	public function admin_dashboard() {
        $this->start_welcome_page_render()->output_welcome_page();
    }

	/**
	 * Start of Admin Page Rendering.
	 *
     * @access private
	 * @return void
	 * @since  1.0
	 */
    private function start_welcome_page_render() {

        // Render header, footer with content.
        $this->header()->content()->footer();

        return $this;
    }

	/**
	 * Admin Page Output Final Markup.
	 *
     * @access private
	 * @since  1.0
	 */
    private function output_welcome_page() {

        // Wrapping and outputting.
        $this->page_wrapper()->output_page();
    }

	/**
	 * Rendering Admin Page Header.
	 *
     * @access private
	 * @since  1.0
	 */
    private function header() {
        ob_start();
        get_template_part( 'template-parts/admin/admin', 'header' );
        $this->render_page .= ob_get_clean();

        return $this;
    }

	/**
	 * Rendering Admin Page Content.
	 *
     * @access private
	 * @since  1.0
	 */
    private function content() {
        ob_start();
        get_template_part( 'template-parts/admin/admin', 'content' );
        $this->render_page .= ob_get_clean();

        return $this;
    }

	/**
	 * Rendering Admin Page Footer.
	 *
     * @access private
	 * @since  1.0
	 */
    private function footer() {
        ob_start();
        get_template_part( 'template-parts/admin/admin', 'footer' );
        $this->render_page .= ob_get_clean();

        return $this;
    }

	/**
	 * Admin Page Wrapper.
	 *
     * @access private
	 * @since  1.0
	 */
    private function page_wrapper() {
        $this->render_page = '<div id="aurora-wp-dashboard" class="wrap">' . $this->render_page . '</div><!-- #aurora-wp-dashboard -->';

        return $this;
    }

	/**
	 * Page Output Markup.
	 *
     * @access private
	 * @since  1.0
	 */
    private function output_page() {
        echo apply_filters( "aurora_admin_welcome_page", $this->render_page ); // WPCS: XSS ok.
    }

	/**
	 * Page Section Render.
	 *
     * @access private
	 * @since  1.0
	 */
    public function section_render( array $args ) {

            $section_output = '<div class="row">';

            foreach ( $args as $arg ) {
                $section_output .= '<div class="' . esc_attr( $arg['column'] ) . '">';
                $section_output .= '<h3>';
                if ( ! empty( $arg['icon'] ) ) {
                    $section_output .= '<i class="dashicons dashicons-' . esc_attr( $arg['icon'] ) . '"></i>';
                }
                if ( ! empty( $arg['title'] ) ) {
                    $section_output .= esc_html( $arg['title'] ) . '</h3>';
                }
                if ( ! empty( $arg['description'] ) ) {
                    $section_output .= '<p>' . wp_kses_post( $arg['description'] ) . '</p>';
                }
                if ( ! empty( $arg['button'] ) ) {
                    $section_output .= $this->render_button( $arg['button'] );
                }
                $section_output .= '</div>';
            }

            $section_output .= '</div><!-- .row -->';

        return $section_output;

    }

	/**
	 * Render button.
	 *
	 * @param array $button Arguments for button.
	 */
	private function render_button( $button ) {
		if ( empty( $button ) ) {
			return;
        }

        $button_class   = $button['need_button'] ? 'class="button button-primary"' : '';
        $button_target  = $button['new_tab'] ? 'target="_blank"' : '';
        $button_link    = esc_url( $button['link'] );

		return '<a href="' . $button_link . '"' . $button_class . ' ' . $button_target . '>' . esc_html( $button['text'] ) . '</a>';
    }
}
