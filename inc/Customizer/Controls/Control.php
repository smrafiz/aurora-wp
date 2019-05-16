<?php
/**
 * Customizer Custom Control Base Class.
 *
 * @package 	AuroraWPThemes
 * @since 		1.0
 */

namespace AuroraThemes\Customizer\Controls;

use AuroraThemes\Core\Base as Base;
use WP_Customize_Control;

// Do not allow directly accessing this file.
if ( ! defined('ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

// Exit if WP_Customize_Control does not exsist.
if ( ! class_exists( 'WP_Customize_Control' ) ) {
    return null;
}

/**
 * Customizer Custom Control Base Class.
 *
 * @since v1.0
 */
class Control extends WP_Customize_Control {

    /**
     * Assets URI.
     *
     * @access protected
     * @since  1.0
     */
    protected function get_assets_uri() {
        return Base::get_instance()->get_assets_uri();
    }

    /**
     * Theme Version.
     *
     * @access protected
     * @since  1.0
     */
    protected function get_theme_version() {
        return Base::get_instance()->get_theme_version();
    }
}