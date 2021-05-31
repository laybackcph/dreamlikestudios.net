<?php
	function lb_enqueue_admin_styles()
	{
		wp_enqueue_style( 'lb_admin_styles', get_stylesheet_directory_uri() . '/lib/css/admin.css', false, '1.0.0' );
	}
	add_action('admin_enqueue_scripts', 'lb_enqueue_admin_styles');

	//Removes the meta boxes on admin dashboard
	add_action( 'wp_dashboard_setup', 'lb_add_dashboard_widgets' );
	function lb_add_dashboard_widgets()
	{

		remove_action('welcome_panel', 'wp_welcome_panel');
		remove_meta_box('dashboard_recent_drafts', 'dashboard', 'normal');
		remove_meta_box('dashboard_activity', 'dashboard', 'normal');
		remove_meta_box('wpseo-dashboard-overview', 'dashboard', 'normal');
		remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
		remove_meta_box('dashboard_primary', 'dashboard', 'side');

		// remove_meta_box('dashboard_right_now', 'dashboard', 'normal');

		// Woocommerce
//		remove_meta_box( 'woocommerce_dashboard_status', 'dashboard', 'normal');

		// Disabled
//		remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
//		remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');
//		remove_meta_box('dashboard_plugins', 'dashboard', 'normal');
	}
	

	// Add role class to body
//	add_filter('body_class','add_role_to_body');
//	add_filter('admin_body_class', 'add_role_to_body');
	function add_role_to_body($classes) {
		if(is_admin()){
			global $current_user;
			$user_role = array_shift($current_user->roles);

			$classes .= 'role-'. $user_role;
			$classes .= ' user_id-'. $current_user->ID;
		}

		return $classes;
	}