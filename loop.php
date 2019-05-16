<?php
/**
 * The loop template file.
 *
 * Included on pages like index.php, archive.php and search.php to display a loop of posts
 * Learn more: https://codex.wordpress.org/The_Loop
 *
 * @package 	AuroraWPThemes
 * @since 		1.0
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

/**
 * Hook: aurora_loop_before, Contents before main post loop.
 *
 * @hooked aurora_posts_loop_wrapper_start			- 10
 */
do_action( 'aurora_loop_before' );

/* Start the Loop */
while ( have_posts() ) {
	the_post();

	if( is_search() ) {

		// Search template partial.
        get_template_part( 'template-parts/content/content', 'search' );

    } else {
		/**
		 * Include the Post-Format-specific template for the content.
		 * If you want to override this in a child theme, then include a file
		 * called templates/content/content-___.php (where ___ is the Post Format name)
		 * and that will be used instead.
		 */
		get_template_part( 'template-parts/content/content', get_post_format() );
    }
}

/**
 * Hook: aurora_loop_after, Contents after main post loop.
 *
 * @hooked aurora_posts_loop_wrapper_close			- 10
 * @hooked aurora_pagination						- 15
 */
do_action( 'aurora_loop_after' );
