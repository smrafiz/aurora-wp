/**
 * File customize-preview.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */
"use strict";
(function ($) {
	// Header text.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '#header-text, .site-description' ).css({
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute'
				});
				// Add class for different logo styles if title and description are hidden.
				$( 'body' ).addClass( 'title-tagline-hidden' );
			} else {
				$( '#header-text, .site-description' ).css({
					clip: 'auto',
					position: 'relative'
				});
				$( '#header-text, .site-description' ).css({
					color: to
				});
				// Add class for different logo styles if title and description are visible.
				$( 'body' ).removeClass( 'title-tagline-hidden' );
			}
		});
	});

	// Header Search.
	wp.customize( 'cx_enable_header_search', function ( value ) {
		value.bind( function ( to ) {
			if ( to ) {
				$( 'header .header-search' ).show();
			} else {
				$( 'header .header-search' ).hide();
			}
		});
	});

	// Header Socials.
	wp.customize( 'cx_enable_header_socials', function ( value ) {
		value.bind( function ( to ) {
			if ( to ) {
				$( 'header .header-social' ).show();
			} else {
				$( 'header .header-social' ).hide();
			}
		});
	});

	// Header Phone.
	wp.customize( 'cx_enable_header_phone', function ( value ) {
		value.bind( function ( to ) {
			if ( to ) {
				$( 'header .header-right>a:first-child' ).show();
			} else {
				$( 'header .header-right>a:first-child' ).hide();
			}
		});
	});

	// Header Phone Text.
	wp.customize( 'cx_header_phone_number', function ( value ) {
		value.bind( function ( to ) {
			$( 'header .header-right>a:first-child' ).html( to );
		});
	});

	// Header Button Text.
	wp.customize( 'cx_header_button', function ( value ) {
		value.bind( function ( to ) {
			$( 'header .header-right>a:last-child' ).html( to );
		});
	});

	// Header Sticky Logo.
	wp.customize( 'sticky_logo_setting', function ( value ) {
		value.bind( function ( to ) {
			if ( to !== '' ) {
				$( 'header .sticky-logo img' ).show();
				$( 'header .sticky-logo img' ).attr( 'src', to );
			} else {
				$( 'header .sticky-logo img' ).hide();
			}
		});
	});

	// Blog Title Text.
	wp.customize( 'cx_blog_title', function ( value ) {
		value.bind( function ( to ) {
			$( '.home.blog .page-title h1' ).html( to );
		});
	});

	// Blog more button.
	wp.customize( 'cx_enable_readmore', function ( value ) {
		value.bind( function ( to ) {
			if ( to ) {
				$( 'body:not(.single) .entry-footer' ).show();
			} else {
				$( 'body:not(.single) .entry-footer' ).hide();
			}
		});
	});

	// Social shares.
	wp.customize( 'cx_enable_share_link', function ( value ) {
		value.bind( function ( to ) {
			if ( to ) {
				$( '.single .entry-footer .share' ).show();
			} else {
				$( '.single .entry-footer .share' ).hide();
			}
		});
	});

	// Single Post Nav.
	wp.customize( 'cx_enable_post_nav', function ( value ) {
		value.bind( function ( to ) {
			if ( to ) {
				$( '.single .posts-nav' ).show();
			} else {
				$( '.single .posts-nav' ).hide();
			}
		});
	});

	// Widgetized Footer.
	wp.customize( 'cx_enable_footer_widget', function ( value ) {
		value.bind( function ( to ) {
			if ( to ) {
				$( '#colophon .footer-widgets-area' ).show();
			} else {
				$( '#colophon .footer-widgets-area' ).hide();
			}
		});
	});

	// Footer Copyright.
	wp.customize( 'cx_enable_copyright', function ( value ) {
		value.bind( function ( to ) {
			if ( to ) {
				$( '#colophon .footer-copyright' ).show();
			} else {
				$( '#colophon .footer-copyright' ).hide();
			}
		});
	});

	// Footer Copyright Text.
	wp.customize( 'footer_copy_text', function ( value ) {
		value.bind( function ( to ) {
			$( '#colophon .copyright-legal' ).html( to );
		});
	});
})(jQuery);
