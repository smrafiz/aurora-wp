<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package 	AuroraWPThemes
 * @since 		1.0
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}
?>
			<?php
			/**
			 * Hook: aurora_content_bottom, Bottom Contents inside #content.
			 */
			do_action( 'aurora_content_bottom' );
			?>
		</div><!-- #content -->

		<?php
		/**
		 * Hook: aurora_before_footer, Contents before #colophon.
		 */
		do_action( 'aurora_before_footer' );
		?>

		<footer id="colophon" class="site-footer">

			<?php
			/**
			 * Hook: aurora_footer, Contents inside #colophon.
			 */
			do_action( 'aurora_footer' );
			?>

		</footer><!-- #colophon -->

		<?php
		/**
		 * Hook: aurora_after_footer, Contents after #colophon.
		 */
		do_action( 'aurora_after_footer' );
		?>

	</div><!-- #page -->

	<?php
	/**
	 * Hook: aurora_after_site, Contents after #page.
	 */
	do_action( 'aurora_after_site' );
	?>

	<?php wp_footer(); ?>

</body>
</html>
