<?php

	
	/* Tasks when activating our theme
	------------------------------------------------------------------ */

	add_action( 'after_setup_theme', 'the_theme_setup' );
	function the_theme_setup()
	{
		// First we check to see if our default theme settings have been applied.
		$the_theme_status = get_option( 'theme_setup_status' );
		
		// If the theme has not yet been used we want to run our default settings.
		if ( $the_theme_status !== '1' )
		{
			$core_settings = array();

			foreach ( $core_settings as $k => $v ) {
				update_option( $k, $v );
			}

			// Delete dummy post, page and comment.
			wp_delete_post( 1, true );
			wp_delete_post( 2, true );
			wp_delete_comment( 1 );

			// Disable admin bar by default
			update_user_meta( $user_id = 1, 'show_admin_bar_front', $adminbar = false );

			// Change permalinks to "name on post"
			add_action( 'init', 'reset_permalinks' );
			function reset_permalinks() {
			    global $wp_rewrite;
			    $wp_rewrite->set_permalink_structure( '/%postname%/' );
			}
			
			// create new page
			$new_page_title = 'Forside';
			$new_page_template = '';
			$page_check = get_page_by_title($new_page_title);
			$new_page = array(
				'post_type' => 'page',
				'post_title' => $new_page_title,
				'post_content' => 'Some content',
				'post_status' => 'publish',
				'post_author' => 1,
			);

			if(!isset($page_check->ID)){
				$new_page_id = wp_insert_post($new_page);
				if(!empty($new_page_template)){
					update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
				}
			}

			// Once done, we register our setting to make sure we don't duplicate everytime we activate.
			update_option( 'theme_setup_status', '1' );
			
			// Lets let the admin know whats going on.
			add_action( 'admin_notices', 'lb_admin_notices_reactivate' );
			$msg = '<div class="updated"><p>Tillykke! ' . get_option( 'current_theme' ) . 's tema er installeret og har nulstillet din side.</p></div>';

			// Change reading option to static page
			$homepage = get_page_by_title('Forside');

			if ( $homepage ){
			    update_option( 'page_on_front', $homepage->ID );
			    update_option( 'show_on_front', 'page' );
			}

		}

		// Else if we are re-activing the theme
		elseif ( $the_theme_status === '1' and isset( $_GET['activated'] ) ) {
			$msg = '<div class="updated"><p>Sådan! ' . get_option( 'current_theme' ) . ' er gen-aktiveret.</p></div>';
			add_action( 'admin_notices', 'lb_admin_notices_reactivate' );
		}

		// disable color scheme adminpanel
		// remove_action( 'admin_color_scheme_picker', 'admin_color_scheme_picker' );
	}

	function lb_admin_notices_activate($msg){
		$msg = '<div class="updated"><p>Tillykke! ' . get_option( 'current_theme' ) . 's tema er installeret og har nulstillet din side.</p></div>';
		echo addcslashes( $msg, '"' );
	}

	function lb_admin_notices_reactivate($msg){
		$msg = '<div class="updated"><p>Sådan! ' . get_option( 'current_theme' ) . ' er gen-aktiveret.</p></div>';
		echo addcslashes( $msg, '"' );
	}
