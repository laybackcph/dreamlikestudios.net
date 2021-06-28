jQuery(document).ready(function ($){
	/* Start your javascript here
	-------------------------------------------------- */
	// 2. This code loads the IFrame Player API code asynchronously.
    let tag = document.createElement('script');

    tag.src = "https://www.youtube.com/iframe_api";
    let firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

      // 3. This function creates an <iframe> (and YouTube player)
      //    after the API code downloads.
    let player;

    (async() => {
	    while(!window.hasOwnProperty("YT")) // define the condition as you like
	        await new Promise(resolve => setTimeout(resolve, 1000));
    	onYouTubeIframeAPIReady();
	})();

    function onYouTubeIframeAPIReady() 
    {
        player = new YT.Player('player', {
          	height: '390',
          	width: '640',
          	videoId: 'eW_00xWZNIE',
          	playerVars: {
            	'playsinline': 1,
            	'controls': 0,
          		'listType': 'playlist',
            	'rel': 0
          	},
          	events: {
            	'onReady': onPlayerReady,
            	'onStateChange': onPlayerStateChange
          	}
        });
    }

    // 4. The API will call this function when the video player is ready.
    function onPlayerReady(event) 
    {
        player.playVideo();
    }

    // 5. The API calls this function when the player's state changes.
    //    The function indicates that when playing a video (state=1),
    //    the player should play for six seconds and then stop.
    let done = false;
    function onPlayerStateChange(event) 
    {
        if (event.data == YT.PlayerState.PLAYING && !done) 
        {
          	stopVideo;
          	done = true;
        }
    }

    function stopVideo() 
    {
        player.pauseVideo();
    }

    function playVideo() 
    {
        player.playVideo();
    }


	function openFullscreen(elem) 
	{
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
			if(jQuery(element[i]).find('video').length)
			{
		        jQuery(element[i]).find('video')[0].play();
		    }
			if(jQuery(element[i]).find('iframe').length)
			{
				playVideo();
			}
	    })
		.on('leave', function () {
			if(jQuery(element[i]).find('video').length)
			{
	        	jQuery(element[i]).find('video')[0].pause();
			}
			if(jQuery(element[i]).find('iframe').length)
			{
				stopVideo();
			}
	    })
		.setTween(tween)
		.setPin(element[i])
		.addTo(controller);
	}
});