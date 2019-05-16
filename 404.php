<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package 	AuroraWPThemes
 * @since 		1.0
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

get_header();
?>

	<div id="primary" class="content-area">
		<?php
		/**
		 * Hook: aurora_primary_top, Top Contents inside #primary.
		 *
		 * @hooked aurora_content_area_container_start 		- 0
		 * @hooked aurora_main_wrapper_start 				- 5
		 */
		do_action( 'aurora_primary_top' );
		?>
		<main id="main" class="site-main">
            <div class="error-404 not-found">
                <div class="page-content">
                    <article>
                        <h2><?php esc_html_e( 'The page you are trying to access does not exist.', 'aurora-wp' ) ?></h2>
                        <p><?php esc_html_e( 'Please use the menu above to locate what you are searching for. Or you can try searching with a keyword below:', 'aurora-wp' ) ?></p>
                        <?php get_search_form(); ?>
					</article>
                </div><!-- .page-content -->
            </div><!-- .error-404 -->

		</main><!-- #main -->
		<?php
		/**
		 * Hook: aurora_primary_bottom, Bottom Contents inside #primary.
		 *
		 * @hooked aurora_sidebar_wrapper_close 			- 0
		 * @hooked aurora_content_area_container_close		- 50
		 */
		do_action( 'aurora_primary_bottom' );
		?>
	</div><!-- #primary -->

<?php
get_footer();
