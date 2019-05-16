<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package 	AuroraWPThemes
 * @since 		1.0
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

get_header(); ?>

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
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) :
				the_post();

				/**
				 * Hook: aurora_page_before, Contents before page contents.
				 */
				do_action( 'aurora_page_before' );

				get_template_part( 'template-parts/content/content', 'page' );

				/**
				 * Hook: aurora_page_after, Contents after page contents.
				 *
				 * @hooked aurora_render_comments 				- 10
				 */
				do_action( 'aurora_page_after' );

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
		<?php
		/**
		 * Hook: aurora_sidebar, Renders sidebar contents.
		 *
		 * @hooked aurora_main_wrapper_close				- 0
		 * @hooked aurora_sidebar_wrapper_start				- 5
		 */
		do_action( 'aurora_sidebar' );

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
