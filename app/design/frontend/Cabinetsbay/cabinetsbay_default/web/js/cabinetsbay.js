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
], function ($) {
  jQuery(document).ready(function () {
	jQuery('#search').on('click', function () {
	  jQuery('.block-search').addClass('block-search-focused');
	});

	jQuery('#backTop').on('click', function (event) {
	  event.preventDefault();
	  jQuery('html, body').animate({
		scrollTop: jQuery(jQuery.attr(this, 'href')).offset().top - 130
	  }, 500);
	});

	jQuery('.scrollTo').on('click', function (event) {
	  event.preventDefault();
	  jQuery('html, body').animate({
		scrollTop: jQuery(jQuery.attr(this, 'href')).offset().top - 30
	  }, 500);
	});

	jQuery('li._hasSubmenu').find('.link-wrapper').on('click', function (event) {
	  event.preventDefault();
	  let el = $(this).parents('._hasSubmenu');
	  if (el.hasClass('active')) {
		el.removeClass('active').addClass('_closed');
	  } else {
		el.removeClass('_closed').addClass('active');
	  }
	});

	jQuery('.mobile-navigation-opener').on('click', function (event) {
	  event.preventDefault();
	  let el = $(this).closest('#mobile-navigation');
	  if (el.hasClass('active')) {
		el.removeClass('active').addClass('_closed');
	  } else {
		el.removeClass('_closed').addClass('active');
	  }
	});

	jQuery('.customlinks > div > p').on('click', function (event) {
	  event.preventDefault();
	  let el = $(this).closest('div');
	  if (el.hasClass('active')) {
		el.removeClass('active').addClass('_closed');
	  } else {
		el.removeClass('_closed').addClass('active');
	  }
	});

	jQuery('.category-tab > label').on('click', function (event) {
	  event.preventDefault();
	  let el = $(this).parent('div');
	  if (el.hasClass('active')) {
		el.removeClass('active').addClass('_closed');
	  } else {
		el.removeClass('_closed').addClass('active');
	  }
	});

	//jQuery('.category-filter-dropdown').on('click', function (e) {
	  //e.preventDefault();
	  //alert('ssss');
	  //let $t = jQuery(e.currentTarget);
	  //console.log($t);
	  /*if ($t.find('ul.dropdown').length === 0) {
		if ($t.find('span.action.toggle').is('[data-category-url]')) {
		  window.location.href = $t.find('span.action.toggle').attr('data-category-url');
		}
	  } else {*/
		//if($t.hasClass('active')) {
		  //$t.removeClass('active');
		//} else {
		  //$t.addClass('active');
		//}
		/*
		if ($t.find('ul.dropdown').length > 0) {

		}*/
		/*if ((('ontouchstart' in window) || (navigator.msMaxTouchPoints > 0))) {
		  if ($t.find('ul.dropdown').length > 0) {
			if($t.hasClass('active')) {
			  $t.removeClass('active');
			} else {
			  $t.addClass('active');
			}
		  }
		}*/

		//if ($t.find('ul.dropdown').find('span').filter(':hover').is('[data-category-url]')) {
		//  window.location.href = $t.find('ul.dropdown').find('span').filter(':hover').attr('data-category-url');
		//}
	 //}
	//});

	if (typeof jQuery.ui.tabs != 'undefined' && jQuery('#categoryTabs').length > 0) {
	  if (jQuery(window).width() > 680) {
		jQuery.ui.tabs({
		  active: 0
		}, "#categoryTabs");
		//jQuery('#categoryTabs').tabs();
	  } else {
		jQuery('#overview.category-tab').addClass('active');
	  }
	}

	if (jQuery('#category-gallery').length > 0) {
	  jQuery('#category-gallery').lightSlider({
		gallery: true,
		item: 1,
		thumbItem: 3,
		slideMargin: 0,
		speed: 700,
		auto: false,
		loop: true,
		galleryMargin: 0,
		enableDrag: false,
		autoWidth: false,
		adaptiveHeight: true,
		onSliderLoad: function (el) {
		  jQuery('#category-gallery').removeClass('cS-hidden');
		  el.lightGallery({
			selector: '#category-gallery .lslide',
			download: false
		  });
		}
	  });
	}

	let $sortWrapper = jQuery('#products_list');

	let $sortPriceToggler = jQuery('#dropdown-price');
	$sortPriceToggler.find('.dropdown li').on('click', function (el) {
	  $sortPriceToggler.find('span.toggle > span').text('Price (' + el.target.innerHTML + ')');
	  setTimeout(function () {
		jQuery('.category-filter-dropdown').removeClass('active');
	  }, 500);
	  if(el.target.dataset.sortby == 'asc') {
		$sortWrapper.find('li').sort(function(a, b) {
		  return +a.dataset.sorterprice - +b.dataset.sorterprice;
		}).appendTo($sortWrapper);
	  } else {
		$sortWrapper.find('li').sort(function(a, b) {
		  return +b.dataset.sorterprice - +a.dataset.sorterprice;
		}).appendTo($sortWrapper);
	  }
	});

	let $sortColorToggler = jQuery('#dropdown-color');
	$sortColorToggler.find('.dropdown li').on('click', function (el) {
	  $sortColorToggler.find('span.toggle > span').text('Color (' + el.target.innerHTML + ')');
	  setTimeout(function () {
		jQuery('.category-filter-dropdown').removeClass('active');
	  }, 500);
	  if(el.target.dataset.sortby == 'darker') {
		$sortWrapper.find('li').sort(function(a, b) {
		  return +b.dataset.sortercolor - +a.dataset.sortercolor;
		}).appendTo($sortWrapper);
	  } else {
		$sortWrapper.find('li').sort(function(a, b) {
		  return +a.dataset.sortercolor - +b.dataset.sortercolor;
		}).appendTo($sortWrapper);
	  }
	});

	$sortColorToggler.find('ul > li:first').click();

	let $sortStyleToggler = jQuery('#dropdown-style');
	$sortStyleToggler.find('.dropdown li').on('click', function (el) {
	  $sortStyleToggler.find('span.toggle > span').text('Style (' + el.target.innerHTML + ')');
	  setTimeout(function () {
		jQuery('.category-filter-dropdown').removeClass('active');
	  }, 500);
	  if(el.target.innerHTML == 'All') {
		$sortWrapper.find('li').show();
	  } else {
		$sortWrapper.find('li').hide();
		$sortWrapper.find('li[data-sorterstyle="'+el.target.innerHTML+'"]').show();
	  }
	});

	let $sortConstructionToggler = jQuery('#dropdown-construction');
	$sortConstructionToggler.find('.dropdown li').on('click', function (el) {
	  $sortConstructionToggler.find('span.toggle > span').text('Cabinet Construction (' + el.target.innerHTML + ')');
	  setTimeout(function () {
		jQuery('.category-filter-dropdown').removeClass('active');
	  }, 500);
	  if(el.target.innerHTML == 'All') {
		$sortWrapper.find('li').show();
	  } else {
		$sortWrapper.find('li').hide();
		$sortWrapper.find('li[data-sorterconstruction="'+el.target.innerHTML+'"]').show();
	  }
	});

	if(screen.width < 680 && jQuery('.products.wrapper.list').hasClass('products-list')) {
	  jQuery('.products.wrapper.list').removeClass('products-list').addClass('products-grid');
	}
  });

  jQuery(document).scroll(function () {
	var y = jQuery(this).scrollTop();
	if (y > 30) {
	  jQuery('.page-header').addClass('sticky');
	} else {
	  jQuery('.page-header').removeClass('sticky');
	}
	if (y > 800) {
	  jQuery('#backTop').fadeIn();
	} else {
	  jQuery('#backTop').fadeOut();
	}
  });

  jQuery('#newsletter-validate-detail').on('submit', function () {
	if(jQuery(this).valid()) {
	  console.log('datalayer even subscription is fired');
	  //dataLayer.push({event: 'subscription'});
	  gtag('event', 'sent', {
		'event_category': 'subscription'
	  });
	}
  });

  jQuery('#amform-form-6').on('submit', function () {
	if(jQuery(this).valid()) {
	  console.log('datalayer even free_design is fired');
	  //dataLayer.push({event: 'free_design'});
	  gtag('event', 'sent', {
		'event_category': 'free_design'
	  });
	}
  });

  jQuery('#amform-form-7').on('submit', function () {
	if(jQuery(this).valid()) {
	  console.log('datalayer even get_quote is fired');
	  //dataLayer.push({event: 'get_quote'});
	  gtag('event', 'sent', {
		'event_category': 'get_quote'
	  });
	}
  });
});
