<?php
	
	/* Featured image
	------------------------------------------------------------------ */
	
	add_theme_support( 'post-thumbnails' );

	/* Title tag
	------------------------------------------------------------------ */

	add_theme_support( 'title-tag' );

	/* Site logo
	------------------------------------------------------------------ */

	add_theme_support( 'custom-logo', array(
		'height'     		 => 100,
		'width'       		=> 400,
		'flex-height' 		=> true,
		'flex-width'  		=> true,
		'update_button'		=> __('Update', 'laybackparent'),
		'header-text' 		=> array( 'site-title', 'site-description' ),
	) );

	/* HTML5 support
	------------------------------------------------------------------ */

	add_theme_support( 'html5', array( 'gallery' ) );

	/* Custimizer refresh widgets
	------------------------------------------------------------------ */

	add_theme_support( 'customize-selective-refresh-widgets' );

	/* RSS
	------------------------------------------------------------------ */
	add_theme_support( 'automatic-feed-links' );

	/* Menu separator
	------------------------------------------------------------------ */

	add_action( 'admin_menu', function () {
	    $position = 997;
	    global $menu;
	    $separator = [
	        0 => '',
	        1 => 'read',
	        2 => 'separator' . $position,
	        3 => '',
	        4 => 'wp-menu-separator'
	    ];
	    if (isset($menu[$position])) {
	        $menu = array_splice($menu, $position, 0, $separator);
	    } else {
	        $menu[$position] = $separator;
	    }
	});