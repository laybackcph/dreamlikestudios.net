jQuery(document).ready(function ($){
	/* Mobile navigation
	------------------------------------------------------------------ */

	jQuery('#mobileicon, #mobilemenu-overlay').on('click', function () {
		jQuery('body').toggleClass('overflow');
		jQuery('body').toggleClass('open-mobilemenu');
	});

	jQuery('#mobilemenu nav ul li > span').on('click', function () {
		jQuery(this).toggleClass('open');
		jQuery(this).parent().find('.sub-menu').slideToggle(300);
	});

	jQuery('.current-menu-parent span').addClass('open');



	let controller = new ScrollMagic.Controller();

	// let revealElements = document.getElementsByClassName("game");
	let revealElements = jQuery('h2 .dots');
	for (let i=0; i<revealElements.length; i++) { // create a scene for each element
		new ScrollMagic.Scene({
			triggerElement: revealElements[i], // y value not modified, so we can use element as trigger as well
			offset: 50,						   // start a little later
			triggerHook: .8,
		})
		.setClassToggle(revealElements[i], "visible") // add class toggle
		.addTo(controller);
	}
});


jQuery(window).scroll(function () {
	scrolling();
});

scrolling();

function scrolling() {
	let scrollvalue = jQuery(window).scrollTop();
    if (scrollvalue > 100) 
    {
    	jQuery('.site-header').addClass('scrolled');
		let winScroll = document.body.scrollTop || document.documentElement.scrollTop;
		let height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
		let scrolled = (winScroll / height) * 100;
		jQuery('.scroll_line').css('width', scrolled + "%");
    }
    else
    {
    	jQuery('.site-header').removeClass('scrolled');
		jQuery('.scroll_line').css('width', "0%");
    }
}

function is_touch_device() {
	var prefixes = ' -webkit- -moz- -o- -ms- '.split(' ');
	var mq = function (query) {
		return window.matchMedia(query).matches;
	}

	if (('ontouchstart' in window) || window.DocumentTouch && document instanceof DocumentTouch) {
		return true;
	}

	// include the 'heartz' as a way to have a non matching MQ to help terminate the join
	// https://git.io/vznFH
	var query = ['(', prefixes.join('touch-enabled),('), 'heartz', ')'].join('');
	return mq(query);
}
