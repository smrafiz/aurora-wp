<?php
/**
 * Admin Class.
 *
 * @package 	AuroraWPThemes
 * @since 		1.0
 */

namespace AuroraThemes\Admin;

use AuroraThemes\Admin\Settings_Callbacks as Callbacks;
use AuroraThemes\Admin\Plugins as Plugins;
use AuroraThemes\Core\Base as Base;
use AuroraThemes\Core\Settings as Settings;

// Do not allow directly accessing this file.
if ( ! defined('ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

/**
 * Main Admin Class.
 * This Class uses admin related methods
 * by tapping into the settings api class.
 *
 * @since v1.0
 */
class Admin {

	/**
	 * Stores the instance of the Settings API Class.
	 *
	 * @access private
	 * @var object
	 * @since  1.0
	 */
	private $settings;

	/**
	 * Stores the instance of the Settings Callbacks Class.
	 *
	 * @access private
	 * @var object
	 * @since  1.0
	 */
	private $callback;

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
	 * Initialize Admin page with scripts.
	 *
	 * @access public
	 * @since  v1.0
	 */
	public function register() {

		// Redirect to admin page on theme activation.
		add_action( 'after_switch_theme', [ $this, 'welcome_page' ] );

		// Required and recommended plugins.
		add_action( 'tgmpa_register', [ Plugins::get_instance(), 'register_plugins' ] );

		// Custom button for TGMPA notice.
		add_filter( 'tgmpa_notice_action_links', [ Plugins::get_instance(), 'edit_tgmpa_notice_action_links' ] );

		// Base Class.
		$this->base = Base::get_instance();

		// Settings Api.
		$this->settings = Settings::get_instance();

		// Settings Callbacks.
		$this->callback = Callbacks::get_instance();

		// Init admin page with styles and scripts.
		$this->enqueue()->pages()->admin_init();
	}

	/**
	 * Redirect to admin page on theme activation.
	 *
	 * @access public
	 * @since  v1.0
	 */
	public function welcome_page() {
		if ( current_user_can('edit_theme_options' ) ) {
			header( 'Location:' . esc_url( admin_url() ) . 'themes.php?page=' . esc_attr( $this->base->get_theme_slug() ) );
		}
	}

	/**
	 * Triggers the register method of the Settings API Class.
	 *
	 * @access private
	 * @since  v1.0
	 */
	private function admin_init() {
		$this->settings->register();
	}

	/**
	 * Enqueue scripts in specific admin pages.
	 *
	 * @access private
	 * @return object
	 * @since  v1.0
	 */
	private function enqueue() {

		// Multidimensional array for styles and scripts.
		$scripts = [
			'style' => [
				[
					'handle' 		=> 'aurora-welcome-styles',
					'asset_uri' 	=> $this->base->get_css_uri() . 'admin/welcome-page.css',
					'dependency'	=> [],
					'version' 		=> '1.0',
				],
			],

			'script' => [
				[
					'handle' 		=> 'aurora-welcome-script',
					'asset_uri' 	=> $this->base->get_js_uri() . 'admin/welcome-page.js',
					'dependency'	=> ['jquery'],
					'version' 		=> '1.0',
				],
			],
		];

		// Pages array to where enqueue scripts.
		$pages = ['appearance_page_' . esc_attr( $this->base->get_theme_slug() )];

		// Enqueue scripts in Admin area.
		$this->settings->admin_enqueue( $scripts, $pages );

		return $this;
	}

	/**
	 * Registers theme page.
	 *
	 * @access private
	 * @return object
	 * @since  v1.0
	 */
	private function pages() {

		// Theme Page args.
		$theme_page = [
			[
				'page_title'	=> esc_html( $this->base->get_theme_name() ),
				'menu_title' 	=> esc_html( $this->base->get_theme_name() ),
				'capability' 	=> 'manage_options',
				'menu_slug' 	=> esc_attr( $this->base->get_theme_slug() ),
				'callback' 		=> [ $this->callback, 'admin_dashboard' ],
			]
		];

		// Creating Theme Page.
		$this->settings->add_page( $theme_page );

		return $this;
	}
}
