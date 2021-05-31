jQuery(document).ready(function ($){
	/* Start your javascript here
	-------------------------------------------------- */
	// const intro = jQuery('.block-video-scroll .intro');
	// const video = jQuery('.block-video-scroll video');

	const html = document.documentElement;
	const canvas = document.getElementById("hero-section");
	const context = canvas.getContext('2d');


	const controller = new ScrollMagic.Controller();

	// Scenes
	const scene = new ScrollMagic.Scene({
		duration: 9000,
		triggerElement: canvas,
		triggerHook: 0
	})
	.addIndicators()
	.setPin(canvas)
	.addTo(controller);

	// // Video animation
	// let accelamount = 0.1;	
	// let scrollpos = 0;
	// let delay = 0;

	// scene.on("update", e => {
	// 	scrollpos = e.scrollPos / 1000;
	// });

	// setInterval(() => {
	// 	delay += (scrollpos - delay) * accelamount;

	// 	video[0].currentTime = delay;
	// }, 33.3);



	// canvas.width = 1158;
	// canvas.height = 770;

	let ratio = canvas.width / canvas.height;
	let width = canvas.height * ratio;
	let height = canvas.width / ratio;

	const currentFrame = index => (
	    `https://www.apple.com/105/media/us/airpods-pro/2019/1299e2f5_9206_4470_b28e_08307a42f19b/anim/sequence/large/01-hero-lightpass/${index.toString().padStart(4, '0')}.jpg`
	)


	const preloadImages = () => {
	    for (let i = 1; i < 148; i++) {
	      	const image = new Image();
	      	image.src = currentFrame(i);
	    }
	};

	const image = new Image();
	image.src = currentFrame(1);

	image.onload = function(){
	    context.drawImage(image, 0, 0, width, height);
	}

	window.addEventListener('scroll', () => {
	    const scrollTop = html.scrollTop;
	    const maxScroll = html.scrollHeight - window.innerHeight;
	    const scrollFraction = scrollTop / maxScroll;
	    const frameIndex = Math.min(147,Math.floor(scrollFraction * 148));
	    requestAnimationFrame(() => updateImage(frameIndex+1))
	});
	  
	const updateImage = index => {
	    image.src = currentFrame(index);
	    context.drawImage(image, 0, 0, width, height);
	}

	preloadImages()
});