<?php
	//credit: http://wordpress.stackexchange.com/questions/204607/hide-author-page-from-others/204616
	add_action( 'template_redirect', 'author_template_redirect' );
	function author_template_redirect() 
	{
		// Check if we are on author template
		if (is_author()) 
		{
			// Check if current user is logged in
			if(is_user_logged_in()) 
			{
				
				// User is logged in
				
				// Get the id of the user being displayed
				$viewing_profile_id = get_query_var('author');
				
				// Get the id of current user
				$current_user_id = get_current_user_id();
				
				// if current user and profile being displayed is not the same,
				// then redirect to current user author page
				if ($viewing_profile_id != $current_user_id) 
				{
					wp_redirect( get_author_posts_url($current_user_id));
					exit;
				}
				
			} 
			else 
			{
				// User is not logged in, redirect to login with redirect parameter
				// set to current user profile url, so the user will be redirected to
				// own profile if login is successful
				wp_redirect( esc_url( home_url() ) );
				exit;
			}
		}
	}