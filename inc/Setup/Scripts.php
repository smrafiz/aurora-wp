<?php
/**
 * The Aurora Framework Scripts Loader.
 * Handles loading of frontend and backend scripts.
 *
 * @package     AuroraThemes
 * @since       1.0
 */

namespace AuroraThemes\Setup;

use AuroraThemes\Core\Base as Base;

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

/**
 * Aurora Scripts Loader.
 *
 * @since 1.0
 */
class Scripts {

    /**
     * Base Class.
     *
     * @access private
     * @var object
     * @since  1.0
     */
    private $base;

    /**
     * Holds script file name suffix.
     *
     * @var string suffix
     * @access private
     * @since  1.0
     */
    private $suffix = null;

    /**
     * Theme Font.
     *
     * @static
     * @access private
     * @since  1.0
     */
    private static $fonts = [];

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
     * @return AuroraThemes\Setup\Scripts
     * @since  1.0
     */
    public static function get_instance() {
        if ( null === self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Load the scripts.
     *
     * @access public
     * @since  1.0
     */
    public function register() {

        // Theme font.
        self::$fonts 			= [
            'source-sans-pro' 	=> 'Source+Sans+Pro:400,300,300italic,400italic,600,700,900',
            'roboto-condensed' 	=> 'Roboto+Condensed:300,300i,400,400i,700,700i',
        ];

        // Framework Base.
        $this->base             = Base::get_instance();

        // Register scripts early to allow replacement.
        add_action( 'wp_enqueue_scripts', [ $this, 'register_front_scripts' ], 0 );

        // Enqueue the scripts.
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_front_scripts' ] );
    }

    /**
     * Register the styles & scripts.
     *
     * @access public
     * @since  1.0
     */
    public function register_front_scripts() {

        // Suffix.
        $this->suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

        // Font Awesome Icon Font.
        wp_register_style( 'font-awesome', $this->base->get_css_uri() . "font-awesome{$this->suffix}.css", [], '4.7.0' );

        // Ionicons Icon Font.
        wp_register_style( 'ionicons', $this->base->get_css_uri() . "ionicons{$this->suffix}.css", [], '4.5.4' );

        // Animate CSS.
        wp_register_style( 'animate', $this->base->get_css_uri() . "animate{$this->suffix}.css", [], '3.7.0' );

        // Google fonts.
        wp_register_style( 'aurora-fonts', self::google_fonts(), [], null );

        // Bootstrap Framework CSS.
        wp_register_style( 'bootstrap', $this->base->get_css_uri() . "bootstrap{$this->suffix}.css", [], '4.3.1' );

        // Animsition CSS.
        wp_register_style( 'animsition', $this->base->get_css_uri() . "animsition{$this->suffix}.css", [], '4.0.2' );

        // Swiper Slider
        wp_register_style( 'swiper', $this->base->get_css_uri() . "swiper{$this->suffix}.css", [], '4.5.0' );

        // Photoswipe.
        wp_register_style( 'photoswipe', $this->base->get_css_uri() . "photoswipe{$this->suffix}.css", [], '4.1.3' );

		// Photoswipe default skin.
        wp_register_style( 'photoswipe-default-skin',  $this->base->get_css_uri() . "photoswipe-default-skin{$this->suffix}.css", [], '4.1.2' );

		// Theme Styles.
		wp_register_style( 'aurora-theme-styles', apply_filters( 'aurora_theme_styles_url', $this->base->get_css_uri() . "theme{$this->suffix}.css" ), [], $this->base->get_theme_version() );

		// Popper JS.
        wp_register_script( 'popper', $this->base->get_js_uri() . "popper{$this->suffix}.js", [ 'jquery' ], '1.14.7', true );

        // Bootstrap Framework JS.
        wp_register_script( 'bootstrap', $this->base->get_js_uri() . "bootstrap{$this->suffix}.js", [ 'jquery' ], '4.3.1', true );

		// Query Easing.
		wp_register_script( 'jquery-easing-js', $this->base->get_js_uri() . 'jquery.easing.1.3.js', [ 'jquery' ], '1.3', true );

        // Superfish Menu.
        wp_register_script( 'jquery-superfish', $this->base->get_js_uri() . "superfish{$this->suffix}.js", [ 'jquery', 'hoverIntent' ], '1.7.10', true );

		// Headroom JS.
        wp_register_script( 'headroom', $this->base->get_js_uri() . "headroom{$this->suffix}.js", [ 'jquery' ], '0.9.4', true );

        // Animsition JS.
        wp_register_script( 'animsition', $this->base->get_js_uri() . "animsition{$this->suffix}.js", [ 'jquery' ], '4.0.2', true );

		// Swiper Slider.
        wp_register_script( 'swiper', $this->base->get_js_uri() . "swiper{$this->suffix}.js", [ 'jquery' ], '4.5.0', true );

		// Photoswipe.
		wp_register_script( 'photoswipe', $this->base->get_js_uri() . "photoswipe{$this->suffix}.js", [ 'jquery' ], '4.1.3', true );

		// Photoswipe default ui.
		wp_register_script( 'photoswipe-ui-default', $this->base->get_js_uri() . "photoswipe-ui-default{$this->suffix}.js", [ 'jquery' ], '4.1.3', true );

		// Photoswipe trigger.
        wp_register_script( 'photoswipe-trigger', $this->base->get_js_uri() . "photoswipe-trigger.js", [ 'jquery' ], $this->base->get_theme_version(), true );

		// Slide and Push Menu.
		wp_register_script( 'slide-push-menu-js', $this->base->get_js_uri() . "slide-push-menu{$this->suffix}.js", [ 'jquery' ], '1.0', true );

        // Skip Links.
        wp_register_script( 'skip-links', $this->base->get_js_uri() . "skip-links{$this->suffix}.js", [], $this->base->get_theme_version(), true );

		// Main Script.
		wp_register_script( 'aurora-theme-script', apply_filters( 'aurora_theme_script_url', $this->base->get_js_uri() . "theme{$this->suffix}.js" ), [ 'jquery' ], $this->base->get_theme_version(), true );
    }

    /**
     * Enqueues the styles & scripts.
     *
     * @access public
     * @since  1.0
     */
    public function enqueue_front_scripts() {

        /**
         * Fonts.
         */
        wp_enqueue_style( 'aurora-fonts' );

        /**
         * Styles.
         */
        wp_enqueue_style( 'font-awesome' );
        wp_enqueue_style( 'ionicons' );
        wp_enqueue_style( 'animate' );
        // wp_enqueue_style( 'bootstrap' );
        wp_enqueue_style( 'animsition' );
        wp_enqueue_style( 'swiper' );
        wp_enqueue_style( 'photoswipe' );
        wp_enqueue_style( 'photoswipe-default-skin' );
        wp_enqueue_style( 'aurora-theme-styles' );

        /**
         * Scripts.
         */
        // wp_enqueue_script( 'popper' );
        // wp_enqueue_script( 'bootstrap' );
        wp_enqueue_script( 'jquery-easing-js' );
        wp_enqueue_script( 'jquery-superfish' );
        wp_enqueue_script( 'headroom' );
        wp_enqueue_script( 'animsition' );
        wp_enqueue_script( 'swiper' );
        wp_enqueue_script( 'photoswipe' );
        wp_enqueue_script( 'photoswipe-ui-default' );
        wp_enqueue_script( 'photoswipe-trigger' );
        wp_enqueue_script( 'slide-push-menu-js' );
        wp_enqueue_script( 'skip-links' );
        wp_enqueue_script( 'aurora-theme-script' );

        // If a single post or page, threaded comments are enabled, and comments are open.
        if ( is_singular() && get_option( 'thread_comments' ) && comments_open() ) {
            wp_enqueue_script( 'comment-reply' );
        }
    }

    /**
     * Register Google fonts.
     *
     * @static
     * @access public
     * @since  1.0
     */
    public static function google_fonts() {

        // Default google fonts.
        $google_fonts = apply_filters( 'aurora_google_font_families', self::$fonts );

        // Building up the arguments.
        $query_args = [
            'family' => implode( '%7C', $google_fonts ),
            'subset' => rawurlencode( 'latin,latin-ext' ),
        ];

        // Fetching Google fonts URL.
        $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );

        return esc_url_raw( $fonts_url );
    }
}
