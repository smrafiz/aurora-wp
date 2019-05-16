<?php
/**
 * Template functions
 * List of all template functions used globally on the theme.
 *
 * @package 	AuroraWPThemes
 * @since 		1.0
 */

use AuroraThemes\Lib\Breadcrumbs;
use AuroraThemes\Lib\Pagination;
use AuroraThemes\Setup\Menus;

if ( ! function_exists( 'aurora_mobile_navigation' ) ) {
	/**
	 * Displays Mobile Navigation.
	 *
	 * @since 1.0.0
	 */
	function aurora_mobile_navigation() {
		if ( ! has_nav_menu( 'handheld_nav' ) ) {
			return;
		}
		?>
        <div id="c-menu--slide-left" class="c-menu c-menu--slide-left d-block d-sm-block d-md-block d-lg-none">
            <button class="c-menu__close"><?php echo esc_html__( '&larr; Back', 'aurora-wp' ); ?></button>
            <?php Menus::aurora_nav_menu(
                [
                    'theme_location'    => 'handheld_nav',
                    'menu'              => 'handheld_nav',
                    'container'         => 'div',
                    'container_class'   => 'nav-wrapper',
					'menu_class'        => 'c-menu__items',
					'menu_id'         	=> 'handheld-menu',
                ]
            ); ?>
        </div>
        <?php
	}
}

if ( ! function_exists( 'aurora_mobile_navigation_mask' ) ) {
	/**
	 * Displays Mobile Navigation Mask.
	 *
	 * @since 1.0.0
	 */
	function aurora_mobile_navigation_mask() {
        echo '<div id="c-mask" class="c-mask"></div><!-- ' . esc_attr__( 'Empty placeholder for Mobile Menu masking.', 'aurora-wp' ) . '-->';
	}
}

if ( ! function_exists( 'aurora_page_title' ) ) {
	/**
	 * Displays Page Title.
	 *
	 * @since 1.0.0
	 */
	function aurora_page_title() {
		if( is_front_page() ) {
			return;
		}

		$breadcrumbs = Breadcrumbs::get_instance();
		?>

		<div id="page-title" class="page-title">
			<div class="container">
				<div class="row">
					<div class="col-12 col-sm-12 col-md-12">
						<h1><?php echo wp_kses_post( aurora_get_page_title() ); ?></h1>
						<?php
						// Breadcrumbs
						$breadcrumbs->get_breadcrumbs(
							[
								'home_prefix'	=> esc_attr__( 'You are here', 'aurora-wp' ),
								'delimiter'  	=> '<i class="fa fa-angle-right"></i>',
							]
						);
						?>
					</div>
				</div>
			</div>
		</div>

		<?php
	}
}

if ( ! function_exists( 'aurora_content_area_container_start' ) ) {
	/**
	 * Starting Content Area Container.
	 *
	 * @since 1.0.0
	 */
	function aurora_content_area_container_start() {
        echo '<div class="container">';
			echo '<div class="row">';
	}
}

if ( ! function_exists( 'aurora_main_wrapper_start' ) ) {
	/**
	 * Starting Main content wrapper.
	 *
	 * @since 1.0.0
	 */
	function aurora_main_wrapper_start() {
		if( is_404() ) {
			echo '<div class="col-12 col-sm-12 col-md-12 col-lg-12">';
		} else {
			echo '<div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-9">';
		}
	}
}

if ( ! function_exists( 'aurora_main_wrapper_close' ) ) {
	/**
	 * Closing Main content wrapper.
	 *
	 * @since 1.0.0
	 */
	function aurora_main_wrapper_close() {
        echo '</div><!-- .col -->';
	}
}

if ( ! function_exists( 'aurora_sidebar_wrapper_start' ) ) {
	/**
	 * Starting sidebar wrapper.
	 *
	 * @since 1.0.0
	 */
	function aurora_sidebar_wrapper_start() {
        echo '<div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-3">';
	}
}

if ( ! function_exists( 'aurora_get_sidebar' ) ) {
	/**
	 * Display sidebar
	 *
	 * @uses get_sidebar()
	 * @since 1.0.0
	 */
	function aurora_get_sidebar() {
		get_sidebar();
	}
}

if ( ! function_exists( 'aurora_sidebar_wrapper_close' ) ) {
	/**
	 * Closing sidebar wrapper.
	 *
	 * @since 1.0.0
	 */
	function aurora_sidebar_wrapper_close() {
		echo '</div><!-- .col -->';
	}
}

if ( ! function_exists( 'aurora_content_area_container_close' ) ) {
	/**
	 * Closing Content Area Container.
	 *
	 * @since 1.0.0
	 */
	function aurora_content_area_container_close() {
			echo '</div><!-- .row -->';
		echo '</div><!-- .container -->';
	}
}

if ( ! function_exists( 'aurora_skip_links' ) ) {
	/**
	 * Displays Skip Link.
	 *
	 * @since 1.0.0
	 */
	function aurora_skip_links() {
        echo '<a class="skip-link sr-only sr-only-focusable" href="#content">' . esc_html__( 'Skip to content', 'aurora-wp' ) . '</a>';
	}
}

if ( ! function_exists( 'aurora_header_area_wrapper_start' ) ) {
	/**
	 * Starting Header area wrapper.
	 *
	 * @since 1.0.0
	 */
	function aurora_header_area_wrapper_start() {
        echo '<div class="header-area intelligent-header">';
	}
}

if ( ! function_exists( 'aurora_header_container_start' ) ) {
	/**
	 * Starting Header container.
	 *
	 * @since 1.0.0
	 */
	function aurora_header_container_start() {
        echo '<div class="container">';
            echo '<div class="row align-items-center">';
	}
}

if ( ! function_exists( 'aurora_site_branding' ) ) {
	/**
	 * Rendering site branding.
	 *
	 * @since 1.0.0
	 */
	function aurora_site_branding() {
		$site_branding = '';
        $site_branding .= '<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3">';
            $site_branding .= '<div class="site-branding">';
                $site_branding .= '<div class="logo">';

					if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
						$logo = get_custom_logo();
						$site_branding .= ( is_home() || is_front_page() ) ? '<h1 class="logo">' . $logo . '</h1>' : $logo;
					} else {
						$tag = ( is_front_page() ) ? 'h1' : 'div';

						$site_branding .= '<' . esc_attr( $tag ) . ' class="site-title"><a href="' . esc_url( home_url( '/' ) ) . '" rel="home">' . esc_html( get_bloginfo( 'name', 'display' ) ) . '</a></' . esc_attr( $tag ) . '>';

						if ( '' !== get_bloginfo( 'description' ) ) {
							$site_branding .= '<p class="site-description">' . esc_html( get_bloginfo( 'description', 'display' ) ) . '</p>';
						}
					}
				$site_branding .= '</div><!-- .logo -->';
			$site_branding .= '</div><!-- .site-branding -->';
		$site_branding .= '</div><!-- .col -->';

		echo $site_branding; // WPCS: XSS ok.

	}
}

if ( ! function_exists( 'aurora_primary_navigation_wrapper_start' ) ) {
	/**
	 * Starting Primary Navigation wrapper.
	 *
	 * @since 1.0.0
	 */
	function aurora_primary_navigation_wrapper_start() {
        echo '<div class="col-12 col-sm-12 col-md-6 col-lg-8 col-xl-9">';
	}
}

if ( ! function_exists( 'aurora_primary_navigation' ) ) {
	/**
	 * Rendering Primary Navigation.
	 *
	 * @since 1.0.0
	 */
	function aurora_primary_navigation() {
		if ( ! has_nav_menu( 'primary_nav' ) ) {
			return;
		}
		?>
		<div class="navigation-wrapper d-none d-sm-none d-md-none d-lg-block">
			<div id="main-nav">
				<?php
					Menus::aurora_nav_menu(
						[
							'theme_location'    => 'primary_nav',
							'menu'              => 'primary_nav',
						]
					);
				?>
			</div><!-- #main-nav -->
		</div><!-- .navigation-wrapper -->
		<?php
	}
}

if ( ! function_exists( 'aurora_mobile_navigation_activator' ) ) {
	/**
	 * Rendering Mobile Navigation Activator Menu Button.
	 *
	 * @since 1.0.0
	 */
	function aurora_mobile_navigation_activator() {
		$button = '';
		$button .= '<div id="o-wrapper" class="mobile-nav o-wrapper d-block d-sm-block d-md-block d-lg-none">';
			$button .= '<div class="primary-nav">';
				$button .= '<button id="c-button--slide-left" class="primary-nav-details">';
					$button .= esc_html__( 'Menu', 'aurora-wp' ) . '<i class="fa fa-bars"></i>';
				$button .= '</button><!-- #main-nav -->';
			$button .= '</div><!-- #main-nav -->';
		$button .= '</div>';

		echo $button; // WPCS: XSS ok.
	}
}

if ( ! function_exists( 'aurora_primary_navigation_wrapper_close' ) ) {
	/**
	 * Closing Primary Navigation wrapper.
	 *
	 * @since 1.0.0
	 */
	function aurora_primary_navigation_wrapper_close() {
        echo '</div><!-- .col -->';
	}
}

if ( ! function_exists( 'aurora_header_container_close' ) ) {
	/**
	 * Closing Header container.
	 *
	 * @since 1.0.0
	 */
	function aurora_header_container_close() {
            echo '</div><!-- .row -->';
        echo '</div><!-- .container -->';
	}
}

if ( ! function_exists( 'aurora_header_area_wrapper_close' ) ) {
	/**
	 * Closing Header area wrapper.
	 *
	 * @since 1.0.0
	 */
	function aurora_header_area_wrapper_close() {
        echo '</div><!-- .header-area -->';
	}
}

if ( ! function_exists( 'aurora_fixed_header_height_placeholder' ) ) {
	/**
	 * Placeholder for fixed header.
	 *
	 * @since 1.0.0
	 */
	function aurora_fixed_header_height_placeholder() {
        echo '<div class="fixed-header-space"></div><!-- ' . esc_attr__( 'Empty placeholder for header height.', 'aurora-wp' ) . '-->';
	}
}

if ( ! function_exists( 'aurora_footer_widget_area' ) ) {
	/**
	 * Display Footer Widgets.
	 *
	 * @since 1.0.0
	 */
	function aurora_footer_widget_area() {
		$column_count = 4;

		echo '<div class="footer-widget-area">';
			echo '<div class="container">';
				echo '<div class="row">';
					for ( $footer_no = 1; $footer_no <= intval( $column_count ); $footer_no++ ) {
						echo '<div id="footer-col-' . esc_attr( $footer_no ) . '" class="footer-column col-12 col-sm-12 col-md-6 col-lg-3">';
							if ( is_active_sidebar( 'aurora-footer-col-' . esc_attr( $footer_no ) ) ) {
								dynamic_sidebar( 'aurora-footer-col-' . esc_attr( $footer_no ) );
							}
						echo '</div>';
					}
				echo '</div><!-- .row -->';
			echo '</div><!-- .container -->';
		echo '</div><!-- .footer-widget-area -->';
	}
}

if ( ! function_exists( 'aurora_footer_copyright' ) ) {
	/**
	 * Display Footer Copyright.
	 *
	 * @since 1.0.0
	 */
	function aurora_footer_copyright() {
		?>
		<div class="footer-copyright">
			<div class="container">
				<div class="row">
					<div class="col-12 col-sm-12 col-md-12">
						<div class="site-info text-center">
							<?php
							$blog_info = get_bloginfo( 'name' );
							if ( ! empty( $blog_info ) ) {
							?>
								<a class="site-name" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>,
							<?php
							}
							?>
							<a href="<?php echo esc_url( esc_html__( 'https://wordpress.org/', 'aurora-wp' ) ); ?>" class="imprint">
								<?php
								/* translators: %s: WordPress. */
								printf( esc_html__( 'Proudly powered by %s.', 'aurora-wp' ), 'WordPress' );
								?>
							</a>
						</div><!-- .site-info -->
					</div>
				</div><!-- .row -->
			</div><!-- .container -->
		</div><!-- .footer-copyright -->
	<?php
	}
}

if ( ! function_exists( 'aurora_posts_loop_wrapper_start' ) ) {
	/**
	 * Starting wrapper for posts loop.
	 *
	 * @since 1.0.0
	 */
	function aurora_posts_loop_wrapper_start() {
        echo '<div class="posts-container">';
	}
}

if ( ! function_exists( 'aurora_post_header' ) ) {
	/**
	 * Display the post header with a link to the single post.
	 *
	 * @since 1.0.0
	 */
	function aurora_post_header() {
		echo '<header class="entry-header">';

			if ( is_single() ) {
				aurora_post_meta();
				the_title( '<h2 class="entry-title">', '</h2>' );
			} else {
				if ( 'post' === get_post_type() ) {
					aurora_post_meta();
				}

				the_title(
					sprintf(
						'<h2 class="entry-title"><a href="%s" rel="bookmark">',
						esc_url( get_permalink() )
					),
					'</a></h2>'
				);
			}

		echo '</header><!-- .entry-header -->';
	}
}

if ( ! function_exists( 'aurora_post_content' ) ) {
	/**
	 * Display the post contents.
	 *
	 * @since 1.0.0
	 */
	function aurora_post_content() {

		echo '<div class="entry-content">';

			/**
			 * Hook: aurora_post_content_before, Contents before Post Contents.
			 *
			 * @hooked aurora_post_thumbnail			- 10
			 */
			do_action( 'aurora_post_content_before' );

			if ( is_single() ) {
				the_content();

				// This section is for pagination purpose for a long large post that is seperated using nextpage tags.
				$args = [
					'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'aurora-wp' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
					'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'aurora-wp' ) . ' </span>%',
					'separator'   => '<span class="screen-reader-text">, </span>',
				];
				wp_link_pages( $args );

			} else {
				the_excerpt();
			}

			/**
			 * Hook: aurora_post_content_after, Contents after Post Contents.
			 */
			do_action( 'aurora_post_content_after' );

		echo '</div><!-- .entry-content -->';
	}
}

if ( ! function_exists( 'aurora_post_footer' ) ) {
	/**
	 * Display the post footer.
	 *
	 * @since 1.0.0
	 */
	function aurora_post_footer() {
		if ( ! is_single() ) {
			?>
			<div class="read-more">
				<a href="<?php the_permalink(); ?>"><?php echo esc_html__( 'Read More', 'aurora-wp' ); ?></a>
			</div>
			<?php
		} else {
			if ( ! post_password_required() ) {

				// Tags.
				if ( has_tag() ) {
				?>
					<div class="tagcloud">
						<?php the_tags( '', ' ', '' ); ?>
					</div>
				<?php
				}
			}
		} // End if().
	}
}

if ( ! function_exists( 'aurora_post_nav' ) ) {
	/**
	 * Display the single post pagination.
	 *
	 * @since 1.0.0
	 */
	function aurora_post_nav() {

		// Pagination Class Instance.
		$pagination 	= Pagination::get_instance();
		$display_title 	= true;

		// Render Pagination.
		$pagination->single_post_nav(
			$prev 	= esc_html_x( 'Previous Post', 'Previous Post', 'aurora-wp' ),
			$next 	= esc_html_x( 'Next Post', 'Next Post', 'aurora-wp' ),
			$title 	= $display_title
		);
	}
}

if ( ! function_exists( 'aurora_render_comments' ) ) {
	/**
	 * Display the comments.
	 *
	 * @since 1.0.0
	 */
	function aurora_render_comments() {

		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || 0 !== intval( get_comments_number() ) ) {
			comments_template();
		}
	}
}

if ( ! function_exists( 'aurora_comment_callback' ) ) {
	/**
	 * Aurora comment template.
	 *
	 * @param array $comment the comment array.
	 * @param array $args the comment args.
	 * @param int   $depth the comment depth.
	 * @since 1.0.0
	 */
	function aurora_comment_callback( $comment, $args, $depth ) {
		?>
		<li <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="comment-<?php comment_ID(); ?>">
			<div class="comment-body">
				<div class="comment-media media">
					<?php
					if ( ! empty( get_avatar( $comment ) ) ) {
					?>
						<div class="comment-author vcard">
							<?php
							echo get_avatar(
								$comment,
								$size = '128',
								$default = '',
								$alt = sprintf( '%1$s %2$s', esc_html__( 'Avatar for', 'aurora-wp' ), get_comment_author() )
							);
							?>
						</div><!-- .comment-author -->
					<?php
					}
					?>

					<div class="comment-content media-body">
						<?php
						// Comment Author link.
						printf(
							wp_kses_post( '<cite class="fn">%s</cite>', 'aurora-wp' ),
							get_comment_author_link()
						);
						?>
						<div class="comment-meta commentmetadata">
							<a href="<?php echo esc_url( htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ); ?>">
								<time datetime="<?php echo esc_attr( get_the_time( 'c' ) ); ?>" itemprop="datePublished">
									<?php
									/* translators: 1: comment date, 2: comment time */
									printf( esc_html__( '%1$s at %2$s', 'aurora-wp' ), get_comment_date(), get_comment_time() );
									?>
								</time>
							</a>
							<?php
							edit_comment_link( esc_html__( '(Edit)', 'aurora-wp' ), '  ', '' );
							?>
						</div>

						<div class="comment-text" itemprop="text">
							<?php comment_text(); ?>
						</div>

						<?php
						if ( '0' === $comment->comment_approved ) {
						?>
							<em class="comment-awaiting-moderation"><?php esc_attr_e( 'Your comment is awaiting moderation.', 'aurora-wp' ); ?></em>
							<br />
						<?php
						}
						?>

						<div class="comment-reply">
							<?php
							comment_reply_link(
								array_merge(
									$args,
									[
										'depth' 	=> $depth,
										'max_depth' => $args['max_depth'],
									]
								)
							);
							?>
						</div>
					</div><!-- .comment-content -->
				</div><!-- .comment-media -->
			</div><!-- .comment-body -->
		<?php
	}
}

if ( ! function_exists( 'aurora_posts_loop_wrapper_close' ) ) {
	/**
	 * Closing wrapper for posts loop.
	 *
	 * @since 1.0.0
	 */
	function aurora_posts_loop_wrapper_close() {
        echo '</div><!-- .posts-container -->';
	}
}

if ( ! function_exists( 'aurora_pagination' ) ) {
	/**
	 * Display Pagination.
	 *
	 * @since 1.0.0
	 */
	function aurora_pagination() {

		// Pagination Class Instance.
		$pagination = Pagination::get_instance();

		// Rendering Classic Pagination.
		$pagination->posts_nav(
			$prev = esc_html_x( '&laquo; Older Posts', 'Older Posts', 'aurora-wp' ),
			$next = esc_html_x( 'Newer Posts &raquo;', 'Newer Posts', 'aurora-wp' )
		);

		// Rendering Numbered Pagination.
		// $pagination->numbered_posts_nav(
		// 	$prev = esc_html_x( '&laquo;', 'Older Posts', 'aurora-wp' ),
		// 	$next = esc_html_x( '&raquo;', 'Newer Posts', 'aurora-wp' )
		// );
	}
}

if ( ! function_exists( 'aurora_post_thumbnail' ) ) {
	/**
	 * Display the featured image.
	 *
	 * @var $size thumbnail size. thumbnail|medium|large|full|$custom
	 * @uses has_post_thumbnail()
	 * @uses the_post_thumbnail()
	 * @uses get_the_permalink()
	 * @param string $size the post thumbnail size.
	 * @since 1.0.0
	 */
	function aurora_post_thumbnail( $size = 'full' ) {
		if ( has_post_thumbnail() ) {
			echo '<div class="post-thumbnail">';
				echo ( ! is_single() ) ? '<a href="' . esc_url( get_the_permalink() ) . '">' : '';
					the_post_thumbnail( $size );
				echo ( ! is_single() ) ? '</a>' : '';
			echo '</div>';
		}
	}
}

if ( ! function_exists( 'aurora_page_content' ) ) {
	/**
	 * Display the page contents.
	 *
	 * @since 1.0.0
	 */
	function aurora_page_content() {

		echo '<div class="entry-content">';
			the_content();

			// This section is for pagination purpose for a long large page that is seperated using nextpage tags.
			$args = [
				'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'aurora-wp' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'aurora-wp' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			];
			wp_link_pages( $args );
		echo '</div><!-- .entry-content -->';
	}
}

if ( ! function_exists( 'aurora_comment_area_wrapper_start' ) ) {
	/**
	 * Starting wrapper for Comments Area.
	 *
	 * @since 1.0.0
	 */
	function aurora_comment_area_wrapper_start() {
        echo '<section id="comments" class="comments-area" aria-label="' . esc_html__( 'Post Comments', 'aurora-wp' ) . '">';
	}
}

if ( ! function_exists( 'aurora_render_comments_list' ) ) {
	/**
	 * Display Comment List.
	 *
	 * @since 1.0.0
	 */
	function aurora_render_comments_list() {
		if ( ! have_comments() ) {
			return;
		}
		?>

		<h2 class="comments-title">
			<?php
				printf( // WPCS: XSS OK.
					/* translators: 1: number of comments, 2: post title */
					esc_html(
						_nx(
							'%1$s thought on &ldquo;%2$s&rdquo;',
							'%1$s thoughts on &ldquo;%2$s&rdquo;',
							get_comments_number(),
							'comments title',
							'aurora-wp'
							)
						),
					number_format_i18n( get_comments_number() ),
					'<span>' . get_the_title() . '</span>'
				);
			?>
		</h2><!-- .comment-title -->

		<ol class="comment-list">
			<?php
				wp_list_comments(
					[
						'style'      => 'ol',
						'short_ping' => true,
						'callback'   => 'aurora_comment_callback',
					]
				);
			?>
		</ol><!-- .comment-list -->

		<?php
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { // Are there comments to navigate through.
		?>
			<nav id="comment-nav" class="comment-navigation" aria-label="<?php esc_html_e( 'Comment Navigation Below', 'aurora-wp' ); ?>">
				<span class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'aurora-wp' ); ?></span>
				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Previous', 'aurora-wp' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Next &rarr;', 'aurora-wp' ) ); ?></div>
			</nav><!-- #comment-nav -->
			<?php
		} // Check for comment navigation.

		if ( ! comments_open() && 0 !== intval( get_comments_number() ) && post_type_supports( get_post_type(), 'comments' ) ) {
			?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'aurora-wp' ); ?></p>
			<?php
		}
	}
}

if ( ! function_exists( 'aurora_render_comment_form' ) ) {
	/**
	 * Display Comment Form.
	 *
	 * @since 1.0.0
	 */
	function aurora_render_comment_form() {

		// Getting parametes for Comment Form.
		$commenter 		= wp_get_current_commenter();
		$req 			= get_option( 'require_name_email' );
		$aria_req 		= ( $req ? " aria-required='true'" : '' );
		$html5     		= current_theme_supports( 'html5', 'comment-form' ) ? 1 : 0;
		$consent  		= empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';

		// Comment Form fields.
		$author 		= '<div class="row">' .
						'<div class="col-12 col-sm-12 col-md-4">' .
						'<div class="comment-form-author">' .
						'<fieldset>' .
						'<input id="author" name="author" type="text" placeholder="' . esc_html__( 'Name', 'aurora-wp' ) . ( $req ? ' *' : '' ) . '" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' />' .
						'</fieldset>' .
						'</div>' .
						'</div>';

		$email			= '<div class="col-12 col-sm-12 col-md-4">' .
						'<div class="comment-form-email">' .
						'<fieldset>' .
						'<input id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" placeholder="' . esc_html__( 'Email', 'aurora-wp' ) . ( $req ? ' *' : '' ) . '" ' . $aria_req . ' />' .
						'</fieldset>' .
						'</div>' .
						'</div>';

		$url			= '<div class="col-12 col-sm-12 col-md-4">' .
						'<div class="comment-form-url">' .
						'<fieldset>' .
						'<input id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" placeholder="' . esc_html__( 'Website', 'aurora-wp' ) . '" size="30" />' .
						'</fieldset>' .
						'</div>' .
						'</div>';

		$cookies		= '<div class="col-12 col-sm-12 col-md-12">' .
						'<div class="comment-form-cookies-consent">' .
						'<fieldset>' .
						'<input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $consent . ' /> ' .
						'<label class="form-check-label" for="wp-comment-cookies-consent">' . esc_html__( 'Save my name, email, and website in this browser for the next time I comment', 'aurora-wp' ) . '</label>' .
						'</fieldset>' .
						'</div>' .
						'</div>' .
						'</div>';

		$comment_field 	= '<div class="comment-form-comment">' .
						'<fieldset>' .
						'<textarea id="comment" placeholder="' . esc_html_x( 'Comment', 'noun', 'aurora-wp' ) . ( $req ? ' *' : '' ) . '" name="comment" cols="45" rows="8" aria-required="true"></textarea>' .
						'</fieldset>' .
						'</div>';

		// Building Comment Form args.
		$args = apply_filters(
			'aurora_comment_form_args',
			[
				'fields' => apply_filters(
					'aurora_comment_form_fields',
					[
						'author' 				=> $author,
						'email' 				=> $email,
						'url' 					=> $url,
						'cookies' 				=> $cookies,
					]
				),
				'comment_notes_before' 			=> '',
				'comment_notes_after'  			=> '',
				'title_reply' 					=> esc_html__( 'Got Something To Say?', 'aurora-wp' ),
				'title_reply_to' 				=> esc_html__( 'Got Something To Say?', 'aurora-wp' ),
				'cancel_reply_link' 			=> esc_html__( 'Cancel Comment', 'aurora-wp' ),
				'comment_field' 				=> $comment_field,
				'label_submit' 					=> esc_html__( 'Submit Comment', 'aurora-wp' ),
				'id_submit' 					=> 'submit_comment',
				'class_submit' 					=> 'default-btn',
			]
		);

		// The Comment Form.
		comment_form( $args );
	}
}

if ( ! function_exists( 'aurora_comment_area_wrapper_close' ) ) {
	/**
	 * Closing wrapper for Comments Area.
	 *
	 * @since 1.0.0
	 */
	function aurora_comment_area_wrapper_close() {
        echo '</section><!-- #comments -->';
	}
}
