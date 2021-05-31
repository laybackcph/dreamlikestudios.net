<?php

	if (!isset($content_width))
	{
	    $content_width = '1140';
	}

/*
 * If you want to use date() (PHP) and not of current_time() (WP)
 * You have to uncomment the line below.
 */
//	date_default_timezone_set(get_option( 'timezone_string' )); //Current timezone selected in WP Admin
//	date_default_timezone_set('Europe/Copenhagen'); //Copenhagen timezone

	if(!function_exists('lb_is_plugin_active_for_network'))
	{
		function lb_is_plugin_active_for_network( $plugin )
		{
			if ( !is_multisite() )
				return false;

			$plugins = get_site_option( 'active_sitewide_plugins');
			if ( isset($plugins[$plugin]) )
				return true;

			return false;
		}
	}

	if(!function_exists('lb_is_plugin_active'))
	{
		function lb_is_plugin_active( $plugin )
		{
			return in_array( $plugin, (array) get_option( 'active_plugins', array() ) ) || lb_is_plugin_active_for_network( $plugin );
		}
	}

	///////////////////////////////////////////////////////////////////////
	//////////////////////////////  FUNCTIONS /////////////////////////////
	///////////////////////////////////////////////////////////////////////

	//Remember to add .php at the end of files
	$skip_functions = array(
	);

	// Required files
	foreach (glob(get_stylesheet_directory().'/inc/*.php') as $function_filename)
	{
		if(in_array(basename($function_filename), $skip_functions))
			continue;

		require_once($function_filename);
	}

	///////////////////////////////////////////////////////////////////////
	///////////////////////////////  BLOCKS ///////////////////////////////
	///////////////////////////////////////////////////////////////////////

	$block_directory = array_filter(glob(get_stylesheet_directory().'/partials/blocks/*/'), 'is_dir');

	foreach ($block_directory as $key => $directory) {
		require_once( $directory . 'block.php');
	}

	///////////////////////////////////////////////////////////////////////
	//////////////////////////////  BODY TAG //////////////////////////////
	///////////////////////////////////////////////////////////////////////
	
	function lb_after_body_tag()
	{

		if(get_option('body_top_scripts')){
			
			$script = get_option('body_top_scripts');
			echo stripslashes($script);
		
		}else{
			
			$script = get_theme_mod('ltw_body_script');
			echo stripslashes($script);

		}
		
	}
	add_action('lb_after_body_tag', 'lb_after_body_tag');