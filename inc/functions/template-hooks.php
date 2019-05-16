<?php
/**
 * Template hooks
 * List of all template hooks used on the theme.
 *
 * @package 	AuroraWPThemes
 * @since 		1.0
 */

/**
 * General.
 *
 * @see aurora_mobile_navigation()
 * @see aurora_page_title()
 * @see aurora_get_sidebar()
 */
add_action( 'aurora_before_site', 'aurora_mobile_navigation', 10 );
add_action( 'aurora_before_site', 'aurora_mobile_navigation_mask', 15 );
add_action( 'aurora_before_content', 'aurora_page_title', 10 );
add_action( 'aurora_primary_top', 'aurora_content_area_container_start', 0 );
add_action( 'aurora_primary_top', 'aurora_main_wrapper_start', 5 );
add_action( 'aurora_sidebar', 'aurora_main_wrapper_close', 0 );
add_action( 'aurora_sidebar', 'aurora_sidebar_wrapper_start', 5 );
add_action( 'aurora_sidebar', 'aurora_get_sidebar', 10 );
add_action( 'aurora_primary_bottom', 'aurora_sidebar_wrapper_close', 0 );
add_action( 'aurora_primary_bottom', 'aurora_content_area_container_close', 50 );

/**
 * Header.
 *
 * @see aurora_skip_links()
 * @see aurora_site_branding()
 * @see aurora_primary_navigation()
 * @see aurora_mobile_navigation_activator()
 */
add_action( 'aurora_header', 'aurora_skip_links', 0 );
add_action( 'aurora_header', 'aurora_header_area_wrapper_start', 5 );
add_action( 'aurora_header', 'aurora_header_container_start', 10 );
add_action( 'aurora_header', 'aurora_site_branding', 15 );
add_action( 'aurora_header', 'aurora_primary_navigation_wrapper_start', 20 );
add_action( 'aurora_header', 'aurora_primary_navigation', 25 );
add_action( 'aurora_header', 'aurora_mobile_navigation_activator', 30 );
add_action( 'aurora_header', 'aurora_primary_navigation_wrapper_close', 35 );
add_action( 'aurora_header', 'aurora_header_container_close', 40 );
add_action( 'aurora_header', 'aurora_header_area_wrapper_close', 45 );
add_action( 'aurora_header', 'aurora_fixed_header_height_placeholder', 50 );

/**
 * Footer.
 *
 * @see aurora_footer_widget_area()
 * @see aurora_footer_copyright()
 */
add_action( 'aurora_footer', 'aurora_footer_widget_area', 10 );
add_action( 'aurora_footer', 'aurora_footer_copyright', 15 );

/**
 * Homepage.
 *
 */

/**
 * Posts.
 *
 * @see aurora_post_header()
 * @see aurora_post_thumbnail()
 * @see aurora_post_content()
 * @see aurora_post_footer()
 * @see aurora_pagination()
 */
add_action( 'aurora_loop_before', 'aurora_posts_loop_wrapper_start', 10 );
add_action( 'aurora_loop_post', 'aurora_post_header', 10 );
add_action( 'aurora_post_content_before', 'aurora_post_thumbnail', 10 );
add_action( 'aurora_loop_post', 'aurora_post_content', 15 );
add_action( 'aurora_loop_post', 'aurora_post_footer', 20 );
add_action( 'aurora_loop_after', 'aurora_posts_loop_wrapper_close', 10 );
add_action( 'aurora_loop_after', 'aurora_pagination', 15 );
add_action( 'aurora_single_post', 'aurora_post_header', 10 );
add_action( 'aurora_single_post', 'aurora_post_content', 15 );
add_action( 'aurora_single_post', 'aurora_post_footer', 20 );
add_action( 'aurora_single_post_bottom', 'aurora_post_nav', 10 );
add_action( 'aurora_single_post_bottom', 'aurora_render_comments', 15 );

/**
 * Pages.
 *
 * @see aurora_page_content()
 * @see aurora_render_comments()
 */
add_action( 'aurora_page', 'aurora_page_content', 10 );
add_action( 'aurora_page_after', 'aurora_render_comments', 10 );

/**
 * Comment Area.
 *
 * @see aurora_render_comments_list()
 * @see aurora_render_comment_form()
 */
add_action( 'aurora_before_comment_area', 'aurora_comment_area_wrapper_start', 10 );
add_action( 'aurora_comment_area', 'aurora_render_comments_list', 10 );
add_action( 'aurora_comment_area', 'aurora_render_comment_form', 20 );
add_action( 'aurora_after_comment_area', 'aurora_comment_area_wrapper_close', 50 );
