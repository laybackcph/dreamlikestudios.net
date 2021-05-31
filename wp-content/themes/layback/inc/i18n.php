<?php

	/* i18n support
	------------------------------------------------------------------ */

	function i18n_support() {
	    load_theme_textdomain( 'laybackparent', get_template_directory() . '/languages' );

	    $locale = get_locale();
	    $locale_file = get_template_directory() . "/languages/$locale.php";

	    if ( is_readable( $locale_file ) ) {
	        get_template_part( $locale_file );
	    }
	}
	add_action( 'after_setup_theme', 'i18n_support' );