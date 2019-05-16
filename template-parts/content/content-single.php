<?php
/**
 * Template used to display post content on single pages.
 *
 * @package 	AuroraWPThemes
 * @since 		1.0
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'single-post-entry-content' ) ); ?>>

	<?php
	/**
	 * Hook: aurora_single_post_top, Top Contents inside single post loop.
	 */
	do_action( 'aurora_single_post_top' );

	/**
	 * Hook: aurora_single_post, Single Post Contents.
	 *
	 * @hooked aurora_post_header 						- 10
	 * @hooked aurora_post_content 						- 15
	 * @hooked aurora_post_footer 						- 20
	 */
	do_action( 'aurora_single_post' );

	/**
	 * Hook: aurora_single_post_bottom, Bottom Contents inside single post loop.
	 *
	 * @hooked aurora_post_nav 							- 10
	 * @hooked aurora_render_comments					- 15
	 */
	do_action( 'aurora_single_post_bottom' );
	?>

</article><!-- #post-## -->
