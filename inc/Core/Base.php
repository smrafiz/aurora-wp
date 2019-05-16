<?php
/**
 * The main theme init class.
 * We're using this one to instantiate uther classes
 * and access the main theme objects.
 *
 * @package     AuroraThemes
 * @since       1.0
 */

namespace AuroraThemes\Core;

 // Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'This script cannot be accessed directly.' );
}


class Base {

    /**
     * Theme Version.
     *
     * @access private
     * @since  1.0
     */
    private $theme_version;

    /**
     * Theme Root Directory Path.
     *
     * @access private
     * @since  1.0
     */
    private $root_dir_path;

    /**
     * Framework Directory Path.
     *
     * @access private
     * @since  1.0
     */
    private $framework_dir_path;

    /**
     * Root Directory URL.
     *
     * @access private
     * @since  1.0
     */
    private $root_uri;

    /**
     * Assets Directory URL.
     *
     * @access private
     * @since  1.0
     */
    private $assets_uri;

    /**
     * CSS Directory URL.
     *
     * @access private
     * @since  1.0
     */
    private $css_uri;

    /**
     * JS Directory URL.
     *
     * @access private
     * @since  1.0
     */
    private $js_uri;

    /**
     * Images Directory URL.
     *
     * @access private
     * @since  1.0
     */
    private $images_uri;

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
     * @return AuroraThemes\Base\Base
     * @since  1.0
     */
    public static function get_instance() {
        if ( null === self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Defining theme constants.
     *
     * @access protected
     * @since  1.0
     */
    protected function __construct() {

        // Theme Name & Version.
        $this->theme_name           = wp_get_theme()->__get( 'Name' );
        $this->theme_slug           = strtolower( str_replace( ' ', '_', $this->theme_name ) );
        $this->theme_version        = '1.0';

        // System constants.
        $this->root_dir_path        = wp_normalize_path( get_theme_file_path() );
        $this->framework_dir_path   = trailingslashit( wp_normalize_path( get_theme_file_path( 'inc' ) ) );
        $this->root_uri             = trailingslashit( get_theme_file_uri() );
        $this->assets_uri           = trailingslashit( get_theme_file_uri( 'assets' ) );
        $this->css_uri              = trailingslashit( get_theme_file_uri( 'assets/css' ) );
        $this->js_uri               = trailingslashit( get_theme_file_uri( 'assets/js' ) );
        $this->images_uri           = trailingslashit( get_theme_file_uri( 'assets/images' ) );
    }

    /**
     * Theme Name.
     *
     * @access public
     * @since  1.0
     */
    public function get_theme_name() {
        return $this->theme_name;
    }

    /**
     * Theme Slug.
     *
     * @access public
     * @since  1.0
     */
    public function get_theme_slug() {
        return $this->theme_slug;
    }

    /**
     * Theme Version.
     *
     * @access public
     * @since  1.0
     */
    public function get_theme_version() {
        return $this->theme_version;
    }

    /**
     * Theme Directory.
     *
     * @access public
     * @since  1.0
     */
    public function get_theme_directory() {
        return $this->root_dir_path;
    }

    /**
     * Framework Directory.
     *
     * @access public
     * @since  1.0
     */
    public function get_framework_directory() {
        return $this->framework_dir_path;
    }

    /**
     * Theme URI.
     *
     * @access public
     * @since  1.0
     */
    public function get_theme_uri() {
        return $this->root_uri;
    }

    /**
     * Theme Assets URI.
     *
     * @access public
     * @since  1.0
     */
    public function get_assets_uri() {
        return $this->assets_uri;
    }

    /**
     * Theme CSS URI.
     *
     * @access public
     * @since  1.0
     */
    public function get_css_uri() {
        return $this->css_uri;
    }

    /**
     * Theme JS URI.
     *
     * @access public
     * @since  1.0
     */
    public function get_js_uri() {
        return $this->js_uri;
    }

    /**
     * Theme Images URI.
     *
     * @access public
     * @since  1.0
     */
    public function get_images_uri() {
        return $this->images_uri;
    }

    /**
     * If a file exists, require it from the file system.
     *
     * @static
     * @param  string $file The file to require.
     * @return bool True if the file exists, false if not.
     * @access public
     * @since  1.0
     */
    public static function require_file( $file ) {
        if ( file_exists( $file ) ) {
            require_once wp_normalize_path( $file );
            return true;
        }

        return false;
    }
}