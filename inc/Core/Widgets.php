<?php
/**
 * The Widget class.
 * We're using this one to register various widget locations.
 *
 * @package     AuroraThemes
 * @since       1.0
 */

namespace AuroraThemes\Base;

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

/**
 * Widgets class.
 *
 * @since 1.0
 */
class Widgets {

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
     * @return AuroraThemes\Base\Widgets
     * @since  1.0
     */
    public static function get_instance() {
        if ( null === self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Registering Widgets.
     *
     * @access public
     * @since  1.0
     */
    public function register() {
        add_action( 'widgets_init', [ $this, 'register_widgets' ] );
    }

    /**
     * Widgets Locations.
     *
     * @access public
     * @since  1.0
     */
    public function register_widgets() {
        $this->sidebar();
        $this->footer();
    }

    /**
     * Widgets: Sidebar.
     *
     * @access private
     * @since  1.0
     */
    private function sidebar() {
        self::register_widget_area(
            [
                'name'			=> esc_html__( 'Sidebar (General)', 'aurora-wp' ),
                'id'			=> esc_attr( 'aurora-sidebar-general' ),
                'description'	=> esc_html__( 'This sidebar will show everywhere the sidebar is enabled, both Posts and Pages.', 'aurora-wp' ),
            ]
        );

        self::register_widget_area(
            [
                'name'			=> esc_html__( 'Sidebar (Blog)', 'aurora-wp' ),
                'id'			=> esc_attr( 'aurora-sidebar-blog' ),
                'description'	=> esc_html__( 'This sidebar will show in Blog (Posts) page.', 'aurora-wp' ),
            ]
        );
    }

    /**
     * Widgets: Footer.
     *
     * @access private
     * @since  1.0
     */
    private function footer() {
        for ( $footer_col = 1; $footer_col <= 4; $footer_col++ ) {
            self::register_widget_area(
                [
                    'name'				=> esc_html__( 'Footer', 'aurora-wp' ) . ' - ' . esc_attr( $footer_col ),
                    'id'				=> esc_attr( 'aurora-footer-col-' ) . esc_attr( $footer_col ),
                    'description'	 	=> esc_html__( 'The widget area for the footer column', 'aurora-wp') . ' - ' . esc_attr( $footer_col ),
                    'before_widget' 	=> '<aside id="%1$s" class="%2$s footer-widget">',
                    'after_widget'      => '</aside>',
                ]
            );
        }
    }

    /**
     * Method to expedite the widget area registration process.
     *
     * @access public
     * @since  1.0
     */
    public static function register_widget_area( $args ) {

        $defaults = [
            'before_widget' => '<section id="%1$s" class="%2$s sidebar-widget">',
            'after_widget'  => '</section>',
            'before_title'  => '<h4 class="widget-title widgettitle">',
            'after_title'   => '</h4>',
        ];

        $defaults = apply_filters( 'register_widget_area_defaults', $defaults, $args );

        $args = wp_parse_args( $args, $defaults );

        return register_sidebar( $args );
    }
}