<?php

	/* i18n support
	------------------------------------------------------------------ */

	add_action('wp_footer', 'lb_mobile_ui');
	function lb_mobile_ui(){
		
		get_template_part( 'partials/mobile-ui');
		
	}