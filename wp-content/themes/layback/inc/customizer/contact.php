<?php
	
	/* Add section
	------------------------------------------------------------------ */

	$wp_customize->add_section(
		'layback_contact_section', 
		array(
			'title'       => __( 'Contact details', 'laybackparent' ),
			'priority'    => 20,
			'capability'  => 'edit_theme_options',
			'panel'  		=> 'layback_theme_panel',
			'description' => __('Company details', 'Layback'),
		) 
	);

	/* Add name
	------------------------------------------------------------------ */

	$wp_customize->add_setting(
		'company',
		array(
			'default' 		=> '',
			'transport' 	=> 'refresh',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Control(
			$wp_customize,
			'company',
			array(
				'type' 			=> 'text',
				'label' 		=> __( 'Company', 'laybackparent' ),
				'description' 	=> __( '', 'laybackparent'),
				'section' 		=> 'layback_contact_section',
				'priority' 		=> 10,
			)
		)
	);

	/* Add vat no.
	------------------------------------------------------------------ */

	$wp_customize->add_setting(
		'cvr',
		array(
			'default' 		=> '',
			'transport' 	=> 'refresh',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Control(
			$wp_customize,
			'cvr',
			array(
				'type' 			=> 'text',
				'label' 		=> __( 'Vat no.', 'laybackparent' ),
				'description' 	=> __( '', 'laybackparent'),
				'section' 		=> 'layback_contact_section',
				'priority' 		=> 20,
			)
		)
	);

	/* Add phone text
	------------------------------------------------------------------ */

	$wp_customize->add_setting(
		'phone',
		array(
			'default' 		=> '',
			'transport' 	=> 'refresh',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Control(
			$wp_customize,
			'phone',
			array(
				'type' 			=> 'text',
				'label' 		=> __( 'Phone', 'laybackparent' ),
				'description' 	=> __( '', 'laybackparent'),
				'section' 		=> 'layback_contact_section',
				'priority' 		=> 30,
			)
		)
	);

	/* Add email text
	------------------------------------------------------------------ */

	$wp_customize->add_setting(
		'mail',
		array(
			'default' 		=> '',
			'transport' 	=> 'refresh',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Control(
			$wp_customize,
			'mail',
			array(
				'type' 			=> 'email',
				'label' 		=> __( 'Mail', 'laybackparent' ),
				'description' 	=> __( '', 'laybackparent'),
				'section' 		=> 'layback_contact_section',
				'priority' 		=> 40,
			)
		)
	);


	/* Add address section
	------------------------------------------------------------------ */

	$wp_customize->add_section(
		'layback_company_address', 
		array(
			'title'       => __( 'Address', 'laybackparent' ),
			'priority'    => 20,
			'capability'  => 'edit_theme_options',
			'panel'  		=> 'layback_theme_panel',
			'description' => __('Company details', 'Layback'),
			'description_hidden' => true,
		) 
	);

	/* Add streetname
	------------------------------------------------------------------ */

	$wp_customize->add_setting(
		'street',
		array(
			'default' 		=> '',
			'transport' 	=> 'refresh',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Control(
			$wp_customize,
			'street',
			array(
				'type' 			=> 'text',
				'label' 		=> __( 'Street', 'laybackparent' ),
				'description' 	=> __( '', 'laybackparent'),
				'section' 		=> 'layback_company_address',
				'priority' 		=> 10,
			)
		)
	);

	/* Add zip
	------------------------------------------------------------------ */

	$wp_customize->add_setting(
		'zip',
		array(
			'default' 		=> '',
			'transport' 	=> 'refresh',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Control(
			$wp_customize,
			'zip',
			array(
				'type' 			=> 'number',
				'label' 		=> __( 'Zip', 'laybackparent' ),
				'description' 	=> __( '', 'laybackparent'),
				'section' 		=> 'layback_company_address',
				'priority' 		=> 10,
			)
		)
	);

	/* Add city
	------------------------------------------------------------------ */
	
	$wp_customize->add_setting(
		'city',
		array(
			'default' 		=> '',
			'transport' 	=> 'refresh',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Control(
			$wp_customize,
			'city',
			array(
				'type' 			=> 'text',
				'label' 		=> __( 'City', 'laybackparent' ),
				'description' 	=> __( '', 'laybackparent'),
				'section' 		=> 'layback_company_address',
				'priority' 		=> 10,
			)
		)
	);

	/* Add state
	------------------------------------------------------------------ */
	
	$wp_customize->add_setting(
		'state',
		array(
			'default' 		=> '',
			'transport' 	=> 'refresh',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Control(
			$wp_customize,
			'state',
			array(
				'type' 			=> 'text',
				'label' 		=> __( 'State', 'laybackparent' ),
				'description' 	=> __( '', 'laybackparent'),
				'section' 		=> 'layback_company_address',
				'priority' 		=> 10,
			)
		)
	);

	/* Add country
	------------------------------------------------------------------ */
	
	$wp_customize->add_setting(
		'country',
		array(
			'default' 		=> 'Danmark',
			'transport' 	=> 'refresh',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Control(
			$wp_customize,
			'country',
			array(
				'type' 			=> 'text',
				'label' 		=> __( 'Country', 'laybackparent' ),
				'description' 	=> __( '', 'laybackparent'),
				'section' 		=> 'layback_company_address',
				'priority' 		=> 10,
			)
		)
	);