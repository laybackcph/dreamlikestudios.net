<?php
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

	//Remember to add .php at the end of files
	$includes_skip = array();
	$functions_skip = array();
	$shortcodes_skip = array();

	// Required files
	foreach (glob(get_template_directory().'/inc/*.php') as $includes_filename)
	{
		if(in_array(basename($includes_filename), $includes_skip))
			continue;

		require_once($includes_filename);
	}

	foreach (glob(get_template_directory().'/shortcodes/*.php') as $shortcodes_filename)
	{
		if(in_array(basename($shortcodes_filename), $shortcodes_skip))
			continue;

		require_once($shortcodes_filename);
	}

	foreach (glob(get_template_directory().'/functions/*.php') as $functions_filename)
	{
		if(in_array(basename($functions_filename), $functions_skip))
			continue;

		require_once($functions_filename);
	}

	function layback_parent_style_enqueue()
	{
	    wp_enqueue_style('layback-parent-admin', get_template_directory_uri() . '/lib/css/admin.css', array(), filemtime(get_template_directory() . '/lib/css/admin.css'));
	}
	add_action('admin_enqueue_scripts', 'layback_parent_style_enqueue');

	// local json
	function layback_acf_json_load_point( $paths ) {
	    
	    // remove original path (optional)
	    unset($paths[0]);
	    
	    
	    // append path
	    $paths[] = get_template_directory() . '/acf-local-json';
	    $paths[] = get_stylesheet_directory() . '/acf-json';
	    
	    // var_dump($paths);
	    // die();
	    
	    // return
	    return $paths;
	    
	}
	add_filter('acf/settings/load_json', 'layback_acf_json_load_point');

	// Remove console notice for backwards comp. jQuery Migrate
	add_action( 'wp_default_scripts', function( $scripts ) {
		if ( ! empty( $scripts->registered['jquery'] ) ) {
			$scripts->registered['jquery']->deps = array_diff( $scripts->registered['jquery']->deps, array( 'jquery-migrate' ) );
		}
	});

	// Add role class to body
	if(!function_exists('lb_admin_add_role_to_body'))
	{
		function lb_admin_add_role_to_body($classes) {
			if(is_admin() && get_option('options_lb_pluginsupdates') == '1'){
				if( explode('.', $_SERVER['SERVER_NAME'])[0] == 'local'){
					$classes .= ' local-site';
				} else {
					$classes .= ' live-site';
				}
			}

			return $classes;
		}
		add_filter('admin_body_class', 'lb_admin_add_role_to_body');
	}

	add_filter( 'auto_update_plugin', '__return_false' );
	add_filter( 'auto_update_theme', '__return_false' );