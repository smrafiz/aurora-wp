<?php
/**
 * Helpers functions
 * List of all helper functions used globally on the theme.
 *
 * @package 	AuroraWPThemes
 * @since 		1.0
 */

if ( ! function_exists( 'aurora_has_woocommerce' ) ) {
	/**
	 * Query WooCommerce activation.
	 */
	function aurora_has_woocommerce() {
		return class_exists( 'WooCommerce' ) ? true : false;
	}
}

if ( ! function_exists( 'aurora_inside_woocommerce' ) ) {
	/**
	 * Query if inside Woocommerce Page.
	 */
	function aurora_inside_woocommerce() {
		if ( function_exists( 'is_woocommerce' ) ) {
			return (bool) is_woocommerce();
		}
		return false;
	}
}

if ( ! function_exists( 'aurora_inside_tribe_event' ) ) {
	/**
	 * Check if we're on an Event page.
	 *
	 * @param int|false $id The page ID.
	 * @return bool
	 */
	function aurora_inside_tribe_event( $id = false ) {

		if ( function_exists( 'tribe_is_event' ) ) {
			if ( false === $id ) {
				return (bool) tribe_is_event();
			} else {
				return (bool) tribe_is_event( $id );
			}
		}
		return false;

	}
}

if ( ! function_exists( 'aurora_page_class' ) ) {
	/**
	 * Main wrapper classes for the theme.
	 */
	function aurora_page_class() {
        $classes = ['site'];

        // array_push( $classes, 'animsition' );

        echo esc_attr( implode( ' ', $classes ) );
	}
}

if ( ! function_exists( 'aurora_header_class' ) ) {
	/**
	 * Header classes for the theme.
	 */
	function aurora_header_class() {
        $header_classes = ['site-header'];

        echo esc_attr( implode( ' ', $header_classes ) );
	}
}

if ( ! function_exists( 'aurora_get_page_title' ) ) {
	/**
	 * Retrives the page title.
	 */
	function aurora_get_page_title() {
		if( is_front_page() && is_home() ) {
			return;
		}

		$title = '';

		if ( is_home() ) {
			$title = esc_html__( 'Blog', 'aurora-wp' );
		} elseif ( is_archive() ) {
			$title = get_the_archive_title();
		} elseif ( is_search() ) {
			$title = esc_html__( 'Search results for', 'aurora-wp' ) . ' "' . get_search_query() . '"';
		} elseif ( is_404() ) {
			$title = esc_html__( 'Page Not Found', 'aurora-wp' );
		} else {
			global $post;
			$title = get_the_title($post->ID);
		}

		return $title;
	}
}

if ( ! function_exists( 'aurora_posted_on' ) ) {
	/**
	 * Retrives Post time meta.
	 */
	function aurora_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time> <time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		return sprintf(
			'<li class="list-inline-item posted-on"><span class="screen-reader-text">%s</span> <a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a></li>',
			/* translators: %s: post date */
			esc_html_x( 'Posted on', 'post date', 'aurora-wp' )
		);
	}
}

if ( ! function_exists( 'aurora_comments_meta' ) ) {
	/**
	 * Retrives Post comments meta.
	 */
	function aurora_comments_meta() {

		$comments = '';

		if ( ! post_password_required() && ( comments_open() || 0 !== intval( get_comments_number() ) ) ) {
			$comments_number = get_comments_number_text( esc_html__( '0', 'aurora-wp' ), esc_html__( '1', 'aurora-wp' ), esc_html__( '%', 'aurora-wp' ) );

			$comments = sprintf(
				'<li class="list-inline-item posted-comments"><span class="screen-reader-text">%1$s</span> <a href="%2$s">%3$s</a></li>',
				esc_html__( 'Posted comments', 'aurora-wp' ),
				esc_url( get_comments_link() ),
				$comments_number
			);
		}

		return $comments;
	}
}

if ( ! function_exists( 'aurora_post_meta' ) ) {
	/**
	 * Display the post meta.
	 *
	 * @since 1.0.0
	 */
	function aurora_post_meta() {
		// Posted on.
		$posted_on = aurora_posted_on();

		// Avatar.
		$avatar = get_avatar(
			get_the_author_meta( 'ID' ),
			$size = '128',
			$default = '',
			$alt = sprintf( '%1$s %2$s', esc_html__( 'Avatar for', 'aurora-wp' ), get_the_author_meta('display_name') )
		);

		// Author.
		$author = sprintf(
			'<div class="post-author">
				<span class="byline">
					<span class="screen-reader-text">%1$s</span>
					<span class="author vcard">
						<a href="%2$s" class="url fn" rel="author">%3$s</a>
					</span>
				</span>
			</div>',
			esc_html__( 'By', 'aurora-wp' ),
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		);

		// Comments.
		$comments = aurora_comments_meta();

		// Categories.
		$categories = sprintf(
			'<li class="list-inline-item posted-in"><span class="screen-reader-text">%1$s</span>%2$s</li>',
			esc_html__( 'Posted in', 'aurora-wp' ),
			get_the_category_list()
		);

		// Building up the post metas.
		echo '<div class="entry-meta">';
			echo '<div class="media meta-container">';
				echo wp_kses(
					sprintf(
						'<div class="author-media">%1$s</div><div class="meta-details media-body">%2$s<ul class="list-inline">%3$s %4$s %5$s</ul></div>',
						$avatar,
						$author,
						$posted_on,
						$comments,
						$categories
					),
					[
						'div' 	=> [
							'class' 	=> [],
						],
						'img' 	=> [
							'class' 	=> [],
							'src' 		=> [],
							'alt' 		=> [],
						],
						'ul'  	=> [
							'class' 	=> [],
						],
						'li'  	=> [
							'class' 	=> [],
						],
						'span' 	=> [
							'class' 	=> [],
						],
						'a'    	=> [
							'href'  	=> [],
							'title' 	=> [],
							'rel'   	=> [],
						],
						'time' 	=> [
							'datetime' 	=> [],
							'class'    	=> [],
						],
					]
				);
			echo '</div>';
		echo '</div>';
	}
}

if ( ! function_exists( 'aurora_array_key_check' ) ) {
	/**
	 * Checks for array keys.
	 *
	 * @since 1.0.0
	 */
	function aurora_array_key_check( array $arr, $key ) {

	    // is in base array?
	    if ( array_key_exists( $key, $arr ) ) {
	        return true;
	    }

	    // check arrays contained in this array
	    foreach ( $arr as $element ) {
	        if ( is_array( $element ) ) {
	            if ( aurora_array_key_check( $element, $key ) ) {
	                return true;
	            }
	        }
	    }

	    return false;
	}
}
