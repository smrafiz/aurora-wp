/**
 * Welcome Admin Page script.
 */

(function($) {
	$(document).ready(function() {
		// Variables.
		var $tabNav = $('#aurora-content-tab .nav > .nav-tab'),
			$tabNavFirst = $('#aurora-content-tab .nav > .nav-tab:first'),
			$tabContent = $('#aurora-content-tab .tab-pane'),
			$tabContentFirst = $('#aurora-content-tab .tab-pane:first'),
			$button = $('#aurora-content-tab .button-primary');

		// Initially hide all content.
		$tabContent.hide();

		// Activate first tab.
		$tabContentFirst.show();
		$tabNavFirst.addClass('nav-tab-active');

		// Check for on click event.
		$tabNav.on('click', function(event) {
			event.preventDefault();

			$tabNav.removeClass('nav-tab-active');
			$(this).addClass('nav-tab-active');
			$tabContent.hide();

			// Detection for current tab.
			var selectTab = $(this).attr('href');
			$(selectTab).fadeIn();
		});

		$("#aurora-content-tab .tab-pane > div a[href^='#']").on('click', function(event) {
			event.preventDefault();
			var targetID = $(this).attr('href');
			$('#aurora-content-tab .nav > .nav-tab[href="' + targetID + '"').click();
			return false;
		});
	});
})(jQuery);
