<?php

	/* Fix for getting back the ability to add admin users, when WooCommerce is installed
	------------------------------------------------------------------ */

	add_action( 'admin_init', 'fix_add_new_user_bug');
	function fix_add_new_user_bug() {

		$user = wp_get_current_user();
		$allowed_roles = array('administrator');

		if( ! array_intersect($allowed_roles, $user->roles ) ) { 
	        return;
	    }
	    
	    remove_filter( 'editable_roles', 'wc_modify_editable_roles' );
	    remove_filter( 'map_meta_cap', 'wc_modify_map_meta_cap', 10 );

	}