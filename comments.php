<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package 	AuroraWPThemes
 * @since 		1.0
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	printf(
		'<p class="alert">%s</p>',
		esc_html__( 'This post is password protected. Enter the password to view comments.', 'aurora-wp' ) );
	return;
}
?>

<?php
/**
 * Hook: aurora_before_comment_area, Contents before Comments area.
 *
 * @hooked aurora_comment_area_wrapper_start 		- 10
 */
do_action( 'aurora_before_comment_area' );

/**
 * Hook: aurora_comment_area, Comment area contents.
 *
 * @hooked aurora_render_comments_list 				- 10
 * @hooked aurora_render_comment_form 				- 20
 */
do_action( 'aurora_comment_area' );

/**
 * Hook: aurora_after_comment_area, Contents after Comments area.
 *
 * @hooked aurora_comment_area_wrapper_close 		- 50
 */
do_action( 'aurora_after_comment_area' );
