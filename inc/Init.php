<?php
/**
 * The main theme init class.
 * We're using this one to instantiate other classes
 * and access the main theme objects.
 *
 * @package     AuroraThemes
 * @since       1.0
 */

namespace AuroraThemes;

use AuroraThemes\Core\Base;

// Do not allow directly accessing this file.
if ( ! defined('ABSPATH' ) ) {
    exit( 'This script cannot be accessed directly.' );
}

final class Init {

    /**
     * Base Class.
     *
     * @access private
     * @var object
     * @since  1.0
     */
    private $base;

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
     * Store all the classes.
     *
     * @static
     * @access private

     * @since  1.0
     */
    private function get_classes() {
        $classes = [
            \AuroraThemes\Admin\Admin::class,
            \AuroraThemes\Base\Widgets::class,
            \AuroraThemes\Customizer\Customizer::class,
            \AuroraThemes\Setup\Menus::class,
            \AuroraThemes\Setup\Setup::class,
            \AuroraThemes\Setup\Scripts::class,
        ];

        return $classes;
    }

    /**
     * Store all the files.
     *
     * @static
     * @access private

     * @since  1.0
     */
    private function get_files() {
        $files = [
            $this->base->get_framework_directory() . 'functions/helpers',
            $this->base->get_framework_directory() . 'functions/sanitization',
            $this->base->get_framework_directory() . 'functions/template-hooks',
            $this->base->get_framework_directory() . 'functions/template-functions',
        ];

        return $files;
    }

    /**
     * Method to register the services and functions.
     *
     * @static
     * @access public
     * @since  1.0
     */
    public function register_services() {

        // Base Class.
        $this->base = Base::get_instance();

        // Registering Services
        $this->services();

        // Registering Functions.
        $this->functions();
    }

    /**
     * Method to register the services.
     *
     * @static
     * @access private
     * @since  1.0
     */
    private function services() {
        foreach ( $this->get_classes() as $class ) {
            $service = $class::get_instance();

            if ( method_exists( $service, 'register' ) ) {
                $service->register();
            }
        }
    }

    /**
     * Method to register the functions.
     *
     * @static
     * @access private
     * @since  1.0
     */
    private function functions() {
        foreach ( $this->get_files() as $file ) {
            $this->base::require_file( "$file.php" );
        }
    }
}
