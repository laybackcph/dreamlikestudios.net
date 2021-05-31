<?php

	/* i18n support
	------------------------------------------------------------------ */

	add_action( 'after_setup_theme', 'lb_i18n_child_support' );
	function lb_i18n_child_support()
	{
	    load_theme_textdomain( 'layback', get_stylesheet_directory() . '/languages' );

	    $locale = get_locale();
	    $locale_file = get_stylesheet_directory() . "/languages/$locale.php";

	    if ( is_readable( $locale_file ) ) {
	        get_template_part( $locale_file );
	    }
	}