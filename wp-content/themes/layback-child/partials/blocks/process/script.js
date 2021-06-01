jQuery(document).ready(function ($){
	/* Start your javascript here
	-------------------------------------------------- */
	let controller = new ScrollMagic.Controller();

	let revealElements = jQuery('.block-process .process-single');
	for (let i=0; i<revealElements.length; i++) { // create a scene for each element
		let scene = new ScrollMagic.Scene({
			triggerElement: revealElements[i], // y value not modified, so we can use element as trigger as well
			offset: 50,						   // start a little later
			triggerHook: 0.9
		})
		.setClassToggle(revealElements[i], "visible") // add class toggle
		.addTo(controller);
	}
});