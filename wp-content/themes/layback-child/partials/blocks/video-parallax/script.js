jQuery(document).ready(function ($){
	/* Start your javascript here
	-------------------------------------------------- */
	function openFullscreen(elem) {
		if (elem.requestFullscreen) 
		{
		    elem.requestFullscreen();
		} 
		else if (elem.webkitRequestFullscreen) /* Safari */
		{ 
		    elem.webkitRequestFullscreen();
		} 
		else if (elem.msRequestFullscreen) /* IE11 */
		{ 
		    elem.msRequestFullscreen();
		}
	}

	let w = window.innerWidth;
  	let triggerWidth = w > 768 ? 0.1 : 0.3;
  	let durationWidth = w > 768 ? 2000 : 1000;

	const element = jQuery('.block-video-parallax');
	const controller = new ScrollMagic.Controller();

	jQuery('.block-video-parallax video').on('dblclick', function() {
		openFullscreen(this);
	});

	let tween = TweenMax.to(".block-video-parallax img", 1, {scale:3, opacity:0, ease:Linear.easeNone});

	// Scenes
	for (let i=0; i<element.length; i++) { // create a scene for each element
		const scene = new ScrollMagic.Scene({
			duration: durationWidth,
			triggerElement: element[i],
			triggerHook: triggerWidth
		})
		// .addIndicators()
		.on('enter', function () {
	        jQuery(element[i]).find('video')[0].play();
	    })
		.on('leave', function () {
	        jQuery(element[i]).find('video')[0].pause();
	    })
		.setTween(tween)
		.setPin(element[i])
		.addTo(controller);
	}
});