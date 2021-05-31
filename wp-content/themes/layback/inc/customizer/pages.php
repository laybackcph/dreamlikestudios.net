<?php 

	/* Add section
	------------------------------------------------------------------ */

	$wp_customize->add_section(
		'layback_pages_section', 
		array(
			'title'       => __( 'Pages', 'laybackparent' ),
			'priority'    => 40,
			'capability'  => 'edit_theme_options',
			'panel'  		=> 'layback_theme_panel',
			'description' => __('Choose pages for specific purposes', 'Layback'),
		) 
	);

	/* Add terms
	------------------------------------------------------------------ */

	$wp_customize->add_setting(
		'terms',
		array(
			'default' 		=> '',
			'transport' 	=> 'refresh',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Control(
			$wp_customize,
			'terms',
			array(
				'label' 		=> __( 'Terms', 'laybackparent' ),
				'description' 	=> __( 'Choose the page for your terms', 'laybackparent'),
				'section' 		=> 'layback_pages_section',
				'type' 			=> 'dropdown-pages',
				'priority' 		=> 10,
			)
		)
	);