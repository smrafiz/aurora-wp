<?php
/**
 * Settings API.
 *
 * @package 	AuroraWPThemes
 * @since 		1.0
 */

namespace AuroraThemes\Core;

// Do not allow directly accessing this file.
if( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

/**
 * Settings API Class.
 *
 * @since v1.0
 */
class Settings {

	/**
	 * Enqueues scripts.
	 *
	 * @var array
     * @access private
     * @since  1.0
	 */
	private $enqueues = [];

	/**
	 * Admin pages to enqueue scripts.
	 *
	 * @var array
     * @access private
     * @since  1.0
	 */
	private $enqueue_on_specific_pages = [];

	/**
	 * Theme Page.
	 *
	 * @var array
     * @access private
     * @since  1.0
	 */
    private $theme_page = [];

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
     * @return AuroraThemes\Api\Settings
     * @since  1.0
     */
    public static function get_instance() {
        if( null === self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Init Admin Menu.
     *
     * @access public
     * @since  1.0
     */
	public function register() {

		// Enqueue Admin Scripts.
		if( ! empty( $this->enqueues ) ) {
            add_action( 'admin_enqueue_scripts', [ $this, 'admin_scripts' ] );
        }

		// Add Theme Page.
		if( ! empty( $this->theme_page ) ) {
            add_action( 'admin_menu', [ $this, 'init_theme_page' ] );
        }
	}

	/**
	 * Enqueue styles and scripts.
	 *
	 * @param array $scripts Scripts to load
	 * @param array $pages Pages where to load scripts.
     * @access public
     * @since  1.0
	 */
	public function admin_enqueue( array $scripts, array $pages ) {
		if( empty( $scripts ) ) {
            return $this;
		}

		$this->enqueues = $scripts;

		if( ! empty( $pages ) ) {
			$this->enqueue_on_specific_pages = $pages;
        }

		return $this;
	}

	/**
	 * Method to be called by the admin_enqueue_scripts hook.
	 *
	 * @param  array $hook page id or filename passed by admin_enqueue_scripts.
     * @access public
     * @since  1.0
	 */
	public function admin_scripts( $hook ) {

		$this->enqueue_on_specific_pages = ( ! empty( $this->enqueue_on_specific_pages ) ) ? $this->enqueue_on_specific_pages : [ $hook ];

		if( in_array( $hook, $this->enqueue_on_specific_pages ) ) {
			$wp_enqueue_function = '';

			foreach( $this->enqueues as $type => $enqueue ) {
				$wp_enqueue_function = 'wp_enqueue_' . $type;

				foreach( $enqueue as $key ) {
					$wp_enqueue_function(
						$key['handle'],
						$key['asset_uri'],
						$key['dependency'],
						$key['version'],
						( 'style' === $type ) ? 'all' : true
					);
				}
			}
		}
	}

	/**
	 * Injects user's defined theme pages array into $theme_page array.
	 *
	 * @param  array $args Array of user's defined pages.
     * @access public
     * @since  1.0
	 */
	public function add_page( array $args ) {
		$this->theme_page = $args;

		return $this;
	}

	/**
	 * Generate Theme Page.
	 *
     * @access public
     * @since  1.0
	 */
	public function init_theme_page() {

		// Theme Page under Appearance.
		foreach( $this->theme_page as $args ) {
			add_theme_page(
				$args['page_title'],
				$args['menu_title'],
				$args['capability'],
				$args['menu_slug'],
				$args['callback']
			);
		}
	}
}
