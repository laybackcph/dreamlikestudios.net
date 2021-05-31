jQuery(document).ready(function ($){
	/* Start your javascript here
	-------------------------------------------------- */
	let controller = new ScrollMagic.Controller();

	let revealElements = jQuery('#our-projects');
	for (let i=0; i<revealElements.length; i++) { // create a scene for each element
		new ScrollMagic.Scene({
			triggerElement: revealElements[i], // y value not modified, so we can use element as trigger as well
			offset: 50,						   // start a little later
			triggerHook: 0.9,
		})
		.setClassToggle(revealElements[i], "visible") // add class toggle
		.addTo(controller);
	}

	// Slider
	jQuery('.block-projects #our-projects').slick({
		slidesToShow: 3,
		slidesToScroll: 1,
		arrows: true,
		dots: false,
		infinite: true,
		focusOnSelect: true,
		responsive: [
		    {
		      breakpoint: 1025,
		      settings: {
		        slidesToShow: 2,
		      }
		    },
		    {
		      breakpoint: 577,
		      settings: {
		        slidesToShow: 1,
		      }
		    }
		]
	});


	jQuery('.block-projects .slick-prev').html('<i class="far fa-chevron-left"></i>');
	jQuery('.block-projects .slick-next').html('<i class="far fa-chevron-right"></i>');
});