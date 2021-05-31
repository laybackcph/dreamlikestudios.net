<?php
	
	
	/* Changing the title tag if localhost
	------------------------------------------------------------------ */

	$serverinfo = $_SERVER;
	$addr = $serverinfo['SERVER_ADDR'];

	if($addr == '::1' || $addr == '127.0.0.1' )
	{


		if(in_array('wordpress-seo/wp-seo.php', apply_filters('active_plugins', get_option('active_plugins'))))
		{ 

			add_filter('wpseo_title', 'lb_change_wpseo_local_title'); 			// on the website
			add_filter('admin_title', 'lb_change_wpseo_local_title'); 			// In wp-admin
			function lb_change_wpseo_local_title($title) {
				
				$title = 'localhost: ' . $title;
				
				return $title;

			}

			

		}else{

			add_filter('pre_get_document_title', 'lb_change_local_title'); 		// on the website
			add_filter('admin_title', 'lb_change_local_title'); 				// In wp-admin
			function lb_change_local_title($title)
			{

				if( is_archive() || is_category() || is_tax() )
				{

					$title = get_the_archive_title();

				} else if( is_home() ){

					$title = __('Blog', 'layback-parent');

				}else{

					$title = get_the_title();

				}

				$new_title = 'localhost: ' . $title;

				return $new_title;

			}

		}

	}