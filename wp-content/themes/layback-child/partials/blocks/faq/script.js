jQuery(document).ready(function ($){
	/* Start your javascript here
	-------------------------------------------------- */
	let controller = new ScrollMagic.Controller();

	let revealElements = jQuery('.block-faq .accordion li');
	for (let i=0; i<revealElements.length; i++) { // create a scene for each element
		new ScrollMagic.Scene({
			triggerElement: revealElements[i], // y value not modified, so we can use element as trigger as well
			offset: 50,						   // start a little later
			triggerHook: .9
		})
		.setClassToggle(revealElements[i], "visible") // add class toggle
		.addTo(controller);
	}



	jQuery('.accordion .open').children('.accordion--content').slideDown();
	jQuery('.accordion--headline').on('click', function(){
	  let oThis = jQuery(this),
	      li = oThis.closest('li'),
	      open = oThis.closest('.accordion').find('li.open').not(li);

	  //Close open accordions
	  open.children('.accordion--content').slideUp();
	  open.removeClass('open');
	 
	  //Open selected accordion
	  li.toggleClass('open');
	  oThis.next('.accordion--content').slideToggle();
	});
});