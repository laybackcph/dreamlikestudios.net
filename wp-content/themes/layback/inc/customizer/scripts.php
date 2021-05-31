<?php
	
	/* Add section
	------------------------------------------------------------------ */

	$wp_customize->add_section(
		'ltw_scripts_section', 
		array(
			'title'       => __( 'Scripts', 'layback' ),
			'priority'    => 30,
			'capability'  => 'edit_theme_options',
			// 'panel'  		=> 'ltw_company_details',
			// 'description' => __('Social media', 'Layback'),
		) 
	);

	/* Add header script textarea
	------------------------------------------------------------------ */

	$wp_customize->add_setting(
		'ltw_header_script',
		array(
			'default' 		=> '',
			// 'type' 			=> 'option',
			'transport' 	=> 'refresh',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Control(
			$wp_customize,
			'',
			array(
				'type' 			=> 'textarea',
				'label' 		=> __( 'Header script', 'layback' ),
				'description' 	=> __( '', 'layback'),
				'section' 		=> 'ltw_scripts_section',
				'priority' 		=> 10,
			)
		)
	);

	/* Add footer script textarea
	------------------------------------------------------------------ */

	$wp_customize->add_setting(
		'ltw_body_script',
		array(
			'default' 		=> '',
			// 'type' 			=> 'option',
			'transport' 	=> 'refresh',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Control(
			$wp_customize,
			'ltw_body_script',
			array(
				'type' 			=> 'textarea',
				'label' 		=> __( 'Body (top) script', 'layback' ),
				'description' 	=> __( '', 'layback'),
				'section' 		=> 'ltw_scripts_section',
				'priority' 		=> 10,
			)
		)
	);

	/* Add footer script textarea
	------------------------------------------------------------------ */

	$wp_customize->add_setting(
		'ltw_footer_script',
		array(
			'default' 		=> '',
			// 'type' 			=> 'option',
			'transport' 	=> 'refresh',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Control(
			$wp_customize,
			'ltw_footer_script',
			array(
				'type' 			=> 'textarea',
				'label' 		=> __( 'Footer script', 'layback' ),
				'description' 	=> __( '', 'layback'),
				'section' 		=> 'ltw_scripts_section',
				'priority' 		=> 10,
			)
		)
	);