<?php
/**
 * Theme Engine Room.
 * This theme uses PSR-4 and OOP logic instead of procedural coding.
 * Every function, hook and action is properly divided and organized inside related folders and files.
 *
 * @package 	AuroraWPThemes
 * @since 		1.0
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

/**
 * This Theme only works in WordPress 4.7 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7', '<' ) ) {
	require get_template_directory() . '/inc/utils/back-compat.php';
	return;
}

if ( file_exists( get_parent_theme_file_path( 'vendor/autoload.php' ) ) ) {
	require_once get_parent_theme_file_path( 'vendor/autoload.php' );
}

if ( class_exists( 'AuroraThemes\\Init' ) ) {
	$theme = AuroraThemes\Init::get_instance();
	$theme->register_services();
}

// echo ( ! is_admin() ) ? AURORA_ROOT_DIR : '';

add_action('init', 'codexin_custompost_type');
/**
 * Function to register all the Custom Post Types
 *
 * @since 1.0
 */
function codexin_custompost_type()
{
    /**
     * Custom Post Type -  Testimonial
     *
     */

    // Creating the Labels for Testimonial Custom Post
    $labels = array(
        'name'                  => esc_html__('Testimonial', 'codexin'),
        'singular_name'         => esc_html__('Testimonial', 'codexin'),
        'add_new'               => esc_html__('Add New', 'codexin'),
        'all_items'             => esc_html__('All Testimonial', 'codexin'),
        'add_new_item'          => esc_html__('Add New', 'codexin'),
        'edit_item'             => esc_html__('Edit Testimonial', 'codexin'),
        'new_item'              => esc_html__('New Testimonial', 'codexin'),
        'view_item'             => esc_html__('View Testimonial', 'codexin'),
        'search_item'           => esc_html__('Search Testimonial Post', 'codexin'),
        'not_found'             => esc_html__('No Testimonial Found', 'codexin'),
        'not_found_in_trash'    => esc_html__('No Testimonial In Trash', 'codexin'),
        'parent_item_colon'     => esc_html__('Parent Testimonial', 'codexin')

    );

    // Creating an Aruments Array that Store all argumens of Testimonial Custom Post
    $args = array(
        'labels'                => $labels,
        'menu_icon'             => 'dashicons-admin-customizer',
        'public'                => true,
        'has_archive'           => true,
        'publicly_queryable'    => true,
        'query_var'             => true,
        'rewrite'               => true,
        'capability-type'       => 'post',
        'hierarchical'          => true,
        'supports'              => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail',
        ),
        'taxonomies'            => array( '' ),
        'menu_position'         => 11,
        'exclude_from_search'   => false
    );

    // Registering the Testimonial Custom Post
    register_post_type('testimonial', $args);


    /**
     * Custom Post Type -  Podcast
     *
     */

    // Creating the Labels for Podcast Custom Post
    $labels = array(
        'name'                  => esc_html__('Podcast', 'codexin'),
        'singular_name'         => esc_html__('Podcast', 'codexin'),
        'add_new'               => esc_html__('Add New', 'codexin'),
        'all_items'             => esc_html__('All Podcast', 'codexin'),
        'add_new_item'          => esc_html__('Add New', 'codexin'),
        'edit_item'             => esc_html__('Edit Podcast', 'codexin'),
        'new_item'              => esc_html__('New Podcast', 'codexin'),
        'view_item'             => esc_html__('View Podcast', 'codexin'),
        'search_item'           => esc_html__('Search Podcast Post', 'codexin'),
        'not_found'             => esc_html__('No Podcast Found', 'codexin'),
        'not_found_in_trash'    => esc_html__('No Podcast In Trash', 'codexin'),
        'parent_item_colon'     => esc_html__('Parent Podcast', 'codexin')

    );

    // Creating an Aruments Array that Store all argumens of Podcast Custom Post
    $args = array(
        'labels'                => $labels,
        'menu_icon'             => 'dashicons-format-audio',
        'public'                => true,
        'has_archive'           => true,
        'publicly_queryable'    => true,
        'query_var'             => true,
        'rewrite'               => true,
        'capability-type'       => 'post',
        'hierarchical'          => true,
        'supports'              => array(
            'title',
        ),
        'taxonomies'            => array( '' ),
        'menu_position'         => 12,
        'exclude_from_search'   => false
    );

    // Registering the Podcast Custom Post
    register_post_type('podcasting', $args);
}