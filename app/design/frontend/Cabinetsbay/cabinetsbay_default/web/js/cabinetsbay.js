// 2024-03-25 Dmitrii Fediuk https://upwork.com/fl/mage2pro
// "Refactor `app/design/frontend/Cabinetsbay/cabinetsbay_default/web/js/cabinetsbay.js`":
// https://github.com/cabinetsbay/site/issues/121
require([
	'jquery',
	'jquery/ui',
	'lightslider',
	'lightgallery',
	'autoplay',
	'fullscreen',
	'hash',
	'pager',
	'thumbnail',
	'video',
	'zoom'
	,'domReady!'
], function($) {
	$('#search').on('click', function () {
		$('.block-search').addClass('block-search-focused');
	});
	$('#backTop').on('click', function (event) {
		event.preventDefault();
		$('html, body').animate({
			scrollTop: $($.attr(this, 'href')).offset().top - 130
		}, 500);
	});
	$('.scrollTo').on('click', function (event) {
		event.preventDefault();
		$('html, body').animate({
			scrollTop: $($.attr(this, 'href')).offset().top - 30
		}, 500);
	});
	$('li._hasSubmenu').find('.link-wrapper').on('click', function (event) {
		event.preventDefault();
		let el = $(this).parents('._hasSubmenu');
		if (el.hasClass('active')) {
			el.removeClass('active').addClass('_closed');
		}
		else {
			el.removeClass('_closed').addClass('active');
		}
	});
	$('.mobile-navigation-opener').on('click', function (event) {
		event.preventDefault();
		let el = $(this).closest('#mobile-navigation');
		if (el.hasClass('active')) {
			el.removeClass('active').addClass('_closed');
		}
		else {
			el.removeClass('_closed').addClass('active');
		}
	});
	$('.customlinks > div > p').on('click', function (event) {
		event.preventDefault();
		let el = $(this).closest('div');
		if (el.hasClass('active')) {
			el.removeClass('active').addClass('_closed');
		}
		else {
			el.removeClass('_closed').addClass('active');
		}
	});
	$('.category-tab > label').on('click', function (event) {
		event.preventDefault();
		let el = $(this).parent('div');
		if (el.hasClass('active')) {
			el.removeClass('active').addClass('_closed');
		}
		else {
			el.removeClass('_closed').addClass('active');
		}
	});
	if (typeof $.ui.tabs != 'undefined' && $('#categoryTabs').length > 0) {
		if ($(window).width() > 680) {
			$.ui.tabs({active: 0}, "#categoryTabs");
		}
		else {
			$('#overview.category-tab').addClass('active');
		}
	}
	if ($('#category-gallery').length > 0) {
		$('#category-gallery').lightSlider({
			adaptiveHeight: true,
			auto: false,
			autoWidth: false,
			enableDrag: false,
			gallery: true,
			galleryMargin: 0,
			item: 1,
			loop: true,
			slideMargin: 0,
			speed: 700,
			thumbItem: 3,
			onSliderLoad: function (el) {
				$('#category-gallery').removeClass('cS-hidden');
				el.lightGallery({download: false, selector: '#category-gallery .lslide'});
			}
		});
	}
	let $sortWrapper = $('#products_list');
	let $sortPriceToggler = $('#dropdown-price');
	$sortPriceToggler.find('.dropdown li').on('click', function (el) {
		$sortPriceToggler.find('span.toggle > span').text('Price (' + el.target.innerHTML + ')');
		setTimeout(function () {
			$('.category-filter-dropdown').removeClass('active');
		}, 500);
		if(el.target.dataset.sortby == 'asc') {
			$sortWrapper.find('li').sort(function(a, b) {
				return +a.dataset.sorterprice - +b.dataset.sorterprice;
			}).appendTo($sortWrapper);
		}
		else {
			$sortWrapper.find('li').sort(function(a, b) {
				return +b.dataset.sorterprice - +a.dataset.sorterprice;
			}).appendTo($sortWrapper);
		}
	});
	let $sortColorToggler = $('#dropdown-color');
	$sortColorToggler.find('.dropdown li').on('click', function (el) {
	$sortColorToggler.find('span.toggle > span').text('Color (' + el.target.innerHTML + ')');
	setTimeout(function () {
		$('.category-filter-dropdown').removeClass('active');
	}, 500);
	if(el.target.dataset.sortby == 'darker') {
		$sortWrapper.find('li').sort(function(a, b) {
			return +b.dataset.sortercolor - +a.dataset.sortercolor;
		}).appendTo($sortWrapper);
	}
	else {
		$sortWrapper.find('li').sort(function(a, b) {
			return +a.dataset.sortercolor - +b.dataset.sortercolor;
		}).appendTo($sortWrapper);
	}
	});

	$sortColorToggler.find('ul > li:first').click();

	let $sortStyleToggler = $('#dropdown-style');
	$sortStyleToggler.find('.dropdown li').on('click', function (el) {
	$sortStyleToggler.find('span.toggle > span').text('Style (' + el.target.innerHTML + ')');
	setTimeout(function () {
	$('.category-filter-dropdown').removeClass('active');
	}, 500);
	if(el.target.innerHTML == 'All') {
	$sortWrapper.find('li').show();
	} else {
	$sortWrapper.find('li').hide();
	$sortWrapper.find('li[data-sorterstyle="'+el.target.innerHTML+'"]').show();
	}
	});

	let $sortConstructionToggler = $('#dropdown-construction');
	$sortConstructionToggler.find('.dropdown li').on('click', function (el) {
	$sortConstructionToggler.find('span.toggle > span').text('Cabinet Construction (' + el.target.innerHTML + ')');
	setTimeout(function () {
	$('.category-filter-dropdown').removeClass('active');
	}, 500);
	if(el.target.innerHTML == 'All') {
	$sortWrapper.find('li').show();
	} else {
	$sortWrapper.find('li').hide();
	$sortWrapper.find('li[data-sorterconstruction="'+el.target.innerHTML+'"]').show();
	}
	});

	if(screen.width < 680 && $('.products.wrapper.list').hasClass('products-list')) {
	$('.products.wrapper.list').removeClass('products-list').addClass('products-grid');
	}
	$(document).scroll(function () {
		const y = $(this).scrollTop();
		$('.page-header').toggleClass('sticky', y > 30);
		// 2024-03-25 Dmitrii Fediuk https://upwork.com/fl/mage2pro
		// 1) "How to apply a jQuery function conditionally?": https://df.tips/t/2174
		// 2) https://jsfiddle.net/dfediuk/c6epnqor
		$.fn[y > 800 ? 'fadeIn' : 'fadeOut'].apply($('#backTop'));
	});
	$('#newsletter-validate-detail').on('submit', function() {
		if ($(this).valid()) {
			gtag('event', 'sent', {'event_category': 'subscription'});
		}
	});
	$('#amform-form-6').on('submit', function() {
		if ($(this).valid()) {
			gtag('event', 'sent', {'event_category': 'free_design'});
		}
	});
	$('#amform-form-7').on('submit', function() {
		if ($(this).valid()) {
			gtag('event', 'sent', {'event_category': 'get_quote'});
		}
	});
});
