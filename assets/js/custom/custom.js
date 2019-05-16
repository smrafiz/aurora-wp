/******************************
 Main Theme JS File

 INDEX:

	s00 - Predefined Variables
	s01 - Main Navigation Menu
	s02 - Mobile Navigation Menu
	s03 - Image Background Settings
	s04 - Primary Slider Settings
	s05 - Elements Spacing & Classes
	s06 - Elements Carousel
	s07 - Tooltips
	s08 - Testimonial Carousel
	s09 - Scroll to Top JS
	s10 - Interactive Behaviour


******************************/

(function($) {
	'use strict';

	// Declaring main variable.
	var CODEXIN = {};

	/************************************************************
		s00 - Predefined Variables
	*************************************************************/

	var $window = $(window),
		$document = $(document),
		$wholeWrapper = $('#whole'),
		$searchModule = $('.search-module'),
		$sideAreaModule = $('.side-area-module'),
		$searchModuleInput = $('.search-module input[type="search"]'),
		$mainMenu = $('.sf-menu'),
		$menuSearchTrigger = $('.header-search'),
		$sideAreaTrigger = $('.side-area-trigger'),
		$headerfl = $('.floating-header'),
		$elCarousel = $('.element-carousel'),
		$testimonial = $('.testimonial-container'),
		$toTop = $('#to-top'),
		$pageloader = $('.animsition'),
		$intelHeader = $('.intelligent-header'),
		$fixedMenuSpace = $('.fixed-header-space'),
		$footer = $('#colophon'),
		$headerSearch = $('.header-search'),
		$body = $('body');

	// Check if element exists.
	$.fn.elExists = function() {
		return this.length > 0;
	};

	// var $animation_elements = $('.powerpro-title span');

	// function check_if_in_view() {
	// 	var window_height = $window.height();
	// 	var window_top_position = $window.scrollTop();
	// 	var window_bottom_position = (window_top_position + window_height);

	// 	$.each($animation_elements, function() {
	// 		var $element = $(this);
	// 		var element_height = $element.outerHeight();
	// 		var element_top_position = $element.offset().top + 80;
	// 		var element_bottom_position = (element_top_position + element_height);

	// 		if ((element_bottom_position >= window_top_position) &&
	// 		(element_top_position <= window_bottom_position)) {
	// 		$element.addClass('visible');
	// 		} else {
	// 		$element.removeClass('visible');
	// 		}
	// 	});
	// }

	/************************************************************
		s01 - Main Navigation Menu
	*************************************************************/

	CODEXIN.mainNav = function() {
		$mainMenu.superfish({
			delay: 0,
			animation: { opacity: 'show' },
			animationOut: { opacity: 'hide' },
			speed: 'fast',
			autoArrows: false,
			disableHI: true
		});

		$mainMenu.on('hover', '.sub-menu', function() {
			var menu = $(this);
			var child_menu = $(this).find('ul');
			if ($(menu).offset().left + $(menu).width() + $(child_menu).width() > $window.width()) {
				$(child_menu).css({ left: 'inherit', right: '100%' });
			}
		});
	};

	/************************************************************
		s02 - Mobile Navigation Menu
	*************************************************************/

	CODEXIN.mobileNav = function() {
		var slideLeft = new Menu({
			wrapper: '#o-wrapper',
			type: 'slide-left',
			menuOpenerClass: '.c-button',
			maskId: '#c-mask'
		});

		var slideLeftBtn = document.querySelector('#c-button--slide-left');

		slideLeftBtn.addEventListener('click', function(e) {
			e.preventDefault;
			slideLeft.open();
		});
	};

	// Mobile menu sub-menu actions
	CODEXIN.responsiveSubMenu = function() {
		var nav = $('#mobile-menu');
		// adds toggle button to li items that have children
		nav.find('li a').each(function() {
			if ($(this).next().length > 0) {
				$(this)
					.parent('li')
					.addClass('has-child')
					.append('<a class="drawer-toggle" href="#"><i class="fa fa-angle-down"></i></a>');
			}
		});

		// expands the dropdown menu on each click
		nav.find('li .drawer-toggle').on('click', function(e) {
			e.preventDefault();
			$(this).parent('li').children('ul').stop(true, true).slideToggle(250);
			$(this).parent('li').toggleClass('open');
		});
	};

	/************************************************************
		s03 - Image Background Settings
	*************************************************************/

	CODEXIN.imageBgSettings = function() {
		$('.bg-img-wrapper').each(function() {
			var $this = $(this);
			var img = $this.find('img.visually-hidden').attr('src');

			$this.find('.image-placeholder').css({
				backgroundImage: 'url(' + img + ')',
				backgroundSize: 'cover',
				backgroundPosition: 'center center'
			});
		});
	};

	/************************************************************
		s04 - Primary Slider Settings
	*************************************************************/

	/************************************************************
		s04 - Temp, will be shifted later
	*************************************************************/

	CODEXIN.searchIconChange = function(status = 'search') {
		if (status === 'search') {
			$('.mobile-search-icon a i').removeClass('fa fa-search', '500');
			$('.mobile-search-icon a i').addClass('fa fa-close', '500');
		} else {
			$('.mobile-search-icon a i').removeClass('fa fa-close', '500');
			$('.mobile-search-icon a i').addClass('fa fa-search', '500');
		}
	};

	CODEXIN.searchComponentTrigger = function() {
		if (false === $headerSearch.elExists()) {
			return;
		}
		if ($window.width() < 576) {
			$headerSearch.hide();
			CODEXIN.searchIconChange('close');
			var searchTerm = $headerSearch.find('input[type="search"]').val();
			if (searchTerm.length > 0) {
				$headerSearch.slideDown();
				CODEXIN.searchIconChange('search');
			}
		}

		$document.on('click', '.mobile-search-icon a', function(e) {
			e.preventDefault();
			$headerSearch.stop().slideToggle(function() {
				var finalState = $(this).is(':hidden') ? 'close' : 'search';
				CODEXIN.searchIconChange(finalState);
			});
		});
	};

	CODEXIN.searchComponentTriggerOnResize = function() {
		if (false === $headerSearch.elExists()) {
			return;
		}
		if ($window.width() < 576) {
			var searchTerm = $headerSearch.find('input[type="search"]').val();
			$headerSearch.hide();
			CODEXIN.searchIconChange('close');
			if (searchTerm.length > 0) {
				$headerSearch.slideDown();
				CODEXIN.searchIconChange('search');
			}

			return;
		}

		$headerSearch.show();
		CODEXIN.searchIconChange('search');
	};

	CODEXIN.headerSearchComponent = function() {
		if ($menuSearchTrigger.elExists()) {
			$menuSearchTrigger.on('click', function() {
				$wholeWrapper.addClass('header-search-active');
				$searchModule.addClass('search-module-open');
				setTimeout(function() {
					$('.search-module-close').addClass('active');
				}, 800);
				$searchModuleInput.focus();
			});

			$('.search-module-close').on('click', function() {
				$wholeWrapper.removeClass('header-search-active');
				$searchModule.removeClass('search-module-open');
				$(this).removeClass('active');
				$searchModuleInput.blur();
			});
		}
	};

	CODEXIN.sideAreaComponent = function() {
		if ($sideAreaTrigger.elExists()) {
			function fix_scroll() {
				var scrollTop = $window.scrollTop();
				$intelHeader.css('position', 'absolute');
				$intelHeader.css('top', scrollTop + 'px');
			}

			function remove_fix_scroll() {
				$intelHeader.removeAttr('style');
			}

			$sideAreaTrigger.on('click', function() {
				$wholeWrapper.toggleClass('side-area-active');
				$sideAreaModule.toggleClass('side-area-open');
				setTimeout(function() {
					$('.side-area-close').addClass('active');
				}, 800);

				// fix_scroll();
				// $window.on( 'scroll', fix_scroll );
			});

			$('.side-area-close').on('click', function() {
				$wholeWrapper.removeClass('side-area-active');
				$sideAreaModule.removeClass('side-area-open');
				$(this).removeClass('active');

				// remove_fix_scroll();
				// $window.on( 'scroll', remove_fix_scroll );
			});

			// Closing the side-area by clicking in the menu button or anywhere in the screen
			$body.on('click', function(e) {
				var target = e.target;
				if (!$(target).is($sideAreaTrigger) && !$(target).parents().is($sideAreaTrigger)) {
					$wholeWrapper.removeClass('side-area-active');
					$sideAreaModule.removeClass('side-area-open');
					$('.side-area-close').removeClass('active');
				}

				// remove_fix_scroll();
				// $window.on( 'scroll', remove_fix_scroll );
			});

			// Prevent closing side-area upon clicking inside the side-area
			$sideAreaModule.on('click', function(e) {
				e.stopPropagation();
			});
		}
	};

	CODEXIN.headerPlaceholder = function() {
		var intHeight = $intelHeader[0].getBoundingClientRect().height;
		$fixedMenuSpace.height(intHeight);
	};

	CODEXIN.headerAutoHide = function() {
		$intelHeader.headroom({
			// vertical offset in px before element is first unpinned
			offset: 0,
			// scroll tolerance in px before state changes
			tolerance: 0,
			// or you can specify tolerance individually for up/down scroll
			tolerance: {
				up: 5,
				down: 0
			},
			// css classes to apply
			classes: {
				// when element is initialised
				initial: 'animated',
				// when scrolling up
				pinned: 'slide-down',
				// when scrolling down
				unpinned: 'slide-up',
				// when above offset
				top: 'is-top',
				// when below offset
				notTop: 'is-not-top',
				// when at bottom of scoll area
				bottom: 'is-bottom',
				// when not at bottom of scroll area
				notBottom: 'is-not-bottom'
			}
		});

		$window.on('scroll', function() {
			var height = $window.scrollTop();

			if (height < 200) {
				$intelHeader.removeClass('is-scrolling');
			} else {
				$intelHeader.addClass('is-scrolling');
			}
		});
	};

	/************************************************************
        s01 - Preloader
    *************************************************************/

	CODEXIN.preloader = function() {
		if ($pageloader.elExists()) {
			$pageloader.animsition({
				inClass: 'zoom-in-sm',
				outClass: 'zoom-out-sm',
				inDuration: 500,
				outDuration: 500,
				linkElement:
					'a:not([target="_blank"]):not([href^="#"]):not([href^="mailto:"]):not([href^="tel:"]):not(.img):not(.comment-reply-link):not(#cancel-comment-reply-link)',
				loading: true,
				loadingParentElement: 'body',
				loadingClass: 'cx-pageloader',
				loadingInner: '<div class="cx-loader-inner"></div>',
				timeout: false,
				timeoutCountdown: 5000,
				onLoadEvent: true,
				browser: [ 'animation-duration', '-webkit-animation-duration' ],
				overlay: false,
				overlayClass: 'animsition-overlay-slide',
				overlayParentElement: 'body',
				transition: function(url) {
					window.location.href = url;
				}
			});
		}
	};
	/************************************************************
		s05 - Elements Spacing & Classes
	*************************************************************/

	CODEXIN.ElementsSpacingClasses = function() {
		$('.sidebar-widget p:empty').remove();
		$('.tagcloud').find('a').removeAttr('style');

		// Fluid Wrapper for iframe.
		// $( '#whole' ).find( '.cx-fluid-wrapper' ).removeClass( 'cx-fluid-wrapper' );
		// $( '#whole' ).find( 'iframe' ).parent().addClass( 'cx-fluid-wrapper' );
		$('.rwmb-oembed-not-available').closest('.cx-fluid-wrapper').remove();

		$mainMenu
			.on('mouseenter', function() {
				$intelHeader.parent().addClass('hovered-on-menu');
			})
			.on('mouseleave', function() {
				$intelHeader.parent().removeClass('hovered-on-menu');
			});
	};

	/************************************************************
		s06 - Elements Carousel
	*************************************************************/

	CODEXIN.elementsCarousel = function() {
		var visibleSlides = null;
		var visibleSlides_xl = null;
		var visibleSlides_lg = null;
		var visibleSlides_md = null;
		var visibleSlides_sm = null;
		var visibleSlides_xs = null;
		var slideLoop = null;
		var slideSpeed = null;
		var slideSpace = null;
		var slideAutoPlayDelay = null;
		var slideEffect = null;

		if ($elCarousel.elExists()) {
			var swiperInstances = [];

			$elCarousel.each(function(index, element) {
				var $this = $(this);

				// Fetching from data attributes.
				var visibleSlides = $this.attr('data-visible-slide') ? parseInt($this.attr('data-visible-slide')) : 5;
				var visibleSlides_xl = $this.attr('data-visible-xl-slide')
					? parseInt($this.attr('data-visible-xl-slide'))
					: 5;
				var visibleSlides_lg = $this.attr('data-visible-lg-slide')
					? parseInt($this.attr('data-visible-lg-slide'))
					: 4;
				var visibleSlides_md = $this.attr('data-visible-md-slide')
					? parseInt($this.attr('data-visible-md-slide'))
					: 3;
				var visibleSlides_sm = $this.attr('data-visible-sm-slide')
					? parseInt($this.attr('data-visible-sm-slide'))
					: 2;
				var visibleSlides_xs = $this.attr('data-visible-xs-slide')
					? parseInt($this.attr('data-visible-xs-slide'))
					: 1;
				var slideSpeed = $this.attr('data-speed') ? parseInt($this.attr('data-speed')) : 1000;
				var slideLoop = $this.attr('data-loop') === 'true' ? 1 : 0;
				var slideSpace = $this.attr('data-space-between') ? parseInt($this.attr('data-space-between')) : 30;
				var slideAutoPlayDelay = $this.attr('data-autoplay-delay')
					? parseInt($this.attr('data-autoplay-delay'))
					: 100000000;
				var slideEffect = $this.attr('data-effect') ? $this.attr('data-effect') : 'slide';

				// Adding slider and slider-nav instances to use multiple times in a page.
				$this.addClass('instance-' + index);
				$this.parent().find('.prev').addClass('prev-' + index);
				$this.parent().find('.next').addClass('next-' + index);

				swiperInstances[index] = new Swiper('.instance-' + index, {
					slidesPerView: visibleSlides,
					spaceBetween: slideSpace,
					speed: slideSpeed,
					loop: slideLoop,
					effect: slideEffect,
					observer: true,
					observeParents: true,
					watchSlidesProgress: true,
					watchSlidesVisibility: true,
					loopAdditionalSlides: 10,
					autoplay: {
						delay: slideAutoPlayDelay
					},

					navigation: {
						nextEl: '.swiper-arrow.next',
						prevEl: '.swiper-arrow.prev'
					},

					pagination: {
						el: '.pagination-' + index,
						type: 'bullets',
						clickable: true
					},

					// Responsive breakpoints.
					breakpoints: {
						1400: {
							slidesPerView: visibleSlides_xl,
							autoplay: {
								delay: slideAutoPlayDelay
							}
						},
						1199: {
							slidesPerView: visibleSlides_lg,
							autoplay: {
								delay: slideAutoPlayDelay
							}
						},
						991: {
							slidesPerView: visibleSlides_md,
							autoplay: {
								delay: slideAutoPlayDelay
							}
						},
						767: {
							slidesPerView: visibleSlides_sm,
							autoplay: {
								delay: slideAutoPlayDelay
							}
						},
						479: {
							slidesPerView: visibleSlides_xs,
							autoplay: {
								delay: 5000
							}
						}
					},

					on: {
						slideChange: function() {
							$('.swiper-slide.swiper-slide-visible').removeClass('visible-not-last');
							$('.swiper-slide.swiper-slide-visible').prev().addClass('visible-not-last');
						}
					}
				});
			});

			// Updating the sliders.
			setTimeout(function() {
				swiperInstances.forEach(function(slider) {
					slider.update();
				});
			}, 50);

			// Updating the sliders in tab.
			$('body').on('shown.bs.tab', 'a[data-toggle="tab"], a[data-toggle="pill"]', function(e) {
				swiperInstances.forEach(function(slider) {
					slider.update();
				});
			});
		} // End if().
	};

	/************************************************************
		s07 - Tooltips
	*************************************************************/

	CODEXIN.toolTips = function() {
		$('body').tooltip({ selector: '[data-toggle="tooltip"]' });
	};

	/************************************************************
		s08 - Testimonial Carousel
	*************************************************************/

	CODEXIN.testimonialCarousel = function() {
		if ($testimonial.elExists()) {
			var testimonial = new Swiper($testimonial, {
				loop: true,
				spaceBetween: 0,
				parallax: true,
				speed: 1000,
				autoplay: {
					delay: 6000
				},

				pagination: {
					el: '.swiper-pagination-testimonial',
					clickable: true
				},

				navigation: {
					nextEl: '.swiper-arrow.next.testimonial-slide',
					prevEl: '.swiper-arrow.prev.testimonial-slide'
				}
			});
		}
	};

	/************************************************************
		s09 - Scroll to Top JS
	*************************************************************/

	CODEXIN.scrollToTop = function() {
		$toTop.hide();
		$window.on('scroll', function() {
			if ($window.scrollTop() > 300) {
				$toTop.fadeIn();
			} else {
				$toTop.fadeOut();
			}
		});

		$toTop.on('click', function() {
			$('html,body').animate(
				{
					scrollTop: 0
				},
				1500,
				'easeInOutExpo'
			);
		});
	};

	/************************************************************
		s10 - Interactive Behaviour
	*************************************************************/

	CODEXIN.interactiveBehaviour = function() {};

	/************************************************************
		s11 - Sticky nav
	*************************************************************/

	CODEXIN.stickyNavTrigger = function() {
		var topSpacing = 0;
		if ($body.hasClass('admin-bar')) {
			topSpacing = 32;
		}

		$('.navigation-wrapper').sticky({ topSpacing: topSpacing });
	};

	// Window load functions.
	$window.on('load', function() {
		CODEXIN.interactiveBehaviour();
		CODEXIN.imageBgSettings();
	});

	// Document ready functions.
	$document.on('ready', function() {
		CODEXIN.mainNav(),
			CODEXIN.headerSearchComponent(),
			CODEXIN.mobileNav(),
			CODEXIN.responsiveSubMenu(),
			CODEXIN.elementsCarousel(),
			CODEXIN.testimonialCarousel(),
			CODEXIN.scrollToTop(),
			CODEXIN.headerAutoHide(),
			CODEXIN.toolTips(),
			CODEXIN.preloader(),
			CODEXIN.ElementsSpacingClasses(),
			CODEXIN.searchComponentTrigger(),
			CODEXIN.sideAreaComponent(),
			CODEXIN.headerPlaceholder();
		// CODEXIN.stickyNavTrigger();
	});

	// Window load and resize functions.
	$window.on('load resize', function() {
		// CODEXIN.ElementsSpacingClasses();
		// CODEXIN.headerPlaceholder();
	});
	$window.on('resize', function() {
		// CODEXIN.ElementsSpacingClasses();
		// CODEXIN.searchComponentTriggerOnResize();
	});

	// $window.on( 'scroll resize', function() {
	// 	check_if_in_view();
	// });
})(jQuery);
