<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package 	AuroraWPThemes
 * @since 		1.0
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}
?>

<article id="page-<?php the_ID(); ?>" <?php post_class( array( 'page-entry-content' ) ); ?>>

	<?php
	/**
	 * Hook: aurora_page, Page contents.
	 *
	 * @hooked aurora_page_content 					- 10
	 */
	do_action( 'aurora_page' );
	?>

</article><!-- #post-## -->
