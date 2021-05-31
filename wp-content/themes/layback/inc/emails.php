<?php 
	
	/* Disable admin e-mail verification for WordPress 5.3+
	------------------------------------------------------------------ */
	
	add_filter( 'admin_email_check_interval', '__return_false' );