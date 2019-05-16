/**
 * File post-format.js.
 *
 * Corresponding Post Format metabox fields display.
 *
 * Contains logics to show/hide metabox fields.
 */

jQuery( document ).ready(function( $ ) {
	"use strict";

	var metaBoxes = [
		'#codexin-gallery-meta',
		'#codexin-video-meta',
		'#codexin-audio-meta',
		'#codexin-quote-meta',
		'#codexin-link-meta',
	];

	var ids = metaBoxes.join( ', ' );

	// Default Hide.
	$( ids ).hide();

	$( window ).on( 'load', function() {
		jQuery( document ).on( 'change', '#post-formats-select input:radio[name=post_format]:checked, select[id*="post-format"]', function() {
			var cxInputSelected = this.value;

			// Hide during changing.
			$( ids ).hide();
			if ( this.value === cxInputSelected ) {
				$( '#codexin-' + cxInputSelected + '-meta' ).show();
			}
		});

		var cxInputSelected = $( '#post-formats-select input:radio[name=post_format]:checked, select[id*="post-format"]' ).val();

		// Show Default checked.
		$( '#codexin-' + cxInputSelected + '-meta' ).show();
	});
});
