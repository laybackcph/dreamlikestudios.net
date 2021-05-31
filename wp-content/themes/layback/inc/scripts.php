<?php

	/* Scripts included in the wp_footer();
	------------------------------------------------------------------ */

	add_action( 'wp_footer', 'script_in_footer', 100);
	function script_in_footer()
	{
		if(get_option('footer_scripts')){
			
			$script = get_option('footer_scripts');
			echo stripslashes($script);
		
		}else{
			
			$script = get_theme_mod('ltw_footer_script');
			echo stripslashes($script);

		}

	}

	/* Scripts included in the wp_head();
	------------------------------------------------------------------ */
	
	add_action( 'wp_head', 'script_in_header');
	function script_in_header()
	{

		if(get_option('footer_scripts')){
			
			$script = get_option('header_scripts');
			echo stripslashes($script);

		}else{

			$script = get_theme_mod('ltw_header_script');
			echo stripslashes($script);

		}

	}