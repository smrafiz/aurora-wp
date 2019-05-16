/**
 * Initialize Superfish with custom arguments.
 */

(function ($) {
    'use strict';

	$('.sf-menu').superfish({
		delay:          0,
		animation:      { opacity: 'show' },
		animationOut:   { opacity: 'hide' },
		speed:          'fast',
		autoArrows:     false,
		disableHI:      true
	});
})(jQuery);
