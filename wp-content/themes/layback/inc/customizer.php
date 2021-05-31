<?php 

	/* General settings in customizer
	------------------------------------------------------------------ */

	add_action('customize_register', 'layback_customizer_register');
	function layback_customizer_register( $wp_customize )
	{


		/* Add panel
		------------------------------------------------------------------ */
		$wp_customize->add_panel(
			'layback_theme_panel',
			array(
				'priority'       => 30,
				'capability'     => 'edit_theme_options',
				'title'          => __('Company details', 'laybackparent'),
				'description'    => __('Company information', 'laybackparent'),
			)
		);

		require_once('customizer/contact.php');
		require_once('customizer/social.php');
		require_once('customizer/pages.php');
		require_once('customizer/scripts.php');

	}