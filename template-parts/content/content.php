<?php
/**
 * Template used to display post content.
 *
 * @package 	AuroraWPThemes
 * @since 		1.0
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
	/**
	 * Hook: aurora_loop_post, Post Contents.
	 *
	 * @hooked aurora_post_header 						- 10
	 * @hooked aurora_post_content 						- 15
	 * @hooked aurora_post_footer 						- 20
	 */
	do_action( 'aurora_loop_post' );
	?>

</article><!-- #post-## -->
