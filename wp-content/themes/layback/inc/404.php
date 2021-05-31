<?php
	
	/* 404 redircts
	------------------------------------------------------------------ */
	
	function redirect_404_to_parent() {
	    if( is_404() ) :
	        $req = $_SERVER['REQUEST_URI'];
	        if ( is_file( $req )) {
	            return;
	        }
	        $base_dir = dirname( $req );
	        $parent_url = site_url( $base_dir ) . '?utm_source=Intern&utm_medium=404&utm_campaign=404%20tracking';
	        wp_redirect( $parent_url, 301 );
	        exit();
	    endif;
	}
	add_action( 'template_redirect', 'redirect_404_to_parent' );