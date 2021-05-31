<?php

	/* Changing the origin wordpress logo to the logo uploaded in WordPress Customizer
	------------------------------------------------------------------ */

	// add_action( 'login_enqueue_scripts', 'layback_login_screen' );
	function layback_login_screen() { ?>
	    <style type="text/css">
	        #login h1 a,
	        .login h1 a{
				
				<?php if(get_theme_mod( 'custom_logo' ) != false) { ?>
					background-image: url(<?php echo wp_get_attachment_url(get_theme_mod( 'custom_logo' )); ?>);
					background-repeat: no-repeat;
					background-size: contain;
					width: 100%;
				<?php } ?>
	        }

	        #backtoblog,
	        #nav{
	        	text-align: center;
	        }
	        .login .privacy-policy-page-link{
	        	margin: 0em 0 2em !important;
	        }
	    </style>
	<?php }

	/* Remove logo title
	------------------------------------------------------------------ */

	add_filter( 'login_headertext', 'my_login_logo_url_title' );
	function my_login_logo_url_title() {
	    return false;
	}

	/* Remove logo link
	------------------------------------------------------------------ */

	add_filter( 'login_headerurl', 'my_login_logo_url' );
	function my_login_logo_url() {
	    return home_url();
	}