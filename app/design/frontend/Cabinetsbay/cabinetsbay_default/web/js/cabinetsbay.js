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
	$('#search').on('click', () => $('.block-search').addClass('block-search-focused'));
	(() => {
		// 2024-03-25 Dmitrii Fediuk https://upwork.com/fl/mage2pro
		// https://jsfiddle.net/dfediuk/rb0e7q82
		const f = (n, offset) => $(n).on('click', e => {
			e.preventDefault();
			// 2024-03-25 Dmitrii Fediuk https://upwork.com/fl/mage2pro
			// 1) https://caniuse.com/mdn-api_element_getattribute
			// 2.1) `e.currentTarget.href` =>
			// 		«https://localhost.com:2255/pre-assembled-cabinets/moonlight-shaker.html#maincontent»
			// 2.2) `e.currentTarget.getAttribute('href')` => «#maincontent»
			// 2.3) https://stackoverflow.com/a/15439946/
			$('html, body').animate({scrollTop: $(e.currentTarget.getAttribute('href')).offset().top - offset}, 500);
		});
		f('#backTop', 130);
		f('.scrollTo', 30);
	})();
	(() => {
		const f = ($e, f) => $e.on('click', function(e) {
			e.preventDefault();
			const el = f($(this));
			const active = el.hasClass('active');
			el.toggleClass('active', !active);
			el.toggleClass('_closed', active);
		});
		f($('li._hasSubmenu').find('.link-wrapper'), $e => $e.parents('._hasSubmenu'));
		f($('.mobile-navigation-opener'), $e => $e.closest('#mobile-navigation'));
		f($('.customlinks > div > p'), $e => $e.closest('div'));
		f($('.category-tab > label'), $e => $e.parent('div'));
	})();
	if (typeof $.ui.tabs != 'undefined' && $('#categoryTabs').length) {
		if ($(window).width() > 680) {
			$.ui.tabs({active: 0}, "#categoryTabs");
		}
		else {
			$('#overview.category-tab').addClass('active');
		}
	}
	(() => {
		const $g = $('#category-gallery');
		!$g.length || $g.lightSlider({
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
			onSliderLoad: e => {
				$('#category-gallery').removeClass('cS-hidden');
				e.lightGallery({download: false, selector: '#category-gallery .lslide'});
			}
		});
	})();
	(() => {
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
			if (el.target.dataset.sortby == 'darker') {
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
			}
			else {
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
			}
			else {
				$sortWrapper.find('li').hide();
				$sortWrapper.find('li[data-sorterconstruction="'+el.target.innerHTML+'"]').show();
			}
		});
	})();
	if(screen.width < 680 && $('.products.wrapper.list').hasClass('products-list')) {
		$('.products.wrapper.list').removeClass('products-list').addClass('products-grid');
	}
	$(document).scroll(function() {
		const y = $(this).scrollTop();
		$('.page-header').toggleClass('sticky', y > 30);
		// 2024-03-25 Dmitrii Fediuk https://upwork.com/fl/mage2pro
		// 1) "How to apply a jQuery function conditionally?": https://df.tips/t/2174
		// 2) https://jsfiddle.net/dfediuk/c6epnqor
		$.fn[y > 800 ? 'fadeIn' : 'fadeOut'].apply($('#backTop'));
	});
	(() => {
		const f = (s, c) => $('#' + s).on('submit', e =>
			!$(e.currentTarget).valid() || gtag('event', 'sent', {'event_category': c})
		);
		f('newsletter-validate-detail', 'subscription');
		f('amform-form-6', 'free_design');
		f('amform-form-7', 'get_quote');
	})();
});